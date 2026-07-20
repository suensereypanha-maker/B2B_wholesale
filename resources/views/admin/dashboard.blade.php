@extends('layouts.admin.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
{{-- Any page-specific styles --}}
@endpush

@section('content')

{{-- ================================================================
     WELCOME BANNER
================================================================ --}}
<div class="welcome-banner animate-fadeInUp" id="welcomeBanner">
    <div class="welcome-left">
        <div class="welcome-greeting">
            <span class="welcome-emoji" id="greetingEmoji">👋</span>
            <div>
                <h1 class="welcome-title" id="greetingText">Good morning, Super Admin!</h1>
                <p class="welcome-subtitle">Here's what's happening with your wholesale business today.</p>
            </div>
        </div>
        <div class="welcome-meta">
            <div class="welcome-date-time">
                <i class="bi bi-calendar3"></i>
                <span id="currentDate">Saturday, 19 July 2026</span>
            </div>
            <div class="welcome-date-time ms-3">
                <i class="bi bi-clock"></i>
                <span id="currentTime">--:--</span>
            </div>
        </div>
    </div>
    <div class="welcome-right">
        <div class="welcome-stat-mini">
            <div class="welcome-stat-mini-item">
                <span class="wsm-value">${{ number_format($dashboard['today_sales']) }}</span>
                <span class="wsm-label">Today's Sales</span>
            </div>
            <div class="welcome-stat-mini-sep"></div>
            <div class="welcome-stat-mini-item">
                <span class="wsm-value">{{ $dashboard['pending_orders'] }}</span>
                <span class="wsm-label">Pending Orders</span>
            </div>
            <div class="welcome-stat-mini-sep"></div>
            <div class="welcome-stat-mini-item">
                <span class="wsm-value">{{ $dashboard['low_stock'] }}</span>
                <span class="wsm-label">Low Stock</span>
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
     STATISTICS CARDS
================================================================ --}}
<div class="stats-grid animate-fadeInUp" style="animation-delay:.08s">

    {{-- Total Products --}}
    <div class="stat-card" id="stat-products">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-primary">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Total Products</p>
                <h2 class="stat-value" data-count="{{ $dashboard['total_products'] }}">0</h2>
                <div class="stat-growth {{ $growth['products']['trend'] === 'up' ? 'growth-up' : 'growth-down' }}">
                    <i class="bi bi-arrow-{{ $growth['products']['trend'] === 'up' ? 'up' : 'down' }}-right-circle-fill"></i>
                    <span>{{ abs($growth['products']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.products') }}" class="stat-link">View all products <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    {{-- Categories --}}
    <div class="stat-card" id="stat-categories">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-indigo">
                <i class="bi bi-grid-fill"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Categories</p>
                <h2 class="stat-value" data-count="{{ $dashboard['total_categories'] }}">0</h2>
                <div class="stat-growth {{ $growth['categories']['trend'] === 'up' ? 'growth-up' : 'growth-down' }}">
                    <i class="bi bi-arrow-{{ $growth['categories']['trend'] === 'up' ? 'up' : 'down' }}-right-circle-fill"></i>
                    <span>{{ abs($growth['categories']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.categories') }}" class="stat-link">View categories <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    {{-- Total Customers --}}
    <div class="stat-card" id="stat-customers">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-emerald">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Customers</p>
                <h2 class="stat-value" data-count="{{ $dashboard['total_customers'] }}">0</h2>
                <div class="stat-growth {{ $growth['customers']['trend'] === 'up' ? 'growth-up' : 'growth-down' }}">
                    <i class="bi bi-arrow-{{ $growth['customers']['trend'] === 'up' ? 'up' : 'down' }}-right-circle-fill"></i>
                    <span>{{ abs($growth['customers']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.customers') }}" class="stat-link">View customers <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    {{-- Suppliers --}}
    <div class="stat-card" id="stat-suppliers">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-amber">
                <i class="bi bi-truck-front-fill"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Suppliers</p>
                <h2 class="stat-value" data-count="{{ $dashboard['total_suppliers'] }}">0</h2>
                <div class="stat-growth {{ $growth['suppliers']['trend'] === 'up' ? 'growth-up' : 'growth-down' }}">
                    <i class="bi bi-arrow-{{ $growth['suppliers']['trend'] === 'up' ? 'up' : 'down' }}-right-circle-fill"></i>
                    <span>{{ abs($growth['suppliers']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.suppliers') }}" class="stat-link">View suppliers <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    {{-- Total Orders --}}
    <div class="stat-card" id="stat-orders">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-violet">
                <i class="bi bi-receipt-cutoff"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Total Orders</p>
                <h2 class="stat-value" data-count="{{ $dashboard['total_orders'] }}">0</h2>
                <div class="stat-growth {{ $growth['orders']['trend'] === 'up' ? 'growth-up' : 'growth-down' }}">
                    <i class="bi bi-arrow-{{ $growth['orders']['trend'] === 'up' ? 'up' : 'down' }}-right-circle-fill"></i>
                    <span>{{ abs($growth['orders']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.sales-orders') }}" class="stat-link">View orders <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    {{-- Revenue --}}
    <div class="stat-card stat-card-featured" id="stat-revenue">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-white">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Total Revenue</p>
                <h2 class="stat-value" data-count="{{ $dashboard['total_revenue'] }}" data-prefix="$">$0</h2>
                <div class="stat-growth growth-up" style="color:rgba(255,255,255,0.85)">
                    <i class="bi bi-arrow-up-right-circle-fill"></i>
                    <span>{{ abs($growth['revenue']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer" style="border-color:rgba(255,255,255,0.2)">
            <a href="{{ route('admin.reports') }}" class="stat-link" style="color:rgba(255,255,255,0.9)">
                View reports <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="stat-card" id="stat-low-stock">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Low Stock Items</p>
                <h2 class="stat-value" data-count="{{ $dashboard['low_stock'] }}">0</h2>
                <div class="stat-growth growth-up">
                    <i class="bi bi-arrow-up-right-circle-fill"></i>
                    <span>{{ abs($growth['low_stock']['value']) }}% items critical</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.inventory') }}" class="stat-link">View inventory <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    {{-- Pending Orders --}}
    <div class="stat-card" id="stat-pending">
        <div class="stat-card-inner">
            <div class="stat-icon-wrap stat-icon-warning">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-body">
                <p class="stat-title">Pending Orders</p>
                <h2 class="stat-value" data-count="{{ $dashboard['pending_orders'] }}">0</h2>
                <div class="stat-growth {{ $growth['pending']['trend'] === 'down' ? 'growth-down' : 'growth-up' }}">
                    <i class="bi bi-arrow-{{ $growth['pending']['trend'] === 'up' ? 'up' : 'down' }}-right-circle-fill"></i>
                    <span>{{ abs($growth['pending']['value']) }}% vs last month</span>
                </div>
            </div>
        </div>
        <div class="stat-footer">
            <a href="{{ route('admin.sales-orders') }}" class="stat-link">Manage orders <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

</div>

{{-- ================================================================
     CHARTS ROW
================================================================ --}}
<div class="row g-4 mt-1 animate-fadeInUp" style="animation-delay:.16s">

    {{-- Monthly Sales + Orders Chart --}}
    <div class="col-12 col-xl-8">
        <div class="card-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Sales & Orders Overview</h2>
                    <p class="panel-subtitle">Monthly performance for the last 12 months</p>
                </div>
                <div class="panel-actions">
                    <div class="chart-period-toggle" id="salesChartToggle">
                        <button class="period-btn active" data-period="revenue">Revenue</button>
                        <button class="period-btn" data-period="orders">Orders</button>
                        <button class="period-btn" data-period="both">Both</button>
                    </div>
                </div>
            </div>
            <div class="chart-container" style="height:300px;">
                <canvas id="monthlySalesChart" aria-label="Monthly Sales Chart"></canvas>
            </div>
        </div>
    </div>

    {{-- Order Status Pie Chart --}}
    <div class="col-12 col-xl-4">
        <div class="card-panel h-100">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Order Status</h2>
                    <p class="panel-subtitle">Current distribution</p>
                </div>
            </div>
            <div class="chart-container" style="height:220px;">
                <canvas id="orderStatusChart" aria-label="Order Status Chart"></canvas>
            </div>
            <div class="donut-legend" id="orderStatusLegend">
                @foreach($orderStatusData['labels'] as $i => $label)
                <div class="donut-legend-item">
                    <span class="donut-legend-dot" style="background:{{ $orderStatusData['colors'][$i] }}"></span>
                    <span class="donut-legend-label">{{ $label }}</span>
                    <span class="donut-legend-value">{{ $orderStatusData['values'][$i] }}%</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
     REVENUE BY CATEGORY CHART + QUICK ACTIONS
================================================================ --}}
<div class="row g-4 mt-1 animate-fadeInUp" style="animation-delay:.2s">

    {{-- Revenue by Category Bar Chart --}}
    <div class="col-12 col-lg-7">
        <div class="card-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Revenue by Category</h2>
                    <p class="panel-subtitle">Top performing product categories</p>
                </div>
            </div>
            <div class="chart-container" style="height:260px;">
                <canvas id="revenueCategoryChart" aria-label="Revenue by Category Chart"></canvas>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="col-12 col-lg-5">
        <div class="card-panel h-100">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Quick Actions</h2>
                    <p class="panel-subtitle">Common administrative tasks</p>
                </div>
            </div>
            <div class="quick-actions-grid">
                <a href="{{ route('admin.products') }}" class="quick-action-btn" id="qa-product">
                    <div class="qa-icon qa-icon-primary">
                        <i class="bi bi-plus-circle-fill"></i>
                    </div>
                    <div class="qa-text">
                        <span class="qa-title">New Product</span>
                        <span class="qa-desc">Add product to catalog</span>
                    </div>
                    <i class="bi bi-chevron-right qa-arrow"></i>
                </a>
                <a href="{{ route('admin.categories') }}" class="quick-action-btn" id="qa-category">
                    <div class="qa-icon qa-icon-indigo">
                        <i class="bi bi-folder-plus"></i>
                    </div>
                    <div class="qa-text">
                        <span class="qa-title">New Category</span>
                        <span class="qa-desc">Create a product category</span>
                    </div>
                    <i class="bi bi-chevron-right qa-arrow"></i>
                </a>
                <a href="{{ route('admin.suppliers') }}" class="quick-action-btn" id="qa-supplier">
                    <div class="qa-icon qa-icon-amber">
                        <i class="bi bi-truck-front-fill"></i>
                    </div>
                    <div class="qa-text">
                        <span class="qa-title">Add Supplier</span>
                        <span class="qa-desc">Register new supplier</span>
                    </div>
                    <i class="bi bi-chevron-right qa-arrow"></i>
                </a>
                <a href="{{ route('admin.sales-orders') }}" class="quick-action-btn" id="qa-order">
                    <div class="qa-icon qa-icon-emerald">
                        <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    <div class="qa-text">
                        <span class="qa-title">Create Order</span>
                        <span class="qa-desc">Place a new sales order</span>
                    </div>
                    <i class="bi bi-chevron-right qa-arrow"></i>
                </a>
                <a href="{{ route('admin.reports') }}" class="quick-action-btn" id="qa-report">
                    <div class="qa-icon qa-icon-violet">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    </div>
                    <div class="qa-text">
                        <span class="qa-title">Generate Report</span>
                        <span class="qa-desc">Export analytics report</span>
                    </div>
                    <i class="bi bi-chevron-right qa-arrow"></i>
                </a>
                <a href="{{ route('admin.inventory') }}" class="quick-action-btn" id="qa-inventory">
                    <div class="qa-icon qa-icon-danger">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                    <div class="qa-text">
                        <span class="qa-title">Update Inventory</span>
                        <span class="qa-desc">Manage stock levels</span>
                    </div>
                    <i class="bi bi-chevron-right qa-arrow"></i>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
     RECENT ORDERS TABLE
================================================================ --}}
<div class="row g-4 mt-1 animate-fadeInUp" style="animation-delay:.24s">
    <div class="col-12">
        <div class="card-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Recent Orders</h2>
                    <p class="panel-subtitle">Latest transactions from your wholesale customers</p>
                </div>
                <div class="panel-actions">
                    <a href="{{ route('admin.sales-orders') }}" class="btn-outline-primary-sm">
                        View all <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="admin-table" id="recentOrdersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th class="text-center">Items</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>
                                <span class="order-id">{{ $order['id'] }}</span>
                            </td>
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar" style="background:{{ $order['color'] }}">
                                        {{ $order['avatar'] }}
                                    </div>
                                    <span class="customer-name">{{ $order['customer'] }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="items-count">{{ $order['items'] }}</span>
                            </td>
                            <td>
                                <span class="order-amount">{{ $order['total'] }}</span>
                            </td>
                            <td>
                                <span class="payment-method">{{ $order['payment'] }}</span>
                            </td>
                            <td>
                                <span class="order-date">{{ $order['date'] }}</span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order['status'] }}">
                                    <span class="status-dot"></span>
                                    {{ ucfirst($order['status']) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <button class="tbl-action-btn" title="View order" aria-label="View order {{ $order['id'] }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button class="tbl-action-btn" title="Edit order" aria-label="Edit order {{ $order['id'] }}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button class="tbl-action-btn tbl-action-danger" title="Delete order" aria-label="Delete order {{ $order['id'] }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
     TOP PRODUCTS + LOW STOCK
================================================================ --}}
<div class="row g-4 mt-1 animate-fadeInUp" style="animation-delay:.28s">

    {{-- Top Selling Products --}}
    <div class="col-12 col-xl-7">
        <div class="card-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Top Selling Products</h2>
                    <p class="panel-subtitle">Best performers this month</p>
                </div>
                <div class="panel-actions">
                    <a href="{{ route('admin.products') }}" class="btn-outline-primary-sm">
                        View all <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="admin-table" id="topProductsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th class="text-center">Sold</th>
                            <th>Revenue</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Trend</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topProducts as $idx => $product)
                        <tr>
                            <td>
                                <span class="rank-badge rank-{{ $idx + 1 <= 3 ? $idx + 1 : 'other' }}">{{ $idx + 1 }}</span>
                            </td>
                            <td>
                                <div class="product-cell">
                                    <div class="product-cell-info">
                                        <span class="product-cell-name">{{ $product['name'] }}</span>
                                        <span class="product-cell-sku">{{ $product['sku'] }} · {{ $product['category'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <strong>{{ number_format($product['sold']) }}</strong>
                            </td>
                            <td>
                                <span class="product-revenue">{{ $product['revenue'] }}</span>
                            </td>
                            <td class="text-center">
                                <span class="stock-pill {{ $product['stock'] < 100 ? 'stock-low' : 'stock-ok' }}">
                                    {{ number_format($product['stock']) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="trend-pill {{ $product['trend_dir'] === 'up' ? 'trend-up' : 'trend-down' }}">
                                    <i class="bi bi-arrow-{{ $product['trend_dir'] === 'up' ? 'up' : 'down' }}-right"></i>
                                    {{ $product['trend'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Low Stock Products --}}
    <div class="col-12 col-xl-5">
        <div class="card-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Low Stock Alert</h2>
                    <p class="panel-subtitle">Items requiring immediate attention</p>
                </div>
                <div class="panel-actions">
                    <a href="{{ route('admin.inventory') }}" class="btn-outline-danger-sm">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>Restock
                    </a>
                </div>
            </div>
            <div class="low-stock-list">
                @foreach($lowStockProducts as $item)
                <div class="low-stock-item">
                    <div class="low-stock-info">
                        <div class="low-stock-header">
                            <span class="low-stock-name">{{ $item['name'] }}</span>
                            <span class="low-stock-status-badge status-{{ $item['status'] === 'critical' ? 'cancelled' : 'processing' }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($item['status']) }}
                            </span>
                        </div>
                        <div class="low-stock-meta">
                            <span class="low-stock-sku">{{ $item['sku'] }}</span>
                            <span class="low-stock-sep">·</span>
                            <span class="low-stock-cat">{{ $item['category'] }}</span>
                        </div>
                        <div class="stock-progress-wrap">
                            <div class="stock-progress-bar">
                                <div class="stock-progress-fill {{ $item['status'] === 'critical' ? 'fill-danger' : 'fill-warning' }}"
                                     style="width: {{ min(100, round(($item['stock'] / $item['min_stock']) * 100)) }}%">
                                </div>
                            </div>
                            <span class="stock-progress-label">
                                <strong>{{ $item['stock'] }}</strong> / {{ $item['min_stock'] }} min
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
     RECENT ACTIVITIES
================================================================ --}}
<div class="row g-4 mt-1 animate-fadeInUp" style="animation-delay:.32s">
    <div class="col-12">
        <div class="card-panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Recent Activities</h2>
                    <p class="panel-subtitle">Latest system events and actions</p>
                </div>
                <div class="panel-actions">
                    <a href="{{ route('admin.reports') }}" class="btn-outline-primary-sm">
                        View log <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="activity-timeline">
                @foreach($recentActivities as $activity)
                <div class="activity-item">
                    <div class="activity-icon activity-{{ $activity['color'] }}">
                        <i class="bi {{ $activity['icon'] }}"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-header">
                            <span class="activity-title">{{ $activity['title'] }}</span>
                            <span class="activity-time">
                                <i class="bi bi-clock me-1"></i>{{ $activity['time'] }}
                            </span>
                        </div>
                        <p class="activity-desc">{{ $activity['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ─── Pass PHP Data to JavaScript ─────────────────────────────────────────────
window.DashboardData = {
    monthlySales: {
        labels:  {!! json_encode($monthlySalesData['labels']) !!},
        revenue: {!! json_encode($monthlySalesData['revenue']) !!},
        orders:  {!! json_encode($monthlySalesData['orders']) !!},
    },
    orderStatus: {
        labels: {!! json_encode($orderStatusData['labels']) !!},
        values: {!! json_encode($orderStatusData['values']) !!},
        colors: {!! json_encode($orderStatusData['colors']) !!},
    },
    revenueByCategory: {
        labels: {!! json_encode($revenueByCategoryData['labels']) !!},
        values: {!! json_encode($revenueByCategoryData['values']) !!},
    },
};
</script>
@endpush
