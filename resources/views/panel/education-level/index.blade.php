@extends('panel.layouts.index')

@section('title', 'Education Levels | Elmullim')

@section('main-dashboard')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Education Levels</h3>
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
                    <span>Education Levels</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check-circle me-2"></i>Success!</strong>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">
                                <i class="fas fa-layer-group me-2"></i>
                                Education Levels Management
                            </h4>
                            <a href="{{ route('educationlevel.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Education Level
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($educationLevels->count() > 0)
                        <div class="table-responsive">
                            <table id="education-levels-table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Level Name</th>
                                        <th>Education System</th>
                                        <th>Country</th>
                                        <th>Description</th>
                                        {{-- <th>Created</th> --}}
                                        <th style="width: 15%">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Level Name</th>
                                        <th>Education System</th>
                                        <th>Country</th>
                                        <th>Description</th>
                                        {{-- <th>Created</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($educationLevels as $level)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-2">
                                                    <div class="avatar-initial bg-primary rounded-circle">
                                                        <i class="fas fa-layer-group"></i>
                                                    </div>
                                                </div>
                                                <strong>{{ $level->name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                <i class="fas fa-graduation-cap me-1"></i>
                                                {{ $level->educationSystem ? $level->educationSystem->name : 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($level->educationSystem && $level->educationSystem->country)
                                                <span class="badge badge-info">
                                                    <i class="fas fa-flag me-1"></i>
                                                    {{ $level->educationSystem->country->name }}
                                                </span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted description-cell">
                                                {{ $level->description ? Str::limit($level->description, 50) : 'No description' }}
                                            </span>
                                        </td>
                                        {{-- <td>
                                            <small class="text-muted">
                                                {{ $level->created_at->format('M d, Y') }}
                                            </small>
                                        </td> --}}
                                        <td>
                                            <div class="form-button-action">
                                                {{-- <a href="{{ route('educationlevel.show', $level) }}"
                                                    class="btn btn-link btn-info btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a> --}}
                                                <a href="{{ route('educationlevel.edit', $level) }}"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="Edit Level">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('educationlevel.destroy', $level) }}"
                                                    method="POST"
                                                    style="display: inline;"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link btn-danger delete-btn"
                                                        data-bs-toggle="tooltip"
                                                        data-original-title="Delete Level"
                                                        data-level-name="{{ $level->name }}">
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
                        @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-layer-group fa-4x text-muted mb-4"></i>
                                <h4 class="text-muted">No Education Levels Found</h4>
                                <p class="text-muted mb-4">You haven't created any education levels yet. Start by adding your first education level.</p>
                                <a href="{{ route('educationlevel.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>
                                    Create First Education Level
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if($educationLevels->count() > 0)
                <!-- Statistics Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            Quick Statistics
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-md bg-primary">
                                            <i class="fas fa-layer-group text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Total Levels</h6>
                                        <span class="text-muted">{{ $educationLevels->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-md bg-info">
                                            <i class="fas fa-graduation-cap text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Education Systems</h6>
                                        <span class="text-muted">{{ $educationLevels->pluck('education_system_id')->unique()->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-md bg-success">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">With Description</h6>
                                        <span class="text-muted">{{ $educationLevels->whereNotNull('description')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-md bg-warning">
                                            <i class="fas fa-clock text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Recent</h6>
                                        <span class="text-muted">{{ $educationLevels->where('created_at', '>=', now()->subWeek())->count() }} this week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
        border-radius: 0.5rem;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .table td {
        vertical-align: middle;
    }

    .form-button-action .btn {
        margin: 0 2px;
        padding: 0.375rem 0.5rem;
    }

    .text-muted {
        font-size: 0.875rem;
    }

    .description-cell {
        max-width: 200px;
        word-wrap: break-word;
    }

    .avatar {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-xs {
        width: 1.5rem;
        height: 1.5rem;
        font-size: 0.75rem;
    }

    .avatar-md {
        width: 3rem;
        height: 3rem;
        font-size: 1.25rem;
    }

    .avatar-initial {
        background-color: var(--bs-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state {
        padding: 2rem;
    }

    .breadcrumbs {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .breadcrumbs li {
        display: inline-block;
    }

    .breadcrumbs .separator {
        margin: 0 0.5rem;
        color: #6b7280;
    }

    .flex-shrink-0 {
        flex-shrink: 0;
    }

    .flex-grow-1 {
        flex-grow: 1;
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
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables with enhanced features
        if ($('#education-levels-table').length) {
            $('#education-levels-table').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[1, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [6] }, // Disable sorting on Actions column
                    { searchable: false, targets: [0, 6] } // Disable search on # and Actions columns
                ],
                language: {
                    search: "Search Education Levels:",
                    lengthMenu: "Show _MENU_ levels per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ education levels",
                    infoEmpty: "Showing 0 to 0 of 0 education levels",
                    infoFiltered: "(filtered from _MAX_ total education levels)",
                    emptyTable: "No education levels available",
                    zeroRecords: "No matching education levels found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip'
            });
        }

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Enhanced delete confirmation
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const levelName = $(this).find('.delete-btn').data('level-name');

            Swal.fire({
                title: 'Delete Education Level?',
                html: `Are you sure you want to delete "<strong>${levelName}</strong>"?<br><br>This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait while we delete the education level.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    form.submit();
                }
            });
        });

        // Auto-hide success/error messages
        setTimeout(function() {
            $('.alert-success, .alert-danger').fadeOut('slow');
        }, 5000);

        // Add loading state to action buttons
        $('.btn-link').on('click', function(e) {
            if (!$(this).hasClass('delete-btn')) {
                $(this).html('<i class="fas fa-spinner fa-spin"></i>');
            }
        });

        // Refresh page functionality
        $('.card-header').append(`
            <button class="btn btn-sm btn-outline-secondary ms-2" onclick="location.reload();" data-bs-toggle="tooltip" title="Refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
        `);

        // Export functionality (optional)
        if ($('#education-levels-table').length) {
            $('.card-header').append(`
                <div class="dropdown ms-2">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="exportTableToCSV()"><i class="fas fa-file-csv me-2"></i>CSV</a></li>
                        <li><a class="dropdown-item" href="#" onclick="window.print()"><i class="fas fa-print me-2"></i>Print</a></li>
                    </ul>
                </div>
            `);
        }
    });

    // Export to CSV function
    function exportTableToCSV() {
        const table = $('#education-levels-table').DataTable();
        const data = table.data().toArray();

        let csv = 'Level Name,Education System,Country,Description,Created\n';

        data.forEach(row => {
            // Extract text content from HTML elements
            const levelName = $(row[1]).text().trim();
            const educationSystem = $(row[2]).text().trim();
            const country = $(row[3]).text().trim();
            const description = $(row[4]).text().trim();
            const created = $(row[5]).text().trim();

            csv += `"${levelName}","${educationSystem}","${country}","${description}","${created}"\n`;
        });

        // Download CSV
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.setAttribute('hidden', '');
        a.setAttribute('href', url);
        a.setAttribute('download', 'education-levels.csv');
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        // Show success message
        Swal.fire({
            title: 'Export Successful!',
            text: 'Education levels data has been exported to CSV.',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    }
</script>

@endpush
