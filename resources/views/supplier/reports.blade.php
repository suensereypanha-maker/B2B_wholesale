@extends('layouts.admin.dashboard')

@section('title', 'Supplier Reports')
@section('page-title', 'Supplier Reports & Analytics')

@section('content')
{{-- Welcome & Overview --}}
<div class="card-panel animate-fadeInUp" style="background: linear-gradient(135deg, #db2777 0%, #9d174d 100%); border: 1px solid rgba(255,255,255,0.08); color: white; padding: 32px; border-radius: var(--radius-xl); margin-bottom: 24px;">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 8px; letter-spacing: -0.5px;">
                Distribution Reports
            </h1>
            <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.9rem; margin: 0; max-width: 600px;">
                Analyze your monthly sales performance, verify delivery lead times, and monitor top performing product SKUs.
            </p>
        </div>
        <div>
            <span style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25); color: white; font-weight: 700; font-size: 0.78rem; padding: 6px 14px; border-radius: var(--radius-full);">
                <i class="bi bi-clock-history me-1"></i> Data updated live
            </span>
        </div>
    </div>
</div>

{{-- Supplier Key Metrics --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay: .06s;">
    
    {{-- Revenue --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-currency-dollar"></i>
        </div>
        <div>
            <div class="roles-stat-value">${{ number_format($stats['sales_revenue'] / 1000, 1) }}k</div>
            <div class="roles-stat-label">Total Earnings</div>
        </div>
    </div>

    {{-- Products Count --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $stats['listed_products'] }}</div>
            <div class="roles-stat-label">Listed Products</div>
        </div>
    </div>

    {{-- Active Orders --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-cart-check-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $stats['active_orders'] }}</div>
            <div class="roles-stat-label">Active Orders</div>
        </div>
    </div>

    {{-- Completed Orders --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--purple-light);color:var(--purple)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $stats['fulfilled_orders'] }}</div>
            <div class="roles-stat-label">Fulfilled Orders</div>
        </div>
    </div>

</div>

{{-- Performance Charts & Breakdown --}}
<div class="row g-4 animate-fadeInUp" style="animation-delay: .12s; margin-top: 12px;">
    
    {{-- Sales Chart --}}
    <div class="col-12 col-xl-8">
        <div class="card-panel" style="height: 100%;">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Earnings Performance</h2>
                    <p class="panel-subtitle">Monthly earnings history and order volumes</p>
                </div>
            </div>
            
            <div style="padding: 24px;">
                <div style="height: 320px; position: relative;">
                    <canvas id="supplierEarningsChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Side Cards --}}
    <div class="col-12 col-xl-4">
        <div style="display: flex; flex-direction: column; gap: 24px; height: 100%;">
            
            {{-- Performance Indicators --}}
            <div class="card-panel" style="flex: 1;">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Fulfillment Health</h2>
                        <p class="panel-subtitle">Service Level Agreement status metrics</p>
                    </div>
                </div>
                <div style="padding: 0 24px 24px; display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-secondary);">Fulfillment Rate</span>
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--emerald);">{{ $performance['fulfillment_rate'] }}%</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 4px; background-color: var(--border-light);">
                            <div class="progress-bar" role="progressbar" style="width: {{ $performance['fulfillment_rate'] }}%; background-color: var(--emerald); border-radius: 4px;"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-secondary);">Avg. Lead Time</span>
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--primary);">{{ $performance['avg_lead_time'] }}</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 4px; background-color: var(--border-light);">
                            <div class="progress-bar" role="progressbar" style="width: 85%; background-color: var(--primary); border-radius: 4px;"></div>
                        </div>
                    </div>

                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-secondary);">Return / Defect Rate</span>
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--emerald);">{{ $performance['return_rate'] }}%</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 4px; background-color: var(--border-light);">
                            <div class="progress-bar" role="progressbar" style="width: {{ $performance['return_rate'] * 10 }}%; background-color: var(--emerald); border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Top Performing Products --}}
            <div class="card-panel" style="flex: 1;">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Top Products</h2>
                        <p class="panel-subtitle">Your highest-revenue catalog listings</p>
                    </div>
                </div>
                <div style="padding: 0 24px 24px; display: flex; flex-direction: column; gap: 16px;">
                    @foreach($popularItems as $item)
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid var(--border-light); padding-bottom: 12px; margin-bottom: 4px;">
                        <div>
                            <span style="font-size: 0.875rem; font-weight: 700; color: var(--text); display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 200px;">
                                {{ $item['name'] }}
                            </span>
                            <span style="font-size: 0.75rem; color: var(--text-secondary);">
                                SKU: {{ $item['sku'] }} · <strong>{{ $item['sold'] }} sold</strong>
                            </span>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 0.875rem; font-weight: 700; color: var(--text);">{{ $item['revenue'] }}</span>
                            <span style="font-size: 0.72rem; display: block; color: var(--text-secondary);">Stock: {{ $item['stock'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('supplierEarningsChart').getContext('2d');
    
    const labels = {!! json_encode($monthlyEarningsData['labels']) !!};
    const earnings = {!! json_encode($monthlyEarningsData['earnings']) !!};
    const orders = {!! json_encode($monthlyEarningsData['orders']) !!};

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Earnings ($)',
                    data: earnings,
                    borderColor: '#db2777', // Supplier Pink/Magenta
                    backgroundColor: 'rgba(219, 39, 119, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    yAxisID: 'y'
                },
                {
                    label: 'Orders Filled',
                    data: orders,
                    borderColor: '#2563EB', // Blue
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    pointBackgroundColor: '#2563EB',
                    tension: 0.4,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            family: 'Inter',
                            size: 11,
                            weight: '500'
                        },
                        boxWidth: 12,
                        boxHeight: 12,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    padding: 12,
                    titleFont: {
                        family: 'Inter',
                        weight: '700',
                        size: 13
                    },
                    bodyFont: {
                        family: 'Inter',
                        size: 12
                    },
                    backgroundColor: '#0f172a',
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Inter',
                            size: 11
                        }
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: {
                        color: 'rgba(0, 0, 0, 0.04)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        },
                        font: {
                            family: 'Inter',
                            size: 11
                        }
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false, // only want the grid lines for one axis
                    },
                    ticks: {
                        font: {
                            family: 'Inter',
                            size: 11
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
