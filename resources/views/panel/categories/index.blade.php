@extends('panel.layouts.index')

@section('title', 'Categories | Elmullim')

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
                                <h4 class="card-title">Categories</h4>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Category
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
                                            <th>Description</th>
                                            <th>Image</th>
                                            {{-- <th>Created At</th> --}}
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            {{-- <th>Created At</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($category->image)
                                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                                alt="{{ $category->name }}" class="rounded me-2"
                                                                width="32" height="32" style="object-fit: cover;">
                                                        @else
                                                            <div
                                                                class="avatar avatar-sm bg-primary text-white rounded me-2 d-flex align-items-center justify-content-center">
                                                                {{ strtoupper(substr($category->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                        <span>{{ $category->name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-truncate"
                                                        style="max-width: 250px; display: inline-block;"
                                                        title="{{ $category->description }}">
                                                        {{ Str::limit($category->description, 80) ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($category->image)
                                                        <img src="{{ asset('storage/' . $category->image) }}"
                                                            alt="{{ $category->name }}" class="rounded"
                                                            width="50" height="50" style="object-fit: cover;"
                                                            data-bs-toggle="modal" data-bs-target="#imageModal"
                                                            data-image="{{ asset('storage/' . $category->image) }}"
                                                            data-title="{{ $category->name }}"
                                                            style="cursor: pointer;">
                                                    @else
                                                        <span class="text-muted">No Image</span>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    <span class="text-muted">
                                                        {{ $category->created_at->format('M d, Y') }}
                                                    </span>
                                                </td> --}}
                                                <td>
                                                    <div class="form-button-action">
                                                        {{-- <a href="{{ route('categories.show', $category->id) }}"
                                                            class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip"
                                                            data-original-title="View Category">
                                                            <i class="fa fa-eye"></i>
                                                        </a> --}}
                                                        <a href="{{ route('categories.edit', $category->id) }}"
                                                            class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip"
                                                            data-original-title="Edit Category">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('categories.destroy', $category->id) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger"
                                                                data-bs-toggle="tooltip"
                                                                data-original-title="Delete Category">
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

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Category Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid rounded">
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
        .avatar {
            width: 32px;
            height: 32px;
            font-size: 12px;
            font-weight: bold;
        }

        .table td img {
            border: 1px solid #dee2e6;
        }

        .table td img:hover {
            opacity: 0.8;
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
                        targets: [5]
                    } // Disable sorting for action column
                ]
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Handle image modal
            $('#imageModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var imageSrc = button.data('image');
                var imageTitle = button.data('title');

                var modal = $(this);
                modal.find('.modal-title').text(imageTitle);
                modal.find('#modalImage').attr('src', imageSrc).attr('alt', imageTitle);
            });
        });
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
