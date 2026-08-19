@extends('panel.layouts.index')

@section('title', 'Update Country | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="page-header mb-4">
                <h1 class="fw-bold text-primary">
                    <i class="fas fa-globe me-2"></i>
                    Country Management
                </h1>
                <nav class="mt-3 ml-7" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{-- route('dashboard') --}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('countries.index') }}">Countries</a></li>
                        <li class="breadcrumb-item active">Update Country</li>
                    </ol>
                </nav>
            </div>

            {{-- Success Messages --}}
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4 alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Error Messages --}}
            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4 alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-4 alert-dismissible fade show">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light text-dark">
                            <div class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i>
                                Update Country: {{ $country->name }}
                            </div>
                        </div>

                        <form action="{{ route('countries.update', $country->id) }}" method="POST" id="countryForm">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-flag me-1"></i>
                                                Country Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $country->name) }}"
                                                placeholder="Enter country name" required autocomplete="off" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="code" class="form-label">
                                                <i class="fas fa-code me-1"></i>
                                                Country Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" name="code" value="{{ old('code', $country->code) }}"
                                                placeholder="+20, +966, +971" maxlength="3" minlength="2"
                                                style="text-transform: uppercase;" required autocomplete="off" />
                                            @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Enter country code (2-3 characters)
                                            </small>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-toggle-on me-1"></i>
                                                Status
                                            </label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                                <option value="1" {{ old('status', $country->status) == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ old('status', $country->status) == '0' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">
                                                <i class="fas fa-align-left me-1"></i>
                                                Description (Optional)
                                            </label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                id="description"
                                                name="description"
                                                rows="3"
                                                placeholder="Enter a brief description about the country..."
                                                maxlength="500">{{ old('description', $country->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <span id="descriptionCount">{{ strlen(old('description', $country->description ?? '')) }}</span>/500 characters
                                            </small>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- Additional Information --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <h6><i class="fas fa-info-circle me-2"></i>Country Information</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Created:</strong>
                                                        {{ $country->created_at ? $country->created_at->format('d/m/Y H:i') : 'N/A' }}
                                                    </p>
                                                    <p class="mb-0"><strong>Last Updated:</strong>
                                                        {{ $country->updated_at ? $country->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                                    </p>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <p class="mb-1"><strong>Current Status:</strong>
                                                        <span
                                                            class="badge badge-{{ $country->status ? 'success' : 'danger' }}">
                                                            {{ $country->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </p>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="fas fa-save me-1"></i>
                                            Update Country
                                        </button>
                                        <a href="{{ route('countries.index') }}" class="btn btn-outline-danger">
                                            <i class="fas fa-times me-1"></i>
                                            Cancel
                                        </a>
                                        {{-- <button type="reset" class="btn btn-secondary me-2">
                                            <i class="fas fa-undo me-1"></i>
                                            Reset Changes
                                        </button> --}}
                                    </div>
                                    <div>
                                        {{-- <a href="{{ route('countries.show', $country->id) }}"
                                            class="btn btn-outline-info me-2">
                                            <i class="fas fa-eye me-1"></i>
                                            View Details
                                        </a> --}}
                                        {{-- <a href="{{ route('countries.index') }}" class="btn btn-outline-danger">
                                            <i class="fas fa-times me-1"></i>
                                            Cancel
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <style>
        .alert-info {
            background-color: #e3f2fd;
            border-color: #bbdefb;
            color: #0d47a1;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // تحويل رمز الدولة إلى أحرف كبيرة أثناء الكتابة
            $('#code').on('input', function() {
                this.value = this.value.toUpperCase();
            });

            // التحقق من طول رمز الدولة
            $('#code').on('blur', function() {
                if (this.value.length < 2) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // عداد الأحرف للوصف
            function updateCharacterCount() {
                var length = $('#description').val().length;
                $('#descriptionCount').text(length);

                if (length > 450) {
                    $('#descriptionCount').addClass('text-warning');
                } else {
                    $('#descriptionCount').removeClass('text-warning');
                }

                if (length >= 500) {
                    $('#descriptionCount').addClass('text-danger').removeClass('text-warning');
                } else {
                    $('#descriptionCount').removeClass('text-danger');
                }
            }

            $('#description').on('input', updateCharacterCount);

            // تحديث العداد عند تحميل الصفحة
            updateCharacterCount();

            // تأكيد قبل إرسال النموذج
            $('#countryForm').on('submit', function(e) {
                if (!confirm('Are you sure you want to update this country?')) {
                    e.preventDefault();
                    return false;
                }
            });

            // تأكيد قبل إعادة تعيين النموذج
            $('button[type="reset"]').on('click', function(e) {
                if (!confirm('Are you sure you want to reset all changes?')) {
                    e.preventDefault();
                    return false;
                }
            });

            // إظهار رسالة تأكيد عند مغادرة الصفحة مع تغييرات غير محفوظة
            var formChanged = false;

            $('#countryForm input, #countryForm textarea, #countryForm select').on('change input', function() {
                formChanged = true;
            });

            $('#countryForm').on('submit', function() {
                formChanged = false;
            });

            $(window).on('beforeunload', function() {
                if (formChanged) {
                    return 'You have unsaved changes. Are you sure you want to leave?';
                }
            });

            // تحسين تجربة المستخدم - التركيز على أول حقل خطأ
            if ($('.is-invalid').length > 0) {
                $('.is-invalid').first().focus();
            }
        });
    </script>
@endpush
