@extends('panel.layouts.index')

@section('title', 'Education Systems | Elmullim')

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
                                <i class="fas fa-graduation-cap me-2"></i>
                                Education Systems
                            </h4>
                            <a href="{{ route('educationsystem.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Education System
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>System Name</th>
                                        <th>Country</th>
                                        <!-- <th>Education Levels</th> -->
                                        <!-- <th>Created Date</th> -->
                                        <th style="width: 12%">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>System Name</th>
                                        <th>Country</th>
                                        <!-- <th>Education Levels</th> -->
                                        <!-- <th>Created Date</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($educationSystems as $system)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $system->name }}</strong>
                                            <br>
                                            <!-- <small class="text-muted">ID: {{ $system->id }}</small> -->
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                <i class="fas fa-flag me-1"></i>
                                                {{ $system->country ? $system->country->name : 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="form-button-action">
                                                <!-- <a href="{{ route('educationsystem.show', $system) }}"
                                                    class="btn btn-link btn-info btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a> -->
                                                <a href="{{ route('educationsystem.edit', $system) }}"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="Edit System">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('educationsystem.destroy', $system) }}"
                                                    method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this education system? This will also delete all associated education levels!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link btn-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-original-title="Delete System">
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

    .badge-info {
        background-color: #3b82f6;
    }

    .badge-secondary {
        background-color: #6b7280;
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
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [5] }, // Disable sorting on Actions column
                { searchable: false, targets: [0, 5] } // Disable search on # and Actions columns
            ],
            language: {
                search: "Search Education Systems:",
                lengthMenu: "Show _MENU_ systems per page",
                info: "Showing _START_ to _END_ of _TOTAL_ education systems",
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
                title: 'Delete Education System?',
                text: 'This action cannot be undone. All associated data will be permanently removed.',
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

        // Status filter functionality (removed as not applicable)
        // $('#statusFilter').on('change', function() {
        //     const status = $(this).val();
        //     const table = $('#add-row').DataTable();
        //
        //     if (status === '') {
        //         table.column(5).search('').draw();
        //     } else {
        //         table.column(5).search(status).draw();
        //     }
        // });
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