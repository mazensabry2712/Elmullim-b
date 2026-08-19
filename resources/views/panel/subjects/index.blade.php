@extends('panel.layouts.index')

@section('title', 'Subjects | Elmullim')

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
                            <h4 class="card-title">Subjects</h4>
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Subject
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
                                        <th>Image</th>
                                        <th>Education Level</th>
                                        <th>Created At</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Education Level</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>
                                            @if($subject->image)
                                                <img src="{{ asset('storage/' . $subject->image) }}"
                                                     alt="{{ $subject->name }}"
                                                     style="width: 50px; height: 50px; border-radius: 5px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($subject->educationLevel)
                                                <span class="badge badge-info">{{ $subject->educationLevel->name }}</span>
                                            @else
                                                <span class="text-muted">No Level</span>
                                            @endif
                                        </td>
                                        <td>{{ $subject->created_at ? $subject->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                {{-- <a href="{{ route('subjects.show', $subject) }}"
                                                    class="btn btn-link btn-info btn-lg"
                                                    data-original-title="View Subject">
                                                    <i class="fa fa-eye"></i>
                                                </a> --}}
                                                <a href="{{ route('subjects.edit', $subject) }}"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Subject">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('subjects.destroy', $subject) }}"
                                                    method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link btn-danger"
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
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
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
        // Initialize DataTables
        $('#add-row').DataTable({
            pageLength: 10,
            order: [[0, 'asc']],
            responsive: true
        });

        var action =
            '<td> <div class="form-button-action">' +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#editRowModal" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Subject">' +
            '<i class="fa fa-edit"></i></button>' +
            '<button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">' +
            '<i class="fa fa-times"></i></button>' +
            '</div> </td>';

        // Add Row
        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $('#addName').val(),
                $('#addImage').val(),
                $('#addEducationLevel').val(),
                $('#addCreatedAt').val(),
                action
            ]);
            $('#addRowModal').modal('hide');
        });

        // Fill edit modal on edit button click
        $(document).on('click', '[data-bs-target="#editRowModal"]', function() {
            var $tr = $(this).closest('tr');
            $('#editName').val($tr.find('td').eq(1).text());
            $('#editImage').val($tr.find('td').eq(2).text());
            $('#editEducationLevel').val($tr.find('td').eq(3).text());
            $('#editCreatedAt').val($tr.find('td').eq(4).text());
            // mark selected row
            $tr.addClass('selected').siblings().removeClass('selected');
        });

        // Update Row
        $('#editRowButton').click(function() {
            var $tr = $('tr.selected');
            $tr.find('td').eq(1).text($('#editName').val());
            $tr.find('td').eq(2).text($('#editImage').val());
            $tr.find('td').eq(3).text($('#editEducationLevel').val());
            $tr.find('td').eq(4).text($('#editCreatedAt').val());
            $('#editRowModal').modal('hide');
            $tr.removeClass('selected');
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>

<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Kaiadmin JS -->
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/setting-demo.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>
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
