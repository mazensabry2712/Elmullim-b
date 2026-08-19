@extends('panel.layouts.index')

@section('title', 'Transactions | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">
                                <i class="fas fa-money-check-alt me-2"></i>
                                Transactions
                            </h4>
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Transaction
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Teacher</th>
                                        <th>Total Amount</th>
                                        <th>Commission %</th>
                                        <th>Teacher Amount</th>
                                        <th>Commission Amount</th>
                                        <th>Date</th>
                                        <th style="width: 12%">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Teacher</th>
                                        <th>Total Amount</th>
                                        <th>Commission %</th>
                                        <th>Teacher Amount</th>
                                        <th>Commission Amount</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $transaction->teacher ? $transaction->teacher->name : 'N/A' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $transaction->teacher ? $transaction->teacher->email : 'N/A' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">
                                                <i class="fas fa-dollar-sign me-1"></i>
                                                {{ number_format($transaction->total, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $transaction->commission }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                <i class="fas fa-user-tie me-1"></i>
                                                {{ number_format($transaction->teacher_amount, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                <i class="fas fa-percentage me-1"></i>
                                                {{ number_format($transaction->commission_amount, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $transaction->created_at->format('Y-m-d') }}
                                                <br>
                                                {{ $transaction->created_at->format('H:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                {{-- <a href="{{ route('transactions.show', $transaction) }}"
                                                    class="btn btn-link btn-info btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a> --}}
                                                <a href="{{ route('transactions.edit', $transaction) }}"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="Edit Transaction">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction) }}"
                                                    method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link btn-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-original-title="Delete Transaction">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

    .badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }

    .badge-success {
        background-color: #10b981;
    }

    .badge-info {
        background-color: #3b82f6;
    }

    .badge-primary {
        background-color: #6366f1;
    }

    .badge-warning {
        background-color: #f59e0b;
    }

    .badge-danger {
        background-color: #ef4444;
    }

    .table td {
        vertical-align: middle;
    }

    .form-button-action .btn {
        margin: 0 2px;
    }

    .text-muted {
        font-size: 0.875rem;
    }

    .transaction-amount {
        font-weight: 600;
        font-size: 1.1rem;
    }
</style>
@endpush

@push('script')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
<script src="{{asset('assets/js/setting-demo2.js')}}"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables with enhanced features
        $('#add-row').DataTable({
            pageLength: 10,
            responsive: true,
            order: [[6, 'desc']], // Sort by date descending
            columnDefs: [
                { orderable: false, targets: [7] }, // Disable sorting on Actions column
                { searchable: false, targets: [0, 7] } // Disable search on # and Actions columns
            ],
            language: {
                search: "Search Transactions:",
                lengthMenu: "Show _MENU_ transactions per page",
                info: "Showing _START_ to _END_ of _TOTAL_ transactions",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Enhanced delete confirmation
        $('form[method="POST"]').on('submit', function(e) {
            e.preventDefault();
            const form = this;

            Swal.fire({
                title: 'Delete Transaction?',
                text: 'This action cannot be undone. The transaction record will be permanently removed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Amount filter functionality
        $('#amountFilter').on('change', function() {
            const amount = $(this).val();
            const table = $('#add-row').DataTable();

            if (amount === '') {
                table.column(2).search('').draw();
            } else {
                table.column(2).search(amount).draw();
            }
        });

        // Teacher filter functionality
        $('#teacherFilter').on('change', function() {
            const teacher = $(this).val();
            const table = $('#add-row').DataTable();

            if (teacher === '') {
                table.column(1).search('').draw();
            } else {
                table.column(1).search(teacher).draw();
            }
        });
    });

    // Success message auto-hide
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 5000);
</script>

<!-- Additional Scripts -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/setting-demo.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>

@endpush
