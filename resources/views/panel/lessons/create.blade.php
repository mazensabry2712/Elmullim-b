@extends('panel.layouts.index')

@section('title', 'Create Lesson | Elmullim')

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

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Create New Lesson</h4>
                                <a href="{{ route('lessons.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Lessons
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   id="title" name="title" value="{{ old('title') }}"
                                                   placeholder="Enter lesson title" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Teacher -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_id">Teacher <span class="text-danger">*</span></label>
                                            <select class="form-control @error('teacher_id') is-invalid @enderror"
                                                    id="teacher_id" name="teacher_id" required>
                                                <option value="">Select Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                            {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                                       id="price" name="price" value="{{ old('price') }}"
                                                       placeholder="0.00" min="0" step="0.01" required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Enter 0 for free lessons</small>
                                        </div>
                                    </div>

                                    <!-- Logo -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                                   id="logo" name="logo" accept="image/*">
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                      id="description" name="description" rows="4"
                                                      placeholder="Enter lesson description...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Logo Preview -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div id="logo-preview" class="mt-3" style="display: none;">
                                                <label>Logo Preview:</label>
                                                <div class="border rounded p-3 text-center">
                                                    <img id="preview-image" src="#" alt="Logo Preview"
                                                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Create Lesson
                                    </button>
                                    <a href="{{ route('lessons.index') }}" class="btn btn-secondary">
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
        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        #logo-preview {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Logo preview functionality
            $('#logo').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-image').attr('src', e.target.result);
                        $('#logo-preview').show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#logo-preview').hide();
                }
            });

            // Form validation
            $('form').on('submit', function(e) {
                let isValid = true;

                // Check required fields
                const requiredFields = ['title', 'teacher_id', 'price'];
                requiredFields.forEach(function(field) {
                    const input = $(`#${field}`);
                    if (!input.val()) {
                        input.addClass('is-invalid');
                        isValid = false;
                    } else {
                        input.removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });

            // Remove invalid class on input change
            $('.form-control').on('input change', function() {
                $(this).removeClass('is-invalid');
            });
        });
    </script>
@endpush
