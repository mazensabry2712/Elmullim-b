@extends('panel.layouts.index')

@section('title', 'Add Parent | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add New Parent</h4>
                                <a href="{{ route('families.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('families.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Profile Image -->
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input type="file"
                                                class="form-control @error('profile_image') is-invalid @enderror"
                                                id="profile_image" name="profile_image" accept="image/*"
                                                onchange="previewImage(this)">
                                            @error('profile_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="mt-2">
                                                <img id="image-preview" src="#" alt="Preview" class="rounded-circle"
                                                    style="width: 100px; height: 100px; object-fit: cover; display: none;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                                name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Education Level -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_level_id" class="form-label">Education Level</label>
                                            <select class="form-select @error('education_level_id') is-invalid @enderror"
                                                id="education_level_id" name="education_level_id">
                                                <option value="">Select Education Level</option>
                                                @foreach ($educationLevels as $level)
                                                    <option value="{{ $level->id }}"
                                                        {{ old('education_level_id') == $level->id ? 'selected' : '' }}>
                                                        {{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('education_level_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="4" placeholder="Enter description...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" id="email_verified_at"
                                                name="email_verified_at" {{ old('email_verified_at') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="email_verified_at">
                                                Mark email as verified
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Save Parent
                                            </button>
                                            <a href="{{ route('families.index') }}" class="btn btn-secondary ms-2">
                                                <i class="fa fa-times"></i> Cancel
                                            </a>
                                        </div>
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

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
