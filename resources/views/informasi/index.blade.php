<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Informasi Masjid Nabawi - Profil, kegiatan, dan jadwal ibadah">
    <title>Informasi Masjid Nabawi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
      
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <style>
    
        :root {
            --primary: #4f46e5; 
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --white: #ffffff;
            
            --bg-body: #f8fafc;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-card-hover: rgba(255, 255, 255, 1);
            
            --text-main: #0f172a;
            --text-secondary: #64748b;
            
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            --shadow-premium: 0 25px 50px -12px rgba(79, 70, 229, 0.15);

            --radius-lg: 24px;
            --radius-md: 16px;
            --radius-sm: 8px;

            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            line-height: 1.7;
            overflow-x: hidden;
        }

       h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover, 
        .nav-link.active {
            color: var(--primary) !important;
        }

        /* ===== HERO ===== */
        .hero-section {
            background: linear-gradient(135deg, #eef2ff 0%, #e0f2fe 100%);
            min-height: 500px;
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 6rem;
            margin-bottom: -5rem;
            border-radius: 0 0 50px 50px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-secondary);
            font-weight: 500;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            overflow: hidden;
            height: 100%;
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-premium);
            background: var(--bg-card-hover);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(79, 70, 229, 0.5);
        }

        /* Footer */
        .footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 2.5rem 0 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
    </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('informasi.index') }}">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}#kontak">Kontak</a>
                </li>

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


    <div class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-bg-pattern"></div>
            <div class="container position-relative z-2">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="hero-title">
                            <i class="bi bi-mosque me-3"></i>{{ $settings['info_page_title'] ?? 'Informasi Masjid' }}
                        </h1>
                        <p class="hero-subtitle mb-0">
                            {{ $settings['info_page_subtitle'] ?? 'Pelajari lebih lanjut tentang masjid kami dan kegiatan yang kami lakukan' }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Static 3 Cards Section -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4">
                    
                    <!-- Card 1: Visi & Misi (Text Component) -->
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box mb-4 mx-auto bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                    <i class="bi bi-bullseye fs-3"></i>
                                </div>
                                <h4 class="card-title fw-bold mb-3">Visi & Misi</h4>
                                <div class="card-text text-muted text-start">
                                    <div class="mb-3">
                                        <h6 class="text-primary fw-bold text-uppercase small">Visi</h6>
                                        <p class="mb-0">{{ $settings['vision'] ?? 'Menjadi pusat peradaban Islam yang rahmatan lil alamin.' }}</p>
                                    </div>
                                    <div>
                                        <h6 class="text-primary fw-bold text-uppercase small">Misi</h6>
                                        <div class="ps-3 border-start border-primary border-3">
                                            {!! nl2br(e($settings['mission'] ?? "Menyelenggarakan ibadah yang khusyuk.\nPendidikan berkualitas.\nPelayanan sosial yang amanah.")) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Jadwal Sholat (Prayer Times) -->
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card h-100 border-0 shadow-sm hover-card bg-primary text-white">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <div class="icon-box mb-3 mx-auto bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                        <i class="bi bi-clock fs-3"></i>
                                    </div>
                                    <h4 class="card-title fw-bold">Jadwal Sholat</h4>
                                </div>
                                <div class="prayer-times-list">
                                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-white border-opacity-25 pb-2">
                                        <span>Subuh</span>
                                        <span class="fw-bold">{{ $settings['prayer_subuh'] ?? '04:30' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-white border-opacity-25 pb-2">
                                        <span>Dzuhur</span>
                                        <span class="fw-bold">{{ $settings['prayer_dzuhur'] ?? '12:00' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-white border-opacity-25 pb-2">
                                        <span>Ashar</span>
                                        <span class="fw-bold">{{ $settings['prayer_ashar'] ?? '15:15' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-white border-opacity-25 pb-2">
                                        <span>Maghrib</span>
                                        <span class="fw-bold">{{ $settings['prayer_maghrib'] ?? '18:00' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-white border-opacity-25 pb-2">
                                        <span>Isya</span>
                                        <span class="fw-bold">{{ $settings['prayer_isya'] ?? '19:15' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Jumat</span>
                                        <span class="fw-bold">{{ $settings['prayer_jumat'] ?? '11:45' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Kegiatan Rutin (Routine Activities) -->
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <div class="icon-box mb-3 mx-auto bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                        <i class="bi bi-calendar-event fs-3"></i>
                                    </div>
                                    <h4 class="card-title fw-bold">Kegiatan Rutin</h4>
                                </div>
                                
                                <ul class="list-unstyled">
                                    @forelse($activities as $activity)
                                        <li class="mb-3 d-flex align-items-start">
                                            <!-- Hidden Icon Logic: Use default check circle -->
                                            <i class="bi bi-check-circle text-success me-2 mt-1"></i>
                                            <div>
                                                <strong>{{ $activity->name }}</strong>
                                                @if($activity->description)
                                                    <br><small class="text-muted">{{ $activity->description }}</small>
                                                @endif
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-muted text-center">Belum ada kegiatan rutin.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-4" id="kontak">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <a class="d-flex align-items-center gap-2 mb-3 text-decoration-none" href="#">
                        <i class="bi bi-mosque fs-3 text-white"></i>
                        <span class="fs-5 fw-bold text-white">{{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}</span>
                    </a>
                    <p class="mb-3 small">Membangun peradaban umat melalui masjid yang makmur, transparan, dan modern.</p>
                    <div class="d-flex">
                        <a href="{{ $settings['social_facebook'] ?? '#' }}" class="social-link shadow-sm" style="width: 32px; height: 32px; font-size: 0.875rem;"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $settings['social_instagram'] ?? '#' }}" class="social-link shadow-sm" style="width: 32px; height: 32px; font-size: 0.875rem;"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $settings['social_youtube'] ?? '#' }}" class="social-link shadow-sm" style="width: 32px; height: 32px; font-size: 0.875rem;"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h6 class="footer-title mb-3 text-white fw-bold">Navigasi</h6>
                    <ul class="list-unstyled d-flex flex-column gap-1 small">
                        <li><a href="{{ route('welcome') }}" class="text-decoration-none text-secondary hover-white">Beranda</a></li>
                        <li><a href="{{ route('welcome') }}#tentang" class="text-decoration-none text-secondary hover-white">Tentang</a></li>
                        <li><a href="{{ route('informasi.index') }}" class="text-decoration-none text-secondary hover-white">Informasi</a></li>
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
                <p class="mb-0 small" style="font-size: 0.75rem;">&copy; 2026 Kas {{ $settings['nama_masjid'] ?? 'Masjid Nabawi' }}. Developed with ❤️ for Ummah.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>