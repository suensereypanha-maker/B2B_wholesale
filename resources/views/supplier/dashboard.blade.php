@extends('layouts.admin.dashboard')

@section('title', 'Supplier Dashboard')
@section('page-title', 'Supplier Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="card-panel animate-fadeInUp" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 1px solid rgba(255,255,255,0.08); color: white; padding: 32px; border-radius: var(--radius-xl);">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 8px; letter-spacing: -0.5px;">
                Welcome to your Supplier Portal, {{ (auth('admin')->user() ?? auth('web')->user() ?? auth()->user())->name }}! 👋
            </h1>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0; max-width: 600px;">
                Manage your product listings, monitor incoming purchase orders from administrators, and track your distribution sales statistics all in one place.
            </p>
        </div>
        <div>
            <span style="background: rgba(96, 165, 250, 0.1); border: 1px solid rgba(96, 165, 250, 0.2); color: #60a5fa; font-weight: 700; font-size: 0.78rem; padding: 6px 14px; border-radius: var(--radius-full);">
                <i class="bi bi-patch-check-fill me-1"></i> Verified Supplier
            </span>
        </div>
    </div>
</div>

{{-- Supplier Key Metrics --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay: .06s; margin-top: 24px;">
    
    {{-- Products Count --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">12</div>
            <div class="roles-stat-label">Listed Products</div>
        </div>
    </div>

    {{-- Pending Orders --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-cart-check-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">3</div>
            <div class="roles-stat-label">Active Orders</div>
        </div>
    </div>

    {{-- Completed Orders --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">48</div>
            <div class="roles-stat-label">Fulfilled Orders</div>
        </div>
    </div>

    {{-- Revenue --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--purple-light);color:var(--purple)">
            <i class="bi bi-currency-dollar"></i>
        </div>
        <div>
            <div class="roles-stat-value">$14.2k</div>
            <div class="roles-stat-label">Sales Revenue</div>
        </div>
    </div>

</div>

{{-- Orders Overview --}}
<div class="row g-4 animate-fadeInUp" style="animation-delay: .12s; margin-top: 12px;">
    
    <div class="col-12 col-xl-8">
        <div class="card-panel" style="height: 100%;">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Recent Purchase Orders</h2>
                    <p class="panel-subtitle">New order requests received from wholesaling managers</p>
                </div>
            </div>
            
            <div style="padding: 0 24px 24px;">
                <div class="table-responsive">
                    <table class="table" style="width: 100%; border-collapse: collapse; margin: 0;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--border); text-align: left;">
                                <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem;">Order ID</th>
                                <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem;">Items</th>
                                <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem;">Date Received</th>
                                <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem;">Total Value</th>
                                <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid var(--border-light);">
                                <td style="padding: 14px 8px; font-weight: 700; font-size: 0.875rem; color: var(--primary);">#PO-98441</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; color: var(--text-secondary);">4 items</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; color: var(--text-secondary);">Today, 2:14 PM</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; font-weight: 700; color: var(--text);">$1,420.00</td>
                                <td style="padding: 14px 8px;">
                                    <span style="font-size: 0.72rem; font-weight: 700; color: var(--warning); background: var(--warning-light); padding: 3px 8px; border-radius: 4px;">Pending Fulfillment</span>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-light);">
                                <td style="padding: 14px 8px; font-weight: 700; font-size: 0.875rem; color: var(--primary);">#PO-98439</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; color: var(--text-secondary);">8 items</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; color: var(--text-secondary);">Yesterday</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; font-weight: 700; color: var(--text);">$2,890.00</td>
                                <td style="padding: 14px 8px;">
                                    <span style="font-size: 0.72rem; font-weight: 700; color: #2563eb; background: #dbeafe; padding: 3px 8px; border-radius: 4px;">In Transit</span>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-light);">
                                <td style="padding: 14px 8px; font-weight: 700; font-size: 0.875rem; color: var(--primary);">#PO-98402</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; color: var(--text-secondary);">12 items</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; color: var(--text-secondary);">14 Jul 2026</td>
                                <td style="padding: 14px 8px; font-size: 0.875rem; font-weight: 700; color: var(--text);">$4,120.00</td>
                                <td style="padding: 14px 8px;">
                                    <span style="font-size: 0.72rem; font-weight: 700; color: #15803d; background: #dcfce7; padding: 3px 8px; border-radius: 4px;">Delivered</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card-panel" style="height: 100%;">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Portal Guidelines</h2>
                    <p class="panel-subtitle">Key rules for supplier operations</p>
                </div>
            </div>
            <div style="padding: 0 24px 24px; font-size: 0.8375rem; color: var(--text-secondary); line-height: 1.6; display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; gap: 12px;">
                    <i class="bi bi-1-circle-fill" style="color: var(--primary); font-size: 1.15rem;"></i>
                    <span><strong>Keep catalog updated:</strong> Verify your wholesale items have accurate inventory stock count.</span>
                </div>
                <div style="display: flex; gap: 12px;">
                    <i class="bi bi-2-circle-fill" style="color: var(--primary); font-size: 1.15rem;"></i>
                    <span><strong>Order Fulfillment:</strong> Ship purchase orders within 48 hours of approval to avoid service penalties.</span>
                </div>
                <div style="display: flex; gap: 12px;">
                    <i class="bi bi-3-circle-fill" style="color: var(--primary); font-size: 1.15rem;"></i>
                    <span><strong>Need Help?</strong> Open a ticket in System Settings or contact the Wholesaling Administrator.</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
