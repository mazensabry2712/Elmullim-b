@extends('panel.layouts.index')

@section('title', 'Contents | Elmullim')

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
                            <h4 class="card-title">Contents</h4>
                            <a href="{{ route('contents.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Content
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
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($contents as $content)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $content->title }}</td>
                                        <td>
                                            @if($content->description)
                                                {{ Str::limit($content->description, 100) }}
                                            @else
                                                <span class="text-muted">No Description</span>
                                            @endif
                                        </td>
                                        <td>{{ $content->created_at ? $content->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('contents.show', $content->id) }}"
                                                    class="btn btn-link btn-info btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="View Content">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('contents.edit', $content->id) }}"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    data-original-title="Edit Content">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('contents.destroy', $content->id) }}"
                                                    method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this content?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link btn-danger"
                                                        data-bs-toggle="tooltip"
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
            responsive: true,
            columnDefs: [
                {
                    targets: -1,
                    orderable: false
                }
            ]
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Show success message with auto-hide
        @if(session('success'))
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 5000);
        @endif
    });
</script>
@endpush
