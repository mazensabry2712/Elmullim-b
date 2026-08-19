@extends('panel.layouts.index')

@section('title', 'Edit Order | Elmullim')

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
                                <h4 class="card-title">Edit Order #{{ $order->id }}</h4>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Orders
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_id">Student <span class="text-danger">*</span></label>
                                            <select class="form-control @error('student_id') is-invalid @enderror"
                                                    id="student_id" name="student_id" required>
                                                <option value="">Select Student</option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}"
                                                            {{ (old('student_id') ?? $order->student_id) == $student->id ? 'selected' : '' }}>
                                                        {{ $student->name }} - {{ $student->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('student_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount">Amount <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number"
                                                       class="form-control @error('amount') is-invalid @enderror"
                                                       id="amount"
                                                       name="amount"
                                                       value="{{ old('amount') ?? $order->amount }}"
                                                       step="0.01"
                                                       min="0"
                                                       placeholder="0.00"
                                                       required>
                                                @error('amount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paymob_order_id">Paymob Order ID</label>
                                            <input type="text"
                                                   class="form-control @error('paymob_order_id') is-invalid @enderror"
                                                   id="paymob_order_id"
                                                   name="paymob_order_id"
                                                   value="{{ old('paymob_order_id') ?? $order->paymob_order_id }}"
                                                   placeholder="Enter Paymob Order ID">
                                            @error('paymob_order_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transaction_id">Transaction ID</label>
                                            <input type="text"
                                                   class="form-control @error('transaction_id') is-invalid @enderror"
                                                   id="transaction_id"
                                                   name="transaction_id"
                                                   value="{{ old('transaction_id') ?? $order->transaction_id }}"
                                                   placeholder="Enter Transaction ID">
                                            @error('transaction_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="pending" {{ (old('status') ?? $order->status) == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="completed" {{ (old('status') ?? $order->status) == 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>
                                                <option value="failed" {{ (old('status') ?? $order->status) == 'failed' ? 'selected' : '' }}>
                                                    Failed
                                                </option>
                                                <option value="cancelled" {{ (old('status') ?? $order->status) == 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Update Order
                                    </button>
                                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
@endpush

@push('script')
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
@endpush
