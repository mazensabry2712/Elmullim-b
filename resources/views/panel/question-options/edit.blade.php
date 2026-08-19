@extends('panel.layouts.index')

@section('title', 'Edit Question Option | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Question Option</h3>
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
                    <span>Edit</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
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
                            <h4 class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i>
                                Edit Question Option
                            </h4>
                            <div class="ms-auto">
                                <a href="{{ route('question-options.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to List
                                </a>
                                <span class="badge badge-info">
                                    <i class="fas fa-calendar me-1"></i>
                                    Created: {{ $questionOption->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('question-options.update', $questionOption->id) }}" method="POST" id="edit-option-form">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="form-label">
                                            <i class="fas fa-tag me-1"></i>
                                            Option Title <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control @error('title') is-invalid @enderror"
                                               id="title"
                                               name="title"
                                               value="{{ old('title', $questionOption->title) }}"
                                               placeholder="Enter option title..."
                                               required>
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Characters: {{ strlen($questionOption->title) }}/255
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
                                                id="question_id"
                                                name="question_id"
                                                required>
                                            <option value="">-- Select Question --</option>
                                            @foreach($questions as $question)
                                            <option value="{{ $question->id }}"
                                                    {{ old('question_id', $questionOption->question_id) == $question->id ? 'selected' : '' }}>
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
                                            <i class="fas fa-info-circle me-1"></i>Currently linked to: <strong>{{ $questionOption->question ? $questionOption->question->title : 'No question linked' }}</strong>
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
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="is_correct"
                                                       id="correct_yes"
                                                       value="1"
                                                       {{ old('is_correct', $questionOption->is_correct) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="correct_yes">
                                                    <span class="badge {{ old('is_correct', $questionOption->is_correct) == '1' ? 'badge-success' : 'badge-secondary' }}">
                                                        <i class="fas fa-check me-1"></i>
                                                        Yes, this is correct
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="is_correct"
                                                       id="correct_no"
                                                       value="0"
                                                       {{ old('is_correct', $questionOption->is_correct) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="correct_no">
                                                    <span class="badge {{ old('is_correct', $questionOption->is_correct) == '0' ? 'badge-secondary' : 'badge-success' }}">
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
                                            Current status:
                                            @if($questionOption->is_correct)
                                                <span class="text-success"><i class="fas fa-check-circle me-1"></i>This option is marked as correct</span>
                                            @else
                                                <span class="text-secondary"><i class="fas fa-times-circle me-1"></i>This option is marked as incorrect</span>
                                            @endif
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
                                        <button type="button" class="btn btn-outline-warning me-2" id="reset-btn">
                                            <i class="fas fa-undo me-2"></i>
                                            Reset Changes
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>
                                            Update Option
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Current Information Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
