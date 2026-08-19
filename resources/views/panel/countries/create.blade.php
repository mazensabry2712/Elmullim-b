@extends('panel.layouts.index')

@section('title', 'Create Countries | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="page-header mb-4">
                <h1 class="fw-bold text-primary">
                    <i class="fas fa-globe me-2"></i>
                    Country Management
                </h1>
                <nav class="mt-3 ml-7" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('countries.index') ?? '#' }}">Countries</a></li>
                        <li class="breadcrumb-item active">Add New Country</li>
                    </ol>
                </nav>
            </div>

            {{-- Success Messages --}}
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-plus-circle me-2"></i>
                                Add New Country
                            </div>
                        </div>

                        <form action="{{ route('countries.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="name">
                                                <i class="fas fa-flag me-1"></i>
                                                Country Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="Enter country name" required />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="code">
                                                <i class="fas fa-code me-1"></i>
                                                Country Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" name="code" value="{{ old('code') }}"
                                                placeholder="+20, +966, +971" maxlength="3"
                                                style="text-transform: uppercase;" required />
                                            @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Enter country code (2-3 characters)
                                            </small>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="status">
                                                <i class="fas fa-toggle-on me-1"></i>
                                                Status
                                            </label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description">
                                                <i class="fas fa-align-left me-1"></i>
                                                Description (Optional)
                                            </label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="3" placeholder="Enter a brief description about the country...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-save me-1"></i>
                                    Save Country
                                </button>
                                <a href="{{ route('countries.index') ?? '#' }}" class="btn btn-danger">
                                    <i class="fas fa-times me-1"></i>
                                    Cancel
                                </a>
                            </div>
                        </form>
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
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#add-row').DataTable({
                pageLength: 5
            });

            var action =
                '<td> <div class="form-button-action">' +
                '<button type="button" data-bs-toggle="modal" data-bs-target="#editRowModal" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">' +
                '<i class="fa fa-edit"></i></button>' +
                '<button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">' +
                '<i class="fa fa-times"></i></button>' +
                '</div> </td>';

            // Add Row
            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $('#addName').val(),
                    $('#addPosition').val(),
                    $('#addOffice').val(),
                    action
                ]);
                $('#addRowModal').modal('hide');
            });

            // Fill edit modal on edit button click
            $(document).on('click', '[data-bs-target="#editRowModal"]', function() {
                var $tr = $(this).closest('tr');
                $('#editName').val($tr.find('td').eq(0).text());
                $('#editPosition').val($tr.find('td').eq(1).text());
                $('#editOffice').val($tr.find('td').eq(2).text());
                // mark selected row
                $tr.addClass('selected').siblings().removeClass('selected');
            });

            // Update Row
            $('#editRowButton').click(function() {
                var $tr = $('tr.selected');
                $tr.find('td').eq(0).text($('#editName').val());
                $tr.find('td').eq(1).text($('#editPosition').val());
                $tr.find('td').eq(2).text($('#editOffice').val());
                $('#editRowModal').modal('hide');
                $tr.removeClass('selected');
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // تحويل رمز الدولة إلى أحرف كبيرة أثناء الكتابة
        document.getElementById('code').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });

        // التحقق من طول رمز الدولة
        document.getElementById('code').addEventListener('blur', function(e) {
            if (this.value.length < 2) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    </script>
@endpush
