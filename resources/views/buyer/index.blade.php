<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="TechVanguard Wholesale — Premium B2B Computer Hardware Marketplace & Buyer Dashboard" />
    <meta name="theme-color" content="#0B1F3A" />
    <title>TechVanguard Wholesale — B2B Buyer Portal</title>

    {{-- Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    {{-- Google Fonts (Inter) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary-navy: #0B1F3A;
            --primary-navy-light: #1E293B;
            --electric-blue: #2563EB;
            --electric-blue-hover: #1D4ED8;
            --secondary-white: #FFFFFF;
            --secondary-bg: #F8FAFC;
            --text-dark: #334155;
            --text-muted: #64748B;
            --color-green: #16A34A;
            --color-green-light: #DCFCE7;
            --color-orange: #F97316;
            --color-orange-light: #FFEDD5;
            --color-red: #DC2626;
            --color-red-light: #FEE2E2;
            --border-color: #E2E8F0;
            --font-inter: 'Inter', sans-serif;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: var(--font-inter);
            background-color: var(--secondary-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Top Navbar Redesign — Premium Frosted Theme */
        .navbar-b2b {
            background: rgba(9, 15, 28, 0.96) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 0.85rem 2rem;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: var(--transition-smooth);
        }

        .navbar-brand-b2b {
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: -0.03em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            background: linear-gradient(135deg, #FFFFFF 30%, #CBD5E1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
        }

        .navbar-brand-b2b span {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
        }

        .b2b-badge {
            background: linear-gradient(135deg, var(--color-orange) 0%, #EA580C 100%);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            vertical-align: middle;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);
        }

        .search-container {
            max-width: 440px;
            width: 100%;
        }

        .search-input-group {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 99px; /* Pill layout */
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        .search-input-group:focus-within {
            background-color: rgba(255, 255, 255, 0.08) !important;
            border-color: rgba(37, 99, 235, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15), inset 0 2px 4px rgba(0,0,0,0.1) !important;
        }

        .search-input-group .form-control {
            background: transparent !important;
            border: none !important;
            color: #F8FAFC !important;
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
            box-shadow: none !important;
        }

        .search-input-group .form-control::placeholder {
            color: rgba(255, 255, 255, 0.45);
        }

        .search-input-group .input-group-text {
            background: transparent !important;
            border: none !important;
            color: rgba(255, 255, 255, 0.4) !important;
            padding-left: 1.2rem;
        }

        .search-input-group:focus-within .input-group-text {
            color: #60A5FA !important;
        }

        .search-input-group .btn {
            color: rgba(255, 255, 255, 0.4) !important;
            background: transparent !important;
            border: none !important;
            padding-right: 1.2rem;
            transition: color 0.2s ease;
        }

        .search-input-group .btn:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .nav-link-b2b {
            color: rgba(241, 245, 249, 0.75) !important;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.5rem 0.9rem !important;
            border-radius: 99px; /* Pill hover */
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
        }

        .nav-link-b2b:hover {
            color: #FFFFFF !important;
            background-color: rgba(255, 255, 255, 0.06);
        }

        .nav-link-b2b.active {
            color: #FFFFFF !important;
            background-color: var(--electric-blue) !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }

        .cart-badge-container {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background-color: var(--color-orange);
            color: white;
            font-size: 0.65rem;
            padding: 0.15rem 0.35rem;
            border-radius: 50px;
            font-weight: 700;
        }

        .user-profile-btn {
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 99px;
            padding: 0.4rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #F8FAFC;
            background: rgba(255, 255, 255, 0.04);
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .user-profile-btn:hover {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* Premium Dark Dropdown Customization */
        .navbar-b2b .dropdown-menu {
            background-color: rgba(9, 15, 28, 0.98) !important; /* Cohesive Midnight Slate */
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
            padding: 0.5rem !important;
            margin-top: 0.75rem !important;
        }

        /* Guarantee text readability in dropdown menus */
        .navbar-b2b .dropdown-menu .fw-bold {
            color: #FFFFFF !important;
        }

        .navbar-b2b .dropdown-menu .text-muted {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .navbar-b2b .dropdown-menu .text-success {
            color: #4ADE80 !important; /* Brighter premium green */
        }

        .navbar-b2b .dropdown-menu .dropdown-item {
            border-radius: 8px;
            font-size: 0.85rem;
            color: rgba(241, 245, 249, 0.8) !important;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .navbar-b2b .dropdown-menu .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #FFFFFF !important;
        }

        .navbar-b2b .dropdown-menu .dropdown-item i {
            color: rgba(255, 255, 255, 0.5) !important;
            transition: all 0.2s ease;
        }

        .navbar-b2b .dropdown-menu .dropdown-item:hover i {
            color: #60A5FA !important;
        }

        .navbar-b2b .dropdown-menu .dropdown-item.text-danger {
            color: #EF4444 !important;
        }

        .navbar-b2b .dropdown-menu .dropdown-item.text-danger:hover {
            background-color: rgba(239, 68, 68, 0.1) !important;
            color: #F87171 !important;
        }

        .navbar-b2b .dropdown-menu .dropdown-item.text-danger:hover i {
            color: #EF4444 !important;
        }

        .navbar-b2b .dropdown-menu.categories-mega-menu {
            width: 720px !important;
            max-width: calc(100vw - 2rem) !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            margin-top: 0.75rem !important;
            padding: 1.5rem !important;
            border-radius: 16px !important;
        }

        .mega-menu-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            color: rgba(241, 245, 249, 0.8) !important;
            transition: all 0.25s ease;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.04);
            height: 100%;
        }

        .mega-menu-item:hover {
            background: rgba(37, 99, 235, 0.12) !important;
            border-color: rgba(37, 99, 235, 0.3) !important;
            color: #FFFFFF !important;
            transform: translateY(-2px);
        }

        .mega-menu-icon {
            font-size: 1.5rem;
            color: #60A5FA;
            background: rgba(96, 165, 250, 0.1);
            width: 44px;
            height: 44px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .mega-menu-item:hover .mega-menu-icon {
            background: var(--electric-blue) !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }

        .mega-menu-title {
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 0.15rem;
            color: #FFFFFF;
        }

        .mega-menu-desc {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.45);
            line-height: 1.3;
        }

        /* Layout Architecture */
        .portal-layout {
            display: flex;
            flex: 1;
            width: 100%;
        }

        .storefront-view {
            flex: 1;
            width: 100%;
            padding: 2rem 1.5rem;
        }

        /* Dashboard Sidebar Layout */
        .dashboard-container {
            display: flex;
            width: 100%;
            flex: 1;
        }

        .dashboard-sidebar {
            width: 260px;
            background-color: #090F1C; /* Cohesive Midnight Slate */
            color: var(--secondary-white);
            border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
            padding: 1.5rem 0.75rem;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: var(--transition-smooth);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .sidebar-section-header {
            font-size: 0.65rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.35);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.85rem 1rem 0.35rem 1rem;
        }

        .sidebar-item a {
            color: rgba(241, 245, 249, 0.7) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar-item a i {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.4);
            transition: color 0.2s ease;
        }

        .sidebar-item a:hover {
            color: #FFFFFF !important;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sidebar-item a:hover i {
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar-item.active a {
            color: #FFFFFF !important;
            background-color: rgba(37, 99, 235, 0.08) !important;
            font-weight: 600;
        }

        .sidebar-item.active a i {
            color: #60A5FA !important;
        }

        /* Glowing vertical indicator on the left of active link */
        .sidebar-item.active a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 3px;
            background-color: var(--electric-blue);
            border-radius: 99px;
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.8);
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1.25rem;
            margin-top: 1rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        /* User Profile footer widget styling */
        .sidebar-user-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 0.65rem 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            transition: background 0.2s ease;
        }

        .sidebar-user-card:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .user-avatar-circle {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
            flex-shrink: 0;
        }

        .user-info-text {
            line-height: 1.2;
            overflow: hidden;
        }

        .user-name-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #FFFFFF;
            margin-bottom: 0.1rem;
        }

        .user-role-label {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.4);
        }

        .dashboard-content {
            flex: 1;
            background-color: var(--secondary-bg);
            padding: 2rem;
            overflow-y: auto;
        }

        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, #0B1528 0%, #1E3A8A 60%, #3B82F6 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--secondary-white);
            border-radius: 16px;
            padding: 4rem 3rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 30px -10px rgba(37, 99, 235, 0.35) !important;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            right: -10%;
            top: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-banner h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
        }

        .hero-banner p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1.15rem;
            margin-bottom: 2rem;
            max-width: 600px;
        }

        /* Category Cards */
        .category-card {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            border-color: var(--electric-blue);
        }

        .category-icon {
            font-size: 2rem;
            color: var(--electric-blue);
            margin-bottom: 0.75rem;
        }

        .category-title {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
            margin: 0;
        }

        /* Product Cards */
        .product-card {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: var(--transition-smooth);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -8px rgba(0,0,0,0.15);
            border-color: rgba(37, 99, 235, 0.3);
        }

        .product-image-wrapper {
            position: relative;
            background-color: var(--secondary-bg);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
        }

        .product-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(11, 31, 58, 0.4);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
            z-index: 2;
        }

        .product-image-overlay span {
            color: #FFFFFF;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.4rem 0.9rem;
            background: var(--electric-blue);
            border-radius: 99px;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4);
            transform: translateY(10px);
            transition: all 0.25s ease;
        }

        .product-image-wrapper:hover .product-image-overlay {
            opacity: 1;
        }

        .product-image-wrapper:hover .product-image-overlay span {
            transform: translateY(0);
        }

        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            transition: var(--transition-smooth);
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-brand-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--electric-blue);
            letter-spacing: 0.05em;
        }

        .product-moq-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(249, 115, 22, 0.95);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .product-stock-tag {
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .stock-available {
            color: var(--color-green);
        }

        .stock-low {
            color: var(--color-orange);
        }

        .stock-out {
            color: var(--color-red);
        }

        .product-info {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-dark);
            margin: 0.5rem 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.8rem;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .product-title:hover {
            color: var(--electric-blue);
        }

        .sku-text {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .price-tiers-preview {
            background-color: var(--secondary-bg);
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }

        .price-tier-row {
            display: flex;
            justify-content: space-between;
            color: var(--text-dark);
        }

        .price-tier-row.active-tier {
            color: var(--color-green);
            font-weight: 700;
        }

        .price-lead {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary-navy);
            margin-top: auto;
        }

        .price-lead-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .product-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            padding: 1.25rem;
            border-top: 1px solid var(--border-color);
            background-color: var(--secondary-bg);
        }

        /* Listing Page Sidebar */
        .filter-sidebar {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            position: sticky;
            top: 100px;
        }

        .filter-group {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.25rem;
        }

        .filter-group:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .filter-group-title {
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary-navy);
            margin-bottom: 0.75rem;
        }

        .filter-checkbox-label {
            font-size: 0.9rem;
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.4rem;
        }

        /* Detail Page Grid */
        .detail-card {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .detail-image-box {
            background-color: var(--secondary-bg);
            border-radius: 12px;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 450px;
            border: 1px solid var(--border-color);
            position: relative;
        }

        .detail-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .spec-table {
            width: 100%;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .spec-table th {
            font-weight: 600;
            color: var(--text-muted);
            padding: 0.6rem;
            border-bottom: 1px solid var(--border-color);
            width: 35%;
        }

        .spec-table td {
            color: var(--text-dark);
            padding: 0.6rem;
            border-bottom: 1px solid var(--border-color);
        }

        .wholesale-table {
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            margin: 1rem 0;
        }

        .wholesale-table th {
            background-color: var(--primary-navy);
            color: var(--secondary-white);
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .wholesale-table td {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border-color);
        }

        .wholesale-table tr.active-wholesale-row {
            background-color: var(--color-green-light);
            color: var(--color-green);
            font-weight: 700;
        }

        .wholesale-table tr.active-wholesale-row td {
            border-color: rgba(22, 163, 74, 0.2);
        }

        /* Shopping Cart Page */
        .cart-table-wrapper {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .cart-table th {
            background-color: #F1F5F9;
            color: var(--primary-navy);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-table td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .cart-product-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cart-product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            background-color: var(--secondary-bg);
            border: 1px solid var(--border-color);
        }

        .qty-adjuster {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            overflow: hidden;
            width: max-content;
        }

        .qty-adjuster button {
            background-color: var(--secondary-bg);
            border: none;
            padding: 0.4rem 0.75rem;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .qty-adjuster button:hover {
            background-color: #E2E8F0;
        }

        .qty-adjuster input {
            border: none;
            width: 50px;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .cart-summary-card {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 100px;
        }

        /* Widgets */
        .widget-card {
            background-color: var(--secondary-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: var(--transition-smooth);
        }

        .widget-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 12px -3px rgba(0,0,0,0.05);
        }

        .widget-info h6 {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .widget-info h3 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-navy);
            margin: 0;
        }

        .widget-icon {
            font-size: 2.25rem;
            color: var(--electric-blue);
            background-color: rgba(37, 99, 235, 0.08);
            width: 60px;
            height: 60px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .credit-widget {
            border-left: 4px solid var(--electric-blue);
        }
        .orders-widget {
            border-left: 4px solid var(--color-orange);
        }
        .pending-widget {
            border-left: 4px solid #EAB308;
        }
        .spending-widget {
            border-left: 4px solid var(--color-green);
        }

        /* Premium Badge Statuses — Soft Translucent Tones */
        .status-badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.35rem 0.8rem;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            border: 1px solid transparent;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .status-pending {
            background-color: rgba(234, 179, 8, 0.08) !important;
            color: #D97706 !important;
            border-color: rgba(234, 179, 8, 0.15) !important;
        }

        .status-approved {
            background-color: rgba(37, 99, 235, 0.08) !important;
            color: #2563EB !important;
            border-color: rgba(37, 99, 235, 0.15) !important;
        }

        .status-processing {
            background-color: rgba(249, 115, 22, 0.08) !important;
            color: #F97316 !important;
            border-color: rgba(249, 115, 22, 0.15) !important;
        }

        .status-completed {
            background-color: rgba(22, 163, 74, 0.08) !important;
            color: #16A34A !important;
            border-color: rgba(22, 163, 74, 0.15) !important;
        }

        .status-rejected {
            background-color: rgba(220, 38, 38, 0.08) !important;
            color: #DC2626 !important;
            border-color: rgba(220, 38, 38, 0.15) !important;
        }

        /* Card Component Redesign */
        .card {
            background-color: var(--secondary-white) !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02) !important;
            overflow: hidden !important;
            transition: var(--transition-smooth);
        }

        .card:hover {
            box-shadow: 0 12px 25px -5px rgba(15, 23, 42, 0.06), 0 6px 12px -2px rgba(15, 23, 42, 0.03) !important;
        }

        .card-header {
            background-color: var(--secondary-white) !important;
            border-bottom: 1px solid #F1F5F9 !important;
            padding: 1.25rem 1.5rem !important;
        }

        /* Table Redesign — Spacious & Clean */
        .table {
            border-collapse: separate !important;
            border-spacing: 0 !important;
            width: 100% !important;
            margin-bottom: 0 !important;
            overflow: hidden;
        }

        .table th {
            background-color: #F8FAFC !important;
            color: #475569 !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            padding: 1.1rem 1.5rem !important;
            border-bottom: 2px solid #E2E8F0 !important;
            border-top: none !important;
        }

        .table td {
            padding: 1.15rem 1.5rem !important;
            border-bottom: 1px solid #F1F5F9 !important;
            color: #334155 !important;
            font-size: 0.85rem !important;
            vertical-align: middle !important;
            background-color: #FFFFFF !important;
            transition: background-color 0.2s ease;
        }

        .table tr:hover td {
            background-color: #F8FAFC !important;
        }

        /* Rounding table corners inside overflow-hidden card */
        .table tr:first-child th:first-child {
            border-top-left-radius: 16px !important;
        }
        .table tr:first-child th:last-child {
            border-top-right-radius: 16px !important;
        }
        .table tr:last-child td:first-child {
            border-bottom-left-radius: 16px !important;
        }
        .table tr:last-child td:last-child {
            border-bottom-right-radius: 16px !important;
        }

        /* Pill Action Buttons in Tables */
        .btn-table-action {
            border-radius: 99px !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            padding: 0.4rem 1.1rem !important;
            transition: all 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.3rem !important;
            background-color: rgba(37, 99, 235, 0.05) !important;
            color: var(--electric-blue) !important;
            border: 1px solid rgba(37, 99, 235, 0.15) !important;
        }

        .btn-table-action:hover {
            background-color: var(--electric-blue) !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
            border-color: var(--electric-blue) !important;
        }

        /* Modals & Forms */
        .modal-content-b2b {
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }

        .modal-header-b2b {
            background-color: var(--primary-navy);
            color: var(--secondary-white);
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        .modal-header-b2b .btn-close {
            filter: invert(1) grayscale(1) brightness(2);
        }

        /* Toast system */
        .toast-container-b2b {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1060;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-b2b {
            background-color: var(--primary-navy);
            color: var(--secondary-white);
            padding: 1rem 1.25rem;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transform: translateX(120%);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            max-width: 350px;
        }

        .toast-b2b.show {
            transform: translateX(0);
        }

        .toast-b2b-success {
            border-left: 4px solid var(--color-green);
        }

        .toast-b2b-warning {
            border-left: 4px solid var(--color-orange);
        }

        .toast-b2b-danger {
            border-left: 4px solid var(--color-red);
        }

        /* Print Media styling for Invoices */
        @media print {
            body * {
                visibility: hidden;
            }
            #printableInvoiceArea, #printableInvoiceArea * {
                visibility: visible;
            }
            #printableInvoiceArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: white !important;
                color: black !important;
                padding: 2rem !important;
            }
            .no-print {
                display: none !important;
            }
        }

        /* Mobile Sidebar toggle styles */
        @media (max-width: 991.98px) {
            .dashboard-sidebar {
                position: fixed;
                left: -260px;
                top: 70px;
                bottom: 0;
                z-index: 1040;
            }
            .dashboard-sidebar.show {
                left: 0;
            }
            .dashboard-container {
                position: relative;
            }
            .dashboard-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-b2b">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand-b2b" href="#/">
                <i class="bi bi-cpu-fill"></i> TECHVANGUARD <span>WHOLESALE</span> <span class="b2b-badge">B2B Portal</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Collapse Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Search bar (Live search filter redirecting to products page) -->
                <div class="search-container mx-lg-auto my-3 my-lg-0">
                    <div class="input-group search-input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="globalSearchInput" class="form-control" placeholder="Search wholesale hardware by name, SKU, sockets..." aria-label="Search">
                        <button class="btn" type="button" id="clearSearchBtn"><i class="bi bi-x-circle-fill"></i></button>
                    </div>
                </div>

                <!-- Navigation links -->
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link-b2b" href="#/" id="navLinkHome"><i class="bi bi-house-door-fill"></i> Storefront</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-b2b" href="#/products" id="navLinkProducts"><i class="bi bi-grid-3x3-gap-fill"></i> Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link-b2b dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tags-fill"></i> Categories
                        </a>
                        <div class="dropdown-menu categories-mega-menu border-0 shadow" aria-labelledby="categoriesDropdown">
                            <div class="container-fluid p-2">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <a class="mega-menu-item" href="#/products?category=CPU">
                                            <div class="mega-menu-icon"><i class="bi bi-cpu-fill"></i></div>
                                            <div>
                                                <div class="mega-menu-title">Processors</div>
                                                <div class="mega-menu-desc">Intel Core & AMD Ryzen CPUs</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="mega-menu-item" href="#/products?category=GPU">
                                            <div class="mega-menu-icon"><i class="bi bi-gpu-card"></i></div>
                                            <div>
                                                <div class="mega-menu-title">Graphics Cards</div>
                                                <div class="mega-menu-desc">NVIDIA GeForce & AMD Radeon</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="mega-menu-item" href="#/products?category=RAM">
                                            <div class="mega-menu-icon"><i class="bi bi-memory"></i></div>
                                            <div>
                                                <div class="mega-menu-title">Memory (RAM)</div>
                                                <div class="mega-menu-desc">DDR4 & DDR5 desktop modules</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="mega-menu-item" href="#/products?category=SSD">
                                            <div class="mega-menu-icon"><i class="bi bi-hdd-fill"></i></div>
                                            <div>
                                                <div class="mega-menu-title">Storage (SSDs)</div>
                                                <div class="mega-menu-desc">High-speed M.2 NVMe & SATA SSDs</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="mega-menu-item" href="#/products?category=Motherboard">
                                            <div class="mega-menu-icon"><i class="bi bi-motherboard"></i></div>
                                            <div>
                                                <div class="mega-menu-title">Motherboards</div>
                                                <div class="mega-menu-desc">Intel Z790 & AMD B650 chipsets</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="mega-menu-item" href="#/products?category=Accessories">
                                            <div class="mega-menu-icon"><i class="bi bi-keyboard"></i></div>
                                            <div>
                                                <div class="mega-menu-title">Accessories</div>
                                                <div class="mega-menu-desc">Keyboards, mice & peripherals</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 mt-3 pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                                        <span class="text-muted small"><i class="bi bi-shield-check"></i> Contract wholesale pricing applied</span>
                                        <a href="#/products" class="btn btn-primary btn-sm px-3" style="background-color: var(--electric-blue); font-size: 0.8rem">View All Components <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-b2b" href="#/dashboard" id="navLinkDashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-b2b" href="#/orders" id="navLinkOrders"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Purchase Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-b2b" href="#/invoices" id="navLinkInvoices"><i class="bi bi-receipt-cutoff"></i> Invoices</a>
                    </li>

                    <!-- Shopping Cart Icon -->
                    <li class="nav-item mx-lg-2">
                        <a class="nav-link-b2b cart-badge-container px-2" href="#/cart" id="navLinkCart">
                            <i class="bi bi-cart3 fs-5"></i>
                            <span class="cart-badge d-none" id="cartGlobalBadge">0</span>
                        </a>
                    </li>

                    <!-- User Profile Dropdown -->
                    <li class="nav-item ms-lg-2">
                        <div class="dropdown">
                            <button class="user-profile-btn dropdown-toggle" type="button" id="userProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-building-fill-check"></i>
                                <span class="d-inline" id="userCompanyShort">AlphaTech Solutions</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2" aria-labelledby="userProfileDropdown">
                                <li>
                                    <div class="px-3 py-2 border-bottom">
                                        <div class="fw-bold">Serey Panha</div>
                                        <div class="text-muted small">Purchasing Manager</div>
                                        <div class="text-success small fw-semibold mt-1"><i class="bi bi-check-circle-fill"></i> Verified Corporate Account</div>
                                    </div>
                                </li>
                                <li><a class="dropdown-item" href="#/dashboard"><i class="bi bi-speedometer2 me-2 text-muted"></i> Buyer Dashboard</a></li>
                                <li><a class="dropdown-item" href="#/orders"><i class="bi bi-file-earmark-spreadsheet me-2 text-muted"></i> Business Orders</a></li>
                                <li><a class="dropdown-item" href="#/invoices"><i class="bi bi-receipt me-2 text-muted"></i> Invoices & Terms</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Portal Dynamic Container -->
    <div class="portal-layout" id="portalLayout">
        <!-- Render page view dynamically here -->
    </div>

    <!-- RFQ / Quotation Request Modal -->
    <div class="modal fade" id="rfqModal" tabindex="-1" aria-labelledby="rfqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-b2b">
                <div class="modal-header modal-header-b2b">
                    <h5 class="modal-title" id="rfqModalLabel"><i class="bi bi-file-earmark-text-fill me-2 text-orange"></i> Request Bulk Quotation (RFQ)</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="rfqForm">
                    <input type="hidden" id="rfqProductId">
                    <div class="modal-body p-4">
                        <div class="p-3 bg-light rounded border border-light mb-3">
                            <h6 class="mb-1" id="rfqProductTitle">Product Title</h6>
                            <span class="text-muted small" id="rfqProductSku">SKU: ---</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="rfqQty" class="form-label fw-semibold">Target Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="rfqQty" required min="1">
                                <div class="form-text" id="rfqMoqWarning">MOQ: 5 units</div>
                            </div>
                            <div class="col-md-6">
                                <label for="rfqTargetPrice" class="form-label fw-semibold">Target Unit Price ($) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="rfqTargetPrice" required step="0.01">
                                <div class="form-text">Ref starting price: <span id="rfqRefPrice">$350</span></div>
                            </div>
                            <div class="col-12">
                                <label for="rfqDeliveryDate" class="form-label fw-semibold">Expected Delivery Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="rfqDeliveryDate" required>
                            </div>
                            <div class="col-12">
                                <label for="rfqNotes" class="form-label fw-semibold">Special Specifications / Packaging Notes</label>
                                <textarea class="form-control" id="rfqNotes" rows="3" placeholder="Specify if you require bulk shipping pallets, custom labels, custom testing services, etc."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4" style="background-color: var(--electric-blue); border-color: var(--electric-blue)">Submit RFQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Purchase Order Details Modal -->
    <div class="modal fade" id="poDetailsModal" tabindex="-1" aria-labelledby="poDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content modal-content-b2b">
                <div class="modal-header modal-header-b2b">
                    <h5 class="modal-title" id="poDetailsModalLabel"><i class="bi bi-file-spreadsheet me-2 text-warning"></i> Purchase Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="poModalContent">
                    <!-- PO Details loaded dynamically -->
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer-fill me-1"></i> Print / Save PDF</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Details Modal -->
    <div class="modal fade" id="invoiceDetailsModal" tabindex="-1" aria-labelledby="invoiceDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content modal-content-b2b">
                <div class="modal-header modal-header-b2b">
                    <h5 class="modal-title" id="invoiceDetailsModalLabel"><i class="bi bi-receipt-cutoff me-2 text-success"></i> Corporate Invoice Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="invoiceModalContent">
                    <!-- Invoice Details loaded dynamically -->
                </div>
                <div class="modal-footer bg-light border-0 no-print">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="window.print()"><i class="bi bi-file-earmark-pdf-fill me-1"></i> Download PDF / Print</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div class="toast-container-b2b" id="toastContainer"></div>

    <!-- Footer -->
    <footer class="footer mt-auto py-4 bg-dark text-white border-top border-secondary">
        <div class="container-fluid px-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0 text-muted small">&copy; 2026 TechVanguard Wholesale. All rights reserved. business-verified corporate hardware platform.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#/" class="text-muted text-decoration-none me-3 small">Store Terms</a>
                    <a href="#/dashboard" class="text-muted text-decoration-none me-3 small">Corporate Credit Terms</a>
                    <a href="mailto:support@techvanguard.com" class="text-muted text-decoration-none small">Enterprise Support</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Interactive JavaScript Engine -->
    <script>
        // Global Products Mock Data Structure
        const products = [
            {
                id: 1,
                name: "Intel Core i7-14700K Desktop Processor",
                category: "CPU",
                brand: "Intel",
                image: "https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=600&auto=format&fit=crop&q=80",
                stock: 120,
                price: 350.00,
                moq: 5,
                tiers: [
                    { qty: "5-9", price: 350.00 },
                    { qty: "10-49", price: 330.00 },
                    { qty: "50+", price: 310.00 }
                ],
                specification: {
                    socket: "LGA1700",
                    cores: "20 Cores (8 P-cores + 12 E-cores)",
                    generation: "14th Gen Intel Core",
                    warranty: "3 Years",
                    power: "125W Base TDP"
                },
                description: "Intel Core i7-14700K desktop processor. Featuring Intel Turbo Boost Max Technology 3.0, and PCIe 5.0 & 4.0 support, DDR5 and DDR4 support."
            },
            {
                id: 2,
                name: "AMD Ryzen 7 7800X3D Processor",
                category: "CPU",
                brand: "AMD",
                image: "https://images.unsplash.com/photo-1608889174633-56ad37d9011b?w=600&auto=format&fit=crop&q=80",
                stock: 85,
                price: 349.00,
                moq: 5,
                tiers: [
                    { qty: "5-9", price: 349.00 },
                    { qty: "10-49", price: 329.00 },
                    { qty: "50+", price: 309.00 }
                ],
                specification: {
                    socket: "Socket AM5",
                    cores: "8 Cores / 16 Threads",
                    generation: "Zen 4 (Ryzen 7000)",
                    warranty: "3 Years",
                    power: "120W TDP"
                },
                description: "The AMD Ryzen 7 7800X3D is the ultimate gaming processor with AMD 3D V-Cache technology for massive gaming performance boosts."
            },
            {
                id: 3,
                name: "ASUS TUF Gaming GeForce RTX 4070 OC",
                category: "GPU",
                brand: "ASUS",
                image: "https://images.unsplash.com/photo-1591488320449-011701bb6704?w=600&auto=format&fit=crop&q=80",
                stock: 45,
                price: 599.00,
                moq: 2,
                tiers: [
                    { qty: "2-9", price: 599.00 },
                    { qty: "10-24", price: 579.00 },
                    { qty: "25+", price: 549.00 }
                ],
                specification: {
                    socket: "PCIe 4.0 x16",
                    cores: "5888 CUDA Cores",
                    generation: "NVIDIA Ada Lovelace",
                    warranty: "3 Years",
                    power: "200W TDP"
                },
                description: "ASUS TUF Gaming GeForce RTX 4070 OC Edition 12GB GDDR6X. Armed with DLSS 3, lower temps, and enhanced durability."
            },
            {
                id: 4,
                name: "Corsair Vengeance DDR5 32GB (2x16GB) 6000MHz",
                category: "RAM",
                brand: "Corsair",
                image: "https://images.unsplash.com/photo-1562976540-1502c2145186?w=600&auto=format&fit=crop&q=80",
                stock: 250,
                price: 115.00,
                moq: 10,
                tiers: [
                    { qty: "10-29", price: 115.00 },
                    { qty: "30-99", price: 105.00 },
                    { qty: "100+", price: 95.00 }
                ],
                specification: {
                    socket: "288-pin DIMM",
                    cores: "DDR5 Capacity: 32GB",
                    generation: "Vengeance DDR5",
                    warranty: "Lifetime Limited",
                    power: "1.35V Voltage"
                },
                description: "Optimized for Intel motherboards, Corsair Vengeance DDR5 delivers higher frequencies and greater capacities of DDR5 technology in a high-quality compact module."
            },
            {
                id: 5,
                name: "Samsung 990 PRO NVMe M.2 SSD 2TB",
                category: "SSD",
                brand: "Samsung",
                image: "https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=600&auto=format&fit=crop&q=80",
                stock: 180,
                price: 169.00,
                moq: 5,
                tiers: [
                    { qty: "5-19", price: 169.00 },
                    { qty: "20-49", price: 159.00 },
                    { qty: "50+", price: 145.00 }
                ],
                specification: {
                    socket: "M.2 (2280) PCIe 4.0",
                    cores: "Up to 7450 MB/s Read",
                    generation: "990 PRO NVMe",
                    warranty: "5 Years",
                    power: "Avg 5.5W"
                },
                description: "The Samsung NVMe SSD 990 PRO reaches near max performance of PCIe 4.0. Experience long-lasting, industry-dominating speed."
            },
            {
                id: 6,
                name: "ASUS ROG Strix Z790-F Gaming WiFi II",
                category: "Motherboard",
                brand: "ASUS",
                image: "https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80",
                stock: 60,
                price: 369.00,
                moq: 3,
                tiers: [
                    { qty: "3-9", price: 369.00 },
                    { qty: "10-24", price: 349.00 },
                    { qty: "25+", price: 329.00 }
                ],
                specification: {
                    socket: "LGA1700",
                    cores: "Intel Z790 Chipset",
                    generation: "ROG Strix WiFi II",
                    warranty: "3 Years",
                    power: "16+1+2 Power Stages"
                },
                description: "Premium Intel Z790 LGA1700 ATX motherboard with DDR5 support, five M.2 slots, PCIe 5.0, WiFi 7 and advanced cooling solutions."
            },
            {
                id: 7,
                name: "Corsair RM850x 850W 80+ Gold Modular PSU",
                category: "Power Supply",
                brand: "Corsair",
                image: "https://images.unsplash.com/photo-1591488033360-1e5f76b509ef?w=600&auto=format&fit=crop&q=80",
                stock: 90,
                price: 129.00,
                moq: 5,
                tiers: [
                    { qty: "5-19", price: 129.00 },
                    { qty: "20-49", price: 119.00 },
                    { qty: "50+", price: 109.00 }
                ],
                specification: {
                    socket: "ATX Form Factor",
                    cores: "80 Plus Gold Certified",
                    generation: "RMx Series",
                    warranty: "10 Years",
                    power: "850 Watts Output"
                },
                description: "Corsair RM850x series fully modular power supplies are built with the highest quality components to deliver 80 PLUS Gold efficient power to your PC."
            },
            {
                id: 8,
                name: "Lian Li O11 Dynamic EVO Mid-Tower Case",
                category: "PC Cases",
                brand: "Lian Li",
                image: "https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=600&auto=format&fit=crop&q=80",
                stock: 40,
                price: 159.00,
                moq: 2,
                tiers: [
                    { qty: "2-9", price: 159.00 },
                    { qty: "10-24", price: 149.00 },
                    { qty: "25+", price: 139.00 }
                ],
                specification: {
                    socket: "Mid-Tower E-ATX",
                    cores: "Tempered Glass Panel",
                    generation: "O11 Dynamic EVO",
                    warranty: "1 Year",
                    power: "Modular dual-chamber"
                },
                description: "The Lian Li O11 Dynamic EVO is a modular design PC case that can be configured in reverse mode and features a spacious chamber for ultimate watercooling."
            },
            {
                id: 9,
                name: "Noctua NH-D15 Dual-Tower CPU Cooler",
                category: "Cooling",
                brand: "Noctua",
                image: "https://images.unsplash.com/photo-1616440347437-b1c73416efc2?w=600&auto=format&fit=crop&q=80",
                stock: 150,
                price: 109.00,
                moq: 5,
                tiers: [
                    { qty: "5-19", price: 109.00 },
                    { qty: "20-49", price: 99.00 },
                    { qty: "50+", price: 89.00 }
                ],
                specification: {
                    socket: "LGA1700, AM5, AM4",
                    cores: "Dual NF-A15 140mm Fans",
                    generation: "NH-D15 Premium",
                    warranty: "6 Years",
                    power: "Quiet performance"
                },
                description: "Noctua's flagship model NH-D15 is an elite-class dual-tower cooler for highest demands, offering quiet cooling performance rivaling liquid coolers."
            },
            {
                id: 10,
                name: "Logitech MX Master 3S Wireless Mouse",
                category: "Accessories",
                brand: "Logitech",
                image: "https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=600&auto=format&fit=crop&q=80",
                stock: 300,
                price: 99.00,
                moq: 10,
                tiers: [
                    { qty: "10-49", price: 99.00 },
                    { qty: "50-99", price: 89.00 },
                    { qty: "100+", price: 79.00 }
                ],
                specification: {
                    socket: "USB-C, Bluetooth",
                    cores: "8K DPI Optical Sensor",
                    generation: "MX Series",
                    warranty: "2 Years",
                    power: "Rechargeable Li-Po"
                },
                description: "Logitech MX Master 3S ergonomic wireless mouse. Features quiet clicks, 8K DPI tracking on any surface, and MagSpeed electromagnetic scrolling."
            }
        ];

        // Default Company Information
        const companyInfo = {
            name: "AlphaTech Solutions Inc.",
            address: "450 Enterprise Parkway, Suite 100",
            city: "Silicon Valley, CA 94025",
            email: "purchasing@alphatech.com",
            phone: "+1 (555) 019-2834",
            creditLimit: 50000.00,
            initialCreditLimit: 50000.00,
            representative: "Serey Panha (Purchasing Director)"
        };

        // State Manager with LocalStorage Support
        const b2bState = {
            cart: JSON.parse(localStorage.getItem('b2b_cart')) || [],
            orders: JSON.parse(localStorage.getItem('b2b_orders')) || [
                {
                    poNumber: "PO-2026-0482",
                    date: "2026-05-12",
                    items: [
                        { id: 3, name: "ASUS TUF Gaming GeForce RTX 4070 OC", qty: 5, unitPrice: 579.00, originalPrice: 599.00 },
                        { id: 5, name: "Samsung 990 PRO NVMe M.2 SSD 2TB", qty: 10, unitPrice: 159.00, originalPrice: 169.00 }
                    ],
                    subtotal: 4485.00,
                    discount: 200.00,
                    tax: 448.50,
                    shipping: 0,
                    total: 4733.50,
                    status: "Completed"
                },
                {
                    poNumber: "PO-2026-0610",
                    date: "2026-06-05",
                    items: [
                        { id: 1, name: "Intel Core i7-14700K Desktop Processor", qty: 10, unitPrice: 330.00, originalPrice: 350.00 },
                        { id: 6, name: "ASUS ROG Strix Z790-F Gaming WiFi II", qty: 5, unitPrice: 349.00, originalPrice: 369.00 }
                    ],
                    subtotal: 5045.00,
                    discount: 300.00,
                    tax: 504.50,
                    shipping: 0,
                    total: 5249.50,
                    status: "Approved"
                },
                {
                    poNumber: "PO-2026-0701",
                    date: "2026-07-10",
                    items: [
                        { id: 4, name: "Corsair Vengeance DDR5 32GB (2x16GB) 6000MHz", qty: 20, unitPrice: 115.00, originalPrice: 115.00 }
                    ],
                    subtotal: 2300.00,
                    discount: 0,
                    tax: 230.00,
                    shipping: 50.00,
                    total: 2580.00,
                    status: "Processing"
                }
            ],
            invoices: JSON.parse(localStorage.getItem('b2b_invoices')) || [
                {
                    invoiceNumber: "INV-2026-0482",
                    poNumber: "PO-2026-0482",
                    date: "2026-05-12",
                    dueDate: "2026-06-12",
                    total: 4733.50,
                    status: "Paid"
                },
                {
                    invoiceNumber: "INV-2026-0610",
                    poNumber: "PO-2026-0610",
                    date: "2026-06-05",
                    dueDate: "2026-07-05",
                    total: 5249.50,
                    status: "Paid"
                },
                {
                    invoiceNumber: "INV-2026-0701",
                    poNumber: "PO-2026-0701",
                    date: "2026-07-10",
                    dueDate: "2026-08-10",
                    total: 2580.00,
                    status: "Unpaid"
                }
            ],
            creditLimit: parseFloat(localStorage.getItem('b2b_credit_limit')) ?? companyInfo.creditLimit,
            activeFilters: {
                category: "",
                brand: [],
                priceRange: 1000,
                stockOnly: false,
                socket: [],
                ramCapacity: [],
                warranty: []
            },
            searchQuery: ""
        };

        // Sync state to local storage
        function syncLocalStorage() {
            localStorage.setItem('b2b_cart', JSON.stringify(b2bState.cart));
            localStorage.setItem('b2b_orders', JSON.stringify(b2bState.orders));
            localStorage.setItem('b2b_invoices', JSON.stringify(b2bState.invoices));
            localStorage.setItem('b2b_credit_limit', b2bState.creditLimit.toString());
            updateCartBadge();
        }

        // Calculate and get a product's price based on desired quantity
        function getProductTierPrice(product, qty) {
            let activePrice = product.price;
            for (const tier of product.tiers) {
                const parts = tier.qty.split('-');
                if (parts.length === 2) {
                    const min = parseInt(parts[0]);
                    const max = parseInt(parts[1]);
                    if (qty >= min && qty <= max) {
                        activePrice = tier.price;
                        break;
                    }
                } else if (tier.qty.endsWith('+')) {
                    const min = parseInt(tier.qty);
                    if (qty >= min) {
                        activePrice = tier.price;
                        break;
                    }
                }
            }
            return activePrice;
        }

        // Display beautiful toast alert
        function showToast(message, type = "success") {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast-b2b toast-b2b-${type}`;
            
            let icon = 'bi-check-circle-fill text-success';
            if (type === 'warning') icon = 'bi-exclamation-triangle-fill text-warning';
            if (type === 'danger') icon = 'bi-x-circle-fill text-danger';

            toast.innerHTML = `
                <i class="bi ${icon} fs-5"></i>
                <div class="fw-semibold">${message}</div>
            `;
            toastContainer.appendChild(toast);
            
            // Trigger reflow to run transition
            setTimeout(() => toast.classList.add('show'), 10);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Update the cart quantity badge in header
        function updateCartBadge() {
            const badge = document.getElementById('cartGlobalBadge');
            const totalQty = b2bState.cart.reduce((sum, item) => sum + item.qty, 0);
            if (totalQty > 0) {
                badge.textContent = totalQty;
                badge.classList.remove('d-none');
            } else {
                badge.classList.add('d-none');
            }
        }

        // Router Implementation
        function handleRouting() {
            const hash = window.location.hash || '#/';
            const portalLayout = document.getElementById('portalLayout');
            
            // Update active navbar link styling
            document.querySelectorAll('.nav-link-b2b').forEach(link => link.classList.remove('active'));
            
            // Close mobile menu collapse on navigate
            const navbarContent = document.getElementById('navbarContent');
            if (navbarContent.classList.contains('show')) {
                bootstrap.Collapse.getInstance(navbarContent).hide();
            }

            // Sync global search input values based on queries
            const urlParams = new URLSearchParams(hash.split('?')[1] || "");
            const searchParam = urlParams.get('search') || "";
            if (searchParam) {
                document.getElementById('globalSearchInput').value = searchParam;
                b2bState.searchQuery = searchParam;
            }

            if (hash.startsWith('#/products')) {
                document.getElementById('navLinkProducts').classList.add('active');
                renderProductListing(urlParams);
            } else if (hash.startsWith('#/product/')) {
                const id = parseInt(hash.split('#/product/')[1]);
                renderProductDetail(id);
            } else if (hash.startsWith('#/cart')) {
                document.getElementById('navLinkCart').classList.add('active');
                renderCart();
            } else if (hash.startsWith('#/dashboard') || hash.startsWith('#/orders') || hash.startsWith('#/invoices') || hash.startsWith('#/profile') || hash.startsWith('#/support')) {
                
                // Select sidebar menu item activation
                let activeId = "sideLinkDashboard";
                if (hash.startsWith('#/orders')) {
                    activeId = "sideLinkOrders";
                    document.getElementById('navLinkOrders').classList.add('active');
                } else if (hash.startsWith('#/invoices')) {
                    activeId = "sideLinkInvoices";
                    document.getElementById('navLinkInvoices').classList.add('active');
                } else if (hash.startsWith('#/profile')) {
                    activeId = "sideLinkProfile";
                } else if (hash.startsWith('#/support')) {
                    activeId = "sideLinkSupport";
                } else {
                    document.getElementById('navLinkDashboard').classList.add('active');
                }

                renderDashboardLayout(hash, activeId);
            } else {
                document.getElementById('navLinkHome').classList.add('active');
                renderHomepage();
            }
            window.scrollTo(0, 0);
        }

        // Helper: Format currencies consistently
        function formatCurrency(val) {
            return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(val);
        }

        // Render Homepage storefront
        function renderHomepage() {
            const portalLayout = document.getElementById('portalLayout');
            
            // Build Featured Products markup
            let featuredHtml = '';
            // Select first 4 products to feature
            const featuredItems = products.slice(0, 4);
            
            featuredItems.forEach(p => {
                const stockStatus = p.stock > 50 ? 
                    `<span class="product-stock-tag stock-available"><i class="bi bi-check-circle-fill"></i> ${p.stock} units available</span>` :
                    `<span class="product-stock-tag stock-low"><i class="bi bi-exclamation-triangle-fill"></i> Low Stock (${p.stock} left)</span>`;

                featuredHtml += `
                    <div class="col-sm-6 col-lg-3">
                        <div class="product-card">
                            <a href="#/product/${p.id}" class="product-image-wrapper">
                                <span class="product-moq-badge">MOQ: ${p.moq}</span>
                                <img src="${p.image}" class="product-image" alt="${p.name}">
                                <div class="product-image-overlay">
                                    <span><i class="bi bi-eye-fill"></i> View Details</span>
                                </div>
                            </a>
                            <div class="product-info">
                                <span class="product-brand-tag">${p.brand}</span>
                                <a href="#/product/${p.id}" class="product-title">${p.name}</a>
                                <span class="sku-text">SKU: TV-HW-00${p.id}</span>
                                
                                <div class="price-tiers-preview">
                                    <div class="price-tier-row active-tier">
                                        <span>Bulk Price Range</span>
                                        <span>${formatCurrency(p.tiers[p.tiers.length - 1].price)} - ${formatCurrency(p.price)}</span>
                                    </div>
                                </div>

                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="price-lead-label">Bulk starting at</div>
                                        <div class="price-lead">${formatCurrency(p.price)}<span class="fs-6 fw-normal text-muted">/ea</span></div>
                                    </div>
                                    <div class="text-end">
                                        ${stockStatus}
                                    </div>
                                </div>
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-outline-primary btn-sm" onclick="quickRequestQuotation(${p.id})"><i class="bi bi-chat-right-quote"></i> Quote</button>
                                <button class="btn btn-primary btn-sm" onclick="quickAddToCart(${p.id})"><i class="bi bi-cart-plus"></i> Buy</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            portalLayout.innerHTML = `
                <div class="storefront-view container-fluid px-4">
                    <!-- Hero Banner -->
                    <div class="hero-banner">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <h1>Wholesale Computer Hardware Solutions</h1>
                                <p>Get certified high-performance hardware, tier-based discounts, contract business pricing, and flexible net-payment lines tailored specifically for system builders, IT shops, and corporate enterprises.</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="#/products" class="btn btn-primary btn-lg px-4 py-2 fw-semibold" style="background-color: var(--electric-blue); border-color: var(--electric-blue)">Browse Bulk Catalog</a>
                                    <a href="#/dashboard" class="btn btn-outline-light btn-lg px-4 py-2 fw-semibold">Access Line of Credit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Cards Section -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold m-0"><i class="bi bi-tag-fill text-primary"></i> Browse by Category</h3>
                        </div>
                        <div class="row g-4">
                            <div class="col-6 col-md-4 col-lg-2" onclick="navigateToCategory('CPU')">
                                <div class="category-card">
                                    <div class="category-icon"><i class="bi bi-cpu"></i></div>
                                    <h6 class="category-title">Processors</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2" onclick="navigateToCategory('GPU')">
                                <div class="category-card">
                                    <div class="category-icon"><i class="bi bi-gpu-card"></i></div>
                                    <h6 class="category-title">Graphics Cards</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2" onclick="navigateToCategory('RAM')">
                                <div class="category-card">
                                    <div class="category-icon"><i class="bi bi-memory"></i></div>
                                    <h6 class="category-title">Memory (RAM)</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2" onclick="navigateToCategory('SSD')">
                                <div class="category-card">
                                    <div class="category-icon"><i class="bi bi-hdd-fill"></i></div>
                                    <h6 class="category-title">Storage (SSDs)</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2" onclick="navigateToCategory('Motherboard')">
                                <div class="category-card">
                                    <div class="category-icon"><i class="bi bi-motherboard"></i></div>
                                    <h6 class="category-title">Motherboards</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2" onclick="navigateToCategory('Accessories')">
                                <div class="category-card">
                                    <div class="category-icon"><i class="bi bi-keyboard"></i></div>
                                    <h6 class="category-title">Accessories</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Products Section -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold m-0"><i class="bi bi-stars text-orange"></i> Featured Wholesale Stock</h3>
                            <a href="#/products" class="btn btn-outline-secondary fw-semibold">View All Products <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="row g-4">
                            ${featuredHtml}
                        </div>
                    </div>
                </div>
            `;
        }

        // Navigate and prefilter category
        function navigateToCategory(cat) {
            window.location.hash = `#/products?category=${cat}`;
        }

        // Render Product Listing Page (with advanced filters sidebar)
        function renderProductListing(urlParams) {
            const portalLayout = document.getElementById('portalLayout');
            
            // Extract query parameters
            const catQuery = urlParams.get('category') || b2bState.activeFilters.category;
            const searchQuery = urlParams.get('search') || b2bState.searchQuery;
            
            b2bState.activeFilters.category = catQuery;

            // Gather dynamic option lists for checkboxes
            const allCategories = [...new Set(products.map(p => p.category))];
            const allBrands = [...new Set(products.map(p => p.brand))];
            const allSockets = [...new Set(products.filter(p => p.specification.socket).map(p => p.specification.socket))];

            // Render Layout Structure: Left Sidebar + Right Products Grid
            portalLayout.innerHTML = `
                <div class="storefront-view container-fluid px-4">
                    <div class="row g-4">
                        <!-- Left Filter Sidebar -->
                        <div class="col-lg-3">
                            <div class="filter-sidebar">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold m-0"><i class="bi bi-funnel-fill text-primary"></i> Filters</h5>
                                    <button class="btn btn-link btn-sm text-decoration-none p-0" onclick="clearAllFilters()">Clear All</button>
                                </div>

                                <!-- Search Term Status -->
                                ${searchQuery ? `
                                    <div class="alert alert-info py-2 px-3 fs-7 mb-3 d-flex justify-content-between align-items-center">
                                        <span>Search: "<strong>${searchQuery}</strong>"</span>
                                        <button type="button" class="btn-close" style="font-size: 0.7rem" onclick="clearSearch()"></button>
                                    </div>
                                ` : ''}

                                <!-- Category Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-group-title">Category</h6>
                                    <select class="form-select form-select-sm" id="filterCategory" onchange="filterByCategory(this.value)">
                                        <option value="">All Categories</option>
                                        ${allCategories.map(cat => `<option value="${cat}" ${cat === catQuery ? 'selected' : ''}>${cat}</option>`).join('')}
                                    </select>
                                </div>

                                <!-- Brand Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-group-title">Brand</h6>
                                    ${allBrands.map(brand => {
                                        const isChecked = b2bState.activeFilters.brand.includes(brand) ? 'checked' : '';
                                        return `
                                            <label class="filter-checkbox-label">
                                                <input type="checkbox" class="form-check-input brand-checkbox" value="${brand}" ${isChecked} onchange="toggleBrandFilter('${brand}')">
                                                <span>${brand}</span>
                                            </label>
                                        `;
                                    }).join('')}
                                </div>

                                <!-- CPU Sockets Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-group-title">Socket / Connection</h6>
                                    ${allSockets.map(socket => {
                                        const isChecked = b2bState.activeFilters.socket.includes(socket) ? 'checked' : '';
                                        return `
                                            <label class="filter-checkbox-label">
                                                <input type="checkbox" class="form-check-input socket-checkbox" value="${socket}" ${isChecked} onchange="toggleSocketFilter('${socket}')">
                                                <span>${socket}</span>
                                            </label>
                                        `;
                                    }).join('')}
                                </div>

                                <!-- Price Range Filter -->
                                <div class="filter-group">
                                    <div class="d-flex justify-content-between filter-group-title m-0">
                                        <span>Max Price</span>
                                        <span id="priceVal" class="text-primary fw-bold">$${b2bState.activeFilters.priceRange}</span>
                                    </div>
                                    <input type="range" class="form-range" min="50" max="1000" step="50" id="filterPriceRange" value="${b2bState.activeFilters.priceRange}" oninput="updatePriceFilter(this.value)">
                                </div>

                                <!-- Stock Status Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-group-title">Availability</h6>
                                    <label class="filter-checkbox-label">
                                        <input type="checkbox" class="form-check-input" id="filterStockOnly" ${b2bState.activeFilters.stockOnly ? 'checked' : ''} onchange="toggleStockOnlyFilter(this.checked)">
                                        <span>In Stock & Ready to Ship</span>
                                    </label>
                                </div>

                                <!-- Warranty Terms Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-group-title">Warranty Length</h6>
                                    <label class="filter-checkbox-label">
                                        <input type="checkbox" class="form-check-input warranty-checkbox" value="3 Years" ${b2bState.activeFilters.warranty.includes("3 Years") ? 'checked' : ''} onchange="toggleWarrantyFilter('3 Years')">
                                        <span>3 Years or More</span>
                                    </label>
                                    <label class="filter-checkbox-label">
                                        <input type="checkbox" class="form-check-input warranty-checkbox" value="Lifetime Limited" ${b2bState.activeFilters.warranty.includes("Lifetime Limited") ? 'checked' : ''} onchange="toggleWarrantyFilter('Lifetime Limited')">
                                        <span>Lifetime Warranty</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Products Grid -->
                        <div class="col-lg-9">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="fw-bold m-0"><i class="bi bi-gpu-card text-primary"></i> Bulk Product Catalog</h3>
                                <span class="text-muted small fw-semibold" id="productsFoundCount">0 items found</span>
                            </div>

                            <div class="row g-4" id="listingGrid">
                                <!-- Loaded dynamically via filter calculations -->
                            </div>
                        </div>
                    </div>
                </div>
            `;

            updateProductsGrid();
        }

        // Apply filters dynamically to products array and refresh list layout
        function updateProductsGrid() {
            const query = b2bState.searchQuery.toLowerCase().trim();
            const cat = b2bState.activeFilters.category;
            const brands = b2bState.activeFilters.brand;
            const price = b2bState.activeFilters.priceRange;
            const stockOnly = b2bState.activeFilters.stockOnly;
            const sockets = b2bState.activeFilters.socket;
            const warranties = b2bState.activeFilters.warranty;

            const filtered = products.filter(p => {
                // Search filter
                if (query) {
                    const matchName = p.name.toLowerCase().includes(query);
                    const matchBrand = p.brand.toLowerCase().includes(query);
                    const matchSku = `tv-hw-00${p.id}`.includes(query);
                    const matchSocket = p.specification.socket && p.specification.socket.toLowerCase().includes(query);
                    if (!matchName && !matchBrand && !matchSku && !matchSocket) return false;
                }

                // Category filter
                if (cat && p.category !== cat) return false;

                // Brand filter
                if (brands.length > 0 && !brands.includes(p.brand)) return false;

                // Price limit filter
                if (p.price > price) return false;

                // Stock availability filter
                if (stockOnly && p.stock <= 0) return false;

                // Sockets filter
                if (sockets.length > 0 && (!p.specification.socket || !sockets.includes(p.specification.socket))) return false;

                // Warranty filter
                if (warranties.length > 0) {
                    const matchWarranty = warranties.some(w => p.specification.warranty && p.specification.warranty.includes(w));
                    if (!matchWarranty) return false;
                }

                return true;
            });

            document.getElementById('productsFoundCount').textContent = `${filtered.length} products found`;

            const listingGrid = document.getElementById('listingGrid');
            if (filtered.length === 0) {
                listingGrid.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inboxes text-muted fs-1 mb-3"></i>
                        <h4 class="fw-bold">No Products Found</h4>
                        <p class="text-muted">Adjust filters or search queries to look for specific inventory items.</p>
                        <button class="btn btn-primary" onclick="clearAllFilters()">Reset All Filters</button>
                    </div>
                `;
                return;
            }

            let html = '';
            filtered.forEach(p => {
                const stockStatus = p.stock > 50 ? 
                    `<span class="product-stock-tag stock-available"><i class="bi bi-check-circle-fill"></i> ${p.stock} In Stock</span>` :
                    (p.stock > 0 ? `<span class="product-stock-tag stock-low"><i class="bi bi-exclamation-triangle-fill"></i> Low Stock (${p.stock})</span>` : `<span class="product-stock-tag stock-out"><i class="bi bi-x-circle-fill"></i> Out of Stock</span>`);

                // Create HTML layout for pricing tiers table inside card
                let tiersHtml = '';
                p.tiers.forEach(tier => {
                    tiersHtml += `
                        <div class="price-tier-row d-flex justify-content-between">
                            <span>Qty: ${tier.qty}</span>
                            <span class="fw-semibold text-dark">${formatCurrency(tier.price)}</span>
                        </div>
                    `;
                });

                html += `
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="product-card">
                            <a href="#/product/${p.id}" class="product-image-wrapper">
                                <span class="product-moq-badge">MOQ: ${p.moq}</span>
                                <img src="${p.image}" class="product-image" alt="${p.name}">
                                <div class="product-image-overlay">
                                    <span><i class="bi bi-eye-fill"></i> View Details</span>
                                </div>
                            </a>
                            <div class="product-info">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="product-brand-tag">${p.brand}</span>
                                    ${stockStatus}
                                </div>
                                <a href="#/product/${p.id}" class="product-title">${p.name}</a>
                                <span class="sku-text">SKU: TV-HW-00${p.id}</span>
                                
                                <div class="price-tiers-preview">
                                    <div class="fw-bold mb-1 border-bottom pb-1" style="font-size: 0.7rem; color: var(--primary-navy)">WHOLESALE PRICE TIERS</div>
                                    ${tiersHtml}
                                </div>

                                <div class="mt-auto">
                                    <div class="price-lead-label">Bulk starting at</div>
                                    <div class="price-lead">${formatCurrency(p.price)}<span class="fs-6 fw-normal text-muted">/ea</span></div>
                                </div>
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-outline-primary btn-sm" onclick="quickRequestQuotation(${p.id})"><i class="bi bi-chat-right-quote"></i> Quote</button>
                                <button class="btn btn-primary btn-sm" onclick="quickAddToCart(${p.id})" ${p.stock <= 0 ? 'disabled' : ''}><i class="bi bi-cart-plus"></i> Buy</button>
                            </div>
                        </div>
                    </div>
                `;
            });
            listingGrid.innerHTML = html;
        }

        // Filtering Actions
        function filterByCategory(val) {
            b2bState.activeFilters.category = val;
            updateProductsGrid();
        }

        function toggleBrandFilter(brand) {
            const index = b2bState.activeFilters.brand.indexOf(brand);
            if (index > -1) {
                b2bState.activeFilters.brand.splice(index, 1);
            } else {
                b2bState.activeFilters.brand.push(brand);
            }
            updateProductsGrid();
        }

        // CPU Sockets Filter
        function toggleSocketFilter(socket) {
            const index = b2bState.activeFilters.socket.indexOf(socket);
            if (index > -1) {
                b2bState.activeFilters.socket.splice(index, 1);
            } else {
                b2bState.activeFilters.socket.push(socket);
            }
            updateProductsGrid();
        }

        function updatePriceFilter(val) {
            document.getElementById('priceVal').textContent = `$${val}`;
            b2bState.activeFilters.priceRange = parseInt(val);
            updateProductsGrid();
        }

        function toggleStockOnlyFilter(checked) {
            b2bState.activeFilters.stockOnly = checked;
            updateProductsGrid();
        }

        function toggleWarrantyFilter(term) {
            const index = b2bState.activeFilters.warranty.indexOf(term);
            if (index > -1) {
                b2bState.activeFilters.warranty.splice(index, 1);
            } else {
                b2bState.activeFilters.warranty.push(term);
            }
            updateProductsGrid();
        }

        function clearAllFilters() {
            b2bState.activeFilters = {
                category: "",
                brand: [],
                priceRange: 1000,
                stockOnly: false,
                socket: [],
                ramCapacity: [],
                warranty: []
            };
            b2bState.searchQuery = "";
            document.getElementById('globalSearchInput').value = "";
            
            // Uncheck inputs if they are drawn
            document.querySelectorAll('.brand-checkbox, .socket-checkbox, .warranty-checkbox').forEach(cb => cb.checked = false);
            const selectCat = document.getElementById('filterCategory');
            if (selectCat) selectCat.value = "";
            const slider = document.getElementById('filterPriceRange');
            if (slider) slider.value = 1000;
            const stockCheck = document.getElementById('filterStockOnly');
            if (stockCheck) stockCheck.checked = false;
            
            updateProductsGrid();
        }

        function clearSearch() {
            b2bState.searchQuery = "";
            document.getElementById('globalSearchInput').value = "";
            window.location.hash = window.location.hash.split('?')[0];
        }

        // Render Product Detail Page
        function renderProductDetail(id) {
            const portalLayout = document.getElementById('portalLayout');
            const product = products.find(p => p.id === id);

            if (!product) {
                portalLayout.innerHTML = `
                    <div class="storefront-view container px-4 py-5 text-center">
                        <h3 class="fw-bold">Product Not Found</h3>
                        <p class="text-muted">The product you are trying to view does not exist in our catalog database.</p>
                        <a href="#/products" class="btn btn-primary">Return to Catalog</a>
                    </div>
                `;
                return;
            }

            const stockBadge = product.stock > 50 ? 
                `<span class="badge bg-success py-2 px-3"><i class="bi bi-check-circle-fill me-1"></i> In Stock (${product.stock} units)</span>` :
                (product.stock > 0 ? `<span class="badge bg-warning text-dark py-2 px-3"><i class="bi bi-exclamation-triangle-fill me-1"></i> Low Stock (${product.stock} units)</span>` : `<span class="badge bg-danger py-2 px-3"><i class="bi bi-x-circle-fill me-1"></i> Out of Stock</span>`);

            // Build specifications table lines dynamically
            let specHtml = '';
            for (const [key, val] of Object.entries(product.specification)) {
                specHtml += `
                    <tr>
                        <th class="text-capitalize">${key}</th>
                        <td>${val}</td>
                    </tr>
                `;
            }

            // Build pricing tiers table rows
            let tiersTableHtml = '';
            product.tiers.forEach(tier => {
                tiersTableHtml += `
                    <tr id="detail-tier-row-${tier.qty.replace('+', 'plus')}" class="detail-tier-row">
                        <td>${tier.qty} units</td>
                        <td class="text-end fw-bold text-primary">${formatCurrency(tier.price)}</td>
                    </tr>
                `;
            });

            portalLayout.innerHTML = `
                <div class="storefront-view container px-4 py-4">
                    <a href="#/products" class="btn btn-outline-secondary mb-4 fw-semibold"><i class="bi bi-arrow-left"></i> Back to Catalog</a>
                    
                    <div class="detail-card">
                        <div class="row g-5">
                            <!-- Left: Product Image Box -->
                            <div class="col-md-5">
                                <div class="detail-image-box">
                                    <span class="product-moq-badge" style="font-size: 0.9rem; padding: 0.4rem 0.8rem">MOQ Required: ${product.moq}</span>
                                    <img src="${product.image}" class="detail-image" alt="${product.name}">
                                </div>
                            </div>

                            <!-- Right: Product Information & Buy Panel -->
                            <div class="col-md-7">
                                <span class="product-brand-tag text-uppercase fw-bold fs-7">${product.brand}</span>
                                <h1 class="fw-bold my-2 text-primary-navy" style="font-size: 2rem">${product.name}</h1>
                                <div class="sku-text mb-3">SKU: TV-HW-00${product.id} | B2B Wholesale Guaranteed</div>
                                
                                <div class="mb-4">
                                    ${stockBadge}
                                    <span class="ms-3 text-muted small"><i class="bi bi-shield-fill-check text-success"></i> Manufacturer Warranty: ${product.specification.warranty}</span>
                                </div>

                                <p class="text-muted mb-4 lead" style="font-size: 1rem">${product.description}</p>
                                
                                <div class="row g-4">
                                    <!-- Price Tiers Panel -->
                                    <div class="col-lg-6">
                                        <h5 class="fw-bold mb-3"><i class="bi bi-tags text-primary"></i> Tiered Volume Pricing</h5>
                                        <table class="wholesale-table">
                                            <thead>
                                                <tr>
                                                    <th>Quantity Range</th>
                                                    <th class="text-end">Price / Unit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${tiersTableHtml}
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Purchase Actions Box -->
                                    <div class="col-lg-6">
                                        <div class="card p-3 border-light shadow-sm" style="background-color: var(--secondary-bg)">
                                            <h6 class="fw-bold mb-3"><i class="bi bi-cart3 text-orange"></i> Configure Order</h6>
                                            
                                            <div class="mb-3">
                                                <label for="detailQtyInput" class="form-label small fw-bold">Select Volume Quantity</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="adjustDetailQty(-1, ${product.moq})"><i class="bi bi-dash-lg"></i></button>
                                                    <input type="number" class="form-control text-center fw-bold" id="detailQtyInput" value="${product.moq}" min="${product.moq}" onchange="validateDetailQtyInput(this.value, ${product.moq}, ${product.stock})">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="adjustDetailQty(1, ${product.moq})"><i class="bi bi-plus-lg"></i></button>
                                                </div>
                                                <div class="form-text text-orange fw-bold mt-1" id="moqDetailInfo"><i class="bi bi-info-circle-fill"></i> Minimum Order Quantity is ${product.moq}</div>
                                            </div>

                                            <div class="mb-3 py-2 border-top border-bottom">
                                                <div class="d-flex justify-content-between text-muted small">
                                                    <span>Active Unit Price:</span>
                                                    <span id="detailActiveUnitPrice">${formatCurrency(product.price)}</span>
                                                </div>
                                                <div class="d-flex justify-content-between fw-bold text-dark mt-1">
                                                    <span>Est. Subtotal:</span>
                                                    <span id="detailEstSubtotal" class="text-primary">${formatCurrency(product.price * product.moq)}</span>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column gap-2">
                                                <button class="btn btn-primary w-100 py-2 fw-semibold" onclick="handleDetailAddToCart(${product.id})" ${product.stock <= 0 ? 'disabled' : ''}>
                                                    <i class="bi bi-cart-plus me-1"></i> Add to Wholesale Cart
                                                </button>
                                                <button class="btn btn-outline-primary w-100 py-2 fw-semibold" onclick="quickRequestQuotation(${product.id})">
                                                    <i class="bi bi-chat-left-quote me-1"></i> Request Custom Quote
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Specifications Section -->
                        <div class="row mt-5 pt-4 border-top">
                            <div class="col-md-6">
                                <h4 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary"></i> Technical Specifications</h4>
                                <table class="spec-table">
                                    <tbody>
                                        ${specHtml}
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold mb-3"><i class="bi bi-building text-primary"></i> Supplier & Logistics Information</h4>
                                <div class="card p-3 border-light bg-light">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="fs-1 text-primary me-3"><i class="bi bi-truck-flatbed"></i></div>
                                        <div>
                                            <h6 class="fw-bold mb-0">TechVanguard Warehouse California</h6>
                                            <span class="text-muted small">Hub ID: WH-US-WEST-01</span>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="mb-2"><i class="bi bi-dot"></i> <strong>Fulfillment Time:</strong> 1-3 Business days for bulk shipments</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> <strong>Shipping Options:</strong> Freight Carrier (LTL), UPS Ground, and Air Express</li>
                                        <li><i class="bi bi-dot"></i> <strong>Quality Standard:</strong> 100% Original Brand Warranty, factory sealed packaging</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Trigger highlight of correct pricing row on page load
            validateDetailQtyInput(product.moq, product.moq, product.stock);
        }

        // Adjust Detail Qty values via +/- buttons
        function adjustDetailQty(delta, moq) {
            const input = document.getElementById('detailQtyInput');
            let current = parseInt(input.value) || moq;
            current += delta;
            if (current < moq) current = moq;
            input.value = current;
            
            // Trigger validate
            const id = parseInt(window.location.hash.split('#/product/')[1]);
            const product = products.find(p => p.id === id);
            validateDetailQtyInput(current, moq, product.stock);
        }

        // Validate Qty Input box in details view and highlight appropriate wholesale tier row
        function validateDetailQtyInput(qty, moq, stock) {
            qty = parseInt(qty) || moq;
            if (qty < moq) {
                qty = moq;
                document.getElementById('detailQtyInput').value = moq;
            }
            if (qty > stock) {
                qty = stock;
                document.getElementById('detailQtyInput').value = stock;
                showToast(`Limited stock available. Set to maximum stock capacity of ${stock}.`, "warning");
            }

            const id = parseInt(window.location.hash.split('#/product/')[1]);
            const product = products.find(p => p.id === id);
            
            // Get correct tier price
            const unitPrice = getProductTierPrice(product, qty);
            
            // Highlight row in wholesale tiers table
            document.querySelectorAll('.detail-tier-row').forEach(row => row.classList.remove('active-wholesale-row'));
            
            product.tiers.forEach(tier => {
                const parts = tier.qty.split('-');
                let isMatch = false;
                if (parts.length === 2) {
                    const min = parseInt(parts[0]);
                    const max = parseInt(parts[1]);
                    if (qty >= min && qty <= max) isMatch = true;
                } else if (tier.qty.endsWith('+')) {
                    const min = parseInt(tier.qty);
                    if (qty >= min) isMatch = true;
                }
                if (isMatch) {
                    const rowId = `detail-tier-row-${tier.qty.replace('+', 'plus')}`;
                    const row = document.getElementById(rowId);
                    if (row) row.classList.add('active-wholesale-row');
                }
            });

            // Update details panel pricing labels
            document.getElementById('detailActiveUnitPrice').textContent = formatCurrency(unitPrice);
            document.getElementById('detailEstSubtotal').textContent = formatCurrency(unitPrice * qty);
        }

        // Action when customer hits Add To Cart on Product details page
        function handleDetailAddToCart(productId) {
            const product = products.find(p => p.id === productId);
            const inputVal = parseInt(document.getElementById('detailQtyInput').value) || product.moq;
            
            addToCartState(product, inputVal);
            showToast(`${inputVal} x ${product.name} added to cart successfully.`);
        }

        // Cart State Manipulation
        function addToCartState(product, qty) {
            const existing = b2bState.cart.find(item => item.productId === product.id);
            if (existing) {
                existing.qty += qty;
            } else {
                b2bState.cart.push({
                    productId: product.id,
                    qty: qty
                });
            }
            syncLocalStorage();
        }

        function quickAddToCart(id) {
            const product = products.find(p => p.id === id);
            addToCartState(product, product.moq);
            showToast(`Added ${product.moq} x ${product.name} to cart.`);
        }

        // Render Shopping Cart Page
        function renderCart() {
            const portalLayout = document.getElementById('portalLayout');

            if (b2bState.cart.length === 0) {
                portalLayout.innerHTML = `
                    <div class="storefront-view container px-4 py-5 text-center">
                        <i class="bi bi-cart-x text-muted fs-1 mb-3"></i>
                        <h4 class="fw-bold">Your Wholesale Cart is Empty</h4>
                        <p class="text-muted">Explore our catalog of computer processors, memory, graphic modules, and power units to place orders.</p>
                        <a href="#/products" class="btn btn-primary">Browse Products Catalog</a>
                    </div>
                `;
                return;
            }

            // Calculations
            let subtotal = 0;
            let totalDiscount = 0;
            let cartLinesHtml = '';

            b2bState.cart.forEach((item, index) => {
                const product = products.find(p => p.id === item.productId);
                if (!product) return;

                const currentTierPrice = getProductTierPrice(product, item.qty);
                const itemSubtotal = currentTierPrice * item.qty;
                const originalPrice = product.price;
                const itemSavings = (originalPrice - currentTierPrice) * item.qty;

                subtotal += itemSubtotal;
                totalDiscount += itemSavings;

                cartLinesHtml += `
                    <tr>
                        <td>
                            <div class="cart-product-cell">
                                <img src="${product.image}" class="cart-product-img" alt="${product.name}">
                                <div>
                                    <a href="#/product/${product.id}" class="fw-semibold text-decoration-none text-dark d-block">${product.name}</a>
                                    <span class="sku-text d-block m-0">SKU: TV-HW-00${product.id} | Brand: ${product.brand}</span>
                                    <span class="badge bg-light text-muted border mt-1">MOQ: ${product.moq} units</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="qty-adjuster mx-auto">
                                <button type="button" onclick="adjustCartQty(${index}, -1)"><i class="bi bi-dash"></i></button>
                                <input type="number" value="${item.qty}" min="${product.moq}" onchange="updateCartQtyInput(${index}, this.value)">
                                <button type="button" onclick="adjustCartQty(${index}, 1)"><i class="bi bi-plus"></i></button>
                            </div>
                            <div class="text-center text-muted small mt-1">MOQ Req.</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">${formatCurrency(currentTierPrice)}</div>
                            ${currentTierPrice < originalPrice ? `<div class="text-decoration-line-through text-muted small">${formatCurrency(originalPrice)}</div>` : ''}
                        </td>
                        <td>
                            ${itemSavings > 0 ? `<span class="text-success fw-bold">-${formatCurrency(itemSavings)}<br><span class="small font-normal" style="font-size: 0.7rem">(Volume Pricing)</span></span>` : `<span class="text-muted small">None</span>`}
                        </td>
                        <td class="text-end fw-bold text-primary-navy">
                            ${formatCurrency(itemSubtotal)}
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-danger border-0" onclick="removeFromCart(${index})"><i class="bi bi-trash3-fill"></i></button>
                        </td>
                    </tr>
                `;
            });

            const taxRate = 0.10; // 10% B2B Sales Tax
            const tax = subtotal * taxRate;
            const shipping = subtotal > 5000 ? 0 : 150.00; // Free shipping over $5,000
            const grandTotal = subtotal + tax + shipping;

            portalLayout.innerHTML = `
                <div class="storefront-view container-fluid px-4 py-4">
                    <h3 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary"></i> Shopping Cart</h3>

                    <div class="row g-4">
                        <!-- Left Cart Items Table -->
                        <div class="col-lg-8">
                            <div class="cart-table-wrapper">
                                <table class="cart-table table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th>Product Details</th>
                                            <th class="text-center">Quantity</th>
                                            <th>Wholesale Price</th>
                                            <th>Volume Savings</th>
                                            <th class="text-end">Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${cartLinesHtml}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Right Summary Cards -->
                        <div class="col-lg-4">
                            <div class="cart-summary-card">
                                <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary-navy"><i class="bi bi-credit-card-2-front"></i> Checkout Summary</h5>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal:</span>
                                    <span class="fw-semibold text-dark">${formatCurrency(subtotal)}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Wholesale Savings:</span>
                                    <span class="text-success fw-bold">${totalDiscount > 0 ? `-${formatCurrency(totalDiscount)}` : '$0.00'}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Sales Tax (10%):</span>
                                    <span class="fw-semibold text-dark">${formatCurrency(tax)}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-4 pb-2 border-bottom">
                                    <span class="text-muted">Shipping & Freight:</span>
                                    <span class="fw-semibold text-dark">${shipping === 0 ? '<span class="text-success">FREE (Bulk Rate)</span>' : formatCurrency(shipping)}</span>
                                </div>

                                <div class="d-flex justify-content-between fs-5 fw-bold text-primary-navy mb-4">
                                    <span>Total:</span>
                                    <span>${formatCurrency(grandTotal)}</span>
                                </div>

                                <!-- B2B Corporate Credit Limit Checker -->
                                <div class="p-3 bg-light rounded border border-light mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="text-muted small">Company Credit Line:</span>
                                        <span class="fw-bold small text-primary">${formatCurrency(b2bState.creditLimit)}</span>
                                    </div>
                                    ${grandTotal > b2bState.creditLimit ? `
                                        <div class="text-danger small mt-2 fw-semibold">
                                            <i class="bi bi-exclamation-octagon-fill"></i> Total exceeds credit limit of ${formatCurrency(b2bState.creditLimit)}. Order requires manager override or partial wire payment terms.
                                        </div>
                                    ` : `
                                        <div class="text-success small mt-2 fw-semibold">
                                            <i class="bi bi-shield-check"></i> Credit line available. Net-30 payment terms will be automatically applied.
                                        </div>
                                    `}
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <button class="btn btn-primary py-2 fw-bold w-100" onclick="submitB2BOrder('Approved')" ${grandTotal > b2bState.creditLimit ? 'disabled' : ''}>
                                        <i class="bi bi-lock-fill me-1"></i> Submit Purchase Order (PO)
                                    </button>
                                    <button class="btn btn-outline-primary py-2 fw-semibold w-100" onclick="submitB2BOrder('Pending')">
                                        <i class="bi bi-file-earmark-arrow-up-fill me-1"></i> Request PO Approval Route
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Adjust Cart Quantity via buttons
        function adjustCartQty(index, delta) {
            const item = b2bState.cart[index];
            const product = products.find(p => p.id === item.productId);
            let target = item.qty + delta;
            if (target < product.moq) target = product.moq;
            item.qty = target;
            syncLocalStorage();
            renderCart();
        }

        // Validate Qty input directly in shopping cart
        function updateCartQtyInput(index, val) {
            const item = b2bState.cart[index];
            const product = products.find(p => p.id === item.productId);
            let target = parseInt(val) || product.moq;
            if (target < product.moq) target = product.moq;
            if (target > product.stock) {
                target = product.stock;
                showToast(`Maximum stock capacity of ${product.stock} units reached.`, "warning");
            }
            item.qty = target;
            syncLocalStorage();
            renderCart();
        }

        function removeFromCart(index) {
            b2bState.cart.splice(index, 1);
            syncLocalStorage();
            renderCart();
            showToast("Item removed from wholesale cart.", "warning");
        }

        // Handle B2B order checkout / PO generation
        function submitB2BOrder(initialStatus) {
            let subtotal = 0;
            let totalDiscount = 0;
            const items = [];

            b2bState.cart.forEach(item => {
                const product = products.find(p => p.id === item.productId);
                if (!product) return;

                const currentTierPrice = getProductTierPrice(product, item.qty);
                const originalPrice = product.price;

                subtotal += (currentTierPrice * item.qty);
                totalDiscount += ((originalPrice - currentTierPrice) * item.qty);
                
                items.push({
                    id: product.id,
                    name: product.name,
                    qty: item.qty,
                    unitPrice: currentTierPrice,
                    originalPrice: originalPrice
                });
            });

            const taxRate = 0.10;
            const tax = subtotal * taxRate;
            const shipping = subtotal > 5000 ? 0 : 150.00;
            const grandTotal = subtotal + tax + shipping;

            if (grandTotal > b2bState.creditLimit && initialStatus === 'Approved') {
                showToast("Order exceeds corporate credit limit. Submit for Approval route instead.", "danger");
                return;
            }

            // Generate PO Number
            const poNum = "PO-2026-0" + Math.floor(100 + Math.random() * 900);
            const invNum = poNum.replace("PO-", "INV-");

            const today = new Date().toISOString().split('T')[0];
            const dueDate = new Date();
            dueDate.setDate(dueDate.getDate() + 30); // Net 30 Terms
            const dueDateString = dueDate.toISOString().split('T')[0];

            // Deduct from credit line
            if (initialStatus === 'Approved') {
                b2bState.creditLimit -= grandTotal;
            }

            // Create PO
            b2bState.orders.unshift({
                poNumber: poNum,
                date: today,
                items: items,
                subtotal: subtotal,
                discount: totalDiscount,
                tax: tax,
                shipping: shipping,
                total: grandTotal,
                status: initialStatus
            });

            // Create Invoice
            b2bState.invoices.unshift({
                invoiceNumber: invNum,
                poNumber: poNum,
                date: today,
                dueDate: dueDateString,
                total: grandTotal,
                status: initialStatus === 'Approved' ? 'Unpaid' : 'Unpaid'
            });

            // Clear Cart and Sync
            b2bState.cart = [];
            syncLocalStorage();
            
            showToast(`Purchase Order ${poNum} successfully created and registered!`);
            window.location.hash = "#/orders";
        }

        // Render Dashboard layout with Sidebar and dynamic subpages
        function renderDashboardLayout(hash, activeSidebarId) {
            const portalLayout = document.getElementById('portalLayout');
            
            portalLayout.innerHTML = `
                <div class="dashboard-container">
                    <!-- Dashboard Sidebar -->
                    <div class="dashboard-sidebar" id="dashboardSidebar">
                        <ul class="sidebar-menu">
                            <li class="sidebar-section-header">Overview</li>
                            <li class="sidebar-item" id="sideLinkDashboard">
                                <a href="#/dashboard"><i class="bi bi-speedometer2"></i> Dashboard Overview</a>
                            </li>
                            
                            <li class="sidebar-section-header">Marketplace</li>
                            <li class="sidebar-item" id="sideLinkProducts">
                                <a href="#/products"><i class="bi bi-grid-3x3-gap-fill"></i> Browse Catalog</a>
                            </li>
                            <li class="sidebar-item" id="sideLinkCart">
                                <a href="#/cart"><i class="bi bi-cart3"></i> Checkout Cart</a>
                            </li>
                            
                            <li class="sidebar-section-header">Purchasing</li>
                            <li class="sidebar-item" id="sideLinkOrders">
                                <a href="#/orders"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Purchase Orders</a>
                            </li>
                            <li class="sidebar-item" id="sideLinkInvoices">
                                <a href="#/invoices"><i class="bi bi-receipt-cutoff"></i> Invoices & Terms</a>
                            </li>
                            
                            <li class="sidebar-section-header">Organization</li>
                            <li class="sidebar-item" id="sideLinkProfile">
                                <a href="#/profile"><i class="bi bi-building"></i> Company Profile</a>
                            </li>
                            <li class="sidebar-item" id="sideLinkSupport">
                                <a href="#/support"><i class="bi bi-question-circle"></i> Corporate Support</a>
                            </li>
                        </ul>
                        <div class="sidebar-footer">
                            <div class="sidebar-user-card">
                                <div class="user-avatar-circle">SP</div>
                                <div class="user-info-text text-truncate">
                                    <div class="user-name-label text-truncate">Serey Panha</div>
                                    <div class="user-role-label">Purchasing Rep</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inner dashboard Content viewport -->
                    <div class="dashboard-content" id="dashboardContentView">
                        <!-- Dynamic sub-dashboard widgets will load here -->
                    </div>
                </div>
            `;

            // Active Class allocation
            const targetItem = document.getElementById(activeSidebarId);
            if (targetItem) targetItem.classList.add('active');

            // Render detailed widgets or table subpages based on route hashes
            if (hash.startsWith('#/orders')) {
                renderDashboardOrders();
            } else if (hash.startsWith('#/invoices')) {
                renderDashboardInvoices();
            } else if (hash.startsWith('#/profile')) {
                renderDashboardCompanyProfile();
            } else if (hash.startsWith('#/support')) {
                renderDashboardSupport();
            } else {
                renderDashboardOverview();
            }
        }

        // Dashboard subpage: 1. Overview Widgets & Charts
        function renderDashboardOverview() {
            const view = document.getElementById('dashboardContentView');

            // Calculate KPIs
            const totalOrders = b2bState.orders.length;
            const pendingOrders = b2bState.orders.filter(o => o.status === 'Pending').length;
            const totalSpending = b2bState.orders
                .filter(o => o.status === 'Approved' || o.status === 'Processing' || o.status === 'Completed')
                .reduce((sum, o) => sum + o.total, 0) + 12450.00; // include historic spending

            view.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0">Corporate Purchasing Dashboard</h3>
                    <div class="text-muted small fw-semibold"><i class="bi bi-calendar-event"></i> Operating Fiscal Year 2026</div>
                </div>

                <!-- KPI Cards Grid -->
                <div class="row g-4 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget-card credit-widget">
                            <div class="widget-info">
                                <h6>Available Credit</h6>
                                <h3>${formatCurrency(b2bState.creditLimit)}</h3>
                            </div>
                            <div class="widget-icon text-primary"><i class="bi bi-wallet2"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget-card orders-widget">
                            <div class="widget-info">
                                <h6>Total Orders</h6>
                                <h3>${totalOrders}</h3>
                            </div>
                            <div class="widget-icon text-warning"><i class="bi bi-file-earmark-bar-graph"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget-card pending-widget">
                            <div class="widget-info">
                                <h6>Pending Approval</h6>
                                <h3>${pendingOrders}</h3>
                            </div>
                            <div class="widget-icon text-warning"><i class="bi bi-clock-history"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget-card spending-widget">
                            <div class="widget-info">
                                <h6>Approved Spending</h6>
                                <h3>${formatCurrency(totalSpending)}</h3>
                            </div>
                            <div class="widget-icon text-success"><i class="bi bi-cash-coin"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Chart.js Analysis Canvas row -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="card border border-light shadow-sm p-4 h-100">
                            <h5 class="fw-bold mb-3 text-primary-navy"><i class="bi bi-graph-up-arrow"></i> Monthly Purchase History</h5>
                            <div style="position: relative; height: 300px; width: 100%;">
                                <canvas id="monthlyPurchasesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-light shadow-sm p-4 h-100">
                            <h5 class="fw-bold mb-3 text-primary-navy"><i class="bi bi-pie-chart-fill"></i> Spending Analysis</h5>
                            <div style="position: relative; height: 300px; width: 100%;">
                                <canvas id="spendingCategoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Purchase Orders Table -->
                <div class="card border border-light shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-primary-navy"><i class="bi bi-list-stars"></i> Recent Order Trackings</h5>
                        <a href="#/orders" class="btn btn-outline-primary btn-sm">View All Orders</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-nowrap">
                                <thead class="table-light text-uppercase fs-7">
                                    <tr>
                                        <th class="ps-4">PO Number</th>
                                        <th>Order Date</th>
                                        <th>Products Summary</th>
                                        <th>Total Invoice</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${b2bState.orders.slice(0, 3).map(o => {
                                        const itemsSummary = o.items.map(item => `${item.qty}x ${item.name.substring(0, 18)}...`).join(', ');
                                        return `
                                            <tr>
                                                <td class="ps-4 fw-bold text-primary">${o.poNumber}</td>
                                                <td>${o.date}</td>
                                                <td style="max-width: 250px" class="text-truncate">${itemsSummary}</td>
                                                <td class="fw-semibold text-primary-navy">${formatCurrency(o.total)}</td>
                                                <td><span class="status-badge status-${o.status.toLowerCase()}">${o.status}</span></td>
                                                <td class="text-end pe-4">
                                                    <button class="btn btn-sm btn-table-action" onclick="viewPurchaseOrderDetails('${o.poNumber}')"><i class="bi bi-eye-fill"></i> View Details</button>
                                                </td>
                                            </tr>
                                        `;
                                    }).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;

            // Draw Charts
            initDashboardCharts();
        }

        // Draw dynamic charts on canvas components
        function initDashboardCharts() {
            // Chart 1: Bar graph of monthly spending history (6 Months)
            const monthlyCtx = document.getElementById('monthlyPurchasesChart');
            if (monthlyCtx) {
                new Chart(monthlyCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Feb', 'Mar', 'Apr', 'May (Historic)', 'Jun (Historic)', 'Jul (Current)'],
                        datasets: [{
                            label: 'Purchase Volume ($)',
                            data: [1500, 3400, 2100, 4733.50, 5249.50, 2580.00],
                            backgroundColor: '#2563EB',
                            borderColor: '#1D4ED8',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { color: '#E2E8F0' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // Chart 2: Category breakdown doughnut chart
            const categoryCtx = document.getElementById('spendingCategoryChart');
            if (categoryCtx) {
                new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['CPUs', 'GPUs', 'RAM Modules', 'Storage SSDs', 'Motherboards', 'Other Accessories'],
                        datasets: [{
                            data: [35, 40, 10, 8, 5, 2],
                            backgroundColor: ['#0B1F3A', '#2563EB', '#F97316', '#16A34A', '#EAB308', '#64748B'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { boxWidth: 12, font: { size: 10 } }
                            }
                        }
                    }
                });
            }
        }

        // Dashboard subpage: 2. Purchase Order List Page
        function renderDashboardOrders() {
            const view = document.getElementById('dashboardContentView');

            let poRows = '';
            b2bState.orders.forEach(o => {
                const itemsSummary = o.items.map(item => `${item.qty}x ${item.name}`).join('<br>');
                poRows += `
                    <tr>
                        <td class="ps-4 fw-bold text-primary">${o.poNumber}</td>
                        <td>${o.date}</td>
                        <td class="small" style="line-height: 1.4">${itemsSummary}</td>
                        <td class="fw-bold text-primary-navy">${formatCurrency(o.total)}</td>
                        <td><span class="status-badge status-${o.status.toLowerCase()}">${o.status}</span></td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-table-action me-1" onclick="viewPurchaseOrderDetails('${o.poNumber}')"><i class="bi bi-eye-fill"></i> View Details</button>
                            ${o.status === 'Pending' ? `<button class="btn btn-sm btn-success px-3" style="border-radius: 99px; font-size: 0.75rem; font-weight: 600" onclick="approvePurchaseOrderSim('${o.poNumber}')"><i class="bi bi-check-lg"></i> Auto-Approve</button>` : ''}
                        </td>
                    </tr>
                `;
            });

            view.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0"><i class="bi bi-file-earmark-spreadsheet text-orange"></i> Purchase Orders Management</h3>
                    <a href="#/products" class="btn btn-primary btn-sm"><i class="bi bi-cart-plus"></i> New Purchase Order</a>
                </div>

                <div class="card border border-light shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase fs-7">
                                    <tr>
                                        <th class="ps-4">PO Number</th>
                                        <th>Date Submitted</th>
                                        <th>Product Items & Volume</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${poRows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        // Simulate internal corporate approval process for demo
        function approvePurchaseOrderSim(poNumber) {
            const order = b2bState.orders.find(o => o.poNumber === poNumber);
            if (order) {
                order.status = "Approved";
                
                // Deduct from credit line
                b2bState.creditLimit -= order.total;
                
                // Also update the invoice status associated with it
                const invoice = b2bState.invoices.find(i => i.poNumber === poNumber);
                if (invoice) {
                    invoice.status = "Unpaid";
                }
                
                syncLocalStorage();
                renderDashboardOrders();
                showToast(`Purchase Order ${poNumber} has been verified and Approved.`);
            }
        }

        // View single PO details in B2B PDF Layout modal
        function viewPurchaseOrderDetails(poNumber) {
            const order = b2bState.orders.find(o => o.poNumber === poNumber);
            if (!order) return;

            const modalBody = document.getElementById('poModalContent');
            
            let itemLines = '';
            order.items.forEach(item => {
                itemLines += `
                    <tr>
                        <td><strong>${item.name}</strong><br><span class="text-muted small">SKU: TV-HW-00${item.id}</span></td>
                        <td class="text-center">${item.qty}</td>
                        <td class="text-end">${formatCurrency(item.unitPrice)}</td>
                        <td class="text-end fw-bold text-primary-navy">${formatCurrency(item.unitPrice * item.qty)}</td>
                    </tr>
                `;
            });

            modalBody.innerHTML = `
                <div id="printableInvoiceArea" class="p-3">
                    <div class="row align-items-center mb-4 pb-3 border-bottom">
                        <div class="col-6">
                            <h4 class="fw-bold mb-0 text-primary-navy"><i class="bi bi-cpu-fill"></i> TECHVANGUARD</h4>
                            <span class="text-muted small">Wholesale Technology Solutions</span>
                        </div>
                        <div class="col-6 text-end">
                            <h4 class="fw-bold mb-0 text-orange">PURCHASE ORDER</h4>
                            <span class="text-muted small">PO Reference: <strong>${order.poNumber}</strong></span>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase small font-bold">Supplier Info</h6>
                            <div class="fw-bold text-dark">TechVanguard Wholesale Hub</div>
                            <div class="small text-muted">
                                100 Logistics Blvd, Warehouse 10B<br>
                                San Jose, CA 95112<br>
                                invoicing@techvanguard.com
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="text-muted text-uppercase small font-bold">Buyer Entity</h6>
                            <div class="fw-bold text-dark">${companyInfo.name}</div>
                            <div class="small text-muted">
                                ${companyInfo.address}<br>
                                ${companyInfo.city}<br>
                                Contact: ${companyInfo.representative}
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded border border-light mb-4">
                        <div class="row g-3 text-center">
                            <div class="col-4">
                                <div class="text-muted small">PO Date</div>
                                <div class="fw-bold text-dark">${order.date}</div>
                            </div>
                            <div class="col-4 border-start border-end">
                                <div class="text-muted small">Payment Terms</div>
                                <div class="fw-bold text-dark">Corporate Net-30</div>
                            </div>
                            <div class="col-4">
                                <div class="text-muted small">Fulfillment Status</div>
                                <div class="fw-bold text-orange">${order.status}</div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped align-middle mb-4">
                        <thead class="table-light">
                            <tr>
                                <th>Item Description</th>
                                <th class="text-center" style="width: 10%">Qty</th>
                                <th class="text-end" style="width: 20%">Contract Price</th>
                                <th class="text-end" style="width: 20%">Ext. Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${itemLines}
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span class="fw-semibold">${formatCurrency(order.subtotal)}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tier Discount:</span>
                                <span class="text-success fw-bold">-${formatCurrency(order.discount)}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Sales Tax (10%):</span>
                                <span class="fw-semibold">${formatCurrency(order.tax)}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Freight / Logistics:</span>
                                <span class="fw-semibold">${order.shipping === 0 ? 'FREE' : formatCurrency(order.shipping)}</span>
                            </div>
                            <div class="d-flex justify-content-between fs-5 fw-bold text-primary-navy border-top pt-2">
                                <span>Grand Total:</span>
                                <span>${formatCurrency(order.total)}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            const poModal = new bootstrap.Modal(document.getElementById('poDetailsModal'));
            poModal.show();
        }

        // Dashboard subpage: 3. Invoices List Page
        function renderDashboardInvoices() {
            const view = document.getElementById('dashboardContentView');

            let invRows = '';
            b2bState.invoices.forEach(i => {
                const badgeClass = i.status === 'Paid' ? 'bg-success' : 'bg-warning text-dark';
                invRows += `
                    <tr>
                        <td class="ps-4 fw-bold text-primary">${i.invoiceNumber}</td>
                        <td>${i.poNumber}</td>
                        <td>${i.date}</td>
                        <td>${i.dueDate}</td>
                        <td class="fw-bold text-primary-navy">${formatCurrency(i.total)}</td>
                        <td><span class="badge ${badgeClass} py-1 px-3">${i.status}</span></td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-table-action me-1" onclick="viewInvoiceDetails('${i.invoiceNumber}')"><i class="bi bi-file-earmark-pdf-fill"></i> View & Print</button>
                            ${i.status === 'Unpaid' ? `<button class="btn btn-sm btn-primary px-3 text-white border-0" style="border-radius: 99px; font-size: 0.75rem; font-weight: 600" onclick="payInvoiceSim('${i.invoiceNumber}')"><i class="bi bi-wallet2"></i> Settle Payment</button>` : ''}
                        </td>
                    </tr>
                `;
            });

            view.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0"><i class="bi bi-receipt-cutoff text-success"></i> Invoices & Accounts Term</h3>
                    <div class="text-muted small fw-semibold">Net-30 Corporate Billing</div>
                </div>

                <div class="card border border-light shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase fs-7">
                                    <tr>
                                        <th class="ps-4">Invoice Number</th>
                                        <th>Associated PO</th>
                                        <th>Invoice Date</th>
                                        <th>Payment Due Date</th>
                                        <th>Total Balance</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${invRows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        // Settle payment on invoice simulator
        function payInvoiceSim(invoiceNumber) {
            const invoice = b2bState.invoices.find(i => i.invoiceNumber === invoiceNumber);
            if (invoice) {
                invoice.status = "Paid";
                
                // Refund credit limit since the invoice has been settled
                b2bState.creditLimit = Math.min(companyInfo.initialCreditLimit, b2bState.creditLimit + invoice.total);
                
                // Update associated PO status to Completed
                const order = b2bState.orders.find(o => o.poNumber === invoice.poNumber);
                if (order) {
                    order.status = "Completed";
                }

                syncLocalStorage();
                renderDashboardInvoices();
                showToast(`Invoice ${invoiceNumber} settled via corporate bank draft. Credit limit restored.`);
            }
        }

        // View single Invoice details in PDF layout modal
        function viewInvoiceDetails(invoiceNumber) {
            const invoice = b2bState.invoices.find(i => i.invoiceNumber === invoiceNumber);
            if (!invoice) return;

            const order = b2bState.orders.find(o => o.poNumber === invoice.poNumber);
            if (!order) return;

            const modalBody = document.getElementById('invoiceModalContent');

            let itemLines = '';
            order.items.forEach(item => {
                itemLines += `
                    <tr>
                        <td><strong>${item.name}</strong><br><span class="text-muted small">SKU: TV-HW-00${item.id}</span></td>
                        <td class="text-center">${item.qty}</td>
                        <td class="text-end">${formatCurrency(item.unitPrice)}</td>
                        <td class="text-end fw-bold">${formatCurrency(item.unitPrice * item.qty)}</td>
                    </tr>
                `;
            });

            modalBody.innerHTML = `
                <div id="printableInvoiceArea" class="p-3">
                    <div class="row align-items-center mb-4 pb-3 border-bottom">
                        <div class="col-6">
                            <h4 class="fw-bold mb-0 text-primary-navy"><i class="bi bi-cpu-fill"></i> TECHVANGUARD WHOLESALE</h4>
                            <span class="text-muted small">100 Logistics Blvd, San Jose, CA 95112</span>
                        </div>
                        <div class="col-6 text-end">
                            <h3 class="fw-bold mb-0 text-success">INVOICE</h3>
                            <span class="text-muted small">Invoice #: <strong>${invoice.invoiceNumber}</strong></span>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase small font-bold">Billed To (Client)</h6>
                            <div class="fw-bold text-dark">${companyInfo.name}</div>
                            <div class="small text-muted">
                                ${companyInfo.address}<br>
                                ${companyInfo.city}<br>
                                ${companyInfo.email}
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="text-muted text-uppercase small font-bold">Terms & Timeline</h6>
                            <div class="small text-muted">
                                Invoice Date: <strong>${invoice.date}</strong><br>
                                Payment Due Date: <strong class="text-danger">${invoice.dueDate}</strong><br>
                                Payment Method: <strong>Corporate Credit Line (Net-30)</strong><br>
                                Status: <strong class="text-success">${invoice.status}</strong>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered align-middle mb-4">
                        <thead class="table-light">
                            <tr>
                                <th>Item Specification</th>
                                <th class="text-center" style="width: 10%">Qty</th>
                                <th class="text-end" style="width: 20%">Price</th>
                                <th class="text-end" style="width: 20%">Ext. Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${itemLines}
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Subtotal:</span>
                                <span class="fw-semibold">${formatCurrency(order.subtotal)}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Wholesale discount:</span>
                                <span class="text-success fw-bold">-${formatCurrency(order.discount)}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Sales Tax (10%):</span>
                                <span class="fw-semibold">${formatCurrency(order.tax)}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Freight & Transport:</span>
                                <span class="fw-semibold">${order.shipping === 0 ? 'FREE' : formatCurrency(order.shipping)}</span>
                            </div>
                            <div class="d-flex justify-content-between fs-5 fw-bold text-primary-navy border-top pt-2">
                                <span>Amount Due:</span>
                                <span>${formatCurrency(order.total)}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top text-center text-muted small">
                        Thank you for your bulk business relationship with TechVanguard. Payments are terms Net-30 from date of invoice.<br>
                        Wire payments transfer info: <strong>Silicon Valley Trust, Acct: ****8930, Routing: ****0294</strong>
                    </div>
                </div>
            `;

            const invModal = new bootstrap.Modal(document.getElementById('invoiceDetailsModal'));
            invModal.show();
        }

        // Dashboard subpage: 4. Company Profile
        function renderDashboardCompanyProfile() {
            const view = document.getElementById('dashboardContentView');

            view.innerHTML = `
                <h3 class="fw-bold mb-4"><i class="bi bi-building text-primary"></i> Company Corporate Profile</h3>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card p-4 border-light shadow-sm">
                            <h5 class="fw-bold mb-3 text-primary-navy">Business Information</h5>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Company Registered Name</label>
                                <input type="text" class="form-control" value="${companyInfo.name}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Tax Registration Number (EIN)</label>
                                <input type="text" class="form-control" value="XX-XXXX928" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Business Category</label>
                                <input type="text" class="form-control" value="IT System Integrator & Hardware Reseller" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Corporate Representative</label>
                                <input type="text" class="form-control" value="${companyInfo.representative}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-4 border-light shadow-sm h-100">
                            <h5 class="fw-bold mb-3 text-primary-navy">Corporate Credit & Invoicing Address</h5>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Street Address</label>
                                <input type="text" class="form-control" value="${companyInfo.address}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">City, State, Zip Code</label>
                                <input type="text" class="form-control" value="${companyInfo.city}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Email for Billing Invoices</label>
                                <input type="text" class="form-control" value="${companyInfo.email}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold mb-1">Office Telephone Line</label>
                                <input type="text" class="form-control" value="${companyInfo.phone}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Dashboard subpage: 5. Corporate Support Page
        function renderDashboardSupport() {
            const view = document.getElementById('dashboardContentView');

            view.innerHTML = `
                <h3 class="fw-bold mb-4"><i class="bi bi-question-circle text-primary"></i> Enterprise B2B Support</h3>

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card p-4 border-light shadow-sm">
                            <h5 class="fw-bold mb-3 text-primary-navy">Submit Support Ticket</h5>
                            <form id="supportTicketForm" onsubmit="event.preventDefault(); showToast('Support ticket successfully submitted! Our wholesale representatives will contact you shortly.', 'success'); document.getElementById('ticketSubject').value=''; document.getElementById('ticketMessage').value=''">
                                <div class="mb-3">
                                    <label for="ticketSubject" class="form-label small fw-bold">Subject / Concern <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ticketSubject" placeholder="e.g. Credit limit increase request, customs clearance paperwork" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ticketMessage" class="form-label small fw-bold">Message Details <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="ticketMessage" rows="5" placeholder="Please describe the logistics, billing or procurement assistance needed." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: var(--electric-blue)">Submit Ticket</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card p-4 border-light bg-light h-100">
                            <h5 class="fw-bold mb-3 text-primary-navy">Corporate Representatives Contact</h5>
                            <div class="mb-4">
                                <div class="fw-bold">Procurement Account Manager</div>
                                <div class="text-muted small">David Vance (Senior Wholesaler Rep)</div>
                                <div class="small text-primary"><i class="bi bi-telephone"></i> +1 (800) 555-9012 (Ext. 402)</div>
                                <div class="small text-primary"><i class="bi bi-envelope"></i> d.vance@techvanguard.com</div>
                            </div>
                            <div class="mb-4">
                                <div class="fw-bold">Billing & Credit Division</div>
                                <div class="text-muted small">Invoices, Statement of Account & Wire settlement line</div>
                                <div class="small text-primary"><i class="bi bi-envelope"></i> creditops@techvanguard.com</div>
                            </div>
                            <div class="border-top pt-3">
                                <div class="fw-bold text-orange"><i class="bi bi-clock-fill"></i> SLA Response Guidelines</div>
                                <p class="text-muted small mb-0 mt-1">Verified B2B accounts enjoy prioritized support lines with a guaranteed response time of <strong>under 4 business hours</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // RFQ Modal triggers
        function quickRequestQuotation(id) {
            const product = products.find(p => p.id === id);
            if (!product) return;

            document.getElementById('rfqProductId').value = product.id;
            document.getElementById('rfqProductTitle').textContent = product.name;
            document.getElementById('rfqProductSku').textContent = `SKU: TV-HW-00${product.id} | Category: ${product.category}`;
            document.getElementById('rfqQty').value = product.moq;
            document.getElementById('rfqQty').min = product.moq;
            document.getElementById('rfqMoqWarning').textContent = `MOQ Required: ${product.moq} units`;
            document.getElementById('rfqTargetPrice').value = product.price;
            document.getElementById('rfqRefPrice').textContent = formatCurrency(product.price);
            
            // Set default delivery date to +7 days
            const targetDate = new Date();
            targetDate.setDate(targetDate.getDate() + 7);
            document.getElementById('rfqDeliveryDate').value = targetDate.toISOString().split('T')[0];

            const rfqModal = new bootstrap.Modal(document.getElementById('rfqModal'));
            rfqModal.show();
        }

        // Submit RFQ form
        document.getElementById('rfqForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = parseInt(document.getElementById('rfqProductId').value);
            const product = products.find(p => p.id === id);
            const targetQty = parseInt(document.getElementById('rfqQty').value);
            const targetPrice = parseFloat(document.getElementById('rfqTargetPrice').value);
            
            // Close RFQ Modal
            bootstrap.Modal.getInstance(document.getElementById('rfqModal')).hide();
            
            showToast(`RFQ submitted! Target of ${targetQty} units at ${formatCurrency(targetPrice)} / unit is under sales review.`);
        });

        // Search redirection logic: search from any page redirects to catalog pre-filtered
        document.getElementById('globalSearchInput').addEventListener('input', function(e) {
            const val = e.target.value;
            b2bState.searchQuery = val;
            
            // If user is not on products page, redirect them there with search queries intact
            if (!window.location.hash.startsWith('#/products')) {
                window.location.hash = `#/products?search=${encodeURIComponent(val)}`;
            } else {
                updateProductsGrid();
            }
        });

        document.getElementById('clearSearchBtn').addEventListener('click', function() {
            clearSearch();
        });

        // Initialize Router triggers
        window.addEventListener('hashchange', handleRouting);
        window.addEventListener('DOMContentLoaded', () => {
            syncLocalStorage();
            handleRouting();
        });
    </script>
</body>
</html>
