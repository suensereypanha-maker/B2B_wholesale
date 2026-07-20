<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Pending — B2B Wholesale Portal</title>
    
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

        /* Glassmorphism pending card */
        .pending-card {
            width: 100%;
            max-width: 540px;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
            padding: 48px 40px;
            text-align: center;
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

        .pending-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 76px;
            height: 76px;
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            font-size: 2.35rem;
            border-radius: 50%;
            margin: 0 auto 28px;
            border: 1px solid rgba(245, 158, 11, 0.3);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.15);
        }

        .pending-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .pending-desc {
            font-size: 0.95rem;
            color: #94a3b8;
            line-height: 1.65;
            margin-bottom: 32px;
        }

        .pending-bullet-box {
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 24px;
            text-align: left;
            margin-bottom: 36px;
            font-size: 0.8125rem;
            color: #94a3b8;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .pending-bullet-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .pending-bullet-item i {
            color: #60a5fa;
            font-size: 1.1rem;
            margin-top: 1px;
        }

        .pending-bullet-item span {
            line-height: 1.4;
        }

        .btn-back-home {
            padding: 12px 32px;
            border-radius: 9999px;
            font-weight: 600;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
        }

        .btn-back-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.35);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
        }
    </style>
</head>
<body>

    {{-- Glowing background circles --}}
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>

    <div class="pending-card">
        <div class="pending-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        
        <h1 class="pending-title">Account Pending Approval</h1>
        <p class="pending-desc">
            Thank you for registering as a <strong>Supplier</strong> on B2B Wholesale Portal! 
            To maintain database integrity and trust, supplier accounts require review by our administrative team.
        </p>

        <div class="pending-bullet-box">
            <div class="pending-bullet-item">
                <i class="bi bi-shield-check-fill"></i>
                <span><strong>Verification Process:</strong> An administrator will check your supplier credentials and details.</span>
            </div>
            <div class="pending-bullet-item">
                <i class="bi bi-envelope-check-fill"></i>
                <span><strong>Notification:</strong> You will be able to log in as soon as your account is approved.</span>
            </div>
            <div class="pending-bullet-item">
                <i class="bi bi-info-circle-fill"></i>
                <span><strong>Need Help?</strong> Contact support at <a href="mailto:support@b2bwholesale.com" style="color: #60a5fa; text-decoration: none;">support@b2bwholesale.com</a> if you have any questions.</span>
            </div>
        </div>

        <a href="{{ route('login') }}" class="btn-back-home">
            <i class="bi bi-arrow-left"></i> Return to Login
        </a>
    </div>

</body>
</html>
