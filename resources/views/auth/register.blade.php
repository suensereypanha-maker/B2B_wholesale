<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — B2B Wholesale Portal</title>
    
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
            padding: 40px 20px;
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
            width: 450px;
            height: 450px;
            background: #2563eb;
            top: -150px;
            left: -100px;
            animation: float1 14s infinite alternate ease-in-out;
        }

        .blob-2 {
            width: 500px;
            height: 500px;
            background: #7c3aed;
            bottom: -200px;
            right: -100px;
            animation: float2 18s infinite alternate ease-in-out;
        }

        @keyframes float1 {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(90px, 60px) scale(1.1); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        @keyframes float2 {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(-70px, -90px) scale(1.15); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        /* Glassmorphism register card */
        .register-card {
            width: 100%;
            max-width: 500px;
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

        /* Logo icon */
        .register-logo {
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

        .register-logo:hover {
            transform: scale(1.08) rotate(-5deg);
        }

        .register-logo::after {
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

        .register-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: #ffffff;
            text-align: center;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .register-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            text-align: center;
            margin-bottom: 36px;
        }

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

        /* Role Selector Cards */
        .role-selector-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 4px;
        }

        .role-card-option {
            background: rgba(30, 41, 59, 0.3);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 20px 16px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
        }

        .role-card-option:hover {
            border-color: rgba(59, 130, 246, 0.4);
            background: rgba(30, 41, 59, 0.5);
            transform: translateY(-2px);
        }

        .role-card-option input {
            position: absolute;
            top: 20px;
            right: 16px;
            accent-color: #3b82f6;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .role-card-option.selected {
            border-color: #3b82f6;
            background: rgba(37, 99, 235, 0.12);
            box-shadow: 0 0 15px rgba(37, 99, 235, 0.15);
        }

        .role-icon {
            font-size: 1.5rem;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .role-card-option.selected .role-icon {
            color: #60a5fa;
        }

        .role-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: #ffffff;
        }

        .role-desc {
            font-size: 0.72rem;
            color: #94a3b8;
            line-height: 1.4;
        }

        .role-card-option.selected .role-desc {
            color: #cbd5e1;
        }

        .btn-register {
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
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.35);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link-wrap {
            text-align: center;
            margin-top: 28px;
            font-size: 0.875rem;
            color: #94a3b8;
        }

        .login-link {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .login-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    {{-- Glowing background circles --}}
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>

    <div class="register-card">
        <div class="register-logo">
            <i class="bi bi-person-plus-fill"></i>
        </div>
        
        <h1 class="register-title">Create Account</h1>
        <p class="register-subtitle">Join the B2B Wholesale Platform</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            {{-- Name --}}
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input type="text" id="name" name="name" 
                       class="form-control-custom @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name" />
                @error('name')
                    <p class="form-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" 
                       class="form-control-custom @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" placeholder="john@company.com" required autocomplete="email" />
                @error('email')
                    <p class="form-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role Selection --}}
            <div class="form-group">
                <label class="form-label">Account Type</label>
                <div class="role-selector-grid">
                    
                    {{-- Buyer Card --}}
                    <label class="role-card-option selected" id="label-buyer">
                        <input type="radio" name="registration_role" value="buyer" checked />
                        <div class="role-icon"><i class="bi bi-cart3"></i></div>
                        <div class="role-name">Buyer / Customer</div>
                        <div class="role-desc">View products, catalogs, and make purchases. Auto-approved.</div>
                    </label>

                    {{-- Supplier Card --}}
                    <label class="role-card-option" id="label-supplier">
                        <input type="radio" name="registration_role" value="supplier" />
                        <div class="role-icon"><i class="bi bi-truck"></i></div>
                        <div class="role-name">Supplier</div>
                        <div class="role-desc">Upload catalog, sell products, and track orders. Requires admin approval.</div>
                    </label>

                </div>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" 
                       class="form-control-custom @error('password') is-invalid @enderror" 
                       placeholder="••••••••" required autocomplete="new-password" />
                @error('password')
                    <p class="form-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="form-control-custom" 
                       placeholder="••••••••" required autocomplete="new-password" />
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-register">
                <i class="bi bi-person-check-fill"></i> Create Account
            </button>
        </form>

        <div class="login-link-wrap">
            Already have an account? 
            <a href="{{ route('login') }}" class="login-link">Sign In</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const radios = document.querySelectorAll('input[name="registration_role"]');
            const buyerLabel = document.getElementById('label-buyer');
            const supplierLabel = document.getElementById('label-supplier');

            radios.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.value === 'buyer') {
                        buyerLabel.classList.add('selected');
                        supplierLabel.classList.remove('selected');
                    } else {
                        buyerLabel.classList.remove('selected');
                        supplierLabel.classList.add('selected');
                    }
                });
            });
        });
    </script>

</body>
</html>
