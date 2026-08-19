@extends('panel.layouts.index')

@section('title', 'Quizzes | Elmullim')

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

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Quizzes</h4>
                                <a href="{{ route('quizzes.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Quiz
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Subject</th>
                                            <th>Education Level</th>
                                            <th>Academic Year</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Duration</th>
                                            <th>Teacher</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Subject</th>
                                            <th>Education Level</th>
                                            <th>Academic Year</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Duration</th>
                                            <th>Teacher</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($quizzes as $quiz)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $quiz->title }}</strong>
                                                </td>
                                                <td>
                                                    @if ($quiz->subject)
                                                        <span class="badge badge-info">
                                                            {{ $quiz->subject->name }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $quiz->educationLevel->name ?? 'N/A' }}</td>
                                                <td>{{ $quiz->academic_year }}</td>
                                                <td>
                                                    <span class="text-primary">
                                                        <i class="fa fa-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($quiz->date)->format('M d, Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        <i class="fa fa-clock"></i>
                                                        {{ \Carbon\Carbon::parse($quiz->start_time)->format('h:i A') }} -
                                                        {{ \Carbon\Carbon::parse($quiz->end_time)->format('h:i A') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-secondary">
                                                        {{ $quiz->time_limit }} min
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ $quiz->teacher->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('quizzes.edit', $quiz) }}"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Quiz">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST"
                                                            style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this quiz?')">
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
        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.75em;
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
                order: [
                    [5, 'desc']
                ], // Order by date column
                columnDefs: [{
                        orderable: false,
                        targets: [9]
                    } // Disable ordering for Action column
                ]
            });
        });
    </script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Additional Scripts -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
@endpush
