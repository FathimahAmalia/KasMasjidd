<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Kas Masjid</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1e293b;
            --accent: #3b82f6;
            --accent-hover: #1d4ed8;
            --glass: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.6);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: url('https://i.pinimg.com/736x/89/86/80/89868097a6089f7ab7d04b469d132c0c.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Enhanced Dark Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85), rgba(59, 130, 246, 0.35));
            backdrop-filter: blur(3px); /* Subtle blur on background for focus */
            z-index: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.85); /* More translucent for better glass effect */
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 28px; /* Softer rounded corners */
            box-shadow: 
                0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                0 2px 4px -1px rgba(0, 0, 0, 0.06),
                0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 420px;
            padding: 48px 40px;
            position: relative;
            z-index: 10;
            overflow: hidden;
            animation: cardEntrance 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        /* Shine Effect on Card */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(
                to right,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transform: skewX(-25deg);
            animation: shine 6s infinite;
            pointer-events: none;
        }

        @keyframes shine {
            0% { left: -100%; }
            5% { left: 200%; }
            100% { left: 200%; }
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-area {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-icon {
            width: 70px; /* Slightly larger */
            height: 70px;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            color: white;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.5);
            margin-bottom: 20px;
            transform: rotate(-5deg);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .login-card:hover .logo-icon {
            transform: rotate(0deg) scale(1.1);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.6);
        }

        h1 {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #1e293b, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .form-floating > .form-control {
            border-radius: 14px;
            border: 2px solid #f1f5f9;
            background: rgba(255, 255, 255, 0.8);
            height: 58px;
            font-weight: 600;
            color: #334155;
            transition: all 0.3s;
        }

        .form-floating > .form-control:focus {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        .form-floating > label {
            color: #94a3b8;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            border: none;
            height: 54px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.6);
            filter: brightness(1.05);
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
            border-radius: 14px;
            padding: 16px;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            animation: shake 0.5s ease-in-out;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }

        .footer-text {
            text-align: center;
            margin-top: 35px;
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* Checkbox Styling */
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.15em;
            border: 2px solid #cbd5e1;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-area">
            <div class="logo-icon">
                <i class="bi bi-mosque"></i>
            </div>
            <h1>Selamat Datang</h1>
            <p class="subtitle">Masuk untuk mengelola Kas Masjid Nabawi</p>
        </div>

        @if ($errors->any())
        <div class="alert-error">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>Email atau kata sandi salah. Silakan coba lagi.</div>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                <label for="email">Alamat Email</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                <label for="password">Kata Sandi</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-muted" style="font-size: 0.9rem;" for="remember">
                        Ingat saya
                    </label>
                </div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none fw-semibold" style="font-size: 0.9rem; color: var(--accent);">
                    Lupa Sandi?
                </a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Masuk Sekarang <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="footer-text">
            © {{ date('Y') }} Sistem Kas Masjid v2.0 <br>
            Dikembangkan dengan <i class="bi bi-heart-fill text-danger" style="font-size: 10px;"></i> untuk Ummat.
        </div>
    </div>

</body>
</html>
