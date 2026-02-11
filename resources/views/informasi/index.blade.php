<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Informasi Masjid Nabawi - Profil, kegiatan, dan jadwal ibadah">
    <title>Informasi Masjid Nabawi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f1f5f9;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --primary-color: #3b82f6;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --success-color: #10b981;
            --success-light: #d1fae5;
            --warning-color: #f59e0b;
            --warning-light: #fef3c7;
            --danger-color: #ef4444;
            --danger-light: #fee2e2;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
            margin: 0;
        }

        /* Navigation */
        .navbar-custom {
            background: var(--bg-secondary);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-primary) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand:hover {
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: var(--transition);
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background: var(--primary-light);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            background: var(--primary-light);
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            padding-top: 6rem;
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-primary);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(-50%, -50%) rotate(0deg); }
            50% { transform: translate(-50%, -50%) rotate(180deg); }
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        /* Content Sections */
        .content-section {
            background: var(--bg-secondary);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .content-section:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 2rem;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* Icons */
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .icon-box.bg-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .icon-box.bg-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .icon-box.bg-info {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            color: white;
        }

        /* Buttons */
        .btn {
            border-radius: var(--border-radius);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        /* Tables */
        .table {
            background: var(--bg-secondary);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table thead th {
            background: var(--bg-tertiary);
            border-bottom: 2px solid var(--border-color);
            color: var(--text-primary);
            font-weight: 600;
            padding: 1rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background: var(--bg-tertiary);
        }

        /* Info Section */
        .info-section {
            padding: 3rem 0;
            background: var(--bg-primary);
        }

        .info-card {
            background: var(--bg-secondary);
            border-radius: var(--border-radius-lg);
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            height: 100%;
            border: 1px solid var(--border-color);
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .card-text {
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* Prayer Times */
        .prayer-times {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: var(--border-radius-lg);
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .prayer-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(146, 64, 14, 0.1);
        }

        .prayer-item:last-child {
            border-bottom: none;
        }

        .prayer-name {
            font-weight: 600;
            color: #92400e;
        }

        .prayer-time {
            font-weight: 700;
            color: #dc2626;
            font-size: 1.1rem;
        }

        /* Activity List */
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0 0 0;
            text-align: left;
        }

        .activity-list li {
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .activity-list li i {
            color: var(--success-color);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* Contact Info */
        .contact-info {
            margin-top: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateX(4px);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .contact-details {
            flex: 1;
        }

        .contact-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-value {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .contact-value a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .contact-value a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 3rem 0 2rem;
            margin-top: 3rem;
        }

        .footer-content {
            color: var(--text-primary);
        }

        .footer-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-text {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .footer-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
        }

        .footer-link:hover {
            color: var(--primary-color);
            background: var(--primary-light);
        }

        .footer-copyright {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin: 0;
        }

        .footer-copyright small {
            color: var(--text-muted);
            font-size: 0.75rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .content-section {
                margin: 1rem 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                padding: 3rem 0;
            }

            .hero-title {
                font-size: 2rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-mosque"></i>
                Kas Masjid Nabawi
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('informasi.index') }}">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}#kontak">Kontak</a>
                    </li>
                    @auth
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="hero-title">
                            <i class="bi bi-mosque me-3"></i>Informasi Masjid
                        </h1>
                        <p class="hero-subtitle mb-0">
                            Pelajari lebih lanjut tentang masjid kami dan kegiatan yang kami lakukan untuk umat
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mosque Information Cards -->
        <section class="info-section">
            <div class="container">
                <div class="row g-4">
                    <!-- About Mosque -->
                    <div class="col-lg-6">
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <h3 class="card-title">Tentang Masjid</h3>
                            <p class="card-text">
                                Masjid Al-Ikhlas adalah pusat ibadah dan kegiatan sosial yang berkomitmen untuk
                                melayani masyarakat dengan penuh dedikasi dan transparansi dalam pengelolaan keuangan.
                            </p>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-lg-6">
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h3 class="card-title">Lokasi</h3>
                            <p class="card-text">
                                Jl. Raya Masjid No. 123<br>
                                Kelurahan Sejahtera, Kecamatan Harmoni<br>
                                Kota Berkah, Provinsi Damai<br>
                                Kode Pos: 12345
                            </p>
                        </div>
                    </div>

                    <!-- Prayer Times -->
                    <div class="col-lg-6">
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <h3 class="card-title">Jadwal Sholat</h3>
                            <div class="prayer-times">
                                <div class="prayer-item">
                                    <span class="prayer-name">Subuh</span>
                                    <span class="prayer-time">04:30</span>
                                </div>
                                <div class="prayer-item">
                                    <span class="prayer-name">Dzuhur</span>
                                    <span class="prayer-time">12:00</span>
                                </div>
                                <div class="prayer-item">
                                    <span class="prayer-name">Ashar</span>
                                    <span class="prayer-time">15:15</span>
                                </div>
                                <div class="prayer-item">
                                    <span class="prayer-name">Maghrib</span>
                                    <span class="prayer-time">18:05</span>
                                </div>
                                <div class="prayer-item">
                                    <span class="prayer-name">Isya</span>
                                    <span class="prayer-time">19:30</span>
                                </div>
                                <div class="prayer-item">
                                    <span class="prayer-name">Jumat</span>
                                    <span class="prayer-time">12:30</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activities -->
                    <div class="col-lg-6">
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <h3 class="card-title">Kegiatan Rutin</h3>
                            <ul class="activity-list">
                                <li><i class="bi bi-check-circle"></i> Pengajian rutin setiap malam Jumat</li>
                                <li><i class="bi bi-check-circle"></i> Kajian tafsir Al-Quran mingguan</li>
                                <li><i class="bi bi-check-circle"></i> Program TPA untuk anak-anak</li>
                                <li><i class="bi bi-check-circle"></i> Kegiatan sosial dan bakti sosial</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="info-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <h3 class="card-title">Hubungi Kami</h3>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <div class="contact-label">Email</div>
                                        <div class="contact-value">
                                            <a href="mailto:info@masjidalikhlas.com" class="text-decoration-none">info@masjidalikhlas.com</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <div class="contact-label">Telepon</div>
                                        <div class="contact-value">(021) 1234-5678</div>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-whatsapp"></i>
                                    </div>
                                    <div class="contact-details">
                                        <div class="contact-label">WhatsApp</div>
                                        <div class="contact-value">+62 812-3456-7890</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Back to Home Section -->
        <section class="info-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-house me-2"></i>Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="footer-content">
                        <h5 class="footer-title">
                            <i class="bi bi-mosque me-2"></i>Masjid Nabawi
                        </h5>
                        <p class="footer-text">
                            Berkomitmen untuk melayani masyarakat dengan transparansi dan dedikasi dalam pengelolaan keuangan masjid.
                        </p>
                        <div class="footer-links">
                            <a href="{{ route('welcome') }}" class="footer-link">Beranda</a>
                            <a href="{{ route('informasi.index') }}" class="footer-link">Informasi</a>
                            <a href="{{ route('welcome') }}#kontak" class="footer-link">Kontak</a>
                        </div>
                        <p class="footer-copyright">
                            &copy; 2026 Masjid Nabawi. All rights reserved.<br>
                            <small>Dikembangkan dengan ❤️ untuk umat</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>