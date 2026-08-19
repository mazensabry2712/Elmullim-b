@extends('panel.layouts.index')

@section('title', 'Edit Course | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Course: {{ $course->title }}</h4>
                                <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Courses
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('courses.update', $course) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Course Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" placeholder="Enter course title"
                                                value="{{ old('title', $course->title) }}">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number"
                                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                                    name="price" placeholder="0.00" step="0.01" min="0"
                                                    value="{{ old('price', $course->price) }}">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_category_id">Sub Category <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control @error('sub_category_id') is-invalid @enderror"
                                                id="sub_category_id" name="sub_category_id">
                                                <option value="">Select Sub Category</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('sub_category_id', $course->sub_category_id) == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sub_category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_id">Teacher <span class="text-danger">*</span></label>
                                            <select class="form-control @error('teacher_id') is-invalid @enderror"
                                                id="teacher_id" name="teacher_id">
                                                <option value="">Select Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                        {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="level">Level <span class="text-danger">*</span></label>
                                            <select class="form-control @error('level') is-invalid @enderror" id="level"
                                                name="level">
                                                <option value="">Select Level</option>
                                                <option value="beginner"
                                                    {{ old('level', $course->level->value) == 'beginner' ? 'selected' : '' }}>
                                                    Beginner
                                                </option>
                                                <option value="intermediate"
                                                    {{ old('level', $course->level->value) == 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate
                                                </option>
                                                <option value="advanced"
                                                    {{ old('level', $course->level->value) == 'advanced' ? 'selected' : '' }}>
                                                    Advanced
                                                </option>
                                                <option value="expert"
                                                    {{ old('level', $course->level->value) == 'expert' ? 'selected' : '' }}>
                                                    Expert
                                                </option>
                                            </select>
                                            @error('level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Course Image</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*">
                                            <small class="form-text text-muted">
                                                Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                                            </small>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($course->image)
                                                <div class="mt-2">
                                                    <label class="form-label">Current Image:</label>
                                                    <div>
                                                        <img src="{{ asset('storage/' . $course->image) }}"
                                                            alt="{{ $course->title }}" id="currentImage"
                                                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="5" placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i>
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i>
                                            Update Course
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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
@endpush

@push('script')
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update current image or create new preview
                    let currentImage = document.getElementById('currentImage');
                    if (currentImage) {
                        currentImage.src = e.target.result;
                    } else {
                        // Create new preview
                        let preview = document.createElement('img');
                        preview.id = 'imagePreview';
                        preview.style.cssText =
                            'width: 100px; height: 100px; object-fit: cover; border-radius: 5px; margin-top: 10px;';
                        preview.src = e.target.result;
                        document.getElementById('image').parentNode.appendChild(preview);
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = ['title', 'description', 'sub_category_id', 'teacher_id', 'level', 'price'];

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    </script>
@endpush
