{{-- ================================================================
     TOP NAVBAR PARTIAL — B2B Wholesale Admin
     ================================================================ --}}
<header class="top-navbar" id="topNavbar">
    <div class="navbar-left">

        {{-- Sidebar Toggle (hamburger) --}}
        <button class="navbar-toggle-btn" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        {{-- Page Title Breadcrumb --}}
        <div class="navbar-breadcrumb d-none d-md-flex">
            <span class="breadcrumb-home"><i class="bi bi-house-fill"></i></span>
            <span class="breadcrumb-sep"><i class="bi bi-chevron-right"></i></span>
            <span class="breadcrumb-current">@yield('page-title', 'Dashboard')</span>
        </div>

    </div>

    <div class="navbar-center d-none d-lg-flex">
        {{-- Global Search --}}
        <div class="navbar-search" id="navbarSearch">
            <i class="bi bi-search search-icon"></i>
            <input
                type="search"
                class="search-input"
                id="globalSearch"
                placeholder="Search products, orders, customers…"
                autocomplete="off"
                aria-label="Global search"
            />
            <kbd class="search-kbd">⌘K</kbd>
        </div>
    </div>

    <div class="navbar-right">

        {{-- Mobile Search Toggle --}}
        <button class="navbar-action-btn d-lg-none" id="mobileSearchBtn" aria-label="Search">
            <i class="bi bi-search"></i>
        </button>

        {{-- Dark Mode Toggle --}}
        <button class="navbar-action-btn theme-toggle" id="themeToggleBtn" aria-label="Toggle dark mode">
            <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
        </button>

        {{-- Language Dropdown --}}
        <div class="dropdown">
            <button class="navbar-action-btn dropdown-toggle-custom"
                    id="langDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    aria-label="Language">
                <span class="lang-flag">🇺🇸</span>
                <span class="lang-code d-none d-md-inline">EN</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="langDropdown">
                <li class="dropdown-header-label">Language</li>
                <li>
                    <a class="dropdown-item lang-item active" href="#" data-lang="en">
                        <span class="flag-emoji">🇺🇸</span>
                        <span>English</span>
                        <i class="bi bi-check2 ms-auto"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item lang-item" href="#" data-lang="kh">
                        <span class="flag-emoji">🇰🇭</span>
                        <span>ភាសាខ្មែរ</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item lang-item" href="#" data-lang="zh">
                        <span class="flag-emoji">🇨🇳</span>
                        <span>中文</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item lang-item" href="#" data-lang="ja">
                        <span class="flag-emoji">🇯🇵</span>
                        <span>日本語</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Notifications --}}
        <div class="dropdown">
            <button class="navbar-action-btn notification-btn"
                    id="notifDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    aria-label="Notifications">
                <i class="bi bi-bell-fill"></i>
                <span class="notif-badge" aria-label="8 notifications">8</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown notification-dropdown" aria-labelledby="notifDropdown">
                <div class="notification-header">
                    <span class="notification-title">Notifications</span>
                    <a href="#" class="notification-mark-all">Mark all as read</a>
                </div>
                <div class="notification-list">
                    <a href="#" class="notification-item unread">
                        <div class="notif-icon-wrap notif-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="notif-content">
                            <p class="notif-text">Order #ORD-10041 completed</p>
                            <span class="notif-time">2 min ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item unread">
                        <div class="notif-icon-wrap notif-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="notif-content">
                            <p class="notif-text">Low stock: Fire Extinguisher 5kg (15 left)</p>
                            <span class="notif-time">45 min ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item unread">
                        <div class="notif-icon-wrap notif-primary">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div class="notif-content">
                            <p class="notif-text">New customer: Nordic Wholesale AB</p>
                            <span class="notif-time">1 hr ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notif-icon-wrap notif-danger">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="notif-content">
                            <p class="notif-text">Order #ORD-10037 was cancelled</p>
                            <span class="notif-time">3 hrs ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notif-icon-wrap notif-info">
                            <i class="bi bi-truck-front-fill"></i>
                        </div>
                        <div class="notif-content">
                            <p class="notif-text">Shipment dispatched for #ORD-10038</p>
                            <span class="notif-time">5 hrs ago</span>
                        </div>
                    </a>
                </div>
                <div class="notification-footer">
                    <a href="{{ route('admin.reports') }}">View all notifications</a>
                </div>
            </div>
        </div>

        {{-- Messages --}}
        <div class="dropdown">
            <button class="navbar-action-btn message-btn"
                    id="msgDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    aria-label="Messages">
                <i class="bi bi-chat-dots-fill"></i>
                <span class="msg-badge" aria-label="3 messages">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown notification-dropdown" aria-labelledby="msgDropdown">
                <div class="notification-header">
                    <span class="notification-title">Messages</span>
                    <a href="#" class="notification-mark-all">View all</a>
                </div>
                <div class="notification-list">
                    <a href="#" class="notification-item unread">
                        <div class="msg-avatar" style="background:#2563EB;">PR</div>
                        <div class="notif-content">
                            <p class="notif-text"><strong>Pacific Retail Co.</strong> — Need quote for bulk order</p>
                            <span class="notif-time">10 min ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item unread">
                        <div class="msg-avatar" style="background:#7C3AED;">MS</div>
                        <div class="notif-content">
                            <p class="notif-text"><strong>Metro Supplies</strong> — Invoice clarification needed</p>
                            <span class="notif-time">2 hrs ago</span>
                        </div>
                    </a>
                    <a href="#" class="notification-item unread">
                        <div class="msg-avatar" style="background:#059669;">GT</div>
                        <div class="notif-content">
                            <p class="notif-text"><strong>Global Traders</strong> — Shipping address update</p>
                            <span class="notif-time">4 hrs ago</span>
                        </div>
                    </a>
                </div>
                <div class="notification-footer">
                    <a href="#">Open messages</a>
                </div>
            </div>
        </div>

        {{-- Profile Dropdown --}}
        @php
            $currentUser = auth('admin')->user() ?? auth('web')->user() ?? auth()->user();
            $userName = $currentUser->name ?? 'User';
            $userInitials = collect(explode(' ', $userName))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('');
            $userRole = $currentUser->role->name ?? 'User';
            $userEmail = $currentUser->email ?? '';
        @endphp
        <div class="dropdown">
            <button class="profile-btn"
                    id="profileDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    aria-label="Profile menu">
                <div class="profile-avatar">{{ strtoupper($userInitials) }}</div>
                <div class="profile-info d-none d-xl-flex">
                    <span class="profile-name">{{ $userName }}</span>
                    <span class="profile-role">{{ $userRole }}</span>
                </div>
                <i class="bi bi-chevron-down profile-chevron d-none d-xl-inline"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end navbar-dropdown profile-dropdown" aria-labelledby="profileDropdown">
                <li class="profile-dropdown-header">
                    <div class="profile-avatar profile-avatar-lg">{{ strtoupper($userInitials) }}</div>
                    <div>
                        <div class="profile-dropdown-name">{{ $userName }}</div>
                        <div class="profile-dropdown-email">{{ $userEmail }}</div>
                    </div>
                </li>
                <li><hr class="dropdown-divider my-2" /></li>
                <li><a class="dropdown-item profile-menu-item" href="#"><i class="bi bi-person-fill"></i> My Profile</a></li>
                <li><a class="dropdown-item profile-menu-item" href="#"><i class="bi bi-shield-check"></i> Security</a></li>
                <li><a class="dropdown-item profile-menu-item" href="{{ route('admin.settings') }}"><i class="bi bi-gear-fill"></i> Settings</a></li>
                <li><hr class="dropdown-divider my-2" /></li>
                <li>
                    <a class="dropdown-item profile-menu-item profile-logout" href="#">
                        <i class="bi bi-box-arrow-left"></i> Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

    </div>
</header>

{{-- Mobile Search Bar (hidden by default) --}}
<div class="mobile-search-bar" id="mobileSearchBar">
    <div class="mobile-search-inner">
        <i class="bi bi-search"></i>
        <input type="search" class="search-input" id="mobileSearchInput" placeholder="Search…" autocomplete="off" />
        <button class="mobile-search-close" id="mobileSearchClose" aria-label="Close search">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
</div>
