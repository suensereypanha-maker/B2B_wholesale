@extends('layouts.admin.dashboard')

@section('title', 'Edit Supplier — ' . $supplier->company_name)
@section('page-title', 'Edit Supplier')

@section('content')

{{-- Page Header --}}
<div class="page-header animate-fadeInUp mb-4">
    <div class="page-header-left d-flex align-items-center gap-3">
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-light border shadow-sm rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;" title="Back to Suppliers">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="supplier-header-icon rounded-3 d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #db2777 0%, #be185d 100%); font-size: 1.4rem;">
                <i class="bi bi-truck-front-fill"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h1 class="page-header-title mb-0 fs-3 fw-bold">{{ $supplier->company_name }}</h1>
                    @if($supplier->is_active)
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold fs-7">
                            ✓ Approved Vendor
                        </span>
                    @else
                        <span class="badge bg-warning-subtle text-amber border border-warning-subtle rounded-pill px-3 py-1 fw-semibold fs-7">
                            ⏳ Pending Approval
                        </span>
                    @endif
                </div>
                <p class="page-header-subtitle text-muted mb-0 small">Update supplier contact details, address, and portal user permissions.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 animate-fadeInUp" style="animation-delay:.08s;">
    
    {{-- Form Column --}}
    <div class="col-lg-8">
        <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Section 1: Company Profile --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-building text-primary"></i> Company Details
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="company_name" class="form-label fw-semibold text-secondary small">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control rounded-3 p-2.5 @error('company_name') is-invalid @enderror" 
                                   value="{{ old('company_name', $supplier->company_name) }}" required autofocus>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="contact_name" class="form-label fw-semibold text-secondary small">Contact Person Name</label>
                            <input type="text" name="contact_name" id="contact_name" class="form-control rounded-3 p-2.5 @error('contact_name') is-invalid @enderror" 
                                   value="{{ old('contact_name', $supplier->contact_name) }}">
                            @error('contact_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-secondary small">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-primary"></i></span>
                                <input type="email" name="email" id="email" class="form-control border-start-0 rounded-end-3 p-2.5 @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $supplier->email) }}" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold text-secondary small">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-telephone text-primary"></i></span>
                                <input type="text" name="phone" id="phone" class="form-control border-start-0 rounded-end-3 p-2.5 @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone', $supplier->phone) }}">
                            </div>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="address" class="form-label fw-semibold text-secondary small">Physical / Billing Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control rounded-3 p-2.5 @error('address') is-invalid @enderror" 
                                  placeholder="Company street address...">{{ old('address', $supplier->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 2: User Account Status --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge-fill text-primary"></i> Linked User Account
                    </h5>

                    @if($supplier->user)
                        <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold text-dark">{{ $supplier->user->email }}</div>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-0.5 small">
                                    Role ID: {{ $supplier->user->role_id }} (Supplier Portal)
                                </span>
                            </div>
                            <span class="badge {{ $supplier->user->is_active ? 'bg-success' : 'bg-secondary' }} px-3 py-1.5 rounded-pill">
                                User Account: {{ $supplier->user->is_active ? 'Active' : 'Disabled' }}
                            </span>
                        </div>
                    @else
                        <div class="p-3 bg-light rounded-3 border text-muted small">
                            No active portal user account is linked to this supplier.
                        </div>
                    @endif
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 3: Status Options --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-sliders text-primary"></i> Approval Status
                    </h5>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $supplier->is_active) ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                        <label class="form-check-label fw-semibold ms-2 pt-1" for="is_active" id="status-label">
                            {{ old('is_active', $supplier->is_active) ? 'Approved & Active (Allowed to supply products)' : 'Pending / Deactivated' }}
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn-primary-solid ripple-btn px-4 py-2.5 rounded-3 fw-semibold" id="btn-update-supplier">
                        <i class="bi bi-check2-circle me-1 fs-5 align-middle"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-light border px-4 py-2.5 rounded-3 text-secondary fw-medium">
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
                    <span class="text-uppercase text-muted fw-bold small letter-spacing-1">Supplier Profile Card</span>
                    <span class="badge {{ $supplier->is_active ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-2.5 py-1" id="preview-status-pill">
                        {{ $supplier->is_active ? 'Approved' : 'Pending' }}
                    </span>
                </div>

                {{-- Supplier Preview Card --}}
                <div class="supplier-preview-card p-4 rounded-4 text-center border position-relative overflow-hidden style-preview-bg" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
                    
                    <div class="mx-auto mb-3 shadow-sm rounded-4 d-flex align-items-center justify-content-center bg-white border text-primary" style="width: 80px; height: 80px; font-size: 2.2rem; color: #db2777 !important;">
                        <i class="bi bi-building"></i>
                    </div>

                    <h4 class="fw-bold text-dark mb-1" id="preview-company">{{ $supplier->company_name }}</h4>
                    <p class="text-muted small mb-3" id="preview-contact">{{ $supplier->contact_name ?: 'Contact Person' }}</p>

                    <div class="pt-3 border-top text-start small text-secondary d-flex flex-column gap-2">
                        <div id="preview-email"><i class="bi bi-envelope me-2 text-primary"></i> {{ $supplier->email }}</div>
                        <div id="preview-phone"><i class="bi bi-telephone me-2 text-primary"></i> {{ $supplier->phone ?: 'Phone: N/A' }}</div>
                        <div id="preview-address" class="text-truncate"><i class="bi bi-geo-alt me-2 text-primary"></i> {{ $supplier->address ?: 'Address: N/A' }}</div>
                    </div>
                </div>
            </div>

            {{-- Quick Action Card --}}
            <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
                <h6 class="fw-bold text-dark mb-2">Supplier Actions</h6>
                <p class="small text-muted mb-3">Remove supplier and unassign their linked products.</p>

                <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete supplier \'{{ $supplier->company_name }}\'?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-semibold btn-sm">
                        <i class="bi bi-trash3-fill me-1"></i> Delete Supplier
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Live Sync Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const compInput = document.getElementById('company_name');
        const contInput = document.getElementById('contact_name');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const addrInput = document.getElementById('address');
        const activeSwitch = document.getElementById('is_active');

        const prevCompany = document.getElementById('preview-company');
        const prevContact = document.getElementById('preview-contact');
        const prevEmail = document.getElementById('preview-email');
        const prevPhone = document.getElementById('preview-phone');
        const prevAddress = document.getElementById('preview-address');
        const prevStatusPill = document.getElementById('preview-status-pill');

        compInput.addEventListener('input', function () {
            prevCompany.textContent = compInput.value.trim() || 'Company Name';
        });

        contInput.addEventListener('input', function () {
            prevContact.textContent = contInput.value.trim() || 'Contact Person';
        });

        emailInput.addEventListener('input', function () {
            prevEmail.innerHTML = `<i class="bi bi-envelope me-2 text-primary"></i> ${emailInput.value.trim() || 'email@company.com'}`;
        });

        phoneInput.addEventListener('input', function () {
            prevPhone.innerHTML = `<i class="bi bi-telephone me-2 text-primary"></i> ${phoneInput.value.trim() || 'Phone: N/A'}`;
        });

        addrInput.addEventListener('input', function () {
            prevAddress.innerHTML = `<i class="bi bi-geo-alt me-2 text-primary"></i> ${addrInput.value.trim() || 'Address: N/A'}`;
        });

        activeSwitch.addEventListener('change', function () {
            const isActive = activeSwitch.checked;
            prevStatusPill.textContent = isActive ? 'Approved' : 'Pending';
            prevStatusPill.className = isActive ? 'badge bg-success rounded-pill px-2.5 py-1' : 'badge bg-warning text-dark rounded-pill px-2.5 py-1';
        });
    });
</script>

@endsection
