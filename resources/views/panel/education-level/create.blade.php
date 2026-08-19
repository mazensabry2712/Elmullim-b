@extends('panel.layouts.index')

@section('title', 'Create Education Level | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Create Education Level</h3>
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
                    <a href="{{ route('educationlevel.index') }}">Education Levels</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <span>Create</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">
                                <i class="fas fa-plus me-2"></i>
                                Add New Education Level
                            </h4>
                            <a href="{{ route('educationlevel.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('educationlevel.store') }}" method="POST" id="education-level-form">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-layer-group me-2"></i>
                                            Level Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="Enter education level name"
                                               maxlength="255"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Enter a unique name for this education level (2-255 characters)
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="education_system_id" class="form-label">
                                            <i class="fas fa-graduation-cap me-2"></i>
                                            Education System <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('education_system_id') is-invalid @enderror"
                                                id="education_system_id"
                                                name="education_system_id"
                                                required>
                                            <option value="">Select Education System</option>
                                            @foreach($educationSystems as $system)
                                                <option value="{{ $system->id }}"
                                                        {{ old('education_system_id') == $system->id ? 'selected' : '' }}>
                                                    {{ $system->name }}
                                                    @if($system->country)
                                                        ({{ $system->country->name }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('education_system_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Select the education system this level belongs to
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">
                                            <i class="fas fa-file-alt me-2"></i>
                                            Description <span class="text-muted">(Optional)</span>
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description"
                                                  name="description"
                                                  rows="4"
                                                  placeholder="Enter description for this education level"
                                                  maxlength="1000">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            <span id="char-count">0</span>/1000 characters
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Section -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <i class="fas fa-eye me-2"></i>
                                                Preview
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-2">
                                                    <div class="avatar-initial bg-primary rounded-circle">
                                                        <i class="fas fa-layer-group"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong id="preview-name">Education Level Name</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-graduation-cap me-1"></i>
                                                        <span id="preview-system">Education System</span>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <small class="text-muted" id="preview-description">
                                                    Description will appear here...
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('educationlevel.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>
                                            Create Education Level
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
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
<style>
    .card-title {
        color: #1f2937;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
        color: #374151;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .avatar {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-xs {
        width: 1.5rem;
        height: 1.5rem;
        font-size: 0.75rem;
    }

    .avatar-initial {
        background-color: var(--bs-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .breadcrumbs {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .breadcrumbs li {
        display: inline-block;
    }

    .breadcrumbs .separator {
        margin: 0 0.5rem;
        color: #6b7280;
    }

    .breadcrumbs a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumbs a:hover {
        text-decoration: underline;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    #char-count {
        font-weight: 500;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc3545;
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
    $(document).ready(function() {
        // Character count for description
        $('#description').on('input', function() {
            const currentLength = $(this).val().length;
            $('#char-count').text(currentLength);

            if (currentLength > 900) {
                $('#char-count').addClass('text-warning');
            } else if (currentLength > 950) {
                $('#char-count').addClass('text-danger').removeClass('text-warning');
            } else {
                $('#char-count').removeClass('text-warning text-danger');
            }
        });

        // Real-time preview updates
        $('#name').on('input', function() {
            const value = $(this).val() || 'Education Level Name';
            $('#preview-name').text(value);
        });

        $('#education_system_id').on('change', function() {
            const selectedText = $(this).find('option:selected').text() || 'Education System';
            $('#preview-system').text(selectedText);
        });

        $('#description').on('input', function() {
            const value = $(this).val() || 'Description will appear here...';
            $('#preview-description').text(value);
        });

        // Form validation
        $('#education-level-form').on('submit', function(e) {
            let isValid = true;
            const name = $('#name').val().trim();
            const educationSystemId = $('#education_system_id').val();

            // Validate name
            if (name.length < 2) {
                $('#name').addClass('is-invalid');
                isValid = false;
            } else {
                $('#name').removeClass('is-invalid');
            }

            // Validate education system
            if (!educationSystemId) {
                $('#education_system_id').addClass('is-invalid');
                isValid = false;
            } else {
                $('#education_system_id').removeClass('is-invalid');
            }

            if (!isValid) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('.is-invalid').first().offset().top - 100
                }, 500);
            }
        });

        // Auto-hide error messages
        setTimeout(function() {
            $('.alert-danger').fadeOut('slow');
        }, 5000);

        // Trigger initial preview update
        $('#name').trigger('input');
        $('#education_system_id').trigger('change');
        $('#description').trigger('input');
    });
</script>

@endpush
