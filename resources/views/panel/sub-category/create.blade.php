@extends('panel.layouts.index')

@section('title', 'Add Sub Category | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add New Sub Category</h4>
                            <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub-categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Sub Category Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="Enter sub category name"
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
                                        <label for="category_id">Parent Category <span class="text-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                                id="category_id"
                                                name="category_id"
                                                required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="4"
                                          placeholder="Enter sub category description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Sub Category Image</label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/*">
                                <small class="form-text text-muted">
                                    Allowed formats: JPG, PNG, GIF. Max size: 2MB
                                </small>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_active"
                                           id="is_active"
                                           value="1"
                                           {{ old('is_active', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Create Sub Category
                                </button>
                                <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
$(document).ready(function() {
    // Image preview
    $('#image').change(function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Remove existing preview
                $('#imagePreview').remove();

                // Add new preview
                var preview = `
                    <div id="imagePreview" class="mt-2">
                        <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                    </div>
                `;
                $('#image').after(preview);
            }
            reader.readAsDataURL(file);
        }
    });

    // Form validation
    $('form').on('submit', function(e) {
        var name = $('#name').val().trim();
        var category_id = $('#category_id').val();

        if (!name) {
            alert('Please enter sub category name');
            e.preventDefault();
            return false;
        }

        if (!category_id) {
            alert('Please select a parent category');
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
