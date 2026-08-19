@extends('panel.layouts.index')

@section('title', 'Create Question | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Create New Question</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Question Title <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control @error('title') is-invalid @enderror"
                                               id="title"
                                               name="title"
                                               value="{{ old('title') }}"
                                               placeholder="Enter question title"
                                               required>
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quiz_id">Quiz <span class="text-danger">*</span></label>
                                        <select class="form-control @error('quiz_id') is-invalid @enderror"
                                                id="quiz_id"
                                                name="quiz_id"
                                                required>
                                            <option value="">Select Quiz</option>
                                            @foreach($quizzes as $quiz)
                                                <option value="{{ $quiz->id }}"
                                                        {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>
                                                    {{ $quiz->title }}
                                                    ({{ $quiz->subject->name ?? 'N/A' }} - {{ $quiz->educationLevel->name ?? 'N/A' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('quiz_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="score">Score (Points) <span class="text-danger">*</span></label>
                                        <input type="number"
                                               class="form-control @error('score') is-invalid @enderror"
                                               id="score"
                                               name="score"
                                               value="{{ old('score') }}"
                                               placeholder="Enter score points"
                                               min="1"
                                               required>
                                        @error('score')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Enter the points this question is worth
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Quiz Information</div>
                                        </div>
                                        <div class="card-body">
                                            <div id="quiz-info" class="text-muted">
                                                <i class="fa fa-info-circle"></i> Select a quiz to view its details
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Create Question
                                </button>
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">
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

@push('style')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
<style>
    .quiz-info-card {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-top: 0.5rem;
    }
    .quiz-detail {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .quiz-detail:last-child {
        margin-bottom: 0;
    }
    .badge {
        font-size: 0.75em;
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
    // Quiz data for JavaScript
    const quizzes = @json($quizzes->map(function($quiz) {
        return [
            'id' => $quiz->id,
            'title' => $quiz->title,
            'subject' => $quiz->subject->name ?? 'N/A',
            'education_level' => $quiz->educationLevel->name ?? 'N/A',
            'academic_year' => $quiz->academic_year,
            'date' => $quiz->date,
            'start_time' => $quiz->start_time,
            'end_time' => $quiz->end_time,
            'time_limit' => $quiz->time_limit
        ];
    }));

    // Handle quiz selection change
    $('#quiz_id').on('change', function() {
        const quizId = $(this).val();
        const quizInfo = $('#quiz-info');

        if (quizId) {
            const quiz = quizzes.find(q => q.id == quizId);
            if (quiz) {
                const formattedDate = new Date(quiz.date).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });

                quizInfo.html(`
                    <div class="quiz-info-card">
                        <h6 class="text-primary mb-3">
                            <i class="fa fa-info-circle"></i> Quiz Details
                        </h6>
                        <div class="quiz-detail">
                            <strong>Subject:</strong>
                            <span class="badge badge-info">${quiz.subject}</span>
                        </div>
                        <div class="quiz-detail">
                            <strong>Education Level:</strong>
                            <span class="badge badge-secondary">${quiz.education_level}</span>
                        </div>
                        <div class="quiz-detail">
                            <strong>Academic Year:</strong>
                            <span class="text-muted">${quiz.academic_year}</span>
                        </div>
                        <div class="quiz-detail">
                            <strong>Date:</strong>
                            <span class="text-primary">
                                <i class="fa fa-calendar"></i> ${formattedDate}
                            </span>
                        </div>
                        <div class="quiz-detail">
                            <strong>Time:</strong>
                            <span class="text-muted">
                                <i class="fa fa-clock"></i> ${quiz.start_time} - ${quiz.end_time}
                            </span>
                        </div>
                        <div class="quiz-detail">
                            <strong>Duration:</strong>
                            <span class="badge badge-warning">${quiz.time_limit} minutes</span>
                        </div>
                    </div>
                `);
            }
        } else {
            quizInfo.html('<i class="fa fa-info-circle"></i> Select a quiz to view its details');
        }
    });

    // Trigger change event if quiz is already selected (for edit mode)
    if ($('#quiz_id').val()) {
        $('#quiz_id').trigger('change');
    }
});
</script>
@endpush
