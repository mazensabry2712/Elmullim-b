@extends('panel.layouts.index')

@section('title', 'Coupons Management | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                        <div class="d-flex align-items-center">
                            <div class="card-icon me-3">
                                <i class="fas fa-tags fa-2x" style="color: rgba(255,255,255,0.9);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="card-title mb-0 text-white fw-bold">Coupons Management</h4>
                                <p class="card-category mb-0" style="color: rgba(255,255,255,0.8); font-size: 14px;">
                                    Total Coupons: {{ $coupons->count() }} |
                                    Active: {{ $coupons->where('is_active', true)->count() }} |
                                    Expired: {{ $coupons->where('expires_at', '<', now())->count() }}
                                </p>
                            </div>
                            <a href="{{ route('coupons.create') }}" class="btn btn-light btn-round shadow-sm">
                                <i class="fa fa-plus me-1"></i>
                                Add New Coupon
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Statistics Cards -->
                        <div class="row mb-4">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round shadow-sm border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center bubble-shadow-small" style="color: rgba(255,255,255,0.9);">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category" style="color: rgba(255,255,255,0.8); font-size: 13px;">Active Coupons</p>
                                                    <h4 class="card-title text-white mb-0 fw-bold">{{ $coupons->where('is_active', true)->count() }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round shadow-sm border-0" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center bubble-shadow-small" style="color: rgba(255,255,255,0.9);">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category" style="color: rgba(255,255,255,0.8); font-size: 13px;">Expired</p>
                                                    <h4 class="card-title text-white mb-0 fw-bold">{{ $coupons->where('expires_at', '<', now())->count() }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round shadow-sm border-0" style="background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%);">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center bubble-shadow-small" style="color: rgba(255,255,255,0.9);">
                                                    <i class="fas fa-shield-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category" style="color: rgba(255,255,255,0.8); font-size: 13px;">Restricted</p>
                                                    <h4 class="card-title text-white mb-0 fw-bold">{{ $coupons->where('restricted', true)->count() }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round shadow-sm border-0" style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center bubble-shadow-small" style="color: rgba(255,255,255,0.9);">
                                                    <i class="fas fa-percentage"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category" style="color: rgba(255,255,255,0.8); font-size: 13px;">Avg Discount</p>
                                                    <h4 class="card-title text-white mb-0 fw-bold">{{ number_format($coupons->avg('discount'), 1) }}%</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filters -->
                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-8">
                                <div class="btn-group shadow-sm" role="group" aria-label="Coupon filters">
                                    <button type="button" class="btn btn-outline-primary active" data-filter="all" style="border-radius: 8px 0 0 8px;">
                                        <i class="fas fa-list me-1"></i> All
                                    </button>
                                    <button type="button" class="btn btn-outline-success" data-filter="active">
                                        <i class="fas fa-check-circle me-1"></i> Active
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-filter="expired">
                                        <i class="fas fa-clock me-1"></i> Expired
                                    </button>
                                    <button type="button" class="btn btn-outline-warning" data-filter="restricted">
                                        <i class="fas fa-shield-alt me-1"></i> Restricted
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" data-filter="inactive" style="border-radius: 0 8px 8px 0;">
                                        <i class="fas fa-pause-circle me-1"></i> Inactive
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 text-end">
                                <!-- أزرار التصدير البسيطة -->
                                <div class="btn-group shadow-sm" role="group">
                                    <button type="button" class="btn btn-success" id="btn-export-excel">
                                        <i class="fas fa-file-excel me-1"></i>Excel
                                    </button>
                                    <button type="button" class="btn btn-danger" id="btn-export-pdf">
                                        <i class="fas fa-file-pdf me-1"></i>PDF
                                    </button>
                                    <button type="button" class="btn btn-info" id="btn-export-csv">
                                        <i class="fas fa-file-csv me-1"></i>CSV
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btn-print">
                                        <i class="fas fa-print me-1"></i>Print
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Search -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body py-3">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>
                                                    <input type="text"
                                                           class="form-control border-start-0"
                                                           id="searchInput"
                                                           placeholder="Search by code, discount..."
                                                           style="border-left: none;">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-select" id="statusFilter">
                                                    <option value="">All Status</option>
                                                    <option value="active">Active Only</option>
                                                    <option value="inactive">Inactive Only</option>
                                                    <option value="expired">Expired Only</option>
                                                    <option value="scheduled">Scheduled Only</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-select" id="discountRange">
                                                    <option value="">All Discounts</option>
                                                    <option value="1-10">1% - 10%</option>
                                                    <option value="11-25">11% - 25%</option>
                                                    <option value="26-50">26% - 50%</option>
                                                    <option value="51-100">51% - 100%</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-outline-secondary w-100" id="clearFilters">
                                                    <i class="fas fa-undo me-1"></i> Clear
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="coupons-table" class="display table table-striped table-hover modern-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th><i class="fas fa-tag me-1"></i> Code</th>
                                        <th class="text-center"><i class="fas fa-percentage me-1"></i> Discount</th>
                                        <th class="text-center"><i class="fas fa-users me-1"></i> Max Recipients</th>
                                        <th class="text-center"><i class="fas fa-repeat me-1"></i> Usage Limit</th>
                                        <th class="text-center"><i class="fas fa-info-circle me-1"></i> Status</th>
                                        <th class="text-center"><i class="fas fa-play me-1"></i> Starts At</th>
                                        <th class="text-center"><i class="fas fa-stop me-1"></i> Expires At</th>
                                        <th class="text-center"><i class="fas fa-cogs me-1"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($coupons as $coupon)
                                    <tr data-status="{{ $coupon->is_active ? 'active' : 'inactive' }}"
                                        data-expired="{{ $coupon->expires_at && $coupon->expires_at->isPast() ? 'true' : 'false' }}"
                                        data-restricted="{{ $coupon->restricted ? 'true' : 'false' }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm bg-primary rounded-circle me-2">
                                                    <i class="fas fa-tag text-white"></i>
                                                </div>
                                                <div>
                                                    <strong class="text-primary">{{ $coupon->code }}</strong>
                                                    @if($coupon->restricted)
                                                        <span class="badge badge-warning badge-sm ms-2">
                                                            <i class="fas fa-shield-alt me-1"></i>Restricted
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success badge-lg">
                                                <i class="fas fa-percentage me-1"></i>
                                                {{ number_format($coupon->discount, 0) }}%
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">
                                                <i class="fas fa-users me-1"></i>
                                                {{ number_format($coupon->max_recipients) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="usage-limits">
                                                <span class="badge badge-secondary mb-1">
                                                    <i class="fas fa-globe me-1"></i>
                                                    Total: {{ $coupon->usage_limit ?? 'Unlimited' }}
                                                </span>
                                                <br>
                                                <span class="badge badge-outline-secondary">
                                                    <i class="fas fa-user me-1"></i>
                                                    Per User: {{ $coupon->usage_limit_per_user ?? 'Unlimited' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $now = now();
                                                $isExpired = $coupon->expires_at && $coupon->expires_at->isPast();
                                                $isScheduled = $coupon->starts_at && $coupon->starts_at->isFuture();
                                            @endphp

                                            @if(!$coupon->is_active)
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-pause-circle me-1"></i>Inactive
                                                </span>
                                            @elseif($isExpired)
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-clock me-1"></i>Expired
                                                </span>
                                            @elseif($isScheduled)
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-calendar me-1"></i>Scheduled
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($coupon->starts_at)
                                                <div class="text-center">
                                                    <strong>{{ $coupon->starts_at->format('Y/m/d') }}</strong>
                                                    <small class="d-block text-muted">{{ $coupon->starts_at->format('H:i') }}</small>
                                                </div>
                                            @else
                                                <span class="text-muted">
                                                    <i class="fas fa-infinity me-1"></i>Immediate
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($coupon->expires_at)
                                                <div class="text-center">
                                                    <strong class="{{ $coupon->expires_at->isPast() ? 'text-danger' : 'text-success' }}">
                                                        {{ $coupon->expires_at->format('Y/m/d') }}
                                                    </strong>
                                                    <small class="d-block text-muted">{{ $coupon->expires_at->format('H:i') }}</small>
                                                    @if($coupon->expires_at->isPast())
                                                        <small class="text-danger">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            Expired {{ $coupon->expires_at->diffForHumans() }}
                                                        </small>
                                                    @else
                                                        <small class="text-success">
                                                            <i class="fas fa-clock me-1"></i>
                                                            {{ $coupon->expires_at->diffForHumans() }}
                                                        </small>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">
                                                    <i class="fas fa-infinity me-1"></i>No expiry
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('coupons.show', $coupon->id) }}"
                                                    class="btn btn-info btn-sm"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('coupons.edit', $coupon->id) }}"
                                                    class="btn btn-warning btn-sm"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="Edit Coupon">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('coupons.destroy', $coupon->id) }}"
                                                    method="POST"
                                                    style="display: inline;"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-original-title="Delete Coupon">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No Coupons Found</h5>
                                                <p class="text-muted">Start by creating your first coupon</p>
                                                <a href="{{ route('coupons.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-1"></i>Create Coupon
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
/* Enhanced Badge Styles */
.badge {
    font-size: 0.75em;
    padding: 0.375rem 0.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.badge-lg {
    font-size: 0.875em;
    padding: 0.5rem 0.75rem;
}

.badge-sm {
    font-size: 0.65em;
    padding: 0.25rem 0.375rem;
}

.badge-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background-color: transparent;
}

/* Modern Table Styles */
.modern-table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.modern-table thead th {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
    padding: 1rem 0.75rem;
}

.modern-table tbody td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-color: rgba(0, 0, 0, 0.05);
}

