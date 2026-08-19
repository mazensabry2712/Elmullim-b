@extends('panel.layouts.index')

@section('title', 'Add Education System | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Add New Education System
                            </h4>
                            <a href="{{ route('educationsystem.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('educationsystem.store') }}" method="POST" id="educationSystemForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-tag me-1"></i>
                                            System Name <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            placeholder="Enter education system name"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Enter a unique name for the education system (e.g., "American K-12 System")
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country_id" class="form-label">
                                            <i class="fas fa-flag me-1"></i>
                                            Country <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            class="form-control select2 @error('country_id') is-invalid @enderror"
                                            id="country_id"
                                            name="country_id"
                                            required>
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Select the country where this education system is used
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Description
                                        </label>
                                        <textarea
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description"
                                            name="description"
                                            rows="4"
                                            placeholder="Enter a brief description of the education system">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Optional: Provide a brief description of the education system's structure and characteristics
                                        </small>
                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-label">
                                            <i class="fas fa-toggle-on me-1"></i>
                                            Status
                                        </label>
                                        <select
                                            class="form-control @error('status') is-invalid @enderror"
                                            id="status"
                                            name="status">
                                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Set the initial status of the education system
                                        </small>
                                    </div>
                                </div> -->
                            </div>

                            <div class="form-group">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-lightbulb text-warning me-2"></i>
                                            Next Steps
                                        </h6>
                                        <p class="card-text text-muted mb-0">
                                            After creating the education system, you'll be able to add education levels,
                                            define grade structures, and configure curriculum details.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between">

                                <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i>
                                        Create Education System
                                    </button>

                                    <button type="button" class="btn btn-danger" onclick="history.back()">
                                        <i class="fas fa-times me-1"></i>
                                        Cancel
                                    </button>


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
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}" />

<style>
    .card-title {
        color: #1f2937;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #374151;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .text-danger {
        color: #ef4444 !important;
    }

    .form-text {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6b7280;
        border-color: #6b7280;
    }

    .btn-light {
        background-color: #f9fafb;
        border-color: #e5e7eb;
        color: #6b7280;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 12px 12px 0 0;
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .bg-light {
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0;
    }

    .invalid-feedback {
        display: block;
    }

    .select2-container--default .select2-selection--single {
        height: 48px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 46px;
        padding-left: 12px;
    }
</style>
@endpush

@push('script')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for country dropdown
        $('#country_id').select2({
            placeholder: "Select Country",
            allowClear: true,
            width: '100%'
        });

        // Form validation
        $('#educationSystemForm').on('submit', function(e) {
            let isValid = true;

            // Check required fields
            const requiredFields = ['name', 'country_id'];
            requiredFields.forEach(function(field) {
                const element = $('#' + field);
                if (!element.val() || element.val().trim() === '') {
                    element.addClass('is-invalid');
                    isValid = false;
                } else {
                    element.removeClass('is-invalid');
                }
            });

            // Validate name length
            const nameField = $('#name');
            if (nameField.val() && nameField.val().length < 3) {
                nameField.addClass('is-invalid');
                if (!nameField.next('.invalid-feedback').length) {
                    nameField.after('<div class="invalid-feedback">System name must be at least 3 characters long.</div>');
                }
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                $('html, body').animate({
                    scrollTop: $('.is-invalid').first().offset().top - 100
                }, 500);
            }
        });

        // Real-time validation
        $('#name').on('input', function() {
            const value = $(this).val().trim();
            if (value.length >= 3) {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });

        $('#country_id').on('change', function() {
            if ($(this).val()) {
                $(this).removeClass('is-invalid');
            }
        });

        // Auto-hide validation errors after typing
        $('.form-control').on('input change', function() {
            if ($(this).val()) {
                $(this).removeClass('is-invalid');
            }
        });
    });

    // Success notification helper
    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: message,
            timer: 3000,
            showConfirmButton: false
        });
    }

    // Error notification helper
    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: message
        });
    }
</script>

<!-- Additional Scripts -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

@endpush