<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Pengelolaan Kas Masjid Nabawi - Transparan dan Akuntabel">
    <title>Kas Masjid Nabawi - Transparansi & Amanah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --white: #ffffff;
            --glass: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        /* Glassmorphism Navbar */
        /* .navbar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        } */

         .navbar-custom {
            background: rgba(255, 255, 255, 0.95); /* Slightly more opaque for sticky */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            padding: 1rem 0;
            transition: var(--transition);
        }

        .navbar-brand {
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }


        .nav-link {
            font-weight: 500;
            color: var(--text-secondary) !important;
            border-radius: var(--radius-sm);
            padding: 0.6rem 1.2rem !important;
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: rgba(79, 70, 229, 0.1); /* light primary */
            transform: translateY(-1px);
        }
        

        /* Hero Section */
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, #eef2ff 0%, #e0f2fe 100%);
            padding: 180px 0 100px;
            overflow: hidden;
        }

        .hero-shape {
            position: absolute;
            width: 600px;
            height: 600px;
            background: linear-gradient(45deg, rgba(79, 70, 229, 0.1), rgba(14, 165, 233, 0.1));
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        .hero-shape-1 { top: -100px; right: -100px; }
        .hero-shape-2 { bottom: -100px; left: -100px; }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.3);
            color: white;
        }

        /* Stats Cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* Feature Cards */
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.05);
        }

        /* Footer */
        .footer {
            background: #1e293b;
            color: #94a3b8;
            padding: 2.5rem 0 1.5rem;
        }

        .footer-title {
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-family: 'Outfit', sans-serif;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
            color: white;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <i class="bi bi-mosque text-primary"></i>
                {{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('informasi.index') }}">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Struktur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Galeri</a>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    @guest

                    @else
                        <li class="nav-item ms-lg-3">
                            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center text-lg-start">
        <div class="hero-shape hero-shape-1"></div>
        <div class="her o-shape hero-shape-2"></div>
        
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-semibold">
                        <i class="bi bi-check-circle-fill me-2"></i>Terpercaya & Transparan
                    </span>
                    <h1 class="display-4 fw-bold mb-4 text-dark lh-tight">
                        {{ $settings['hero_title'] ?? 'Wujudkan Amal Jariyah Bersama ' . ($settings['nama_masjid'] ?? 'Masjid Nabawi') }}
                    </h1>
                    <p class="lead text-secondary mb-5 pe-lg-5">
                       {{ $settings['hero_description'] ?? 'Platform digital pengelolaan keuangan masjid yang transparan. Salurkan donasi Anda dengan mudah, aman, dan barokah untuk kemaslahatan umat.' }}
                    </p>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="#tentang" class="btn btn-light btn-lg rounded-pill px-4">
                            <i class="bi bi-play-circle me-2"></i>Pelajari
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center" data-aos="zoom-in" data-aos-delay="200">
                    <div class="position-relative">

                        <!-- Floating Cards Animation -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 position-relative" style="margin-top: -80px; z-index: 10;">
        <div class="container">
            <div class="row g-4">
                <!-- Pemasukan Masjid -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card border-success border-opacity-25">
                        <div class="icon-wrapper bg-success bg-opacity-10 text-success">
                            <i class="bi bi-arrow-down-left-circle"></i>
                        </div>
                        <p class="text-secondary fw-semibold mb-1">Pemasukan Kas Masjid</p>
                        <h2 class="fw-bold mb-0 text-success">Rp {{ number_format($totalPemasukanMasjid, 0, ',', '.') }}</h2>
                    </div>
                </div>
                <!-- Pengeluaran Masjid -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card border-danger border-opacity-25">
                        <div class="icon-wrapper bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-arrow-up-right-circle"></i>
                        </div>
                        <p class="text-secondary fw-semibold mb-1">Pengeluaran Kas Masjid</p>
                        <h2 class="fw-bold mb-0 text-danger">Rp {{ number_format($totalPengeluaranMasjid, 0, ',', '.') }}</h2>
                    </div>
                </div>
                <!-- Total Saldo Masjid -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card border-primary border-opacity-25">
                        <div class="icon-wrapper bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <p class="text-secondary fw-semibold mb-1">Total Saldo Masjid</p>
                        <h2 class="fw-bold mb-0 text-primary">Rp {{ number_format($saldoMasjid, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-5 my-5">
        <div class="container">
            <div class="row align-items-center gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <img src="{{ Str::startsWith($settings['about_image'] ?? '', 'http') ? $settings['about_image'] : asset('storage/' . ($settings['about_image'] ?? '')) }}" 
                         alt="Masjid" class="img-fluid rounded-4 shadow-lg">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h5 class="text-primary fw-bold text-uppercase mb-3">Tentang Kami</h5>
                    <h2 class="display-6 fw-bold mb-4 text-dark">{{ $settings['about_title'] ?? 'Mengelola Amanah dengan Profesional & Modern' }}</h2>
                    <p class="text-secondary lead mb-4">
                        {{ $settings['about_description'] ?? ($settings['nama_masjid'] ?? 'Masjid Nabawi') . ' hadir dengan sistem manajemen keuangan digital yang memungkinkan seluruh jamaah memantau arus kas secara realtime, transparan, dan akuntabel.' }}
                    </p>
                    <div class="row g-4 mb-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                <span class="fw-semibold">100% Transparan</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                <span class="fw-semibold">Laporan Realtime</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                <span class="fw-semibold">Donasi Mudah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer mt-auto py-4" id="kontak">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <a class="d-flex align-items-center gap-2 mb-3 text-decoration-none" href="#">
                        <i class="bi bi-mosque fs-3 text-white"></i>
                        <span class="fs-5 fw-bold text-white">{{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}</span>
                    </a>
                    <p class="mb-3 small">{{ $settings['footer_description'] ?? 'Membangun peradaban umat melalui masjid yang makmur, transparan, dan modern.' }}</p>
                    <div class="d-flex">
                        @if(!empty($settings['social_facebook']) && $settings['social_facebook'] !== '#')
                            <a href="{{ $settings['social_facebook'] }}" class="social-link shadow-sm" style="width: 32px; height: 32px; font-size: 0.875rem;"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if(!empty($settings['social_instagram']) && $settings['social_instagram'] !== '#')
                            <a href="{{ $settings['social_instagram'] }}" class="social-link shadow-sm" style="width: 32px; height: 32px; font-size: 0.875rem;"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if(!empty($settings['social_youtube']) && $settings['social_youtube'] !== '#')
                            <a href="{{ $settings['social_youtube'] }}" class="social-link shadow-sm" style="width: 32px; height: 32px; font-size: 0.875rem;"><i class="bi bi-youtube"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h6 class="footer-title mb-3 text-white fw-bold">Navigasi</h6>
                    <ul class="list-unstyled d-flex flex-column gap-1 small">
                        <li><a href="#" class="text-decoration-none text-secondary hover-white">Beranda</a></li>
                        <li><a href="#tentang" class="text-decoration-none text-secondary hover-white">Tentang</a></li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <h6 class="footer-title mb-3 text-white fw-bold">Hubungi Kami</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li class="d-flex gap-2">
                            <i class="bi bi-geo-alt text-primary mt-1"></i>
                            <span>{{ $settings['contact_address'] ?? 'Jl. ' . ($settings['nama_masjid'] ?? 'Masjid Nabawi') . ' No. 123, Komplek Surga Firdaus, Kota Madani, Indonesia' }}</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-telephone text-primary mt-1"></i>
                            <span>{{ $settings['contact_phone'] ?? '+62 812-3456-7890' }}</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-envelope text-primary mt-1"></i>
                            <span>{{ $settings['contact_email'] ?? 'info@masjidnabawi.com' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-secondary pt-3 text-center">
                <p class="mb-0 small" style="font-size: 0.75rem;">{!! $settings['footer_copyright'] ?? '&copy; ' . date('Y') . ' Kas ' . ($settings['nama_masjid'] ?? 'Masjid Nabawi') . '. Developed with ❤️ for Ummah.' !!}</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Floating Animation Keyframes
        const styleSheet = document.createElement("style");
        styleSheet.innerText = `
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
        `;
        document.head.appendChild(styleSheet);
    </script>
</body>
</html>