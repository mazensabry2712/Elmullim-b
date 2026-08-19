@extends('panel.layouts.index')

@section('title', 'Lectures | Elmullim')

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
                                <h4 class="card-title">Lectures</h4>
                                <a href="{{ route('lecture.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Lecture
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Video</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Duration</th>
                                            <th>Created</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Video</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Duration</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($lectures as $lecture)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($lecture->video)
                                                        <div class="video-thumbnail" style="position: relative; width: 50px; height: 50px;">
                                                            <video style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"
                                                                   muted preload="metadata">
                                                                <source src="{{ asset('storage/' . $lecture->video) }}" type="video/mp4">
                                                            </video>
                                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                                                        color: white; font-size: 12px; pointer-events: none;">
                                                                <i class="fa fa-play-circle"></i>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="width: 50px; height: 50px; background-color: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa fa-video text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $lecture->title }}</strong>
                                                        @if ($lecture->description)
                                                            <br>
                                                            <small class="text-muted">
                                                                {{ Str::limit($lecture->description, 50) }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $lecture->content->title ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($lecture->deuration)
                                                        <span class="badge badge-info">
                                                            {{ $lecture->deuration }} min
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $lecture->created_at->format('M d, Y') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        {{-- <a href="{{ route('lecture.show', $lecture) }}"
                                                            class="btn btn-link btn-info btn-lg"
                                                            data-original-title="View Lecture">
                                                            <i class="fa fa-eye"></i>
                                                        </a> --}}
                                                        <a href="{{ route('lecture.edit', $lecture) }}"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Lecture">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('lecture.destroy', $lecture) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this lecture?')">
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
        .video-thumbnail:hover video {
            opacity: 0.8;
            cursor: pointer;
        }

        .video-thumbnail .fa-play-circle {
            text-shadow: 0 0 3px rgba(0,0,0,0.7);
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
                pageLength: 5,
                order: [
                    [0, 'desc']
                ], // Order by ID descending
                columnDefs: [{
                        orderable: false,
                        targets: [1, 6]
                    } // Disable ordering for video and action columns
                ]
            });

            // Video hover effect
            $('.video-thumbnail').on('mouseenter', function() {
                $(this).find('video')[0].play();
            }).on('mouseleave', function() {
                $(this).find('video')[0].pause();
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
