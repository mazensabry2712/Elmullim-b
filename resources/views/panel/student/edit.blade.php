@extends('panel.layouts.index')

@section('title', 'Edit Student | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Student: {{ $student->name }}</h4>
                                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Students
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('students.update', $student->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Current Profile Image -->
                                    @if ($student->profile_image)
                                        <div class="col-md-12 mb-3">
                                            <div class="current-image">
                                                <label>Current Profile Image:</label>
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $student->profile_image) }}"
                                                        alt="{{ $student->name }}" class="rounded-circle" width="80"
                                                        height="80">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Basic Information -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $student->name) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $student->email) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Leave blank to keep current password">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePasswordVisibility('password')">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">Leave blank to keep current password</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone', $student->phone) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male"
                                                    {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_level_id">Education Level</label>
                                            <select class="form-control" id="education_level_id" name="education_level_id">
                                                <option value="">Select Education Level</option>
                                                @foreach ($educationLevels as $level)
                                                    <option value="{{ $level->id }}"
                                                        {{ old('education_level_id', $student->education_level_id) == $level->id ? 'selected' : '' }}>
                                                        {{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select @error('gender') is-invalid @enderror"
                                                id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male"
                                                    {{ old('gender', $student->gender?->value) == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female"
                                                    {{ old('gender', $student->gender?->value) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $student->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile_image">Profile Image</label>
                                            <input type="file" class="form-control" id="profile_image"
                                                name="profile_image" accept="image/*">
                                            <small class="form-text text-muted">Upload a new profile image
                                                (optional)</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check mt-4">
                                                <input class="form-check-input" type="checkbox" id="email_verified_at"
                                                    name="email_verified_at"
                                                    {{ old('email_verified_at', $student->email_verified_at) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="email_verified_at">
                                                    Mark email as verified
                                                </label>
                                            </div>
                                            @if ($student->email_verified_at)
                                                <small class="form-text text-success">
                                                    <i class="fa fa-check"></i> Email verified on
                                                    {{ $student->email_verified_at }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Update Student
                                    </button>
                                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .input-group .btn {
            border-left: 0;
        }

        .form-check {
            padding-top: 0.5rem;
        }

        .current-image {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <script>
        // Function to toggle password visibility
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = passwordInput.nextElementSibling.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('fa-eye');
                toggleButton.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('fa-eye-slash');
                toggleButton.classList.add('fa-eye');
            }
        }

        // Form validation
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                let isValid = true;

                // Check required fields
                $('input[required], select[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });

            // Remove invalid class on input
            $('input, select').on('input change', function() {
                $(this).removeClass('is-invalid');
            });
        });
    </script>
@endpush
