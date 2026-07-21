@extends('layouts.admin.dashboard')

@section('title', 'Add New Supplier')
@section('page-title', 'Create Supplier')

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
                <h1 class="page-header-title mb-0 fs-3 fw-bold">Add New Supplier & Vendor Account</h1>
                <p class="page-header-subtitle text-muted mb-0 small">Register a new wholesale hardware vendor and optionally create a Supplier Portal user (Role ID 7).</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 animate-fadeInUp" style="animation-delay:.08s;">
    
    {{-- Form Column --}}
    <div class="col-lg-8">
        <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="{{ route('admin.suppliers.store') }}" method="POST">
                @csrf

                {{-- Section 1: Company Profile --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-building text-primary"></i> Company Details
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="company_name" class="form-label fw-semibold text-secondary small">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control rounded-3 p-2.5 @error('company_name') is-invalid @enderror" 
                                   value="{{ old('company_name') }}" required autofocus placeholder="e.g. Global Tech Components Ltd.">
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="contact_name" class="form-label fw-semibold text-secondary small">Contact Person Name</label>
                            <input type="text" name="contact_name" id="contact_name" class="form-control rounded-3 p-2.5 @error('contact_name') is-invalid @enderror" 
                                   value="{{ old('contact_name') }}" placeholder="e.g. John Smith">
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
                                       value="{{ old('email') }}" required placeholder="vendor@techcomponents.com">
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
                                       value="{{ old('phone') }}" placeholder="+1 (555) 019-2831">
                            </div>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="address" class="form-label fw-semibold text-secondary small">Physical / Billing Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control rounded-3 p-2.5 @error('address') is-invalid @enderror" 
                                  placeholder="Company street address, city, state, postal code...">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 2: Portal Login Account (Role ID 7) --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge-fill text-primary"></i> Supplier Portal Login (Role ID 7)
                    </h5>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="create_user" name="create_user" value="1" {{ old('create_user', 1) ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                        <label class="form-check-label fw-semibold ms-2 pt-1" for="create_user">
                            Create User Account for Supplier Portal Access
                        </label>
                    </div>

                    <div id="user-account-fields" class="p-3 bg-light rounded-3 border">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold text-secondary small">Portal Password</label>
                                <input type="password" name="password" id="password" class="form-control rounded-3 p-2.5 @error('password') is-invalid @enderror" 
                                       placeholder="Default: password">
                                <div class="form-text small">Minimum 6 characters.</div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small d-block">Assigned Role</label>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle p-2.5 w-100 text-start fs-7 fw-semibold">
                                    <i class="bi bi-shield-lock me-1"></i> Supplier (Role ID: 7)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 3: Status Options --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-sliders text-primary"></i> Approval Status
                    </h5>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                        <label class="form-check-label fw-semibold ms-2 pt-1" for="is_active" id="status-label">
                            Approved & Active (Allowed to supply products)
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn-primary-solid ripple-btn px-4 py-2.5 rounded-3 fw-semibold" id="btn-save-supplier">
                        <i class="bi bi-check2-circle me-1 fs-5 align-middle"></i> Save Supplier
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
                    <span class="badge bg-success rounded-pill px-2.5 py-1" id="preview-status-pill">
                        Approved
                    </span>
                </div>

                {{-- Supplier Preview Card --}}
                <div class="supplier-preview-card p-4 rounded-4 text-center border position-relative overflow-hidden style-preview-bg" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
                    
                    <div class="mx-auto mb-3 shadow-sm rounded-4 d-flex align-items-center justify-content-center bg-white border text-primary" style="width: 80px; height: 80px; font-size: 2.2rem; color: #db2777 !important;">
                        <i class="bi bi-building"></i>
                    </div>

                    <h4 class="fw-bold text-dark mb-1" id="preview-company">Company Name</h4>
                    <p class="text-muted small mb-3" id="preview-contact">Contact Person</p>

                    <div class="pt-3 border-top text-start small text-secondary d-flex flex-column gap-2">
                        <div id="preview-email"><i class="bi bi-envelope me-2 text-primary"></i> email@company.com</div>
                        <div id="preview-phone"><i class="bi bi-telephone me-2 text-primary"></i> Phone: N/A</div>
                        <div id="preview-address" class="text-truncate"><i class="bi bi-geo-alt me-2 text-primary"></i> Address: N/A</div>
                    </div>
                </div>
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
        const createUserSwitch = document.getElementById('create_user');
        const userFields = document.getElementById('user-account-fields');

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

        createUserSwitch.addEventListener('change', function () {
            userFields.style.display = createUserSwitch.checked ? 'block' : 'none';
        });
    });
</script>

@endsection
