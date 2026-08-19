@extends('panel.layouts.index')

@section('title', 'Add Lecture | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add New Lecture</h4>
                                <a href="{{ route('lecture.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Lectures
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lecture.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   id="title" name="title" value="{{ old('title') }}"
                                                   placeholder="Enter lecture title" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="content_id">Content <span class="text-danger">*</span></label>
                                            <select class="form-control @error('content_id') is-invalid @enderror"
                                                    id="content_id" name="content_id" required>
                                                <option value="">Select Content</option>
                                                @foreach($contents as $content)
                                                    <option value="{{ $content->id }}"
                                                            {{ old('content_id') == $content->id ? 'selected' : '' }}>
                                                        {{ $content->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('content_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Duration -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Duration (minutes)</label>
                                            <input type="number" class="form-control @error('duration') is-invalid @enderror"
                                                   id="duration" name="duration" value="{{ old('duration') }}"
                                                   placeholder="Enter duration in minutes" min="1">
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Video -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="video">Video File</label>
                                            <input type="file" class="form-control @error('video') is-invalid @enderror"
                                                   id="video" name="video" accept="video/*">
                                            @error('video')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Supported formats: MP4, AVI, MOV (Max: 100MB)</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                      id="description" name="description" rows="4"
                                                      placeholder="Enter lecture description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Video Preview -->
                                <div class="row" id="video-preview-container" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Video Preview</label>
                                            <div class="video-preview-wrapper">
                                                <video id="video-preview" controls style="width: 100%; max-width: 400px; height: 250px; border-radius: 8px;">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Create Lecture
                                            </button>
                                            <a href="{{ route('lecture.index') }}" class="btn btn-secondary ms-2">
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
    <style>
        .video-preview-wrapper {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
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
        $(document).ready(function() {
            // Video file preview
            $('#video').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    $('#video-preview').attr('src', url);
                    $('#video-preview-container').show();
                } else {
                    $('#video-preview-container').hide();
                }
            });

            // Form validation
            $('form').on('submit', function(e) {
                let isValid = true;

                // Check required fields
                const title = $('#title').val().trim();
                const contentId = $('#content_id').val();

                if (!title) {
                    $('#title').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#title').removeClass('is-invalid');
                }

                if (!contentId) {
                    $('#content_id').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#content_id').removeClass('is-invalid');
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });

            // Real-time validation
            $('#title, #content_id').on('input change', function() {
                if ($(this).val().trim()) {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
