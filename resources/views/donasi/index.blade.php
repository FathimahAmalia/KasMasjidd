<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donasi Online - Kas Masjid Nabawi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        .navbar-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .page-header {
            background: linear-gradient(135deg, #eef2ff 0%, #e0f2fe 100%);
            padding: 120px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .form-card {
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border-color: #e2e8f0;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .amount-btn-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .amount-btn {
            border: 1px solid #e2e8f0;
            background: white;
            color: var(--dark);
            padding: 10px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
            width: 100%;
        }

        .amount-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .amount-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 14px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
            color: white;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <i class="bi bi-mosque text-primary"></i>
                <span class="fw-bold text-dark">Masjid Nabawi</span>
            </a>
            <div class="ms-auto">
                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="page-header text-center">
        <div class="container">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-semibold">
                <i class="bi bi-heart-fill me-2"></i>Donasi Online
            </span>
            @if(!config('services.midtrans.is_production'))
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-semibold ms-2">
                    <i class="bi bi-cone-striped me-2"></i>Mode Uji Coba (Sandbox)
                </span>
            @endif
            <h1 class="display-5 fw-bold mb-3">Salurkan Infaq Terbaik Anda</h1>
            <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                "Harta tidak akan berkurang karena sedekah. Dan seorang hamba yang pemaaf pasti akan Allah tambahkan kewibawaannya." (HR. Muslim)
            </p>
        </div>
    </header>

    <div class="container pb-5" style="margin-top: -40px; position: relative; z-index: 10;">
        <div class="row g-4">
            <!-- Left Info Column -->
            <div class="col-lg-4 order-lg-2">
                <div class="form-card p-4 h-100 bg-dark text-white border-0" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                    <h4 class="mb-4">Mengapa Berdonasi?</h4>
                    
                    <div class="d-flex gap-3 mb-4">
                        <div class="feature-icon bg-white bg-opacity-10 text-white flex-shrink-0">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Amanah & Transparan</h6>
                            <p class="small text-white-50 mb-0">Laporan keuangan dapat diakses publik secara realtime.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="feature-icon bg-white bg-opacity-10 text-white flex-shrink-0">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Proses Instan</h6>
                            <p class="small text-white-50 mb-0">Pembayaran otomatis terverifikasi tanpa konfirmasi manual.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="feature-icon bg-white bg-opacity-10 text-white flex-shrink-0">
                            <i class="bi bi-gift-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Pahala Jariyah</h6>
                            <p class="small text-white-50 mb-0">Investasi akhirat yang pahalanya terus mengalir selamanya.</p>
                        </div>
                    </div>

                    <hr class="border-white opacity-10 my-4">
                    
                    <div class="text-center p-3 rounded-3 bg-white bg-opacity-5">
                        <small class="d-block text-white-50 mb-1">Total Donasi Bulan Ini</small>
                        <h3 class="fw-bold mb-0 text-success">Rp {{ number_format(\App\Models\PemasukanMasjid::whereMonth('tanggal', now())->sum('nominal') + \App\Models\PemasukanSosial::whereMonth('tanggal', now())->sum('jumlah'), 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <!-- Form Column -->
            <div class="col-lg-8 order-lg-1">
                <div class="form-card p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-4 border-0 bg-success bg-opacity-10 text-success rounded-3">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('donasi.store') }}" method="POST" id="donationForm">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Jenis Donasi -->
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark mb-3">Jenis Donasi</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="radio" class="btn-check" name="jenis_donasi" id="type_masjid" value="masjid" required {{ old('jenis_donasi') == 'masjid' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-light text-dark border w-100 p-3 text-start d-flex align-items-center gap-3 h-100" for="type_masjid">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle text-primary"><i class="bi bi-mosque fs-5"></i></div>
                                            <div>
                                                <div class="fw-bold">Kas Masjid</div>
                                                <small class="text-secondary">Operasional & Pembangunan</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="btn-check" name="jenis_donasi" id="type_sosial" value="sosial" {{ old('jenis_donasi') == 'sosial' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-light text-dark border w-100 p-3 text-start d-flex align-items-center gap-3 h-100" for="type_sosial">
                                            <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success"><i class="bi bi-people fs-5"></i></div>
                                            <div>
                                                <div class="fw-bold">Kas Sosial</div>
                                                <small class="text-secondary">Santunan & Bencana</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Amount -->
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Nominal Donasi</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-light border-end-0 fw-bold text-secondary">Rp</span>
                                    <input type="number" class="form-control form-control-lg border-start-0 ps-0 fw-bold text-dark" 
                                           id="jumlah" name="jumlah" placeholder="0" min="5000" required>
                                    <div class="invalid-feedback">Minimal donasi Rp 5.000</div>
                                    <small class="text-muted d-block mt-1">Minimal donasi Rp 5.000</small>
                                </div>
                                <div class="amount-btn-wrapper">
                                    <button type="button" class="amount-btn" data-value="50000">50rb</button>
                                    <button type="button" class="amount-btn" data-value="100000">100rb</button>
                                    <button type="button" class="amount-btn" data-value="200000">200rb</button>
                                    <button type="button" class="amount-btn" data-value="500000">500rb</button>
                                    <button type="button" class="amount-btn" data-value="1000000">1 Jt</button>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Hamba Allah" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Email/WhatsApp</label>
                                <input type="text" class="form-control" name="email" placeholder="contoh@email.com" required>
                            </div>

                            <!-- Pesan -->
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Doa / Pesan (Opsional)</label>
                                <textarea class="form-control" name="pesan" rows="2" placeholder="Tulis doa atau harapan Anda..."></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-gradient w-100 py-3 fs-5">
                                    <i class="bi bi-heart-fill me-2"></i>Lanjutkan Pembayaran
                                </button>
                                <p class="text-center text-muted small mt-3 mb-0">
                                    <i class="bi bi-shield-lock me-1"></i>Pembayaran aman & terenkripsi
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-4 text-center text-secondary small">
        <div class="container">
            <p class="mb-0">&copy; 2026 Masjid Nabawi. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quick Amount Script
        const amountBtns = document.querySelectorAll('.amount-btn');
        const amountInput = document.getElementById('jumlah');

        amountBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset active state
                amountBtns.forEach(b => b.classList.remove('active'));
                
                // Set active state
                this.classList.add('active');
                
                // Set value
                amountInput.value = this.dataset.value;
            });
        });

        // Add active class on input manual focus (optional UX)
        amountInput.addEventListener('input', function() {
            amountBtns.forEach(b => b.classList.remove('active'));
        });
    </script>
</body>
</html>