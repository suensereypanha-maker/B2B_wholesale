<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Sign In — B2B Wholesale Portal</title>
    
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
            background: #dc2626; /* Crimson Red for Admin */
            top: -100px;
            left: -100px;
            animation: float1 12s infinite alternate ease-in-out;
        }

        .blob-2 {
            width: 450px;
            height: 450px;
            background: #ea580c; /* Orange for Admin */
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
        .logo-header {
            text-align: center;
            margin-bottom: 32px;
            position: relative;
        }

        .logo-icon-container {
            width: 60px;
            height: 60px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(220, 38, 38, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: transform 0.4s ease;
        }

        .logo-icon-container:hover {
            transform: rotate(10deg);
        }

        .logo-icon-container i {
            font-size: 1.85rem;
            color: #ffffff;
            animation: shimmer 3s infinite linear;
        }

        @keyframes shimmer {
            0% { filter: brightness(1); }
            50% { filter: brightness(1.25) drop-shadow(0 0 4px rgba(255,255,255,0.6)); }
            100% { filter: brightness(1); }
        }

        .logo-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.75px;
            margin-bottom: 4px;
            background: linear-gradient(to right, #f8fafc, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-subtitle {
            font-size: 0.8125rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* Custom inputs matching dashboard system */
        .form-floating-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .form-floating-custom .form-control {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 16px 16px 16px 48px;
            height: 58px;
            color: #ffffff;
            font-size: 0.9rem;
            transition: all 0.25s ease;
        }

        .form-floating-custom .form-control::placeholder {
            color: #64748b;
        }

        .form-floating-custom .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
            outline: none;
        }

        .form-floating-custom .input-icon {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.15rem;
            pointer-events: none;
            transition: color 0.25s ease;
        }

        .form-floating-custom .form-control:focus ~ .input-icon {
            color: #ef4444;
        }

        /* Remember & Forgot Pass */
        .option-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            font-size: 0.8125rem;
        }

        .form-check-input-custom {
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            width: 16px;
            height: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-input-custom:checked {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .form-check-label {
            color: #94a3b8;
            cursor: pointer;
            user-select: none;
        }

        .forgot-link {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.2s ease;
        }

        .forgot-link:hover {
            opacity: 0.85;
            text-decoration: underline;
        }

        /* Action button */
        .btn-submit-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 0.92rem;
            color: #ffffff;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-submit-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.35);
        }

        .btn-submit-gradient:active {
            transform: translateY(0);
        }

        /* Redirection helper block at bottom */
        .portal-switch {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.06);
            font-size: 0.8125rem;
            color: #64748b;
        }

        .portal-switch-link {
            color: #ef4444;
            text-decoration: none;
            font-weight: 700;
            transition: opacity 0.2s ease;
        }

        .portal-switch-link:hover {
            opacity: 0.85;
            text-decoration: underline;
        }

        /* Alerts and errors list */
        .alert-custom {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 24px;
            font-size: 0.8125rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-custom-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #86efac;
        }
    </style>
</head>
<body>

    {{-- Backdrop glowing circles --}}
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>

    <div class="login-card">
        
        {{-- Logo Header --}}
        <div class="logo-header">
            <div class="logo-icon-container">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h1 class="logo-title">Administrator Portal</h1>
            <p class="logo-subtitle">Access management control systems</p>
        </div>

        {{-- Alerts --}}
        @if(session('error'))
            <div class="alert-custom">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.1rem; color: #ef4444;"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if(session('success'))
            <div class="alert-custom alert-custom-success">
                <i class="bi bi-check-circle-fill" style="font-size: 1.1rem;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-custom">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.1rem; color: #ef4444;"></i>
                <div style="flex-grow: 1;">
                    <ul style="margin: 0; padding-left: 14px; text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            {{-- Email Input --}}
            <div class="form-floating-custom">
                <input type="email" class="form-control" name="email" id="adminEmail" placeholder="admin@wholesale.com" value="{{ old('email') }}" required autofocus />
                <i class="bi bi-envelope input-icon"></i>
            </div>

            {{-- Password Input --}}
            <div class="form-floating-custom">
                <input type="password" class="form-control" name="password" id="adminPassword" placeholder="••••••••" required />
                <i class="bi bi-lock input-icon"></i>
            </div>

            {{-- Utilities Check --}}
            <div class="option-row">
                <div class="form-check d-flex align-items-center gap-2">
                    <input class="form-check-input form-check-input-custom m-0" type="checkbox" name="remember" id="adminRemember" {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label" for="adminRemember">Remember session</label>
                </div>
                <a href="#" class="forgot-link">Recover access?</a>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit-gradient">
                <i class="bi bi-box-arrow-in-right"></i> Sign In to Dashboard
            </button>

            {{-- Portal Switcher --}}
            <div class="portal-switch">
                Are you a Buyer or a Supplier? <a href="{{ route('login') }}" class="portal-switch-link">Login here</a>
            </div>

        </form>

    </div>

</body>
</html>
