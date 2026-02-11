<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\PemasukanMasjid;
use App\Models\PemasukanSosial;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Notification;

class NotificationController extends Controller
{
    public function handle(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return response(['message' => 'Notification content is invalid'], 400);
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $donasi = Donasi::where('transaction_id', $order_id)->first();

        if (!$donasi) {
            return response(['message' => 'Donation not found'], 404);
        }

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

        return response(['message' => 'Notification processed'], 200);
    }

    private function successPayment($donasi)
    {
        // Cek jika status sudah success sebelumnya agar tidak double entry
        if ($donasi->status == 'success') {
            return;
        }

        $donasi->update([
            'status' => 'success',
            'tanggal_donasi' => Carbon::now() 
        ]);

        // Masukkan ke buku kas (Pemasukan)
        if ($donasi->jenis_donasi == 'masjid') {
            PemasukanMasjid::create([
                'tanggal' => Carbon::now(),
                'sumber_dana' => 'Donasi Online - ' . $donasi->nama,
                'nominal' => $donasi->jumlah,
                'keterangan' => $donasi->pesan ?? 'Donasi via Midtrans (' . $donasi->transaction_id . ')'
            ]);
        } else {
             PemasukanSosial::create([
                'tanggal' => Carbon::now(),
                'sumber_dana' => 'Donasi Online - ' . $donasi->nama,
                'jumlah' => $donasi->jumlah,
                'keterangan' => $donasi->pesan ?? 'Donasi via Midtrans (' . $donasi->transaction_id . ')'
            ]);
        }
    }
}
