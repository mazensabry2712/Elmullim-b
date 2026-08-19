@extends('panel.layouts.index')
@section('title', 'Admin-Panel | Elmullim')
@section('suptitle', 'Admin Panel')
@section('main-dashboard')

    <div class="container-fluid">
        <div class="page-inner">
            <!-- Header Section -->
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="w-100">
                    <h3 class="fw-bold mb-3">@yield('suptitle')</h3>
                    <h6 class="op-7 mb-2">Dashboard Overview</h6>

                    <!-- Action Buttons - Now below the header -->
                    <div class="mt-3">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-round me-2">
                            <i class="fas fa-graduation-cap me-1"></i>Add Student
                        </a>
                        <a href="{{ route('teachers.index') }}" class="btn btn-info btn-round me-2">
                            <i class="fas fa-chalkboard-teacher me-1"></i>Add Teacher
                        </a>
                        <a href="{{ route('families.index') }}" class="btn btn-success btn-round">
                            <i class="fas fa-users me-1"></i>Add Family
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Admins</p>
                                        <h4 class="card-title">{{ $adminsCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Teachers</p>
                                        <h4 class="card-title">{{ $teachersCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Students</p>
                                        <h4 class="card-title">{{ $studentsCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Families</p>
                                        <h4 class="card-title">{{ $familiesCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Additions -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <i class="fas fa-user-shield text-primary me-2"></i>New Admins Today
                                </div>
                                <div class="card-tools">
                                    <span class="badge badge-primary">{{ $todayAdmins->count() }}</span>
                                </div>
                            </div>
                            <div class="card-list py-4" style="min-height: 250px;">
                                @forelse ($todayAdmins as $admin)
                                    <div class="item-list">
                                        <div class="avatar">
                                            @if ($admin->photo)
                                                <img src="{{ asset('storage/' . $admin->photo) }}"
                                                    alt="{{ $admin->name }}" class="avatar-img rounded-circle" />
                                            @else
                                                <span class="avatar-title rounded-circle border border-white bg-primary">
                                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="info-user ms-3">
                                            <div class="username">{{ $admin->name }}</div>
                                            <div class="status">{{ $admin->email }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="fas fa-user-shield fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No new admins today</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <i class="fas fa-chalkboard-teacher text-info me-2"></i>New Teachers Today
                                </div>
                                <div class="card-tools">
                                    <span class="badge badge-info">{{ $todayTeachers->count() }}</span>
                                </div>
                            </div>
                            <div class="card-list py-4" style="min-height: 250px;">
                                @forelse ($todayTeachers as $teacher)
                                    <div class="item-list">
                                        <div class="avatar">
                                            @if ($teacher->photo)
                                                <img src="{{ asset('storage/' . $teacher->photo) }}"
                                                    alt="{{ $teacher->name }}" class="avatar-img rounded-circle" />
                                            @else
                                                <span class="avatar-title rounded-circle border border-white bg-info">
                                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="info-user ms-3">
                                            <div class="username">{{ $teacher->name }}</div>
                                            <div class="status">{{ $teacher->email }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="fas fa-chalkboard-teacher fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No new teachers today</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <i class="fas fa-user-graduate text-success me-2"></i>New Students Today
                                </div>
                                <div class="card-tools">
                                    <span class="badge badge-success">{{ $todayStudents->count() }}</span>
                                </div>
                            </div>
                            <div class="card-list py-4" style="min-height: 250px;">
                                @forelse ($todayStudents as $student)
                                    <div class="item-list">
                                        <div class="avatar">
                                            @if ($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}"
                                                    alt="{{ $student->name }}" class="avatar-img rounded-circle" />
                                            @else
                                                <span class="avatar-title rounded-circle border border-white bg-success">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="info-user ms-3">
                                            <div class="username">{{ $student->name }}</div>
                                            <div class="status">{{ $student->email }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="fas fa-user-graduate fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No new students today</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <i class="fas fa-users text-secondary me-2"></i>New Families Today
                                </div>
                                <div class="card-tools">
                                    <span class="badge badge-secondary">{{ $todayFamilies->count() }}</span>
                                </div>
                            </div>
                            <div class="card-list py-4" style="min-height: 250px;">
                                @forelse ($todayFamilies as $family)
                                    <div class="item-list">
                                        <div class="avatar">
                                            @if ($family->photo)
                                                <img src="{{ asset('storage/' . $family->photo) }}"
                                                    alt="{{ $family->name }}" class="avatar-img rounded-circle" />
                                            @else
                                                <span class="avatar-title rounded-circle border border-white bg-secondary">
                                                    {{ strtoupper(substr($family->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="info-user ms-3">
                                            <div class="username">{{ $family->name }}</div>
                                            <div class="status">{{ $family->email }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No new families today</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction History -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <i class="fas fa-money-bill-wave text-warning me-2"></i>Today's Transaction History
                                </div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('transactions.index') }}">
                                                <i class="fas fa-eye me-2"></i>View All
                                            </a>
                                            <a class="dropdown-item" href="{{ route('transactions.create') }}">
                                                <i class="fas fa-plus me-2"></i>Add New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">
                                                <i class="fas fa-receipt me-2"></i>Payment Details
                                            </th>
                                            <th scope="col">
                                                <i class="fas fa-chalkboard-teacher me-2"></i>Teacher
                                            </th>
                                            <th scope="col" class="text-end">
                                                <i class="fas fa-money-bill-wave me-2"></i>Amount
                                            </th>
                                            <th scope="col" class="text-end">
                                                <i class="fas fa-calendar-alt me-2"></i>Date & Time
                                            </th>
                                            <th scope="col" class="text-end">
                                                <i class="fas fa-check-circle me-2"></i>Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($todayTransactions as $transaction)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                        <div>
                                                            <strong>Payment #{{ $transaction->id }}</strong>
                                                            <br>
                                                            <small class="text-muted">Transaction ID: {{ $transaction->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-2">
                                                            @if ($transaction->teacher && $transaction->teacher->photo)
                                                                <img src="{{ asset('storage/' . $transaction->teacher->photo) }}"
                                                                    alt="{{ $transaction->teacher->name }}"
                                                                    class="avatar-img rounded-circle" />
                                                            @else
                                                                <span class="avatar-title rounded-circle bg-info">
                                                                    {{ $transaction->teacher ? strtoupper(substr($transaction->teacher->name, 0, 1)) : 'N' }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <strong>{{ $transaction->teacher ? $transaction->teacher->name : 'N/A' }}</strong>
                                                            @if ($transaction->teacher && $transaction->teacher->email)
                                                                <br>
                                                                <small class="text-muted">{{ $transaction->teacher->email }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <span class="badge badge-success badge-lg">
                                                        <i class="fas fa-money-bill-wave me-1"></i>${{ number_format($transaction->total, 2) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i>{{ $transaction->created_at->format('M d, Y') }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>{{ $transaction->created_at->format('g:i A') }}
                                                    </small>
                                                </td>
                                                <td class="text-end">
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check-circle me-1"></i>Completed
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                                    <br>
                                                    <span class="text-muted">No transactions found for today</span>
                                                </td>
                                            </tr>
                                        @endforelse
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
    <link rel="stylesheet" href="{{ asset('assets/css/panel.css') }}">
    <style>
        .card-stats {
            transition: transform 0.3s ease;
        }

        .card-stats:hover {
            transform: translateY(-5px);
        }

        .item-list {
            padding: 12px 0;
        }

        .item-list:not(:last-child) {
            border-bottom: 1px solid #eee;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
        }

        .badge-lg {
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
        }

        .table-responsive {
            border-radius: 0.375rem;
        }

        .table th {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .btn-round {
            border-radius: 20px;
        }

        .card-head-row {
            margin-bottom: 0;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .username {
            font-weight: 600;
            font-size: 0.875rem;
        }

        .status {
            font-size: 0.75rem;
            color: #666;
        }

        /* Icon colors for better visibility */
        .icon-big i {
            font-size: 2rem;
        }

        /* Enhanced icon styling */
        .card-title i {
            opacity: 0.8;
        }

        .table th i {
            opacity: 0.7;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/js/panel.js') }}"></script>
@endpush
