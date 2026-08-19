@extends('panel.layouts.index')

@section('title', 'Edit Quiz | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
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
                                <h4 class="card-title">Edit Quiz: {{ $quiz->title }}</h4>
                                <a href="{{ route('quizzes.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Quizzes
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('quizzes.update', $quiz) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Quiz Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title', $quiz->title) }}"
                                                placeholder="Enter quiz title" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="academic_year">Academic Year <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('academic_year') is-invalid @enderror"
                                                id="academic_year" name="academic_year"
                                                value="{{ old('academic_year', $quiz->academic_year) }}"
                                                placeholder="e.g.,one,two" required>
                                            @error('academic_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject_id">Subject <span class="text-danger">*</span></label>
                                            <select class="form-control @error('subject_id') is-invalid @enderror"
                                                id="subject_id" name="subject_id" required>
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}"
                                                        {{ old('subject_id', $quiz->subject_id) == $subject->id ? 'selected' : '' }}>
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subject_id')
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
                                                        {{ old('teacher_id', $quiz->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_level_id">Education Level <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control @error('education_level_id') is-invalid @enderror"
                                                id="education_level_id" name="education_level_id" required>
                                                <option value="">Select Education Level</option>
                                                @foreach ($educationLevels as $level)
                                                    <option value="{{ $level->id }}"
                                                        {{ old('education_level_id', $quiz->education_level_id) == $level->id ? 'selected' : '' }}>
                                                        {{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('education_level_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date">Quiz Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                                id="date" name="date" value="{{ old('date', $quiz->date) }}"
                                                required>
                                            @error('date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="start_time">Start Time <span class="text-danger">*</span></label>
                                            <input type="time"
                                                class="form-control @error('start_time') is-invalid @enderror"
                                                id="start_time" name="start_time"
                                                value="{{ old('start_time', $quiz->start_time) }}" required>
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="end_time">End Time <span class="text-danger">*</span></label>
                                            <input type="time"
                                                class="form-control @error('end_time') is-invalid @enderror"
                                                id="end_time" name="end_time"
                                                value="{{ old('end_time', $quiz->end_time) }}" required>
                                            @error('end_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="time_limit">Time Limit (minutes) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('time_limit') is-invalid @enderror"
                                                id="time_limit" name="time_limit"
                                                value="{{ old('time_limit', $quiz->time_limit) }}" min="1"
                                                max="300" placeholder="e.g., 60" required>
                                            @error('time_limit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Duration in minutes for the quiz</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Update Quiz
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Quiz Information Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title">Quiz Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Created Date</span>
                                            <span class="info-box-number">{{ $quiz->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Duration</span>
                                            <span class="info-box-number">{{ $quiz->time_limit }} min</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning">
                                            <i class="fa fa-book"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Subject</span>
                                            <span class="info-box-number">{{ $quiz->subject->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Level</span>
                                            <span
                                                class="info-box-number">{{ $quiz->educationLevel->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
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
        .info-box {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info-box-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            margin-right: 15px;
            font-size: 24px;
        }

        .info-box-content {
            flex: 1;
        }

        .info-box-text {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .info-box-number {
            display: block;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .badge-lg {
            font-size: 14px;
            padding: 8px 16px;
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
            // Validate end time is after start time
            $('#start_time, #end_time').on('change', function() {
                var startTime = $('#start_time').val();
                var endTime = $('#end_time').val();

                if (startTime && endTime && startTime >= endTime) {
                    $('#end_time').addClass('is-invalid');
                    if (!$('#end_time').next('.invalid-feedback').length) {
                        $('#end_time').after(
                            '<div class="invalid-feedback">End time must be after start time</div>');
                    }
                } else {
                    $('#end_time').removeClass('is-invalid');
                    $('#end_time').next('.invalid-feedback').remove();
                }
            });
        });
    </script>
@endpush
