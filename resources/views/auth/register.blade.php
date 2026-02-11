<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — Kas Masjid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --accent-primary: #3b82f6;
            --accent-secondary: #1d4ed8;
            --accent-light: #dbeafe;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            margin: 0;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .auth-container {
            width: 100%;
            max-width: 1000px;
            background: var(--bg-secondary);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-left {
            background: var(--gradient-secondary);
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
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

        .illustration {
            width: 100%;
            max-width: 320px;
            position: relative;
            z-index: 2;
        }

        .illustration img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
        }

        .illustration img:hover {
            transform: scale(1.02);
        }

        .auth-left h2 {
            color: white;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 2rem 0 1rem 0;
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .auth-left p {
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            font-size: 1rem;
            line-height: 1.6;
            z-index: 2;
            position: relative;
        }

        .auth-right {
            padding: 2rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--bg-secondary);
            max-height: 90vh;
            overflow-y: auto;
        }

        .auth-header {
            margin-bottom: 2rem;
        }

        .auth-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .auth-description {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-size: 1rem;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            background: var(--bg-secondary);
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--accent-primary);
            background: var(--accent-light);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .btn-group {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
            flex: 1;
        }

        .btn-primary {
            background: var(--gradient-secondary);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: var(--bg-secondary);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-outline:hover {
            background: var(--accent-light);
            color: var(--accent-primary);
            border-color: var(--accent-primary);
            transform: translateY(-1px);
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .auth-footer {
            text-align: center;
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 1rem;
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .auth-links a {
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .auth-links a:hover {
            color: var(--accent-secondary);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-container {
                grid-template-columns: 1fr;
                max-width: 420px;
                margin: 1rem;
            }

            .auth-left {
                display: none;
            }

            .auth-right {
                padding: 2rem 1.5rem;
                max-height: none;
                overflow-y: visible;
            }

            .auth-title {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                margin: 0.5rem;
            }

            .auth-right {
                padding: 1.5rem 1rem;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="auth-container">
        <div class="auth-left">
            <div class="illustration">
                <img src="https://i.pinimg.com/736x/6f/70/cb/6f70cbfdf0c6158ad2680498b64e9ca5.jpg" alt="illustration"/>
            </div>
            <h2>Bergabung dengan Kami</h2>
            <p>Daftar sekarang dan mulai kelola keuangan masjid dengan transparan</p>
        </div>
        <div class="auth-right">
            <div class="auth-header">
                <div class="auth-subtitle">Buat akun baru</div>
                <h1 class="auth-title">Daftar Sekarang</h1>
                <p class="auth-description">Bergabunglah dengan komunitas masjid untuk pengelolaan keuangan yang lebih baik.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror" placeholder="nama@contoh.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePassword()" class="password-toggle">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="password-field">
                        <input type="password" id="password-confirm" name="password_confirmation" required class="form-control" placeholder="Ulangi kata sandi">
                        <button type="button" onclick="togglePasswordConfirm()" class="password-toggle">
                            <i id="eyeIconConfirm" class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Daftar
                    </button>
                </div>
            </form>

            <div class="auth-links">
                <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>

            <div class="auth-footer">
                © {{ date('Y') }} Kas Masjid — Semua hak dilindungi.
            </div>
        </div>
    </section>

    <script>
        // Password toggle functionality
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }

        function togglePasswordConfirm() {
            const passwordField = document.getElementById('password-confirm');
            const eyeIcon = document.getElementById('eyeIconConfirm');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-primary');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i>Mendaftarkan...';
            submitBtn.disabled = true;

            // Re-enable after 3 seconds (in case of error)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });

        // Add smooth focus animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Auto-focus name field
        document.addEventListener('DOMContentLoaded', function() {
            const nameField = document.querySelector('input[name="name"]');
            if (nameField) {
                nameField.focus();
            }
        });
    </script>
</body>
</html>
