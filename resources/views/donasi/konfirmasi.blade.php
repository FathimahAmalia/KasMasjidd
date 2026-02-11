<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selesaikan Donasi - Masjid Nabawi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --success: #10b981;
            --dark: #0f172a;
            --light: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        .receipt-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            position: relative;
        }

        .receipt-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .receipt-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 24px 24px 0 0;
        }

        .receipt-body {
            padding: 30px;
        }

        .amount-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .amount-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .amount-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -1px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 0.95rem;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #64748b;
        }

        .info-value {
            font-weight: 600;
            color: var(--dark);
            text-align: right;
        }

        .btn-pay {
            background: var(--dark);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            background: #1e293b;
        }

        .btn-back {
            background: transparent;
            color: #64748b;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--primary);
        }

        .success-icon {
            background: rgba(255,255,255,0.2);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2.5rem;
            backdrop-filter: blur(5px);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="receipt-card">
        <div class="receipt-header">
            <div class="success-icon">
                <i class="bi bi-heart-fill"></i>
            </div>
            <h3 class="fw-bold mb-1">Terima Kasih!</h3>
            <p class="mb-0 opacity-75">Niat baik Anda telah dicatat.</p>
        </div>

        <div class="receipt-body">
            <div class="amount-display">
                <div class="amount-label">Total Donasi</div>
                <div class="amount-value">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</div>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill mt-2">
                    {{ $donasi->jenis_donasi == 'masjid' ? 'Kas Masjid' : 'Kas Sosial' }}
                </span>
            </div>

            <div class="bg-light p-4 rounded-4 mb-4">
                <div class="info-row">
                    <span class="info-label">ID Transaksi</span>
                    <span class="info-value font-monospace text-secondary small">{{ Str::limit($donasi->transaction_id, 15) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama Donatur</span>
                    <span class="info-value">{{ $donasi->nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ $donasi->tanggal_donasi ? $donasi->tanggal_donasi->format('d M Y') : now()->format('d M Y') }}</span>
                </div>
                @if($donasi->pesan)
                <div class="info-row border-0 pt-3">
                    <span class="info-label w-100 text-center fst-italic text-secondary">"{{ $donasi->pesan }}"</span>
                </div>
                @endif
            </div>

            @if(request()->get('snap_token'))
                <button id="pay-button" class="btn btn-pay">
                    Bayar Sekarang <i class="bi bi-arrow-right"></i>
                </button>
            @else
                <a href="https://wa.me/6281234567890?text=Assalamualaikum,%20saya%20sudah%20donasi%20sebesar%20Rp%20{{ number_format($donasi->jumlah, 0, ',', '.') }}%20atas%20nama%20{{ $donasi->nama }}" target="_blank" class="btn btn-success w-100 py-3 rounded-4 fw-bold shadow-sm">
                    <i class="bi bi-whatsapp me-2"></i> Konfirmasi WhatsApp
                </a>
            @endif

            <a href="{{ route('welcome') }}" class="btn btn-back mt-2">
                Kembali ke Beranda
            </a>

            <div class="secure-badge">
                <i class="bi bi-shield-lock-fill"></i> Pembayaran Aman & Terenkripsi
            </div>
        </div>
    </div>

    @if(request()->get('snap_token'))
    <script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" 
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ request()->get('snap_token') }}', {
          onSuccess: function(result){
            alert("Alhamdulillah! Pembayaran berhasil."); 
            window.location.href = "{{ route('welcome') }}";
          },
          onPending: function(result){
            alert("Menunggu pembayaran Anda!");
          },
          onError: function(result){
            alert("Maaf, pembayaran gagal.");
          },
          onClose: function(){
            // Do nothing
          }
        });
      };
    </script>
    @endif

</body>
</html>