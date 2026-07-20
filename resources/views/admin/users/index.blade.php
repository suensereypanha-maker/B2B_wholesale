@extends('layouts.admin.dashboard')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

@section('content')

@php
    $currentUserId = auth('admin')->id() ?? auth('web')->id() ?? auth()->id();
@endphp

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
    <div class="page-header-left">
        <div class="page-header-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Users Management</h1>
            <p class="page-header-subtitle">Manage system users, view roles, and approve new supplier registrations.</p>
        </div>
    </div>
</div>

{{-- Summary Stats --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    
    {{-- Total Users --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-people-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">Total Users</div>
        </div>
    </div>

    {{-- Pending Suppliers --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--warning)">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['pending_suppliers'] }}</div>
            <div class="roles-stat-label">Pending Suppliers</div>
        </div>
    </div>

    {{-- Suppliers --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--cyan-light);color:var(--cyan)">
            <i class="bi bi-truck"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['suppliers'] }}</div>
            <div class="roles-stat-label">Total Suppliers</div>
        </div>
    </div>

    {{-- Buyers --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-cart-check"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['buyers'] }}</div>
            <div class="roles-stat-label">Buyers / Viewers</div>
        </div>
    </div>

</div>

{{-- Filter Navigation Bar & Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">
    
    <div class="panel-header" style="flex-wrap: wrap; gap: 16px;">
        <div class="matrix-module-filter" style="border: 1px solid var(--border); padding: 4px; display: inline-flex;">
            <a href="{{ route('admin.users', ['filter' => 'all']) }}" 
               class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full);">
               All <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('admin.users', ['filter' => 'pending_suppliers']) }}" 
               class="role-action-btn {{ $filter === 'pending_suppliers' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full);">
               Pending Approval <span class="badge ms-1 bg-warning text-dark">{{ $counts['pending_suppliers'] }}</span>
            </a>
            <a href="{{ route('admin.users', ['filter' => 'suppliers']) }}" 
               class="role-action-btn {{ $filter === 'suppliers' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full);">
               Suppliers <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['suppliers'] }}</span>
            </a>
            <a href="{{ route('admin.users', ['filter' => 'buyers']) }}" 
               class="role-action-btn {{ $filter === 'buyers' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full);">
               Buyers <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['buyers'] }}</span>
            </a>
            <a href="{{ route('admin.users', ['filter' => 'staff']) }}" 
               class="role-action-btn {{ $filter === 'staff' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full);">
               Staff <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['staff'] }}</span>
            </a>
        </div>
        <div class="panel-actions">
            <input type="search" class="search-input search-input-sm" id="userSearch"
                   placeholder="Search users…" style="min-width:220px;padding-left:36px;height:38px;">
        </div>
    </div>

    {{-- Users Table --}}
    <div class="table-responsive" style="padding: 0 24px 24px;">
        <table class="table custom-users-table" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="border-bottom: 2px solid var(--border); text-align: left;">
                    <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem; text-transform: uppercase;">User</th>
                    <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem; text-transform: uppercase;">Email</th>
                    <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem; text-transform: uppercase;">Assigned Role</th>
                    <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem; text-transform: uppercase;">Status</th>
                    <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem; text-transform: uppercase;">Registered</th>
                    <th style="padding: 12px 8px; font-weight: 700; color: var(--text-secondary); font-size: 0.8125rem; text-transform: uppercase; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @forelse($users as $user)
                <tr class="user-row" data-search-content="{{ strtolower($user->name . ' ' . $user->email) }}" style="border-bottom: 1px solid var(--border-light); transition: background 0.15s ease;">
                    
                    {{-- User Profile / Name --}}
                    <td style="padding: 16px 8px; vertical-align: middle;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            @php
                                $initials = collect(explode(' ', $user->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('');
                                $color = $user->role->color ?? '#6B7280';
                            @endphp
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $color }}20; color: {{ $color }}; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.875rem;">
                                {{ strtoupper($initials) }}
                            </div>
                            <div>
                                <div style="font-weight: 700; color: var(--text); font-size: 0.875rem;">{{ $user->name }}</div>
                                @if($user->id === $currentUserId)
                                    <span style="font-size: 0.68rem; font-weight: 700; color: var(--primary); background: var(--primary-light); padding: 1px 6px; border-radius: 4px;">You</span>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td style="padding: 16px 8px; vertical-align: middle; color: var(--text-secondary); font-size: 0.875rem;">
                        {{ $user->email }}
                    </td>

                    {{-- Role Badge --}}
                    <td style="padding: 16px 8px; vertical-align: middle;">
                        @if($user->role)
                            <div class="role-badge" style="background:{{ $user->role->color }}20; border: 1.5px solid {{ $user->role->color }}40; padding: 4px 10px; font-size: 0.75rem;">
                                <span class="role-badge-dot" style="background:{{ $user->role->color }}"></span>
                                <span class="role-badge-name" style="color:{{ $user->role->color }}">{{ $user->role->name }}</span>
                            </div>
                        @else
                            <span style="font-size: 0.78rem; color: var(--text-muted); font-style: italic;">No Role</span>
                        @endif
                    </td>

                    {{-- Status Badge --}}
                    <td style="padding: 16px 8px; vertical-align: middle;">
                        @if($user->is_active)
                            <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.75rem; font-weight: 700; color: #15803d; background: #dcfce7; padding: 4px 10px; border-radius: var(--radius-full); border: 1px solid #bbf7d0;">
                                <span style="width: 6px; height: 6px; background: #22c55e; border-radius: 50%;"></span>
                                Active
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.75rem; font-weight: 700; color: #b91c1c; background: #fee2e2; padding: 4px 10px; border-radius: var(--radius-full); border: 1px solid #fecaca;">
                                <span style="width: 6px; height: 6px; background: #ef4444; border-radius: 50%;"></span>
                                Pending / Blocked
                            </span>
                        @endif
                    </td>

                    {{-- Created At Date --}}
                    <td style="padding: 16px 8px; vertical-align: middle; color: var(--text-secondary); font-size: 0.8125rem;">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>

                    {{-- Actions --}}
                    <td style="padding: 16px 8px; vertical-align: middle; text-align: right;">
                        @if($user->isSuperAdmin())
                            <span style="font-size: 0.75rem; color: var(--text-muted); font-style: italic;" title="System user cannot be modified.">Protected</span>
                        @elseif($user->id === $currentUserId)
                            <span style="font-size: 0.75rem; color: var(--text-muted); font-style: italic;">Self Account</span>
                        @else
                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                @if(!$user->is_active)
                                    <button type="submit" class="role-action-btn ripple-btn" 
                                            style="border-color: #22c55e; color: #15803d; background: #dcfce7; padding: 6px 14px; font-weight: 700;">
                                        <i class="bi bi-check-lg me-1"></i> Approve
                                    </button>
                                @else
                                    <button type="submit" class="role-action-btn role-action-delete" 
                                            style="padding: 6px 14px; font-weight: 500;" 
                                            onclick="return confirm('Are you sure you want to deactivate {{ $user->name }}?')">
                                        <i class="bi bi-slash-circle me-1"></i> Deactivate
                                    </button>
                                @endif
                            </form>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-muted);">
                        <i class="bi bi-people" style="font-size: 2.5rem; display: block; margin-bottom: 12px; color: var(--border);"></i>
                        No users found matching this filter.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<style>
    /* Styling for custom users table and filters */
    .active-filter {
        background: var(--primary) !important;
        color: var(--text-inverse) !important;
        font-weight: 700 !important;
        box-shadow: var(--shadow-sm);
    }
    
    .active-filter .badge {
        background: rgba(255,255,255,0.2) !important;
        color: #fff !important;
    }
    
    .custom-users-table tbody tr:hover {
        background: var(--bg) !important;
    }
    
    /* Search input adjustments */
    .search-input-sm {
        background: var(--bg);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-full);
        padding-left: 36px;
        padding-right: 12px;
        outline: none;
        font-family: var(--font);
        font-size: 0.875rem;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    
    .search-input-sm:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('userSearch');
        const rows = document.querySelectorAll('.user-row');

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase().trim();
                
                rows.forEach(row => {
                    const content = row.getAttribute('data-search-content');
                    if (content.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush

@endsection
