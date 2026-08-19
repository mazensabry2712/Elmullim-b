@extends('panel.layouts.index')

@section('title', 'Create Content | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Create Content</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contents.index') }}">Contents</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Create</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add New Content</h4>
                            <a href="{{ route('contents.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Back to Contents
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contents.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            name="title"
                                            placeholder="Enter content title"
                                            value="{{ old('title') }}"
                                            required
                                            maxlength="255"
                                        />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum 255 characters</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description"
                                            name="description"
                                            rows="5"
                                            placeholder="Enter content description"
                                        >{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">Optional field</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    Create Content
                                </button>
                                <a href="{{ route('contents.index') }}" class="btn btn-danger">
                                    <i class="fa fa-times"></i>
                                    Cancel
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
        // Focus on title field when page loads
        $('#title').focus();

        // Title character counter
        $('#title').on('input', function() {
            var maxLength = 255;
            var currentLength = $(this).val().length;
            var remaining = maxLength - currentLength;

            if (!$('#title-counter').length) {
                $(this).siblings('.form-text').after('<small id="title-counter" class="form-text text-muted"></small>');
            }

            $('#title-counter').text(remaining + ' characters remaining');

            if (remaining < 0) {
                $('#title-counter').removeClass('text-muted').addClass('text-danger');
            } else {
                $('#title-counter').removeClass('text-danger').addClass('text-muted');
            }
        });

        // Character counter for description
        $('#description').on('input', function() {
            var maxLength = 1000;
            var currentLength = $(this).val().length;
            var remaining = maxLength - currentLength;

            if (!$('#char-counter').length) {
                $(this).siblings('.form-text').after('<small id="char-counter" class="form-text text-muted"></small>');
            }

            $('#char-counter').text(remaining + ' characters remaining');

            if (remaining < 0) {
                $('#char-counter').removeClass('text-muted').addClass('text-danger');
            } else {
                $('#char-counter').removeClass('text-danger').addClass('text-muted');
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            var title = $('#title').val().trim();

            if (title === '') {
                e.preventDefault();
                alert('Title is required');
                $('#title').focus();
                return false;
            }

            if (title.length > 255) {
                e.preventDefault();
                alert('Title must not exceed 255 characters');
                $('#title').focus();
                return false;
            }
        });
    });
</script>
@endpush
