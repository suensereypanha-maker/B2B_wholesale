@extends('layouts.admin.dashboard')

@section('title', 'My Supplier Products & Inventory')
@section('page-title', 'My Products')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="flash-alert flash-success animate-fadeInUp" id="flashSuccess">
    <i class="bi bi-check-circle-fill"></i>
    <span>{{ session('success') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif
@if(session('error'))
<div class="flash-alert flash-error animate-fadeInUp" id="flashError">
    <i class="bi bi-exclamation-circle-fill"></i>
    <span>{{ session('error') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif

{{-- Page Header --}}
<div class="page-header animate-fadeInUp">
    <div class="page-header-left d-flex align-items-center justify-content-between w-100 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="page-header-icon"
                style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%); color: #fff;">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h1 class="page-header-title mb-0">My Supply Catalog</h1>
                    @if($supplier?->is_active ?? auth()->user()->is_active)
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 small">
                        <i class="bi bi-patch-check-fill me-1"></i> Admin Approved
                    </span>
                    @else
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1 small">
                        <i class="bi bi-clock-history me-1"></i> Pending Approval
                    </span>
                    @endif
                </div>
                <p class="page-header-subtitle mb-0 mt-1">
                    Vendor: <strong>{{ $supplier?->company_name ?? auth()->user()->name }}</strong> — Products catalog items, stock counts, and wholesale pricing.
                </p>
            </div>
        </div>
        <div>
            @if(($supplier?->is_active ?? auth()->user()->is_active) && auth()->user()->hasPermission('products.create'))
            <a href="{{ route('supplier.products.create') }}" class="btn btn-primary rounded-3 px-3.5 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%); border: none;">
                <i class="bi bi-plus-lg fs-5"></i> Add New Product
            </a>
            @elseif(!$supplier?->is_active && !auth()->user()->is_active)
            <button class="btn btn-secondary rounded-3 px-3.5 py-2 fw-semibold d-inline-flex align-items-center gap-2" disabled title="Requires Admin Approval">
                <i class="bi bi-lock-fill"></i> Add New Product (Account Pending)
            </button>
            @else
            <button class="btn btn-light border text-muted rounded-3 px-3.5 py-2 fw-semibold d-inline-flex align-items-center gap-2" disabled title="Admin has not granted create permission in Role matrix">
                <i class="bi bi-lock-fill"></i> Add Product (Permission Required)
            </button>
            @endif
        </div>
    </div>
</div>

@if(!auth()->user()->hasPermission('products.create') && !auth()->user()->hasPermission('products.edit') && !auth()->user()->hasPermission('products.delete'))
<div class="alert border-0 rounded-4 p-3 mb-4 d-flex align-items-center gap-3 animate-fadeInUp" style="background: rgba(37,99,235,0.06); color: #1e40af; border: 1px solid rgba(37,99,235,0.15)!important;">
    <i class="bi bi-shield-lock-fill fs-3 text-primary"></i>
    <div>
        <strong class="d-block">Read-Only Catalog Access</strong>
        <span class="small opacity-90">Administrator has currently granted read-only access for your role. Adding, editing, and deleting items requires enabling <code>Create Products</code>, <code>Edit Products</code>, or <code>Delete Products</code> permissions under Role Management.</span>
    </div>
</div>
@endif

{{-- Summary Stats Cards --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">

    {{-- Total Products --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">My Listed Items</div>
        </div>
    </div>

    {{-- In Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['in_stock'] }}</div>
            <div class="roles-stat-label">Healthy Stock (>10)</div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['low_stock'] }}</div>
            <div class="roles-stat-label">Low Stock Alert (≤10)</div>
        </div>
    </div>

    {{-- Out of Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--danger-light);color:var(--danger)">
            <i class="bi bi-slash-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['out_of_stock'] }}</div>
            <div class="roles-stat-label">Out of Stock</div>
        </div>
    </div>

</div>

{{-- Main Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">

    {{-- Filter Header --}}
    <div class="panel-header d-flex align-items-center justify-content-between flex-wrap gap-3"
        style="padding: 20px 24px;">
        <div class="matrix-module-filter status-tabs-container">
            <a href="{{ route('supplier.products', ['filter' => 'all', 'search' => $search]) }}"
                class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}"
                style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                All Items <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{
                    $counts['all'] }}</span>
            </a>
            <a href="{{ route('supplier.products', ['filter' => 'in_stock', 'search' => $search]) }}"
                class="role-action-btn {{ $filter === 'in_stock' ? 'active-filter' : '' }}"
                style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                Healthy <span class="badge ms-1" style="background: var(--emerald-light); color: var(--emerald)">{{
                    $counts['in_stock'] }}</span>
            </a>
            <a href="{{ route('supplier.products', ['filter' => 'low_stock', 'search' => $search]) }}"
                class="role-action-btn {{ $filter === 'low_stock' ? 'active-filter' : '' }}"
                style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                Low Stock <span class="badge ms-1" style="background: var(--warning-light); color: var(--amber)">{{
                    $counts['low_stock'] }}</span>
            </a>
            <a href="{{ route('supplier.products', ['filter' => 'out_of_stock', 'search' => $search]) }}"
                class="role-action-btn {{ $filter === 'out_of_stock' ? 'active-filter' : '' }}"
                style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                Out of Stock <span class="badge ms-1" style="background: var(--danger-light); color: var(--danger)">{{
                    $counts['out_of_stock'] }}</span>
            </a>
        </div>

        {{-- Search Controls --}}
        <form action="{{ route('supplier.products') }}" method="GET" class="d-flex align-items-center gap-2">
            <input type="hidden" name="filter" value="{{ $filter }}">

            <div class="position-relative" style="min-width: 240px;">
                <i class="bi bi-search position-absolute text-muted"
                    style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 0.85rem;"></i>
                <input type="search" name="search" class="search-input" placeholder="Search product, SKU..."
                    value="{{ $search }}"
                    style="padding-left: 36px; height: 38px; border-radius: 20px; border: 1px solid var(--border); width: 100%;">
            </div>

            @if($search || $filter !== 'all')
            <a href="{{ route('supplier.products') }}" class="btn-outline-secondary-sm rounded-pill"
                title="Clear Filters" style="height: 38px; display: inline-flex; align-items: center; padding: 0 14px;">
                <i class="bi bi-x-circle me-1"></i> Clear
            </a>
            @endif
        </form>
    </div>

    {{-- Data Table --}}
    <div class="table-responsive" style="margin-top: 16px;">
        <table class="table align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th>Product & SKU</th>
                    <th>Category & Brand</th>
                    <th>Wholesale Price ($)</th>
                    <th>MOQ</th>
                    <th>Inventory Stock</th>
                    <th>Stock Alert</th>
                    @if(auth()->user()->hasPermission('products.edit'))
                    <th style="width: 170px;">Stock Action</th>
                    @endif
                    <th class="text-end" style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr id="product-row-{{ $product->id }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-img-box me-3 shadow-sm"
                                style="width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; background: rgba(219,39,119,0.08); border: 1px solid var(--border); color: #be185d;">
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 9px;">
                                @else
                                <i class="bi {{ $product->category?->icon ?: 'bi-box-seam' }}"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold text-dark fs-6">{{ $product->name }}</div>
                                <div class="text-muted small"><code>SKU: {{ $product->sku }}</code></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <span class="badge bg-light text-dark border align-self-start">
                                {{ $product->category?->name ?? 'Uncategorized' }}
                            </span>
                            @if($product->brand)
                            <span class="small text-secondary fw-semibold">
                                <i class="bi bi-award me-1"></i> {{ $product->brand->name }}
                            </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark fs-6">${{ number_format($product->wholesale_price, 2) }}</div>
                        <div class="text-muted fs-7">Cost: ${{ number_format($product->cost_price, 2) }}</div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border font-monospace px-2.5 py-1">
                            {{ $product->min_order_qty }} pcs
                        </span>
                    </td>
                    <td>
                        <div class="fw-bold fs-5 text-dark font-monospace">{{ $product->stock_qty }} <span
                                class="fs-7 text-muted font-sans-serif">units</span></div>
                    </td>
                    <td>
                        @if($product->stock_qty > 10)
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1">
                            <i class="bi bi-check-circle-fill me-1"></i> In Stock
                        </span>
                        @elseif($product->stock_qty > 0)
                        <span class="badge bg-warning-subtle text-amber border border-warning-subtle px-2.5 py-1">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Low Stock
                        </span>
                        @else
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1">
                            <i class="bi bi-slash-circle-fill me-1"></i> Out of Stock
                        </span>
                        @endif
                    </td>
                    @if(auth()->user()->hasPermission('products.edit'))
                    <td>
                        @if($product->stock_qty <= 10)
                        {{-- Low / Out of stock: Must Request Admin Restock --}}
                        <form action="{{ route('supplier.products.request-stock', $product) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm bg-warning-subtle text-amber border border-warning-subtle fw-semibold py-1 px-2.5 rounded-pill" title="Request Admin to Restock">
                                <i class="bi bi-send-fill me-1"></i> Request Stock
                            </button>
                        </form>
                        @else
                        {{-- Healthy Stock: Quick Stock Update Form --}}
                        <form action="{{ route('supplier.products.update-stock', $product) }}" method="POST"
                            class="d-inline-flex align-items-center gap-1">
                            @csrf
                            <input type="number" name="stock_qty" value="{{ $product->stock_qty }}" min="0"
                                class="form-control form-control-sm text-center font-monospace" style="width: 70px;"
                                title="Update Stock Qty">
                            <input type="hidden" name="wholesale_price" value="{{ $product->wholesale_price }}">
                            <button type="submit" class="btn btn-sm py-1 px-2 text-white" style="background:#be185d;" title="Save Stock">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                    @endif
                    <td class="text-end">
                        <div class="d-flex align-items-center justify-content-end gap-1">
                            @if(auth()->user()->hasPermission('products.edit'))
                            {{-- Edit Product --}}
                            <a href="{{ route('supplier.products.edit', $product) }}" class="btn btn-light btn-sm border text-secondary" title="Edit Product">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @endif

                            @if(auth()->user()->hasPermission('products.delete'))
                            {{-- Delete Product --}}
                            <form action="{{ route('supplier.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete {{ addslashes($product->name) }} from your catalog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm border text-danger" title="Delete Product">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif

                            @if(!auth()->user()->hasPermission('products.edit') && !auth()->user()->hasPermission('products.delete'))
                            <span class="text-muted small fs-7"><i class="bi bi-lock-fill"></i> Read-Only</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->hasPermission('products.edit') ? '8' : '7' }}" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-box-seam display-4 d-block mb-3 opacity-50"></i>
                            <h5>No supply products found</h5>
                            <p class="small text-secondary mb-3">You currently have no products listed under your supplier profile.</p>
                            @if(($supplier?->is_active ?? auth()->user()->is_active) && auth()->user()->hasPermission('products.create'))
                            <a href="{{ route('supplier.products.create') }}" class="btn btn-sm btn-primary px-3 rounded-pill" style="background: #be185d; border:none;">
                                <i class="bi bi-plus-lg me-1"></i> Add First Product
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection