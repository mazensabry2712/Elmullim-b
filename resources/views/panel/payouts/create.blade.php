@extends('panel.layouts.index')

@section('title', 'Create Payout | Elmullim')

@section('main-dashboard')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Create New Payout</h4>
                                <a href="{{ route('payouts.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Payouts
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('payouts.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_id" class="form-label">Teacher <span class="text-danger">*</span></label>
                                            <select class="form-select @error('teacher_id') is-invalid @enderror"
                                                    id="teacher_id" name="teacher_id" required>
                                                <option value="">Select Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                            {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                        @if($teacher->email)
                                                            ({{ $teacher->email }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number"
                                                       class="form-control @error('amount') is-invalid @enderror"
                                                       id="amount"
                                                       name="amount"
                                                       value="{{ old('amount') }}"
                                                       step="0.01"
                                                       min="0"
                                                       placeholder="0.00"
                                                       required>
                                                @error('amount')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>
                                                <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>
                                                    Canceled
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transaction_id" class="form-label">Transaction ID</label>
                                            <input type="text"
                                                   class="form-control @error('transaction_id') is-invalid @enderror"
                                                   id="transaction_id"
                                                   name="transaction_id"
                                                   value="{{ old('transaction_id') }}"
                                                   placeholder="Enter transaction ID">
                                            @error('transaction_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('payouts.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Create Payout
                                        </button>
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
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .btn-round {
            border-radius: 25px;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        .card-title {
            color: #495057;
            font-weight: 600;
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
            // Format amount input
            $('#amount').on('input', function() {
                let value = $(this).val();
                if (value && !isNaN(value)) {
                    $(this).val(parseFloat(value).toFixed(2));
                }
            });

            // Auto-generate transaction ID if status is completed
            $('#status').on('change', function() {
                if ($(this).val() === 'completed' && !$('#transaction_id').val()) {
                    let transactionId = 'TXN-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                    $('#transaction_id').val(transactionId);
                }
            });
        });
    </script>
@endpush
