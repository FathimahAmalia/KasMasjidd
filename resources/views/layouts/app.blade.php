<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kas Masjid') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --success-light: #d1fae5;
            --warning-color: #f59e0b;
            --warning-light: #fef3c7;
            --danger-color: #ef4444;
            --danger-light: #fee2e2;    
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f1f5f9;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --sidebar-width: 280px;
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--bg-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--bg-secondary);
            z-index: 1040;
            box-shadow: var(--shadow-lg);
            border-right: 1px solid var(--border-color);
            transition: var(--transition);
            padding: 1.5rem;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 2rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-logo {
            width: 48px;
            height: 48px;
            border-radius: var(--border-radius);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            box-shadow: var(--shadow-md);
            flex-shrink: 0;
        }

        .sidebar-title h6 {
            margin: 0;
            font-weight: 700;
            color: var(--text-primary);
            font-size: 1rem;
        }

        .sidebar-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 4px;
            color: var(--text-secondary);
            font-weight: 500;
            border-radius: var(--border-radius);
            transition: var(--transition);
            text-decoration: none;
            position: relative;
        }

        .nav-link:hover {
            color: var(--text-primary);
            background-color: var(--bg-tertiary);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-light), rgba(59, 130, 246, 0.1));
            color: var(--primary-color);
            font-weight: 600;
            box-shadow: var(--shadow-sm);
            border-left: 3px solid var(--primary-color);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .nav-link i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            margin-right: 12px;
            border-radius: 10px;
            background: var(--bg-tertiary);
            color: var(--text-secondary);
            font-size: 1rem;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .nav-link.active i {
            background: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .nav-link:hover i {
            background: var(--primary-light);
            color: var(--primary-color);
            transform: scale(1.05);
        }

        .nav-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin: 1.5rem 0 0.5rem 1rem;
            padding-left: 4px;
        }

        /* Submenu adjustments */
        .collapse .nav-link {
            padding-left: 3.5rem;
            background: transparent !important;
            box-shadow: none !important;
            font-weight: 400;
            margin-bottom: 2px;
        }

        .collapse .nav-link:hover {
            color: var(--primary-color);
            background: var(--primary-light) !important;
        }

        .collapse .nav-link::before {
            content: "•";
            position: absolute;
            left: 2rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
            background: var(--bg-primary);
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .navbar-toggler {
                display: block;
            }
        }

        /* Card Revamp */
        .card {
            border: none;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            background-color: var(--bg-secondary);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem 2rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-body {
            padding: 2rem;
        }

        /* Table Revamp */
        .table {
            background: var(--bg-secondary);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table thead th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 700;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid var(--border-color);
            background: var(--bg-tertiary);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            color: var(--text-primary);
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: var(--bg-tertiary);
            transform: scale(1.01);
        }

        /* Button Enhancements */
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
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            box-shadow: var(--shadow-sm);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            box-shadow: var(--shadow-sm);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            box-shadow: var(--shadow-sm);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Alert Enhancements */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-sm);
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            animation: slideInAlert 0.3s ease-out;
        }

        @keyframes slideInAlert {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: var(--success-light);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: var(--danger-light);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .alert-warning {
            background: var(--warning-light);
            color: var(--warning-color);
            border-left: 4px solid var(--warning-color);
        }

        /* Form Enhancements */
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            background: var(--bg-secondary);
            transition: var(--transition);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        /* Progress Bar */
        .progress {
            border-radius: 10px;
            background: var(--bg-tertiary);
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        /* Icon Box */
        .icon-box {
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .icon-box:hover {
            transform: scale(1.05);
        }

        /* Badge */
        .badge {
            border-radius: 20px;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
        }

        /* Dropdown */
        .dropdown-menu {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: var(--bg-tertiary);
            transform: translateX(4px);
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem 2rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
            padding: 1.5rem 2rem;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-tertiary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
        }

        .bg-gradient-dark {
            background: linear-gradient(135deg, #1e293b, #334155);
        }

        .shadow-custom {
            box-shadow: var(--shadow-lg);
        }

        .border-custom {
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="bi bi-mosque"></i>
            </div>
            <div class="sidebar-title">
                <h6>{{ \App\Models\LandingSetting::where('key', 'nama_masjid')->value('value') ?? 'Kas Masjid' }}</h6>
                <div class="sidebar-subtitle">Kelola Kas Masjid</div>
            </div>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-title">Menu Utama</li>

            <!-- KAS MASJID -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#kasMasjid" role="button" aria-expanded="false">
                    <i class="bi bi-box-seam"></i>
                    <span class="d-flex justify-content-between w-100 align-items-center">
                        Kas Masjid <i class="bi bi-chevron-down ms-2" style="font-size: 0.8em; margin:0; width:auto; height:auto; background:none; box-shadow:none; color:inherit;"></i>
                    </span>
                </a>
                <div class="collapse {{ request()->is('*masjid*') || request()->is('rekap-kas*') ? 'show' : '' }}" id="kasMasjid">
                    <ul class="nav flex-column mt-1">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pemasukan_masjid.index') }}">Pemasukan Masjid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengeluaran_masjid.index') }}">Pengeluaran Masjid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan_kas.index') }}">Laporan Kas</a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('activities*') ? 'active' : '' }}" href="{{ route('activities.index') }}">
                    <i class="bi bi-images"></i>
                    <span>Kelola Kegiatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('strukturs*') ? 'active' : '' }}" href="{{ route('admin.struktur.index') }}">
                    <i class="bi bi-images"></i>
                    <span>Manajmen Struktur</span>
                </a>
            </li>


            <li class="nav-title">Lainnya</li>

            @php
                $hasAdminRole = false;
                if(Auth::check()) {
                    $userRoles = Auth::user()->roles()->pluck('name')->toArray();
                    $hasAdminRole = in_array('admin', $userRoles);
                }
            @endphp

            @if($hasAdminRole)
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pengaturan" role="button" aria-expanded="false">
                    <i class="bi bi-gear"></i>
                    <span class="d-flex justify-content-between w-100 align-items-center">
                        Pengaturan <i class="bi bi-chevron-down ms-2" style="font-size: 0.8em; margin:0; width:auto; height:auto; background:none; box-shadow:none; color:inherit;"></i>
                    </span>
                </a>
                <div class="collapse {{ request()->is('users*') ? 'show' : '' }}" id="pengaturan">
                    <ul class="nav flex-column mt-1">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Manajemen Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.settings.index') }}">Pengaturan Web</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif



            <li class="nav-item mt-3">
                <a href="{{ route('profile.edit') }}"
                class="nav-link d-flex align-items-center fw-semibold rounded px-3 py-2"
                style="color: #344767;">
                    <i class="bi bi-person-circle me-2"></i>
                    Edit Profil
                </a>
            </li>

            <li class="nav-item">
                <a href="#"
                class="nav-link d-flex align-items-center text-danger fw-semibold rounded px-3 py-2 logout-hover"
                onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>

                <form id="logout-form-mobile" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
