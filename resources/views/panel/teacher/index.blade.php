@extends('panel.layouts.index')

@section('title', 'Teachers | Elmullim')

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
                                <h4 class="card-title">Teachers</h4>
                                <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Teacher
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Experience</th>
                                            <th>Qualification</th>
                                            <th>CV</th>
                                            <th>Course Type</th>
                                            <th>Education Level</th>
                                            <th>Gender</th>
                                            <th>Password</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Experience</th>
                                            <th>Qualification</th>
                                            <th>CV</th>
                                            <th>Course Type</th>
                                            <th>Education Level</th>
                                            <th>Gender</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($teacher->profile_image)
                                                            <img src="{{ asset('storage/' . $teacher->profile_image) }}"
                                                                alt="{{ $teacher->name }}" class="rounded-circle me-2"
                                                                width="32" height="32">
                                                        @else
                                                            <div
                                                                class="avatar avatar-sm bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                                {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                        <span>{{ $teacher->name }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $teacher->email }}</td>

                                                <td>{{ $teacher->phone ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="text-truncate"
                                                        style="max-width: 150px; display: inline-block;"
                                                        title="{{ $teacher->address }}">
                                                        {{ $teacher->address ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-truncate"
                                                        style="max-width: 200px; display: inline-block;"
                                                        title="{{ $teacher->description }}">
                                                        {{ Str::limit($teacher->description, 50) ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td>{{ $teacher->experince ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="text-truncate"
                                                        style="max-width: 150px; display: inline-block;"
                                                        title="{{ $teacher->qualification }}">
                                                        {{ $teacher->qualification ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($teacher->cv)
                                                        <a href="{{ asset('storage/' . $teacher->cv) }}" target="_blank"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fa fa-download"></i> CV
                                                        </a>
                                                    @else
                                                        <span class="text-muted">No CV</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($teacher->course_type)
                                                        <span
                                                            class="badge bg-secondary">{{($teacher->course_type)}}</span>
                                                    @else
                                                        <span class="text-muted">Not Set</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($teacher->educationLevel)
                                                        <span
                                                            class="badge bg-info">{{ $teacher->educationLevel->name }}</span>
                                                    @else
                                                        <span class="text-muted">Not Set</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($teacher->gender)
                                                        <span
                                                            class="badge {{ $teacher->gender == 'male' ? 'bg-primary' : 'bg-success' }}">
                                                            {{ ($teacher->gender) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Not Set</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary password-toggle"
                                                        data-password="{{ $teacher->password }}"
                                                        onclick="togglePassword(this)">
                                                        <i class="fa fa-eye"></i> Show
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        {{-- <a href="{{ route('teachers.show', $teacher->id) }}"
                                                            class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip"
                                                            data-original-title="View Teacher">
                                                            <i class="fa fa-eye"></i>
                                                        </a> --}}
                                                        <a href="{{ route('teachers.edit', $teacher->id) }}"
                                                            class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip"
                                                            data-original-title="Edit Teacher">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this teacher?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger"
                                                                data-bs-toggle="tooltip"
                                                                data-original-title="Delete Teacher">
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
        .password-field {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            background-color: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
            max-width: 120px;
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
                responsive: true,
                scrollX: true,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        orderable: false,
                        targets: [13]
                    } // Disable sorting for action column (updated index)
                ]
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        // Function to toggle password visibility
        function togglePassword(button) {
            const passwordHash = button.getAttribute('data-password');
            const icon = button.querySelector('i');
            const buttonText = button.innerHTML;

            if (button.classList.contains('showing')) {
                // Currently showing password - hide it
                button.innerHTML = '<i class="fa fa-eye"></i> Show';
                button.classList.remove('showing');
                button.classList.remove('btn-warning');
                button.classList.add('btn-outline-secondary');
            } else {
                // Currently hidden - show password hash (first 20 characters)
                const shortHash = passwordHash.substring(0, 20) + '...';
                button.innerHTML = '<i class="fa fa-eye-slash"></i> Hide';
                button.classList.add('showing');
                button.classList.remove('btn-outline-secondary');
                button.classList.add('btn-warning');

                // Create a tooltip or modal to show the full hash
                button.setAttribute('title', passwordHash);

                // Auto-hide after 5 seconds for security
                setTimeout(() => {
                    if (button.classList.contains('showing')) {
                        button.innerHTML = '<i class="fa fa-eye"></i> Show';
                        button.classList.remove('showing');
                        button.classList.remove('btn-warning');
                        button.classList.add('btn-outline-secondary');
                        button.removeAttribute('title');
                    }
                }, 5000);
            }
        }
    </script>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
@endpush
