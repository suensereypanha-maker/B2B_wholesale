@extends('layouts.admin.dashboard')

@section('title', 'Add New Product')
@section('page-title', 'Create Product')

@section('content')

{{-- Page Header --}}
<div class="page-header animate-fadeInUp mb-4">
    <div class="page-header-left d-flex align-items-center gap-3">
        <a href="{{ route('admin.products.index') }}" class="btn btn-light border shadow-sm rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;" title="Back to Products">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="product-header-icon rounded-3 d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); font-size: 1.4rem;">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div>
                <h1 class="page-header-title mb-0 fs-3 fw-bold">Add New B2B Product</h1>
                <p class="page-header-subtitle text-muted mb-0 small">Create a hardware product listing with wholesale pricing, MOQ, supplier, and inventory stock.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 animate-fadeInUp" style="animation-delay:.08s;">
    
    {{-- Form Column --}}
    <div class="col-lg-8">
        <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section 1: Basic Information --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill text-primary"></i> Basic Product Information
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label fw-semibold text-secondary small">Product Title <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required autofocus placeholder="e.g. Intel Core i9-14900K Processor">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="sku" class="form-label fw-semibold text-secondary small">SKU Code</label>
                            <input type="text" name="sku" id="sku" class="form-control rounded-3 p-2.5 @error('sku') is-invalid @enderror" 
                                   value="{{ old('sku') }}" placeholder="PROD-CPU-001">
                            <div class="form-text small">Auto-generated if empty.</div>
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="short_description" class="form-label fw-semibold text-secondary small">Short Summary</label>
                        <input type="text" name="short_description" id="short_description" class="form-control rounded-3 p-2.5 @error('short_description') is-invalid @enderror" 
                               value="{{ old('short_description') }}" placeholder="Brief 1-line key feature summary...">
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="description" class="form-label fw-semibold text-secondary small">Full Technical Specifications / Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control rounded-3 p-2.5 @error('description') is-invalid @enderror" 
                                  placeholder="Detailed specifications, socket type, architecture, warranty information...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 2: Relations (Category, Brand, Supplier) --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-diagram-3-fill text-primary"></i> Categorization & Sourcing
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="category_id" class="form-label fw-semibold text-secondary small">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select rounded-3 p-2.5 @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="brand_id" class="form-label fw-semibold text-secondary small">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select rounded-3 p-2.5 @error('brand_id') is-invalid @enderror">
                                <option value="">Select Brand</option>
                                @foreach($brands as $b)
                                    <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>
                                        {{ $b->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="supplier_id" class="form-label fw-semibold text-secondary small">Supplier (Vendor)</label>
                            <select name="supplier_id" id="supplier_id" class="form-select rounded-3 p-2.5 @error('supplier_id') is-invalid @enderror">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $sup)
                                    <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                                        {{ $sup->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 3: Pricing & MOQ --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-tags-fill text-primary"></i> B2B Pricing & MOQ
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="wholesale_price" class="form-label fw-semibold text-secondary small">Wholesale Price ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 fw-bold">$</span>
                                <input type="number" step="0.01" name="wholesale_price" id="wholesale_price" class="form-control border-start-0 rounded-end-3 p-2.5 @error('wholesale_price') is-invalid @enderror" 
                                       value="{{ old('wholesale_price') }}" required placeholder="499.00">
                            </div>
                            @error('wholesale_price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cost_price" class="form-label fw-semibold text-secondary small">Supplier Cost Price ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 fw-bold">$</span>
                                <input type="number" step="0.01" name="cost_price" id="cost_price" class="form-control border-start-0 rounded-end-3 p-2.5 @error('cost_price') is-invalid @enderror" 
                                       value="{{ old('cost_price') }}" required placeholder="420.00">
                            </div>
                            @error('cost_price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="retail_price" class="form-label fw-semibold text-secondary small">MSRP / Retail Price ($)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">$</span>
                                <input type="number" step="0.01" name="retail_price" id="retail_price" class="form-control border-start-0 rounded-end-3 p-2.5 @error('retail_price') is-invalid @enderror" 
                                       value="{{ old('retail_price') }}" placeholder="549.00">
                            </div>
                            @error('retail_price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="min_order_qty" class="form-label fw-semibold text-secondary small">Minimum Order Quantity (MOQ)</label>
                            <input type="number" name="min_order_qty" id="min_order_qty" class="form-control rounded-3 p-2.5 @error('min_order_qty') is-invalid @enderror" 
                                   value="{{ old('min_order_qty', 1) }}" min="1">
                            <div class="form-text small">Minimum units buyer must purchase per order.</div>
                            @error('min_order_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock_qty" class="form-label fw-semibold text-secondary small">Initial Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock_qty" id="stock_qty" class="form-control rounded-3 p-2.5 @error('stock_qty') is-invalid @enderror" 
                                   value="{{ old('stock_qty', 50) }}" min="0" required>
                            @error('stock_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 4: Image & Status --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-image text-primary"></i> Image & Display Settings
                    </h5>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold text-secondary small">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control rounded-3 p-2 @error('image') is-invalid @enderror" accept="image/*">
                        <div class="form-text small">High resolution PNG, JPG or WebP image (max 2MB).</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 align-items-center mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small d-block">Catalog Visibility</label>
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                                <label class="form-check-label fw-semibold ms-3 pt-1" for="is_active" id="status-label">
                                    Active (Visible in Storefront)
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small d-block">Featured Product</label>
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                                <label class="form-check-label fw-semibold ms-3 pt-1" for="is_featured" id="featured-label">
                                    Promote on Store Homepage
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn-primary-solid ripple-btn px-4 py-2.5 rounded-3 fw-semibold" id="btn-save-product">
                        <i class="bi bi-check2-circle me-1 fs-5 align-middle"></i> Save Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light border px-4 py-2.5 rounded-3 text-secondary fw-medium">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Live Card Preview Column --}}
    <div class="col-lg-4">
        <div class="sticky-top" style="top: 90px;">
            <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-uppercase text-muted fw-bold small letter-spacing-1">Live Product Card</span>
                    <span class="badge bg-warning-subtle text-amber border rounded-pill px-2.5 py-1 small d-none" id="preview-featured-badge">
                        ★ Featured
                    </span>
                </div>

                {{-- Product Preview Card --}}
                <div class="product-preview-card p-4 rounded-4 text-center border position-relative overflow-hidden style-preview-bg" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
                    
                    {{-- Status Badge --}}
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-success rounded-pill px-2.5 py-1" id="preview-status-pill">
                            Active
                        </span>
                    </div>

                    {{-- Image / Icon Box --}}
                    <div class="mx-auto mb-3 shadow-sm rounded-4 d-flex align-items-center justify-content-center bg-white border text-primary" id="preview-image-box" style="width: 90px; height: 90px; font-size: 2.4rem;">
                        <i class="bi bi-box-seam-fill" id="preview-icon"></i>
                    </div>

                    <h5 class="fw-bold text-dark mb-1" id="preview-name">Product Title</h5>
                    <p class="text-muted small mb-2 font-monospace" id="preview-sku">SKU: PROD-000</p>

                    {{-- Price & MOQ Box --}}
                    <div class="bg-light p-3 rounded-3 mb-3 border">
                        <div class="fs-4 fw-bold text-primary" id="preview-price">$0.00</div>
                        <div class="small text-muted" id="preview-moq">Min. Order (MOQ): 1 pcs</div>
                    </div>

                    <div class="text-start small text-secondary d-flex flex-column gap-1 pt-2 border-top">
                        <div>Category: <strong class="text-dark" id="preview-cat">Unassigned</strong></div>
                        <div>Brand: <strong class="text-dark" id="preview-brand">Unassigned</strong></div>
                        <div>Supplier: <strong class="text-dark" id="preview-supplier">Unassigned</strong></div>
                        <div>Stock Level: <strong class="text-dark" id="preview-stock">50 units</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Live Sync Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const skuInput = document.getElementById('sku');
        const priceInput = document.getElementById('wholesale_price');
        const moqInput = document.getElementById('min_order_qty');
        const stockInput = document.getElementById('stock_qty');
        const catSelect = document.getElementById('category_id');
        const brandSelect = document.getElementById('brand_id');
        const supplierSelect = document.getElementById('supplier_id');
        const activeSwitch = document.getElementById('is_active');
        const featuredSwitch = document.getElementById('is_featured');
        const imageInput = document.getElementById('image');

        const previewName = document.getElementById('preview-name');
        const previewSku = document.getElementById('preview-sku');
        const previewPrice = document.getElementById('preview-price');
        const previewMoq = document.getElementById('preview-moq');
        const previewStock = document.getElementById('preview-stock');
        const previewCat = document.getElementById('preview-cat');
        const previewBrand = document.getElementById('preview-brand');
        const previewSupplier = document.getElementById('preview-supplier');
        const previewImageBox = document.getElementById('preview-image-box');
        const previewFeaturedBadge = document.getElementById('preview-featured-badge');

        nameInput.addEventListener('input', function () {
            previewName.textContent = nameInput.value.trim() || 'Product Title';
        });

        skuInput.addEventListener('input', function () {
            previewSku.textContent = 'SKU: ' + (skuInput.value.trim() || 'PROD-000');
        });

        priceInput.addEventListener('input', function () {
            previewPrice.textContent = '$' + (parseFloat(priceInput.value || 0).toFixed(2));
        });

        moqInput.addEventListener('input', function () {
            previewMoq.textContent = 'Min. Order (MOQ): ' + (moqInput.value || 1) + ' pcs';
        });

        stockInput.addEventListener('input', function () {
            previewStock.textContent = (stockInput.value || 0) + ' units';
        });

        catSelect.addEventListener('change', function () {
            const opt = catSelect.options[catSelect.selectedIndex];
            previewCat.textContent = catSelect.value ? opt.text.trim() : 'Unassigned';
        });

        brandSelect.addEventListener('change', function () {
            const opt = brandSelect.options[brandSelect.selectedIndex];
            previewBrand.textContent = brandSelect.value ? opt.text.trim() : 'Unassigned';
        });

        supplierSelect.addEventListener('change', function () {
            const opt = supplierSelect.options[supplierSelect.selectedIndex];
            previewSupplier.textContent = supplierSelect.value ? opt.text.trim() : 'Unassigned';
        });

        featuredSwitch.addEventListener('change', function () {
            previewFeaturedBadge.classList.toggle('d-none', !featuredSwitch.checked);
        });

        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImageBox.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

@endsection
