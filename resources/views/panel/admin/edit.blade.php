@extends('panel.layouts.index')

@section('title', 'Edit User | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
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
                            <h4 class="card-title">Edit User: {{ $user->name }}</h4>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Back to Users
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Current Profile Image -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Current Profile Image</label>
                                    <div class="current-image-container">
                                        @if($user->profile_image)
                                            <img src="{{ asset('storage/' . $user->profile_image) }}"
                                                 alt="Current Profile"
                                                 id="current-image"
                                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
                                        @else
                                            <div id="current-image" class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                                 style="width: 100px; height: 100px; color: white; font-size: 24px; margin-bottom: 10px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <label for="profile_image" class="form-label">Change Profile Image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                    <small class="form-text text-muted">Leave empty to keep current image</small>
                                </div>

                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="form-text text-muted">Leave empty to keep current password</small>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $user->description) }}</textarea>
                                </div>

                                <!-- Email Verified -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="email_verified_at" name="email_verified_at" value="1"
                                               {{ old('email_verified_at', $user->email_verified_at) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="email_verified_at">
                                            Email is verified
                                        </label>
                                    </div>
                                    @if($user->email_verified_at)
                                        <small class="form-text text-muted">
                                            Email verified at: {{ $user->email_verified_at->format('d M Y, H:i') }}
                                        </small>
                                    @endif
                                </div>

                                <!-- Account Info -->
                                <div class="col-md-12 mb-3">
                                    <div class="alert alert-info">
                                        <h6><i class="fa fa-info-circle"></i> Account Information</h6>
                                        <p class="mb-1"><strong>Created:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                                        <p class="mb-0"><strong>Last Updated:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Update User
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                                <a href="{{ route('users.show', $user) }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i> View User
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
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
<style>
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    .card-action {
        padding: 20px;
        border-top: 1px solid #ebedf2;
        background-color: #f8f9fa;
    }
    .current-image-container {
        margin-bottom: 15px;
    }
    .alert-info {
        border-left: 4px solid #17a2b8;
    }
</style>
@endpush

@push('script')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
<script src="{{asset('assets/js/setting-demo2.js')}}"></script>

<script>
    // Image preview functionality
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update current image preview
                const currentImage = document.getElementById('current-image');
                if (currentImage) {
                    if (currentImage.tagName === 'IMG') {
                        currentImage.src = e.target.result;
                    } else {
                        // Replace div with img
                        const newImg = document.createElement('img');
                        newImg.id = 'current-image';
                        newImg.src = e.target.result;
                        newImg.style.cssText = 'width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;';
                        currentImage.parentNode.replaceChild(newImg, currentImage);
                    }
                }
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        // Only validate if password is entered
        if (password || confirmPassword) {
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return false;
            }
        }
    });

    // Show/hide password confirmation based on password input
    document.getElementById('password').addEventListener('input', function() {
        const confirmPasswordGroup = document.getElementById('password_confirmation').closest('.col-md-6');
        if (this.value.length > 0) {
            confirmPasswordGroup.style.display = 'block';
            document.getElementById('password_confirmation').required = true;
        } else {
            confirmPasswordGroup.style.display = 'block'; // Keep visible but not required
            document.getElementById('password_confirmation').required = false;
        }
    });
</script>
@endpush