.modern-table tbody tr {
    transition: all 0.3s ease;
}

.modern-table tbody tr:hover {
    background-color: rgba(52, 144, 220, 0.08);
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Card Stats Enhancements */
.card-stats {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease;
}

.card-stats:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

/* Avatar Styles */
.avatar {
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.avatar:hover {
    transform: scale(1.1);
}

.avatar-sm {
    width: 2rem;
    height: 2rem;
}

/* Button Group Enhancements */
.btn-group .btn {
    transition: all 0.3s ease;
    border-width: 2px;
}

.btn-group .btn.active {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Export Dropdown Enhancements */
.dropdown-menu {
    border: none;
    border-radius: 12px;
    padding: 0.5rem 0;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.dropdown-item {
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 0 0.5rem;
}

.dropdown-item:hover {
    background-color: rgba(0, 123, 255, 0.1);
    transform: translateX(5px);
}

/* Search Enhancement */
.input-group .form-control {
    border-radius: 8px;
}

.input-group-text {
    border-radius: 8px;
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 40px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endpush

@push('script')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Extensions for Export -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
<script src="{{asset('assets/js/setting-demo2.js')}}"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Debug: التحقق من تحميل المكتبات المطلوبة
    console.log('jQuery loaded:', typeof $ !== 'undefined');
    console.log('DataTables loaded:', typeof $.fn.DataTable !== 'undefined');
    console.log('DataTables Buttons loaded:', typeof $.fn.DataTable !== 'undefined' && $.fn.DataTable.Buttons);
    console.log('JSZip loaded:', typeof JSZip !== 'undefined');
    console.log('pdfMake loaded:', typeof pdfMake !== 'undefined');

    // Fallback للتصدير البسيط إذا فشلت DataTables
    function fallbackExport(type) {
        console.log('استخدام التصدير البديل:', type);

        if (type === 'csv') {
            // تصدير CSV بسيط
            let csvContent = "data:text/csv;charset=utf-8,";

            // Headers
            let headers = [];
            $('#coupons-table thead th').each(function(index) {
                if (index < 8) { // تجاهل عمود Actions
                    headers.push($(this).text().replace(/,/g, ''));
                }
            });
            csvContent += headers.join(',') + '\n';

            // Rows
            $('#coupons-table tbody tr').each(function() {
                let row = [];
                $(this).find('td').each(function(index) {
                    if (index < 8) {
                        row.push('"' + $(this).text().replace(/"/g, '""').trim() + '"');
                    }
                });
                csvContent += row.join(',') + '\n';
            });

            // تحميل الملف
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "coupons_" + new Date().toISOString().slice(0,10) + ".csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

        } else if (type === 'print') {
            // طباعة بسيطة
            window.print();
        } else {
            alert('التصدير إلى ' + type + ' غير متاح حالياً. يرجى استخدام CSV أو الطباعة.');
        }
    }

    // تأكد من تحميل DataTables أولاً
    if (!$.fn.DataTable) {
        console.error('DataTables is not loaded - using fallback');

        // استخدام التصدير البديل
        $('#btn-export-excel').on('click', function() { fallbackExport('excel'); });
        $('#btn-export-pdf').on('click', function() { fallbackExport('pdf'); });
        $('#btn-export-csv').on('click', function() { fallbackExport('csv'); });
        $('#btn-print').on('click', function() { fallbackExport('print'); });

        return;
    }

    // Initialize DataTables مع إعدادات بسيطة وموثوقة
    var table = $('#coupons-table').DataTable({
        pageLength: 10,
        order: [[0, 'asc']],
        responsive: true,
        processing: true,
        language: {
            search: "البحث:",
            searchPlaceholder: "البحث في الكوبونات...",
            lengthMenu: "عرض _MENU_ كوبون في الصفحة",
            info: "عرض _START_ إلى _END_ من _TOTAL_ كوبون",
            infoEmpty: "لا توجد كوبونات متاحة",
            infoFiltered: "(تم التصفية من _MAX_ كوبون)",
            paginate: {
                first: "الأول",
                last: "الأخير",
                next: "التالي",
                previous: "السابق"
            },
            emptyTable: "لا توجد كوبونات في الجدول",
            zeroRecords: "لم يتم العثور على كوبونات مطابقة",
            processing: "جاري المعالجة..."
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Excel',
                className: 'btn btn-success d-none export-btn',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    format: {
                        body: function(data, row, column, node) {
                            return $(data).text();
                        }
                    }
                },
                title: 'تقرير الكوبونات',
                filename: 'coupons_' + new Date().toISOString().slice(0,10)
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                className: 'btn btn-danger d-none export-btn',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    format: {
                        body: function(data, row, column, node) {
                            return $(data).text();
                        }
                    }
                },
                title: 'تقرير الكوبونات',
                orientation: 'landscape',
                pageSize: 'A4',
                filename: 'coupons_' + new Date().toISOString().slice(0,10)
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
                className: 'btn btn-info d-none export-btn',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    format: {
                        body: function(data, row, column, node) {
                            return $(data).text();
                        }
                    }
                },
                filename: 'coupons_' + new Date().toISOString().slice(0,10)
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-secondary d-none export-btn',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    format: {
                        body: function(data, row, column, node) {
                            return $(data).text();
                        }
                    }
                },
                title: 'تقرير الكوبونات'
            }
        ],
        columnDefs: [
            {
                targets: -1,
                orderable: false
            },
            {
                targets: [0, 2, 3, 4, 5, 6, 7],
                className: 'text-center'
            }
        ],
        initComplete: function() {
            console.log('DataTable تم تهيئته بنجاح');
            $('.dataTables_filter input').addClass('form-control form-control-sm');
            $('.dataTables_length select').addClass('form-select form-select-sm');
        }
    });

    // معالجات أزرار التصدير المبسطة
    $('#btn-export-excel').on('click', function() {
        console.log('تجربة تصدير Excel');
        try {
            table.button(0).trigger();
        } catch (error) {
            console.error('خطأ في تصدير Excel:', error);
            alert('فشل في تصدير Excel. يرجى المحاولة مرة أخرى.');
        }
    });

    $('#btn-export-pdf').on('click', function() {
        console.log('تجربة تصدير PDF');
        try {
            table.button(1).trigger();
        } catch (error) {
            console.error('خطأ في تصدير PDF:', error);
            alert('فشل في تصدير PDF. يرجى المحاولة مرة أخرى.');
        }
    });

    $('#btn-export-csv').on('click', function() {
        console.log('تجربة تصدير CSV');
        try {
            table.button(2).trigger();
        } catch (error) {
            console.error('خطأ في تصدير CSV:', error);
            alert('فشل في تصدير CSV. يرجى المحاولة مرة أخرى.');
        }
    });

    $('#btn-print').on('click', function() {
        console.log('تجربة الطباعة');
        try {
            table.button(3).trigger();
        } catch (error) {
            console.error('خطأ في الطباعة:', error);
            alert('فشل في الطباعة. يرجى المحاولة مرة أخرى.');
        }
    });
    });

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Enhanced Search Functionality
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Status Filter
    $('#statusFilter').on('change', function() {
        var selectedStatus = this.value;
        if (selectedStatus === '') {
            table.column(5).search('').draw();
        } else {
            table.column(5).search(selectedStatus, true, false).draw();
        }
    });

    // Discount Range Filter for Percentage
    $('#discountRange').on('change', function() {
        var range = this.value;

        if (range === '') {
            // Clear custom search if no range selected
            if ($.fn.dataTable.ext.search.length > 0) {
                $.fn.dataTable.ext.search.pop();
            }
            table.draw();
        } else {
            // Remove any existing custom search
            if ($.fn.dataTable.ext.search.length > 0) {
                $.fn.dataTable.ext.search.pop();
            }

            // Add custom search function for percentage range
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                // Extract percentage value from the badge (column 2)
                var discountText = data[2];
                var percentageMatch = discountText.match(/(\d+)%/);

                if (!percentageMatch) return true;

                var percentage = parseInt(percentageMatch[1]);

                switch (range) {
                    case '1-10':
                        return percentage >= 1 && percentage <= 10;
                    case '11-25':
                        return percentage >= 11 && percentage <= 25;
                    case '26-50':
                        return percentage >= 26 && percentage <= 50;
                    case '51-100':
                        return percentage >= 51 && percentage <= 100;
                    default:
                        return true;
                }
            });
            table.draw();
        }
    });

    // Clear Filters
    $('#clearFilters').click(function() {
        $('#searchInput').val('');
        $('#statusFilter').val('');
        $('#discountRange').val('');

        // Remove custom search functions
        while ($.fn.dataTable.ext.search.length > 0) {
            $.fn.dataTable.ext.search.pop();
        }

        table.search('').columns().search('').draw();
    });

    // Filter functionality
    $('.btn[data-filter]').on('click', function() {
        const filter = $(this).data('filter');

        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');

        if (filter === 'all') {
            table.column(5).search('').draw();
        } else if (filter === 'active') {
            table.column(5).search('Active').draw();
        } else if (filter === 'expired') {
            table.column(5).search('Expired').draw();
        } else if (filter === 'restricted') {
            table.column(1).search('Restricted').draw();
        } else if (filter === 'inactive') {
            table.column(5).search('Inactive').draw();
        }
    });

    // Delete confirmation
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();

        const form = this;
        const couponCode = $(this).closest('tr').find('td:nth-child(2) strong').text();

        Swal.fire({
            title: 'Are you sure?',
            text: `Coupon "${couponCode}" will be permanently deleted!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Auto-hide success/error messages
    @if(session('success') || session('error'))
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    @endif

    // Add animation to table rows
    $('#coupons-table tbody tr').addClass('animate-fade-in-up');
});
</script>
@endpush
