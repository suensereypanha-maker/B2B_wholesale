<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — B2B Wholesale Portal</title>
    
    {{-- Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    {{-- Google Fonts (Inter) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Use Dashboard CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    
    <style>
        body {
            background-color: #090d16;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            font-family: var(--font), sans-serif;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient background glow blobs */
        .glow-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: #2563eb;
            top: -100px;
            left: -100px;
            animation: float1 12s infinite alternate ease-in-out;
        }

        .blob-2 {
            width: 450px;
            height: 450px;
            background: #7c3aed;
            bottom: -150px;
            right: -100px;
            animation: float2 15s infinite alternate ease-in-out;
        }

        @keyframes float1 {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(80px, 50px) scale(1.1); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        @keyframes float2 {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(-60px, -80px) scale(1.15); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        /* Glassmorphism login card */
        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
            padding: 44px 40px;
            z-index: 1;
            animation: cardEntrance 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            color: #f1f5f9;
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

        /* Logo icon with dynamic rotation/gradient */
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 62px;
            height: 62px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: #ffffff;
            font-size: 1.85rem;
            border-radius: 18px;
            margin: 0 auto 24px;
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.35);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .login-logo:hover {
            transform: scale(1.08) rotate(5deg);
        }

        .login-logo::after {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 200%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-25deg);
            animation: logoShine 6s infinite linear;
        }

        @keyframes logoShine {
            0% { left: -150%; }
            100% { left: 150%; }
        }

        .login-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: #ffffff;
            text-align: center;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            text-align: center;
            margin-bottom: 36px;
        }

        /* Custom inputs with glow hover/active effects */
        .form-group {
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #e2e8f0;
            letter-spacing: 0.2px;
        }

        .form-control-custom {
            background: rgba(30, 41, 59, 0.45) !important;
            border: 1.5px solid rgba(255, 255, 255, 0.1) !important;
            color: #f8fafc !important;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .form-control-custom::placeholder {
            color: #64748b;
        }

        .form-control-custom:focus {
            border-color: #3b82f6 !important;
            background: rgba(30, 41, 59, 0.75) !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.25) !important;
        }

        .form-error {
            font-size: 0.78rem;
            color: #f87171;
            margin: 0;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8125rem;
            margin-bottom: 28px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            cursor: pointer;
            user-select: none;
        }

        .remember-me input {
            accent-color: #2563eb;
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .forgot-password {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s ease;
        }

        .forgot-password:hover {
            color: #93c5fd;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            border-radius: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.35);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .register-link-wrap {
            text-align: center;
            margin-top: 28px;
            font-size: 0.875rem;
            color: #94a3b8;
        }

        .register-link {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .register-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }

        /* Glassmorphic custom alerts */
        .alert-custom {
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.8125rem;
            margin-bottom: 24px;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-custom-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.3);
        }
        
        .alert-custom-success {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
            border-color: rgba(34, 197, 94, 0.3);
        }
    </style>
</head>
<body>

    {{-- Glowing background circles --}}
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>

    <div class="login-card">
        <div class="login-logo">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        
        <h1 class="login-title">Welcome Back</h1>
        <p class="login-subtitle">Sign in to B2B Wholesale Portal</p>

        {{-- Success / Error Flash Messages --}}
        @if(session('error'))
            <div class="alert-custom alert-custom-danger">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.1rem;"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif
        @if(session('success'))
            <div class="alert-custom alert-custom-success">
                <i class="bi bi-check-circle-fill" style="font-size: 1.1rem;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" 
                       class="form-control-custom @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" placeholder="name@company.com" required autofocus autocomplete="email" />
                @error('email')
                    <p class="form-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group" style="margin-bottom: 16px;">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" 
                       class="form-control-custom" 
                       placeholder="••••••••" required autocomplete="current-password" />
            </div>

            {{-- Options --}}
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" class="form-check-input" />
                    <span>Remember me</span>
                </label>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Sign In
            </button>
        </form>

        <div class="register-link-wrap">
            Don't have an account? 
            <a href="{{ route('register') }}" class="register-link">Register here</a>
        </div>

        <div class="register-link-wrap" style="margin-top: 12px; font-size: 0.8rem; border-top: 1px solid rgba(255,255,255,0.06); padding-top: 12px;">
            Are you an administrator? 
            <a href="{{ route('admin.login') }}" class="register-link" style="color: #60a5fa;">Admin Sign In</a>
        </div>
    </div>

</body>
</html>
