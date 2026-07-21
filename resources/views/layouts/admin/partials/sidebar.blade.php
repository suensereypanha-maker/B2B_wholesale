{{-- ================================================================
     SIDEBAR PARTIAL — B2B Wholesale Admin
     ================================================================ --}}
@php
    $user = auth('admin')->user() ?? auth('web')->user() ?? auth()->user();
    $isSupplier = $user && $user->hasRole('supplier');
    $can = function($permission) use ($user) {
        return $user && ($user->isSuperAdmin() || $user->hasPermission($permission));
    };

    $pendingSuppliersCount = \App\Models\User::where('is_active', false)
        ->whereHas('role', fn($q) => $q->where('slug', 'supplier'))
        ->count();

    // Dynamic routes depending on role
    $dashboardRoute      = $isSupplier ? route('supplier.dashboard') : route('admin.dashboard');
    $productsRoute       = $isSupplier ? route('supplier.products') : route('admin.products');
    $purchaseOrdersRoute = $isSupplier ? route('supplier.purchase-orders') : route('admin.purchase-orders');
    $reportsRoute        = $isSupplier ? route('supplier.reports') : route('admin.reports');
@endphp

<aside class="sidebar" id="sidebar">

    {{-- Sidebar Header / Brand --}}
    <div class="sidebar-brand">
        <div class="brand-logo">
            <div class="brand-icon">
                <i class="bi bi-boxes"></i>
            </div>
            <div class="brand-text">
                <span class="brand-name">WholeSale</span>
                <span class="brand-tag">B2B Admin Pro</span>
            </div>
        </div>
        <button class="sidebar-close-btn d-lg-none" id="sidebarCloseBtn" aria-label="Close Sidebar">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    {{-- Sidebar Navigation --}}
    <nav class="sidebar-nav" aria-label="Admin Navigation">

        {{-- Main Menu --}}
        @if($can('dashboard.view') || $can('users.view') || $can('roles.view') || $can('permissions.view'))
        <div class="nav-section">
            <span class="nav-section-label">Main Menu</span>

            @if($can('dashboard.view'))
            <a href="{{ $dashboardRoute }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('supplier.dashboard') ? 'active' : '' }}"
               id="nav-dashboard">
                <span class="nav-icon"><i class="bi bi-grid-1x2-fill"></i></span>
                <span class="nav-label">Dashboard</span>
                @if(request()->routeIs('admin.dashboard') || request()->routeIs('supplier.dashboard'))
                    <span class="nav-active-dot"></span>
                @endif
            </a>
            @endif

            @if($can('users.view'))
            <a href="{{ route('admin.users') }}"
               class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}"
               id="nav-users">
                <span class="nav-icon"><i class="bi bi-people-fill"></i></span>
                <span class="nav-label">Users</span>
                @if($pendingSuppliersCount > 0)
                    <span class="nav-badge warning">{{ $pendingSuppliersCount }}</span>
                @endif
            </a>
            @endif

            @if($can('roles.view'))
            <a href="{{ route('admin.roles.index') }}"
               class="nav-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
               id="nav-roles">
                <span class="nav-icon"><i class="bi bi-shield-lock-fill"></i></span>
                <span class="nav-label">Roles</span>
            </a>
            @endif

            @if($can('permissions.view'))
            <a href="{{ route('admin.permissions.index') }}"
               class="nav-item {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}"
               id="nav-permissions">
                <span class="nav-icon"><i class="bi bi-key-fill"></i></span>
                <span class="nav-label">Permissions</span>
            </a>
            @endif
        </div>
        @endif

        {{-- Catalog --}}
        @if($can('products.view') || $can('categories.view') || $can('brands.view'))
        <div class="nav-section">
            <span class="nav-section-label">Catalog</span>

            <div class="nav-dropdown {{ request()->routeIs('admin.products') || request()->routeIs('supplier.products') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.brands') ? 'open' : '' }}" id="nav-catalog-dropdown">
                <a href="#" class="nav-item nav-dropdown-toggle" onclick="event.preventDefault(); this.parentElement.classList.toggle('open');">
                    <span class="nav-icon"><i class="bi bi-box-seam-fill"></i></span>
                    <span class="nav-label">Product Catalog</span>
                    <span class="nav-arrow"><i class="bi bi-chevron-down"></i></span>
                </a>
                <div class="nav-sub-menu">
                    @if($can('products.view'))
                    <a href="{{ route('admin.products.index') }}"
                       class="nav-sub-item {{ request()->routeIs('admin.products.*') || request()->routeIs('supplier.products') ? 'active' : '' }}"
                       id="nav-products">
                        <span class="nav-sub-dot"></span>
                        <span class="nav-label">Products</span>
                        <span class="nav-badge warning">{{ \App\Models\Product::count() }}</span>
                    </a>
                    @endif

                    @if($can('categories.view'))
                    <a href="{{ route('admin.categories.index', ['filter' => 'parents']) }}"
                       class="nav-sub-item {{ request()->routeIs('admin.categories.*') && request()->query('filter') !== 'subcategories' ? 'active' : '' }}"
                       id="nav-categories">
                        <span class="nav-sub-dot"></span>
                        <span class="nav-label">Categories</span>
                    </a>

                    <a href="{{ route('admin.categories.index', ['filter' => 'subcategories']) }}"
                       class="nav-sub-item {{ request()->routeIs('admin.categories.*') && request()->query('filter') === 'subcategories' ? 'active' : '' }}"
                       id="nav-subcategories">
                        <span class="nav-sub-dot"></span>
                        <span class="nav-label">Subcategories</span>
                    </a>
                    @endif

                    @if($can('brands.view'))
                    <a href="{{ route('admin.brands.index') }}"
                       class="nav-sub-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}"
                       id="nav-brands">
                        <span class="nav-sub-dot"></span>
                        <span class="nav-label">Brands</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- Procurement --}}
        @if($can('suppliers.view') || $can('purchase-orders.view'))
        <div class="nav-section">
            <span class="nav-section-label">Procurement</span>

            @if($can('suppliers.view'))
            <a href="{{ route('admin.suppliers.index') }}"
               class="nav-item {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}"
               id="nav-suppliers">
                <span class="nav-icon"><i class="bi bi-truck-front-fill"></i></span>
                <span class="nav-label">Suppliers</span>
            </a>
            @endif

            @if($can('purchase-orders.view'))
            <a href="{{ $purchaseOrdersRoute }}"
               class="nav-item {{ request()->routeIs('admin.purchase-orders') || request()->routeIs('supplier.purchase-orders') ? 'active' : '' }}"
               id="nav-purchase-orders">
                <span class="nav-icon"><i class="bi bi-cart-check-fill"></i></span>
                <span class="nav-label">Purchase Orders</span>
            </a>
            @endif
        </div>
        @endif

        {{-- Sales --}}
        @if($can('customers.view') || $can('sales-orders.view'))
        <div class="nav-section">
            <span class="nav-section-label">Sales</span>

            @if($can('customers.view'))
            <a href="{{ route('admin.customers') }}"
               class="nav-item {{ request()->routeIs('admin.customers') ? 'active' : '' }}"
               id="nav-customers">
                <span class="nav-icon"><i class="bi bi-person-lines-fill"></i></span>
                <span class="nav-label">Customers</span>
            </a>
            @endif

            @if($can('sales-orders.view'))
            <a href="{{ route('admin.sales-orders') }}"
               class="nav-item {{ request()->routeIs('admin.sales-orders') ? 'active' : '' }}"
               id="nav-sales-orders">
                <span class="nav-icon"><i class="bi bi-receipt-cutoff"></i></span>
                <span class="nav-label">Sales Orders</span>
                <span class="nav-badge danger">12</span>
            </a>
            @endif
        </div>
        @endif

        {{-- Operations --}}
        @if($can('warehouse.view') || $can('inventory.view') || $can('reports.view'))
        <div class="nav-section">
            <span class="nav-section-label">Operations</span>

            @if($can('warehouse.view'))
            <a href="{{ route('admin.warehouse') }}"
               class="nav-item {{ request()->routeIs('admin.warehouse') ? 'active' : '' }}"
               id="nav-warehouse">
                <span class="nav-icon"><i class="bi bi-building-fill"></i></span>
                <span class="nav-label">Warehouse</span>
            </a>
            @endif

            @if($can('inventory.view'))
            <a href="{{ route('admin.inventory') }}"
               class="nav-item {{ request()->routeIs('admin.inventory') ? 'active' : '' }}"
               id="nav-inventory">
                <span class="nav-icon"><i class="bi bi-archive-fill"></i></span>
                <span class="nav-label">Inventory</span>
            </a>
            @endif

            @if($can('reports.view'))
            <a href="{{ $reportsRoute }}"
               class="nav-item {{ request()->routeIs('admin.reports') || request()->routeIs('supplier.reports') ? 'active' : '' }}"
               id="nav-reports">
                <span class="nav-icon"><i class="bi bi-bar-chart-line-fill"></i></span>
                <span class="nav-label">Reports</span>
            </a>
            @endif
        </div>
        @endif

        {{-- System --}}
        <div class="nav-section">
            <span class="nav-section-label">System</span>

            @if($can('settings.view'))
            <a href="{{ route('admin.settings') }}"
               class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
               id="nav-settings">
                <span class="nav-icon"><i class="bi bi-gear-fill"></i></span>
                <span class="nav-label">Settings</span>
            </a>
            @endif

            <a href="#" class="nav-item nav-item-logout" id="nav-logout">
                <span class="nav-icon"><i class="bi bi-box-arrow-left"></i></span>
                <span class="nav-label">Logout</span>
            </a>
        </div>

    </nav>

    {{-- Sidebar Footer --}}
    @php
        $sidebarName = $user->name ?? 'User';
        $sidebarInitials = collect(explode(' ', $sidebarName))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('');
        $sidebarRole = $user->role->name ?? 'User';
    @endphp
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">{{ strtoupper($sidebarInitials) }}</div>
            <div class="sidebar-user-info">
                <span class="sidebar-user-name">{{ $sidebarName }}</span>
                <span class="sidebar-user-role">{{ $sidebarRole }}</span>
            </div>
            <button class="sidebar-user-menu" aria-label="User options">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
        </div>
    </div>

</aside>
