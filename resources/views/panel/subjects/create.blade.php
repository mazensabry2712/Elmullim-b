@extends('panel.layouts.index')

@section('title', 'Add Subject | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add New Subject</h3>
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
                    <a href="#">Add Subject</a>
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
                            <h4 class="card-title">Add New Subject</h4>
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Back to Subjects
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Subject Name <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            placeholder="Enter subject name"
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
                                        <label for="education_level_id">Education Level <span class="text-danger">*</span></label>
                                        <select
                                            class="form-select @error('education_level_id') is-invalid @enderror"
                                            id="education_level_id"
                                            name="education_level_id"
                                            required>
                                            <option value="">Select Education Level</option>
                                            @foreach($educationLevels as $level)
                                            <option value="{{ $level->id }}"
                                                {{ old('education_level_id') == $level->id ? 'selected' : '' }}>
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
                                        <input
                                            type="file"
                                            class="form-control @error('image') is-invalid @enderror"
                                            id="image"
                                            name="image"
                                            accept="image/*"
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
                                        <label>Image Preview</label>
                                        <div class="mt-2">
                                            <div id="noImagePlaceholder"
                                                 class="border border-dashed rounded p-3 text-center text-muted"
                                                 style="width: 200px; height: 150px; display: flex; align-items: center; justify-content: center;">
                                                <span>No image selected</span>
                                            </div>
                                            <img id="imagePreview"
                                                 class="img-thumbnail"
                                                 style="max-width: 200px; max-height: 200px; object-fit: cover; display: none;"
                                                 alt="Image Preview">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Create Subject
                                </button>
                                <button type="reset" class="btn btn-warning" onclick="resetForm()">
                                    <i class="fa fa-undo"></i>
                                    Reset
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
    const noImagePlaceholder = document.getElementById('noImagePlaceholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            noImagePlaceholder.style.display = 'none';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        noImagePlaceholder.style.display = 'flex';
    }
}

function resetForm() {
    // Reset image preview
    const preview = document.getElementById('imagePreview');
    const noImagePlaceholder = document.getElementById('noImagePlaceholder');

    preview.style.display = 'none';
    noImagePlaceholder.style.display = 'flex';

    // Reset form will automatically clear all inputs
    setTimeout(function() {
        document.getElementById('name').focus();
    }, 100);
}

// Focus on first input when page loads
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('name').focus();
});
</script>

@endsection

@push('style')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
@endpush

@push('script')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
<script src="{{asset('assets/js/setting-demo2.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<script>
$(document).ready(function() {
    // Form validation
    $('form').on('submit', function(e) {
        let isValid = true;
        let errorMessage = '';

        // Check required fields
        if (!$('#name').val().trim()) {
            isValid = false;
            errorMessage += 'Subject name is required.\n';
        }

        if (!$('#education_level_id').val()) {
            isValid = false;
            errorMessage += 'Education level is required.\n';
        }

        // Check image size if uploaded
        const imageFile = $('#image')[0].files[0];
        if (imageFile && imageFile.size > 2048000) { // 2MB
            isValid = false;
            errorMessage += 'Image size must be less than 2MB.\n';
        }

        if (!isValid) {
            e.preventDefault();
            swal("Validation Error", errorMessage, "error");
            return false;
        }
    });

    // Success message animation
    @if(session('success'))
        swal("Success!", "{{ session('success') }}", "success");
    @endif
});
</script>
@endpush
