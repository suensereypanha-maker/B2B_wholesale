@extends('layouts.admin.dashboard')

@section('title', 'Add New Brand')
@section('page-title', 'Create Brand')

@section('content')

{{-- Page Header --}}
<div class="page-header animate-fadeInUp mb-4">
    <div class="page-header-left d-flex align-items-center gap-3">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-light border shadow-sm rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;" title="Back to Brands">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="brand-header-icon rounded-3 d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); font-size: 1.4rem;">
                <i class="bi bi-award-fill"></i>
            </div>
            <div>
                <h1 class="page-header-title mb-0 fs-3 fw-bold">Add New Brand</h1>
                <p class="page-header-subtitle text-muted mb-0 small">Register a new IT hardware manufacturer, official website, and brand logo.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 animate-fadeInUp" style="animation-delay:.08s;">
    
    {{-- Form Column --}}
    <div class="col-lg-8">
        <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section 1: Basic Information --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill text-primary"></i> Brand Details
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-secondary small">Brand Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required autofocus placeholder="e.g. Nvidia, Intel, Corsair">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="slug" class="form-label fw-semibold text-secondary small">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted small">/brand/</span>
                                <input type="text" name="slug" id="slug" class="form-control border-start-0 rounded-end-3 p-2.5 @error('slug') is-invalid @enderror" 
                                       value="{{ old('slug') }}" placeholder="auto-generated from name">
                            </div>
                            @error('slug')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="website" class="form-label fw-semibold text-secondary small">Official Website URL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-globe text-primary"></i></span>
                            <input type="url" name="website" id="website" class="form-control border-start-0 rounded-end-3 p-2.5 @error('website') is-invalid @enderror" 
                                   value="{{ old('website') }}" placeholder="https://www.nvidia.com">
                        </div>
                        @error('website')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="description" class="form-label fw-semibold text-secondary small">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control rounded-3 p-2.5 @error('description') is-invalid @enderror" 
                                  placeholder="Briefly describe the manufacturer products and specialty...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 2: Logo Upload & Sort Order --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-image text-primary"></i> Logo & Display Order
                    </h5>

                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="logo" class="form-label fw-semibold text-secondary small">Brand Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control rounded-3 p-2 @error('logo') is-invalid @enderror" accept="image/*">
                            <div class="form-text small">Recommended PNG, SVG or WebP logo file (max 2MB).</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="sort_order" class="form-label fw-semibold text-secondary small">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control rounded-3 p-2.5 @error('sort_order') is-invalid @enderror" 
                                   value="{{ old('sort_order', 0) }}" min="0" style="max-width: 160px;">
                            <div class="form-text small">Lower numbers appear first.</div>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 3: Status Options --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-sliders text-primary"></i> Status & Featured Flags
                    </h5>

                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small d-block">Catalog Status</label>
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                                <label class="form-check-label fw-semibold ms-3 pt-1" for="is_active" id="status-label">
                                    Active (Visible in catalog)
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small d-block">Featured Brand</label>
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                                <label class="form-check-label fw-semibold ms-3 pt-1" for="is_featured" id="featured-label">
                                    Featured on Storefront
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn-primary-solid ripple-btn px-4 py-2.5 rounded-3 fw-semibold" id="btn-save-brand">
                        <i class="bi bi-check2-circle me-1 fs-5 align-middle"></i> Save Brand
                    </button>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-light border px-4 py-2.5 rounded-3 text-secondary fw-medium">
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
                    <span class="text-uppercase text-muted fw-bold small letter-spacing-1">Live Brand Card</span>
                    <span class="badge bg-warning-subtle text-amber border rounded-pill px-2.5 py-1 small d-none" id="preview-featured-badge">
                        ★ Featured
                    </span>
                </div>

                {{-- Brand Card Preview --}}
                <div class="brand-preview-card p-4 rounded-4 text-center border position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
                    
                    {{-- Status Badge --}}
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-success rounded-pill px-2.5 py-1" id="preview-status-pill">
                            Active
                        </span>
                    </div>

                    {{-- Logo Box --}}
                    <div class="mx-auto mb-3 shadow-sm rounded-4 d-flex align-items-center justify-content-center bg-white border font-monospace fw-bold text-primary" id="preview-logo-box" style="width: 80px; height: 80px; font-size: 1.8rem;">
                        BR
                    </div>

                    <h4 class="fw-bold text-dark mb-1" id="preview-name">Brand Name</h4>
                    <p class="text-muted small mb-2 font-monospace" id="preview-slug">/brand/slug</p>

                    <p class="text-secondary small mb-3 text-truncate-2" id="preview-description" style="min-height: 40px;">
                        Brief brand description preview will appear here.
                    </p>

                    <div class="pt-3 border-top d-flex align-items-center justify-content-between small text-muted">
                        <span id="preview-website"><i class="bi bi-globe me-1"></i> website.com</span>
                        <span>Sort: <strong class="text-dark" id="preview-sort">0</strong></span>
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
        const slugInput = document.getElementById('slug');
        const webInput = document.getElementById('website');
        const descInput = document.getElementById('description');
        const sortInput = document.getElementById('sort_order');
        const activeSwitch = document.getElementById('is_active');
        const featuredSwitch = document.getElementById('is_featured');
        const logoInput = document.getElementById('logo');

        const previewName = document.getElementById('preview-name');
        const previewSlug = document.getElementById('preview-slug');
        const previewDesc = document.getElementById('preview-description');
        const previewLogoBox = document.getElementById('preview-logo-box');
        const previewWebsite = document.getElementById('preview-website');
        const previewSort = document.getElementById('preview-sort');
        const previewStatusPill = document.getElementById('preview-status-pill');
        const previewFeaturedBadge = document.getElementById('preview-featured-badge');
        const statusLabel = document.getElementById('status-label');

        nameInput.addEventListener('input', function () {
            const val = nameInput.value.trim();
            previewName.textContent = val || 'Brand Name';
            if (!slugInput.dataset.manual) {
                const generatedSlug = val.toLowerCase().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-');
                slugInput.value = generatedSlug;
                previewSlug.textContent = '/brand/' + (generatedSlug || 'slug');
            }
            if (val.length >= 2 && previewLogoBox.querySelector('img') === null) {
                previewLogoBox.textContent = val.substring(0, 2).toUpperCase();
            }
        });

        slugInput.addEventListener('input', function () {
            slugInput.dataset.manual = "true";
            previewSlug.textContent = '/brand/' + (slugInput.value || 'slug');
        });

        webInput.addEventListener('input', function () {
            const val = webInput.value.trim();
            previewWebsite.innerHTML = `<i class="bi bi-globe me-1"></i> ${val ? val.replace(/^https?:\/\//, '') : 'website.com'}`;
        });

        descInput.addEventListener('input', function () {
            previewDesc.textContent = descInput.value || 'Brief brand description preview will appear here.';
        });

        sortInput.addEventListener('input', function () {
            previewSort.textContent = sortInput.value || 0;
        });

        activeSwitch.addEventListener('change', function () {
            const isActive = activeSwitch.checked;
            statusLabel.textContent = isActive ? 'Active (Visible in catalog)' : 'Inactive (Hidden)';
            previewStatusPill.textContent = isActive ? 'Active' : 'Inactive';
            previewStatusPill.className = isActive ? 'badge bg-success rounded-pill px-2.5 py-1' : 'badge bg-secondary rounded-pill px-2.5 py-1';
        });

        featuredSwitch.addEventListener('change', function () {
            const isFeatured = featuredSwitch.checked;
            previewFeaturedBadge.classList.toggle('d-none', !isFeatured);
        });

        logoInput.addEventListener('change', function () {
            const file = logoInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewLogoBox.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:contain;padding:6px;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

@endsection
