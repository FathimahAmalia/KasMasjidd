<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    public function index()
    {
        return view('donasi.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'jumlah' => 'required|numeric|min:5000',
            'jenis_donasi' => 'required|in:masjid,sosial',
            'pesan' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Set Midtrans Configuration
        $serverKey = config('services.midtrans.server_key');
        
        if (empty($serverKey)) {
            return back()->with('error', 'Sistem pembayaran belum dikonfigurasi (Server Key hilang). Hubungi Admin.');
        }

        \Midtrans\Config::$serverKey = $serverKey;
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = 'DONASI-' . uniqid();

        $donasi = Donasi::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jumlah' => $request->jumlah,
            'jenis_donasi' => $request->jenis_donasi,
            'pesan' => $request->pesan,
            'status' => 'pending',
            'transaction_id' => $orderId,
        ]);

        // Create Transaction for Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->jumlah,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->telepon,
            ],
            'item_details' => [
                [
                    'id' => 'DONASI-' . strtoupper($request->jenis_donasi),
                    'price' => (int) $request->jumlah,
                    'quantity' => 1,
                    'name' => 'Donasi ' . ucfirst($request->jenis_donasi),
                ]
            ]
        ];

        try {
            // Get Snap Payment Page URL
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            // Redirect ke halaman konfirmasi dengan snap token
            return redirect()->route('donasi.konfirmasi', ['id' => $donasi->id, 'snap_token' => $snapToken])
                            ->with('success', 'Donasi berhasil diajukan! Silakan selesaikan pembayaran.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function konfirmasi($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('donasi.konfirmasi', compact('donasi'));
    }

    public function list()
    {
        $donasi = Donasi::latest()->paginate(10);
        return view('donasi.list', compact('donasi'));
    }

    public function checkStatus($id)
    {
        $donasi = Donasi::findOrFail($id);
        
        // Midtrans Config
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            $status = \Midtrans\Transaction::status($donasi->transaction_id);
            $transaction = $status->transaction_status;
            $type = $status->payment_type;
            $fraud = $status->fraud_status;

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $donasi->update(['status' => 'challenge']);
                    } else {
                        $this->successPayment($donasi);
                    }
                }
            } else if ($transaction == 'settlement') {
                $this->successPayment($donasi);
            } else if ($transaction == 'pending') {
                $donasi->update(['status' => 'pending']);
            } else if ($transaction == 'deny') {
                $donasi->update(['status' => 'failed']);
            } else if ($transaction == 'expire') {
                $donasi->update(['status' => 'expired']);
            } else if ($transaction == 'cancel') {
                $donasi->update(['status' => 'cancelled']);
            }

            return back()->with('success', 'Status donasi berhasil diperbarui: ' . $donasi->status);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal cek status Midtrans: ' . $e->getMessage());
        }
    }

    private function successPayment($donasi)
    {
        if ($donasi->status == 'success') {
            return;
        }

        $donasi->update([
            'status' => 'success',
            'tanggal_donasi' => \Carbon\Carbon::now() 
        ]);

        // Insert ke Kas (Code duplication from NotificationController - ideal to refactor to Service/Model)
        if ($donasi->jenis_donasi == 'masjid') {
            \App\Models\PemasukanMasjid::create([
                'tanggal' => \Carbon\Carbon::now(),
                'sumber_dana' => 'Donasi Online - ' . $donasi->nama,
                'nominal' => $donasi->jumlah,
                'keterangan' => $donasi->pesan ?? 'Donasi Manual Check (' . $donasi->transaction_id . ')'
            ]);
        } else {
             \App\Models\PemasukanSosial::create([
                'tanggal' => \Carbon\Carbon::now(),
                'sumber_dana' => 'Donasi Online - ' . $donasi->nama,
                'jumlah' => $donasi->jumlah,
                'keterangan' => $donasi->pesan ?? 'Donasi Manual Check (' . $donasi->transaction_id . ')'
            ]);
        }
    }
}
