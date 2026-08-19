@extends('panel.layouts.index')

@section('title', 'Edit Subject | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Subject</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('subjects.index') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}">Subjects</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Subject</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                                <h4 class="card-title">Edit Subject</h4>
                                <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Subjects
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('subjects.update', $subject) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Subject Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $subject->name) }}"
                                                placeholder="Enter subject name" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_level_id">Education Level <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('education_level_id') is-invalid @enderror"
                                                id="education_level_id" name="education_level_id" required>
                                                <option value="">Select Education Level</option>
                                                @foreach ($educationLevels as $level)
                                                    <option value="{{ $level->id }}"
                                                        {{ old('education_level_id', $subject->education_level_id) == $level->id ? 'selected' : '' }}>
                                                        {{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('education_level_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Subject Image</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*"
                                                onchange="previewImage(this)">
                                            <small class="form-text text-muted">
                                                Supported formats: JPG, JPEG, PNG, GIF. Max size: 2MB
                                            </small>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Current/Preview Image</label>
                                            <div class="mt-2">
                                                @if ($subject->image)
                                                    <img id="currentImage" src="{{ asset('storage/' . $subject->image) }}"
                                                        alt="{{ $subject->name }}" class="img-thumbnail"
                                                        style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                                @else
                                                    <div id="noImagePlaceholder"
                                                        class="border border-dashed rounded p-3 text-center text-muted"
                                                        style="width: 200px; height: 150px; display: flex; align-items: center; justify-content: center;">
                                                        <span>No image uploaded</span>
                                                    </div>
                                                @endif
                                                <img id="imagePreview" class="img-thumbnail mt-2"
                                                    style="max-width: 200px; max-height: 200px; object-fit: cover; display: none;"
                                                    alt="Image Preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="remove_image"
                                                    name="remove_image" value="1">
                                                <label class="form-check-label" for="remove_image">
                                                    Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        Update Subject
                                    </button>
                                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-times"></i>
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const currentImage = document.getElementById('currentImage');
            const noImagePlaceholder = document.getElementById('noImagePlaceholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';

                    // Hide current image and placeholder
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                    if (noImagePlaceholder) {
                        noImagePlaceholder.style.display = 'none';
                    }
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';

                // Show current image or placeholder again
                if (currentImage) {
                    currentImage.style.display = 'block';
                }
                if (noImagePlaceholder) {
                    noImagePlaceholder.style.display = 'flex';
                }
            }
        }

        // Handle remove image checkbox
        document.getElementById('remove_image').addEventListener('change', function() {
            const currentImage = document.getElementById('currentImage');
            const noImagePlaceholder = document.getElementById('noImagePlaceholder');

            if (this.checked) {
                if (currentImage) {
                    currentImage.style.opacity = '0.3';
                }
            } else {
                if (currentImage) {
                    currentImage.style.opacity = '1';
                }
            }
        });
    </script>

@endsection
