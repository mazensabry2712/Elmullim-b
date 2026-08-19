@extends('panel.layouts.index')

@section('title', 'Create Coupon | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                        <div class="d-flex align-items-center">
                            <div class="card-icon me-3">
                                <i class="fas fa-plus-circle fa-2x" style="color: rgba(255,255,255,0.9);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="card-title mb-0 text-white fw-bold">Create New Coupon</h4>
                                <p class="card-category mb-0" style="color: rgba(255,255,255,0.8); font-size: 14px;">
                                    Add a new discount coupon to the system
                                </p>
                            </div>
                            <a href="{{ route('coupons.index') }}" class="btn btn-light btn-round shadow-sm">
                                <i class="fa fa-arrow-left me-1"></i>
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('coupons.store') }}" method="POST" id="couponForm">
                            @csrf

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
                                            <!-- Coupon Code -->
                                            <div class="form-group mb-3">
                                                <label for="code" class="form-label fw-bold">
                                                    <i class="fas fa-tag me-1 text-primary"></i>Coupon Code
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="fas fa-hashtag"></i>
                                                    </span>
                                                    <input type="text"
                                                           class="form-control @error('code') is-invalid @enderror"
                                                           id="code"
                                                           name="code"
                                                           value="{{ old('code') }}"
                                                           placeholder="Enter unique coupon code"
                                                           required>
                                                    <button type="button" class="btn btn-outline-secondary" id="generateCode">
                                                        <i class="fas fa-random"></i> Generate
                                                    </button>
                                                </div>
                                                @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-lightbulb me-1"></i>Use uppercase letters and numbers (e.g., SAVE20, DISCOUNT2024)
                                                </small>
                                            </div>

                                            <!-- Discount Percentage -->
                                            <div class="form-group mb-3">
                                                <label for="discount" class="form-label fw-bold">
                                                    <i class="fas fa-percentage me-1 text-success"></i>Discount Percentage
                                                </label>
                                                <div class="input-group">
                                                    <input type="number"
                                                           class="form-control @error('discount') is-invalid @enderror"
                                                           id="discount"
                                                           name="discount"
                                                           value="{{ old('discount') }}"
                                                           min="1"
                                                           max="100"
                                                           step="1"
                                                           placeholder="Enter discount percentage"
                                                           required>
                                                    <span class="input-group-text bg-success text-white">%</span>
                                                </div>
                                                @error('discount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Enter percentage between 1% and 100% (e.g., 20 for 20% off)
                                                </small>
                                            </div>

                                            <!-- Max Recipients -->
                                            <div class="form-group mb-3">
                                                <label for="max_recipients" class="form-label fw-bold">
                                                    <i class="fas fa-users me-1 text-info"></i>Maximum Recipients
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-info text-white">
                                                        <i class="fas fa-user-friends"></i>
                                                    </span>
                                                    <input type="number"
                                                           class="form-control @error('max_recipients') is-invalid @enderror"
                                                           id="max_recipients"
                                                           name="max_recipients"
                                                           value="{{ old('max_recipients', 150) }}"
                                                           min="1"
                                                           required>
                                                </div>
                                                @error('max_recipients')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Maximum number of users who can use this coupon
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Usage Limits & Status -->
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light mb-4">
                                        <div class="card-header bg-warning text-dark">
                                            <h5 class="mb-0">
                                                <i class="fas fa-cogs me-2"></i>Usage Limits & Status
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Usage Limit -->
                                            <div class="form-group mb-3">
                                                <label for="usage_limit" class="form-label fw-bold">
                                                    <i class="fas fa-repeat me-1 text-warning"></i>Total Usage Limit
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-warning text-dark">
                                                        <i class="fas fa-globe"></i>
                                                    </span>
                                                    <input type="number"
                                                           class="form-control @error('usage_limit') is-invalid @enderror"
                                                           id="usage_limit"
                                                           name="usage_limit"
                                                           value="{{ old('usage_limit') }}"
                                                           min="1"
                                                           placeholder="Leave empty for unlimited">
                                                </div>
                                                @error('usage_limit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Usage Limit Per User -->
                                            <div class="form-group mb-3">
                                                <label for="usage_limit_per_user" class="form-label fw-bold">
                                                    <i class="fas fa-user me-1 text-secondary"></i>Usage Limit Per User
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-secondary text-white">
                                                        <i class="fas fa-user-check"></i>
                                                    </span>
                                                    <input type="number"
                                                           class="form-control @error('usage_limit_per_user') is-invalid @enderror"
                                                           id="usage_limit_per_user"
                                                           name="usage_limit_per_user"
                                                           value="{{ old('usage_limit_per_user') }}"
                                                           min="1"
                                                           placeholder="Leave empty for unlimited">
                                                </div>
                                                @error('usage_limit_per_user')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Status Switches -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               id="is_active"
                                                               name="is_active"
                                                               value="1"
                                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="is_active">
                                                            <i class="fas fa-power-off me-1 text-success"></i>Active Status
                                                        </label>
                                                        <small class="d-block text-muted">Enable coupon usage</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               id="restricted"
                                                               name="restricted"
                                                               value="1"
                                                               {{ old('restricted') ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="restricted">
                                                            <i class="fas fa-shield-alt me-1 text-warning"></i>Restricted
                                                        </label>
                                                        <small class="d-block text-muted">Limit to specific users</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card border-0 bg-light mb-4">
                                        <div class="card-header bg-dark text-white">
                                            <h5 class="mb-0">
                                                <i class="fas fa-calendar-alt me-2"></i>Date Range
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="starts_at" class="form-label fw-bold">
                                                            <i class="fas fa-play me-1 text-success"></i>Start Date & Time
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-success text-white">
                                                                <i class="fas fa-calendar-day"></i>
                                                            </span>
                                                            <input type="datetime-local"
                                                                   class="form-control @error('starts_at') is-invalid @enderror"
                                                                   id="starts_at"
                                                                   name="starts_at"
                                                                   value="{{ old('starts_at') }}"
                                                                   required>
                                                        </div>
                                                        @error('starts_at')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="expires_at" class="form-label fw-bold">
                                                            <i class="fas fa-stop me-1 text-danger"></i>Expiry Date & Time
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-danger text-white">
                                                                <i class="fas fa-calendar-times"></i>
                                                            </span>
                                                            <input type="datetime-local"
                                                                   class="form-control @error('expires_at') is-invalid @enderror"
                                                                   id="expires_at"
                                                                   name="expires_at"
                                                                   value="{{ old('expires_at') }}"
                                                                   required>
                                                        </div>
                                                        @error('expires_at')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <button type="submit" class="btn btn-success btn-lg me-3 shadow">
                                        <i class="fas fa-save me-2"></i>Create Coupon
                                    </button>
                                    <a href="{{ route('coupons.index') }}" class="btn btn-secondary btn-lg shadow">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
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

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.input-group-text {
    border: none;
}

.form-switch .form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-lg {
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 8px;
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Code generator
    $('#generateCode').click(function() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let code = '';
        for (let i = 0; i < 8; i++) {
            code += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        $('#code').val(code);
    });

    // Form validation
    $('#couponForm').on('submit', function(e) {
        const startDate = new Date($('#starts_at').val());
        const endDate = new Date($('#expires_at').val());

        if (endDate <= startDate) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Invalid Date Range',
                text: 'Expiry date must be after start date!',
            });
            return false;
        }
    });

    // Set default dates
    const now = new Date();
    const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
    const nextWeek = new Date(now.getTime() + 7 * 24 * 60 * 60 * 1000);

    if (!$('#starts_at').val()) {
        $('#starts_at').val(tomorrow.toISOString().slice(0, 16));
    }
    if (!$('#expires_at').val()) {
        $('#expires_at').val(nextWeek.toISOString().slice(0, 16));
    }

    // Add animation class
    $('.card').addClass('animate-fade-in');
});

// Load SweetAlert2 if not available
if (typeof Swal === 'undefined') {
    $('head').append('<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><\/script>');
}
</script>
@endpush
