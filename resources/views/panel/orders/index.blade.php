@extends('panel.layouts.index')

@section('title', 'Orders | Elmullim')

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
                                <h4 class="card-title">Orders</h4>
                                <a href="{{ route('orders.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Order
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Filter buttons -->
                            {{-- <div class="mb-3">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                                        <i class="fa fa-list"></i> All Orders
                                    </a>
                                    <a href="{{ route('orders.getByStatus', 'pending') }}" class="btn btn-outline-warning">
                                        <i class="fa fa-clock"></i> Pending
                                    </a>
                                    <a href="{{ route('orders.getByStatus', 'completed') }}"
                                        class="btn btn-outline-success">
                                        <i class="fa fa-check"></i> Completed
                                    </a>
                                    <a href="{{ route('orders.getByStatus', 'failed') }}" class="btn btn-outline-danger">
                                        <i class="fa fa-times"></i> Failed
                                    </a>
                                    <a href="{{ route('orders.getByStatus', 'cancelled') }}" class="btn btn-outline-dark">
                                        <i class="fa fa-ban"></i> Cancelled
                                    </a>
                                </div>
                            </div> --}}

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Amount</th>
                                            <th>Paymob Order ID</th>
                                            <th>Transaction ID</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Amount</th>
                                            <th>Paymob Order ID</th>
                                            <th>Transaction ID</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-2">
                                                            <div
                                                                class="avatar-initial bg-primary text-white rounded-circle">
                                                                {{ substr($order->student->name ?? 'N/A', 0, 1) }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <strong>{{ $order->student->name ?? 'N/A' }}</strong>
                                                            @if ($order->student->email)
                                                                <br>
                                                                <small class="text-muted">
                                                                    {{ $order->student->email }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-success">
                                                        ${{ number_format($order->amount, 2) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($order->paymob_order_id)
                                                        <span class="badge badge-info">
                                                            {{ $order->paymob_order_id }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->transaction_id)
                                                        <code>{{ $order->transaction_id }}</code>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @switch($order->status)
                                                        @case('pending')
                                                            <span class="badge badge-warning">
                                                                <i class="fa fa-clock"></i> Pending
                                                            </span>
                                                        @break

                                                        @case('completed')
                                                            <span class="badge badge-success">
                                                                <i class="fa fa-check"></i> Completed
                                                            </span>
                                                        @break

                                                        @case('failed')
                                                            <span class="badge badge-danger">
                                                                <i class="fa fa-times"></i> Failed
                                                            </span>
                                                        @break

                                                        @case('cancelled')
                                                            <span class="badge badge-dark">
                                                                <i class="fa fa-ban"></i> Cancelled
                                                            </span>
                                                        @break

                                                        @default
                                                            <span class="badge badge-secondary">{{ $order->status }}</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $order->created_at->format('M d, Y') }}
                                                        <br>
                                                        {{ $order->created_at->format('h:i A') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('orders.show', $order) }}"
                                                            class="btn btn-link btn-info btn-lg"
                                                            data-original-title="View Order">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('orders.edit', $order) }}"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Order">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- Quick status update dropdown -->
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-link btn-warning btn-lg dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                data-original-title="Update Status">
                                                                <i class="fa fa-refresh"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                @if ($order->status !== 'pending')
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('orders.updateStatus', $order) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="pending">
                                                                            <button type="submit" class="dropdown-item">
                                                                                <i class="fa fa-clock text-warning"></i>
                                                                                Mark as Pending
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif
                                                                @if ($order->status !== 'completed')
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('orders.updateStatus', $order) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="completed">
                                                                            <button type="submit" class="dropdown-item">
                                                                                <i class="fa fa-check text-success"></i>
                                                                                Mark as Completed
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif
                                                                @if ($order->status !== 'failed')
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('orders.updateStatus', $order) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="failed">
                                                                            <button type="submit" class="dropdown-item">
                                                                                <i class="fa fa-times text-danger"></i>
                                                                                Mark as Failed
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif
                                                                @if ($order->status !== 'cancelled')
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('orders.updateStatus', $order) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="cancelled">
                                                                            <button type="submit" class="dropdown-item">
                                                                                <i class="fa fa-ban text-dark"></i> Mark as
                                                                                Cancelled
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>

                                                        <form action="{{ route('orders.destroy', $order) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this order?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <style>
        .avatar-initial {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
        }

        .badge {
            font-size: 0.75rem;
        }

        .dropdown-item {
            padding: 0.375rem 1rem;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .form-button-action {
            white-space: nowrap;
        }

        .btn-group .btn {
            margin-right: 0.25rem;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }
    </style>
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
                pageLength: 10,
                order: [
                    [0, 'desc']
                ], // Order by ID descending
                columnDefs: [{
                        orderable: false,
                        targets: [7]
                    } // Disable ordering for action column
                ]
            });
        });
    </script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
@endpush
