<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="B2B Wholesale Admin — Super Admin Dashboard" />
    <meta name="theme-color" content="#2563EB" />
    <title>@yield('title', 'Dashboard') — B2B Wholesale Admin</title>

    {{-- Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    {{-- Google Fonts (Inter) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Dashboard CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

    {{-- Roles & Permissions CSS --}}
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}" />

    @stack('styles')
</head>
<body>

    {{-- Sidebar Overlay (mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">

        {{-- Sidebar --}}
        @include('layouts.admin.partials.sidebar')

        {{-- Main Area --}}
        <div class="main-area" id="mainArea">

            {{-- Top Navbar --}}
            @include('layouts.admin.partials.navbar')

            {{-- Page Content --}}
            <main class="page-content">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('layouts.admin.partials.footer')

        </div>{{-- /main-area --}}
    </div>{{-- /admin-wrapper --}}

    {{-- Bootstrap 5 Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    {{-- Dashboard JS --}}
    <script src="{{ asset('js/dashboard.js') }}?v={{ time() }}"></script>

    @stack('scripts')
</body>
</html>
