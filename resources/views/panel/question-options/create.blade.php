@extends('panel.layouts.index')

@section('title', 'Create Question Option | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Create Question Option</h3>
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
                        <a href="{{ route('question-options.index') }}">Question Options</a>
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
                <div class="col-md-8 offset-md-2">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
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
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-plus me-2"></i>
                                    Create New Question Option
                                </h4>
                                <a href="{{ route('question-options.index') }}"
                                    class="btn btn-outline-secondary btn-sm ms-auto">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('question-options.store') }}" method="POST" id="create-option-form">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="form-label">
                                                <i class="fas fa-tag me-1"></i>
                                                Option Title <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title') }}"
                                                placeholder="Enter option title..." required>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Enter the text for this answer option.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="question_id" class="form-label">
                                                <i class="fas fa-question-circle me-1"></i>
                                                Question <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select @error('question_id') is-invalid @enderror"
                                                id="question_id" name="question_id" required>
                                                <option value="">-- Select Question --</option>
                                                @foreach ($questions as $question)
                                                    <option value="{{ $question->id }}"
                                                        {{ old('question_id') == $question->id ? 'selected' : '' }}>
                                                        {{ Str::limit($question->title, 80) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('question_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Select the question this option belongs to.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Is Correct Answer? <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-check-container">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_correct"
                                                        id="correct_yes" value="1"
                                                        {{ old('is_correct') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="correct_yes">
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check me-1"></i>
                                                            Yes, this is correct
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_correct"
                                                        id="correct_no" value="0"
                                                        {{ old('is_correct') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="correct_no">
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-times me-1"></i>
                                                            No, this is incorrect
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('is_correct')
                                                <div class="text-danger mt-1">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Mark whether this option is the correct answer.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('question-options.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>
                                            Cancel
                                        </a>
                                        <div>
                                            <button type="reset" class="btn btn-outline-warning me-2">
                                                <i class="fas fa-undo me-2"></i>
                                                Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>
                                                Create Option
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Help & Tips
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fas fa-lightbulb me-2"></i>Tips for Creating Options:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Keep options concise and clear
                                        </li>
                                        <li><i class="fas fa-check text-success me-2"></i>Make sure only one option is
                                            correct</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Avoid obvious wrong answers</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Use consistent formatting</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Important Notes:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-info text-info me-2"></i>Each question should have multiple
                                            options</li>
                                        <li><i class="fas fa-info text-info me-2"></i>Mark the correct answer carefully
                                        </li>
                                        <li><i class="fas fa-info text-info me-2"></i>Options can be edited after creation
                                        </li>
                                        <li><i class="fas fa-info text-info me-2"></i>Consider distractors for better
                                            assessment</li>
                                    </ul>
                                </div>
                            </div>
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
        .card-title {
            color: #1f2937;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .form-check-container {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .form-check {
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            margin-top: 0.25rem;
        }

        .form-check-label {
            cursor: pointer;
            margin-left: 0.5rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
            border-radius: 0.5rem;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        .form-actions {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-info {
            color: #17a2b8 !important;
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
            color: #3b82f6;
            text-decoration: none;
        }

        .breadcrumbs a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.4.8 1.6 3.2-1.2-3.2-.4-.8z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Form validation
            $('#create-option-form').on('submit', function(e) {
                let isValid = true;
                let errorMessages = [];

                // Validate title
                const title = $('#title').val().trim();
                if (!title) {
                    isValid = false;
                    errorMessages.push('Option title is required.');
                    $('#title').addClass('is-invalid');
                } else {
                    $('#title').removeClass('is-invalid');
                }

                // Validate question selection
                const questionId = $('#question_id').val();
                if (!questionId) {
                    isValid = false;
                    errorMessages.push('Please select a question.');
                    $('#question_id').addClass('is-invalid');
                } else {
                    $('#question_id').removeClass('is-invalid');
                }

                // Validate is_correct radio
                const isCorrect = $('input[name="is_correct"]:checked').val();
                if (isCorrect === undefined) {
                    isValid = false;
                    errorMessages.push('Please specify if this is the correct answer.');
                }

                if (!isValid) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Validation Error',
                        html: errorMessages.join('<br>'),
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }

                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Creating...');
                submitBtn.prop('disabled', true);
            });

            // Auto-hide error messages
            setTimeout(function() {
                $('.alert-danger').fadeOut('slow');
            }, 5000);

            // Reset form
            $('button[type="reset"]').on('click', function() {
                Swal.fire({
                    title: 'Reset Form?',
                    text: 'This will clear all form data.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, reset it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#create-option-form')[0].reset();
                        $('.form-control, .form-select').removeClass('is-invalid');

                        Swal.fire({
                            title: 'Form Reset!',
                            text: 'All form data has been cleared.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });

            // Preview selected question
            $('#question_id').on('change', function() {
                const selectedText = $(this).find('option:selected').text();
                if (selectedText && selectedText !== '-- Select Question --') {
                    $(this).next('.form-text').html(
                        `<i class="fas fa-info-circle me-1"></i>Selected: <strong>${selectedText}</strong>`
                    );
                } else {
                    $(this).next('.form-text').html('Select the question this option belongs to.');
                }
            });

            // Character counter for title
            $('#title').on('input', function() {
                const maxLength = 255;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;

                let counterHtml =
                    `<i class="fas fa-info-circle me-1"></i>Characters: ${currentLength}/${maxLength}`;

                if (remaining < 50) {
                    counterHtml =
                        `<i class="fas fa-exclamation-triangle me-1"></i><span class="text-warning">Characters: ${currentLength}/${maxLength}</span>`;
                }

                $(this).next('.form-text').html(counterHtml);
            });

            // Add visual feedback for radio buttons
            $('input[name="is_correct"]').on('change', function() {
                $('.form-check-label .badge').removeClass('badge-success badge-secondary');

                if ($(this).val() === '1') {
                    $(this).next('.form-check-label').find('.badge').addClass('badge-success');
                    $(this).closest('.form-check').siblings().find('.badge').addClass('badge-secondary');
                } else {
                    $(this).next('.form-check-label').find('.badge').addClass('badge-secondary');
                    $(this).closest('.form-check').siblings().find('.badge').addClass('badge-success');
                }
            });
        });
    </script>
@endpush
