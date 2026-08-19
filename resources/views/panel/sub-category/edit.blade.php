@extends('panel.layouts.index')

@section('title', 'Edit Sub Category | Elmullim')

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
                            <h4 class="card-title">Edit Sub Category: {{ $subcategory->name }}</h4>
                            <div class="ms-auto">
                                {{-- <a href="{{ route('subcategories.show', $subcategory) }}" class="btn btn-info btn-round me-2">
                                    <i class="fa fa-eye"></i>
                                    View
                                </a> --}}
                                <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary btn-round">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub-categories.update', $subcategory) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Sub Category Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{ old('name', $subcategory->name) }}"
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
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
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
                                          placeholder="Enter sub category description">{{ old('description', $subcategory->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Sub Category Image</label>

                                @if($subcategory->image)
                                <div class="mb-3">
                                    <label class="form-label">Current Image:</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $subcategory->image) }}"
                                             alt="{{ $subcategory->name }}"
                                             class="img-thumbnail"
                                             style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                                @endif

                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/*">
                                <small class="form-text text-muted">
                                    Allowed formats: JPG, PNG, GIF. Max size: 2MB. Leave empty to keep current image.
                                </small>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            @if($subcategory->image)
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="remove_image"
                                           id="remove_image"
                                           value="1">
                                    <label class="form-check-label text-danger" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_active"
                                           id="is_active"
                                           value="1"
                                           {{ old('is_active', $subcategory->is_active ?? 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Update Sub Category
                                </button>
                                <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                                {{-- <a href="{{ route('subcategories.show', $subcategory) }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i> View
                                </a> --}}
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Update History Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Update Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Created:</strong> {{ $subcategory->created_at ? $subcategory->created_at->format('M d, Y \a\t g:i A') : 'Not available' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Last Updated:</strong> {{ $subcategory->updated_at ? $subcategory->updated_at->format('M d, Y \a\t g:i A') : 'Not available' }}</p>
                            </div>
                        </div>
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
    // Image preview for new image
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
                        <label class="form-label">New Image Preview:</label>
                        <div>
                            <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>
                `;
                $('#image').after(preview);
            }
            reader.readAsDataURL(file);
        }
    });

    // Handle remove image checkbox
    $('#remove_image').change(function() {
        if ($(this).is(':checked')) {
            $('#image').val('');
            $('#imagePreview').remove();
            alert('Current image will be removed when you save the form.');
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
