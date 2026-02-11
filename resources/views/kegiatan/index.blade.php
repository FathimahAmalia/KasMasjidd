<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['hero_title'] ?? 'Kas Masjid' }} - Semua Kegiatan</title>

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
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            font-weight: 600;
        }
        .btn-gradient:hover {
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }
        /* Glassmorphism Navbar */
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

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }

        .group-hover:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Footer */
        .footer {
            background: #1e293b;
            color: #94a3b8;
            padding: 4rem 0 2rem;
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <i class="bi bi-mosque text-primary"></i>
                Masjid Nabawi
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('informasi.index') }}">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}#kontak">Kontak</a></li>
                    @guest
                        <li class="nav-item ms-lg-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
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
    <div style="margin-top: 100px;"></div> <!-- Spacer for fixed navbar -->

    <!-- Header -->
    <section class="py-5 bg-white text-center">
        <div class="container">
            <h1 class="display-5 fw-bold text-dark mb-3">Galeri Kegiatan</h1>
            <p class="lead text-muted mb-0">Dokumentasi aktivitas dan program keumatan Masjid Nabawi</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($activities as $activity)
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden group-hover">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ Str::startsWith($activity->image, 'http') ? $activity->image : asset('storage/' . str_replace('activities/', '', $activity->image)) }}" class="card-img-top object-fit-cover" alt="{{ $activity->title }}" style="height: 250px; transition: transform 0.5s ease;">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <span class="badge bg-primary mb-2">{{ $activity->category }}</span>
                                <h5 class="fw-bold mb-0 text-white">{{ $activity->title }}</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted small mb-0">{{ Str::limit($activity->description, 150) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $activities->links() }}
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <a class="d-flex align-items-center gap-2 mb-4 text-decoration-none" href="#">
                        <i class="bi bi-mosque fs-2 text-white"></i>
                        <span class="fs-3 fw-bold text-white">Masjid Nabawi</span>
                    </a>
                    <p class="mb-4">Membangun peradaban umat melalui masjid yang makmur, transparan, dan modern.</p>
                    <div class="d-flex">
                        <a href="{{ $settings['social_facebook'] ?? '#' }}" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $settings['social_instagram'] ?? '#' }}" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $settings['social_youtube'] ?? '#' }}" class="social-link"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h5 class="footer-title">Navigasi</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('welcome') }}" class="text-decoration-none text-secondary hover-white">Beranda</a></li>
                        <li><a href="{{ route('welcome') }}#tentang" class="text-decoration-none text-secondary hover-white">Tentang</a></li>
                        <li><a href="{{ route('login') }}" class="text-decoration-none text-secondary hover-white">Login Admin</a></li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3">
                        <li class="d-flex gap-3">
                            <i class="bi bi-geo-alt text-primary mt-1"></i>
                            <span>{{ $settings['contact_address'] ?? 'Jl. Masjid Nabawi No. 123, Komplek Surga Firdaus, Kota Madani, Indonesia' }}</span>
                        </li>
                        <li class="d-flex gap-3">
                            <i class="bi bi-telephone text-primary mt-1"></i>
                            <span>{{ $settings['contact_phone'] ?? '+62 812-3456-7890' }}</span>
                        </li>
                        <li class="d-flex gap-3">
                            <i class="bi bi-envelope text-primary mt-1"></i>
                            <span>{{ $settings['contact_email'] ?? 'info@masjidnabawi.com' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-secondary pt-4 text-center">
                <p class="mb-0 small">&copy; 2026 Kas Masjid Nabawi. Developed with ❤️ for Ummah.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
