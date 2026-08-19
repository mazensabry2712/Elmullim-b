@extends('panel.layouts.index')

@section('title', 'Edit Teacher | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Teacher</h3>
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
                        <a href="{{ route('teachers.index') }}">Teachers</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Teacher</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
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
                                <h4 class="card-title">Edit Teacher Information</h4>
                                <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Teachers
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Personal Information Section -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">Personal Information</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $teacher->name) }}"
                                                placeholder="Enter teacher's full name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $teacher->email) }}"
                                                placeholder="Enter email address" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}"
                                                placeholder="Enter phone number">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                                name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male"
                                                    {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                                placeholder="Enter full address">{{ old('address', $teacher->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="4" placeholder="Enter teacher description or bio">{{ old('description', $teacher->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Professional Information Section -->
                                <hr class="my-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">Professional Information</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_level_id" class="form-label">Education Level</label>
                                            <select class="form-select @error('education_level_id') is-invalid @enderror"
                                                id="education_level_id" name="education_level_id">
                                                <option value="">Select Education Level</option>
                                                @foreach ($educationLevels as $level)
                                                    <option value="{{ $level->id }}"
                                                        {{ old('education_level_id', $teacher->education_level_id) == $level->id ? 'selected' : '' }}>
                                                        {{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('education_level_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_type" class="form-label">Course Type</label>
                                            <select class="form-select @error('course_type') is-invalid @enderror"
                                                id="course_type" name="course_type">
                                                <option value="">Select Course Type</option>
                                                <option value="online"
                                                    {{ old('course_type', $teacher->course_type) == 'online' ? 'selected' : '' }}>
                                                    Online</option>
                                                <option value="offline"
                                                    {{ old('course_type', $teacher->course_type) == 'offline' ? 'selected' : '' }}>
                                                    Offline</option>
                                                <option value="hybrid"
                                                    {{ old('course_type', $teacher->course_type) == 'hybrid' ? 'selected' : '' }}>
                                                    Hybrid</option>
                                            </select>
                                            @error('course_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="experince" class="form-label">Experience (Years)</label>
                                            <input type="number"
                                                class="form-control @error('experince') is-invalid @enderror"
                                                id="experince" name="experince"
                                                value="{{ old('experince', $teacher->experince) }}"
                                                placeholder="Enter years of experience" min="0">
                                            @error('experince')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qualification" class="form-label">Qualification</label>
                                            <input type="text"
                                                class="form-control @error('qualification') is-invalid @enderror"
                                                id="qualification" name="qualification"
                                                value="{{ old('qualification', $teacher->qualification) }}"
                                                placeholder="Enter qualification (e.g., Bachelor's Degree)">
                                            @error('qualification')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- File Uploads Section -->
                                <hr class="my-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">File Uploads</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input type="file"
                                                class="form-control @error('profile_image') is-invalid @enderror"
                                                id="profile_image" name="profile_image" accept="image/*">
                                            <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF. Max size:
                                                2MB</small>
                                            @error('profile_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($teacher->profile_image)
                                                <div class="mt-2">
                                                    <p class="text-muted mb-1">Current Image:</p>
                                                    <img src="{{ asset('storage/' . $teacher->profile_image) }}"
                                                        alt="{{ $teacher->name }}" class="img-thumbnail"
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cv" class="form-label">CV/Resume</label>
                                            <input type="file" class="form-control @error('cv') is-invalid @enderror"
                                                id="cv" name="cv" accept=".pdf,.doc,.docx">
                                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX. Max size:
                                                5MB</small>
                                            @error('cv')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($teacher->cv)
                                                <div class="mt-2">
                                                    <p class="text-muted mb-1">Current CV:</p>
                                                    <a href="{{ asset('storage/' . $teacher->cv) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-download"></i> Download Current CV
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Preview -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div id="image-preview" class="mt-2" style="display: none;">
                                                <p class="text-muted mb-1">New Image Preview:</p>
                                                <img id="preview-img" src="" alt="Preview"
                                                    class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Account Settings Section -->
                                <hr class="my-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">Account Settings</h5>
                                        <p class="text-muted mb-3">Leave password fields empty if you don't want to change
                                            the password.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="form-label">New Password</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password"
                                                    placeholder="Enter new password (leave empty to keep current)">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="togglePassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">Confirm New
                                                Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                                                <i class="fa fa-times"></i> Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Update Teacher
                                            </button>
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
        $(document).ready(function() {
            // Image preview functionality
            $('#profile_image').change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img').attr('src', e.target.result);
                        $('#image-preview').show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#image-preview').hide();
                }
            });

            // Toggle password visibility
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                var icon = $(this).find('i');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Form validation
            $('form').submit(function(e) {
                var password = $('#password').val();
                var confirmPassword = $('#password_confirmation').val();

                // Only validate password if it's filled
                if (password !== '' || confirmPassword !== '') {
                    if (password !== confirmPassword) {
                        e.preventDefault();
                        alert('Passwords do not match!');
                        return false;
                    }
                }

                // Check file sizes
                var profileImage = $('#profile_image')[0].files[0];
                var cv = $('#cv')[0].files[0];

                if (profileImage && profileImage.size > 2 * 1024 * 1024) { // 2MB
                    e.preventDefault();
                    alert('Profile image size should not exceed 2MB');
                    return false;
                }

                if (cv && cv.size > 5 * 1024 * 1024) { // 5MB
                    e.preventDefault();
                    alert('CV file size should not exceed 5MB');
                    return false;
                }
            });
        });
    </script>
@endpush
