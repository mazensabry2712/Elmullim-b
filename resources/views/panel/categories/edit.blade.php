@extends('panel.layouts.index')

@section('title', 'Edit Category | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Categories</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('panel.index') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Category</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Validation Error!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Category: {{ $record->name }}</h4>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Categories
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name', $record->name) }}"
                                                   placeholder="Enter category name"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Category Image</label>
                                            <input type="file"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   id="image"
                                                   name="image"
                                                   accept="image/*"
                                                   onchange="previewImage(this)">
                                            <small class="form-text text-muted">
                                                Allowed formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                                            </small>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                      id="description"
                                                      name="description"
                                                      rows="4"
                                                      placeholder="Enter category description">{{ old('description', $record->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Image -->
                                @if($record->image)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Current Image</label>
                                            <div class="text-center">
                                                <img src="{{ asset('storage/' . $record->image) }}"
                                                     alt="{{ $record->name }}"
                                                     class="img-fluid rounded"
                                                     style="max-width: 200px; max-height: 200px; border: 2px solid #dee2e6;">
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeCurrentImage()">
                                                        <i class="fa fa-trash"></i> Remove Current Image
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- New Image Preview -->
                                <div class="row" id="imagePreview" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">New Image Preview</label>
                                            <div class="text-center">
                                                <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-width: 200px; max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Update Category
                                    </button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                    <a href="{{ route('categories.show', $record->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i> View Category
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
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        #preview {
            border: 2px dashed #dee2e6;
            padding: 10px;
        }

        .current-image {
            position: relative;
            display: inline-block;
        }

        .remove-image-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(220, 53, 69, 0.8);
            border: none;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
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
        // Image preview function
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        }

        // Remove current image function
        function removeCurrentImage() {
            if (confirm('Are you sure you want to remove the current image?')) {
                // Hide current image section
                const currentImageSection = document.querySelector('.form-group:has(img[src*="storage"])');
                if (currentImageSection) {
                    currentImageSection.style.display = 'none';
                }

                // Add hidden input to indicate image removal
                const form = document.querySelector('form');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'remove_image';
                hiddenInput.value = '1';
                form.appendChild(hiddenInput);

                // Show success message
                alert('Current image will be removed when you save the form.');
            }
        }

        // Form validation
        $(document).ready(function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush
