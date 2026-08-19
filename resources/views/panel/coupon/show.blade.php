@extends('panel.layouts.index')

@section('title', 'Coupon Details | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
                        <div class="d-flex align-items-center">
                            <div class="card-icon me-3">
                                <i class="fas fa-info-circle fa-2x" style="color: rgba(255,255,255,0.9);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="card-title mb-0 text-white fw-bold">Coupon Details</h4>
                                <p class="card-category mb-0" style="color: rgba(255,255,255,0.8); font-size: 14px;">
                                    Viewing coupon: <strong>{{ $coupon->code }}</strong>
                                </p>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('coupons.index') }}" class="btn btn-light btn-round shadow-sm me-2">
                                    <i class="fa fa-arrow-left me-1"></i>
                                    Back to List
                                </a>
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning btn-round shadow-sm">
                                    <i class="fa fa-edit me-1"></i>
                                    Edit Coupon
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Status Overview -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="alert alert-primary border-0 shadow-sm">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong>Current Status:</strong>
                                            @if(!$coupon->is_active)
                                                <span class="badge badge-secondary ms-2 fs-6">
                                                    <i class="fas fa-pause-circle me-1"></i>Inactive
                                                </span>
                                            @elseif($coupon->expires_at && $coupon->expires_at->isPast())
                                                <span class="badge badge-danger ms-2 fs-6">
                                                    <i class="fas fa-clock me-1"></i>Expired
                                                </span>
                                            @elseif($coupon->starts_at && $coupon->starts_at->isFuture())
                                                <span class="badge badge-warning ms-2 fs-6">
                                                    <i class="fas fa-calendar me-1"></i>Scheduled
                                                </span>
                                            @else
                                                <span class="badge badge-success ms-2 fs-6">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Usage Count:</strong>
                                            <span class="badge badge-info ms-2 fs-6">{{ $coupon->students()->count() ?? 0 }} users</span>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Remaining Uses:</strong>
                                            @if($coupon->usage_limit)
                                                <span class="badge badge-primary ms-2 fs-6">
                                                    {{ $coupon->usage_limit - ($coupon->students()->count() ?? 0) }} left
                                                </span>
                                            @else
                                                <span class="badge badge-success ms-2 fs-6">Unlimited</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Type:</strong>
                                            @if($coupon->restricted)
                                                <span class="badge badge-warning ms-2 fs-6">
                                                    <i class="fas fa-shield-alt me-1"></i>Restricted
                                                </span>
                                            @else
                                                <span class="badge badge-success ms-2 fs-6">
                                                    <i class="fas fa-globe me-1"></i>Public
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <div class="card border-0 bg-light mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">
                                            <i class="fas fa-info-circle me-2"></i>Basic Information
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="fw-bold w-50">
                                                        <i class="fas fa-tag text-primary me-2"></i>Coupon Code:
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary badge-lg">{{ $coupon->code }}</span>
                                                        <button class="btn btn-sm btn-outline-primary ms-2" onclick="copyToClipboard('{{ $coupon->code }}')">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">
                                                        <i class="fas fa-percentage text-success me-2"></i>Discount Percentage:
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success badge-lg">{{ number_format($coupon->discount, 0) }}%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">
                                                        <i class="fas fa-users text-info me-2"></i>Max Recipients:
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">{{ number_format($coupon->max_recipients) }} users</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">
                                                        <i class="fas fa-shield-alt text-warning me-2"></i>Access Type:
                                                    </td>
                                                    <td>
                                                        @if($coupon->restricted)
                                                            <span class="badge badge-warning">
                                                                <i class="fas fa-lock me-1"></i>Restricted Access
                                                            </span>
                                                        @else
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-globe me-1"></i>Public Access
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Usage Limits -->
                            <div class="col-md-6">
                                <div class="card border-0 bg-light mb-4">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0">
                                            <i class="fas fa-chart-bar me-2"></i>Usage Statistics
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="fw-bold w-50">
                                                        <i class="fas fa-globe text-warning me-2"></i>Total Usage Limit:
                                                    </td>
                                                    <td>
                                                        @if($coupon->usage_limit)
                                                            <span class="badge badge-warning">{{ number_format($coupon->usage_limit) }} uses</span>
                                                        @else
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-infinity me-1"></i>Unlimited
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">
                                                        <i class="fas fa-user text-secondary me-2"></i>Per User Limit:
                                                    </td>
                                                    <td>
                                                        @if($coupon->usage_limit_per_user)
                                                            <span class="badge badge-secondary">{{ $coupon->usage_limit_per_user }} per user</span>
                                                        @else
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-infinity me-1"></i>Unlimited
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">
                                                        <i class="fas fa-chart-line text-info me-2"></i>Current Usage:
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">{{ $coupon->students()->count() ?? 0 }} users</span>
                                                        @if($coupon->usage_limit)
                                                            <div class="progress mt-2" style="height: 6px;">
                                                                @php
                                                                    $usagePercent = ($coupon->students()->count() / $coupon->usage_limit) * 100;
                                                                @endphp
                                                                <div class="progress-bar bg-info"
                                                                     style="width: {{ min($usagePercent, 100) }}%"></div>
                                                            </div>
                                                            <small class="text-muted">{{ number_format($usagePercent, 1) }}% used</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">
                                                        <i class="fas fa-power-off text-success me-2"></i>Status:
                                                    </td>
                                                    <td>
                                                        @if($coupon->is_active)
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-check-circle me-1"></i>Enabled
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary">
                                                                <i class="fas fa-pause-circle me-1"></i>Disabled
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Information -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 bg-light mb-4">
                                    <div class="card-header bg-dark text-white">
                                        <h5 class="mb-0">
                                            <i class="fas fa-calendar-alt me-2"></i>Date & Time Information
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card border border-success">
                                                    <div class="card-body text-center">
                                                        <i class="fas fa-play fa-2x text-success mb-3"></i>
                                                        <h6 class="fw-bold">Start Date & Time</h6>
                                                        @if($coupon->starts_at)
                                                            <p class="mb-1 fw-bold">{{ $coupon->starts_at->format('F d, Y') }}</p>
                                                            <p class="mb-1">{{ $coupon->starts_at->format('g:i A') }}</p>
                                                            <small class="text-muted">
                                                                @if($coupon->starts_at->isFuture())
                                                                    <i class="fas fa-clock me-1"></i>Starts {{ $coupon->starts_at->diffForHumans() }}
                                                                @else
                                                                    <i class="fas fa-check me-1"></i>Started {{ $coupon->starts_at->diffForHumans() }}
                                                                @endif
                                                            </small>
                                                        @else
                                                            <p class="text-muted">
                                                                <i class="fas fa-infinity me-1"></i>Immediate Start
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card border border-danger">
                                                    <div class="card-body text-center">
                                                        <i class="fas fa-stop fa-2x text-danger mb-3"></i>
                                                        <h6 class="fw-bold">Expiry Date & Time</h6>
                                                        @if($coupon->expires_at)
                                                            <p class="mb-1 fw-bold">{{ $coupon->expires_at->format('F d, Y') }}</p>
                                                            <p class="mb-1">{{ $coupon->expires_at->format('g:i A') }}</p>
                                                            <small class="text-muted">
                                                                @if($coupon->expires_at->isPast())
                                                                    <i class="fas fa-exclamation-triangle text-danger me-1"></i>
                                                                    <span class="text-danger">Expired {{ $coupon->expires_at->diffForHumans() }}</span>
                                                                @else
                                                                    <i class="fas fa-clock me-1"></i>Expires {{ $coupon->expires_at->diffForHumans() }}
                                                                @endif
                                                            </small>
                                                        @else
                                                            <p class="text-muted">
                                                                <i class="fas fa-infinity me-1"></i>No Expiry
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- System Information -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0">
                                            <i class="fas fa-database me-2"></i>System Information
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <i class="fas fa-plus-circle fa-2x text-primary mb-2"></i>
                                                <h6 class="fw-bold">Created</h6>
                                                <p class="mb-0">{{ $coupon->created_at->format('M d, Y') }}</p>
                                                <small class="text-muted">{{ $coupon->created_at->format('g:i A') }}</small>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <i class="fas fa-edit fa-2x text-warning mb-2"></i>
                                                <h6 class="fw-bold">Last Updated</h6>
                                                <p class="mb-0">{{ $coupon->updated_at->format('M d, Y') }}</p>
                                                <small class="text-muted">{{ $coupon->updated_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <i class="fas fa-fingerprint fa-2x text-info mb-2"></i>
                                                <h6 class="fw-bold">Coupon ID</h6>
                                                <p class="mb-0">#{{ $coupon->id }}</p>
                                                <small class="text-muted">Unique identifier</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <div class="btn-group shadow" role="group">
                                    <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning btn-lg">
                                        <i class="fas fa-edit me-2"></i>Edit Coupon
                                    </a>
                                    <a href="{{ route('coupons.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-list me-2"></i>Back to List
                                    </a>
                                    <button type="button" class="btn btn-danger btn-lg" onclick="deleteCoupon()">
                                        <i class="fas fa-trash me-2"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
.card {
    border-radius: 12px;
    overflow: hidden;
}

.badge-lg {
    font-size: 1rem;
    padding: 0.5rem 0.75rem;
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn-lg {
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
}

.table td {
    padding: 0.75rem 0.5rem;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}

.alert-primary {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    color: #0d47a1;
    border: none;
}
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Add animation class
    $('.card').addClass('animate-fade-in');
});

// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        Swal.fire({
            icon: 'success',
            title: 'Copied!',
            text: `Coupon code "${text}" copied to clipboard`,
            timer: 2000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    });
}

// Delete coupon function
function deleteCoupon() {
    Swal.fire({
        title: 'Are you sure?',
        text: `Coupon "{{ $coupon->code }}" will be permanently deleted!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'animate__animated animate__fadeInDown'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("coupons.destroy", $coupon->id) }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Load SweetAlert2 if not available
if (typeof Swal === 'undefined') {
    $('head').append('<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><\/script>');
}
</script>
@endpush
