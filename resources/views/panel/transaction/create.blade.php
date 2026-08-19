@extends('panel.layouts.index')

@section('title', 'Create Transaction | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">
                                <i class="fas fa-plus-circle me-2"></i>
                                Create New Transaction
                            </h4>
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-round ms-auto">
                                <i class="fa fa-arrow-left"></i>
                                Back to Transactions
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="teacher_id">Teacher <span class="text-danger">*</span></label>
                                        <select class="form-control" id="teacher_id" name="teacher_id" required>
                                            <option value="">Select Teacher</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }} - {{ $teacher->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total">Total Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="total" name="total"
                                                   value="{{ old('total') }}" step="0.01" min="0" required>
                                        </div>
                                        @error('total')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commission">Commission Percentage <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="commission" name="commission"
                                                   value="{{ old('commission') }}" step="0.01" min="0" max="100" required>
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('commission')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commission_amount">Commission Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="commission_amount" name="commission_amount"
                                                   value="{{ old('commission_amount') }}" step="0.01" min="0" readonly>
                                        </div>
                                        @error('commission_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="teacher_amount">Teacher Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="teacher_amount" name="teacher_amount"
                                                   value="{{ old('teacher_amount') }}" step="0.01" min="0" readonly>
                                        </div>
                                        @error('teacher_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Calculation Summary</label>
                                        <div class="card bg-light">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <small class="text-muted">Total:</small>
                                                        <div class="fw-bold" id="summary-total">$0.00</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">Commission:</small>
                                                        <div class="fw-bold text-warning" id="summary-commission">$0.00</div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <small class="text-muted">Teacher:</small>
                                                        <div class="fw-bold text-success" id="summary-teacher">$0.00</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">Rate:</small>
                                                        <div class="fw-bold text-info" id="summary-rate">0%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Create Transaction
                                </button>
                                <a href="{{ route('transactions.index') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-times me-2"></i>
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
<style>
    .card-title {
        color: #1f2937;
        font-weight: 600;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .card.bg-light {
        border: 1px solid #e9ecef;
    }

    .text-danger {
        font-size: 0.875rem;
    }

    .fw-bold {
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
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
    // Function to calculate amounts
    function calculateAmounts() {
        const total = parseFloat($('#total').val()) || 0;
        const commission = parseFloat($('#commission').val()) || 0;

        const commissionAmount = (total * commission) / 100;
        const teacherAmount = total - commissionAmount;

        $('#commission_amount').val(commissionAmount.toFixed(2));
        $('#teacher_amount').val(teacherAmount.toFixed(2));

        // Update summary
        $('#summary-total').text('$' + total.toFixed(2));
        $('#summary-commission').text('$' + commissionAmount.toFixed(2));
        $('#summary-teacher').text('$' + teacherAmount.toFixed(2));
        $('#summary-rate').text(commission.toFixed(2) + '%');
    }

    // Bind calculation to input changes
    $('#total, #commission').on('input', calculateAmounts);

    // Form validation
    $('#transactionForm').on('submit', function(e) {
        let isValid = true;
        const total = parseFloat($('#total').val()) || 0;
        const commission = parseFloat($('#commission').val()) || 0;
        const teacherId = $('#teacher_id').val();

        // Check if teacher is selected
        if (!teacherId) {
            isValid = false;
            $('#teacher_id').addClass('is-invalid');
        } else {
            $('#teacher_id').removeClass('is-invalid');
        }

        // Check if total is greater than 0
        if (total <= 0) {
            isValid = false;
            $('#total').addClass('is-invalid');
        } else {
            $('#total').removeClass('is-invalid');
        }

        // Check if commission is valid
        if (commission < 0 || commission > 100) {
            isValid = false;
            $('#commission').addClass('is-invalid');
        } else {
            $('#commission').removeClass('is-invalid');
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                title: 'Validation Error',
                text: 'Please fill in all required fields with valid values.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Initial calculation
    calculateAmounts();
});
</script>

<!-- Additional Scripts -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/setting-demo.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>

@endpush
