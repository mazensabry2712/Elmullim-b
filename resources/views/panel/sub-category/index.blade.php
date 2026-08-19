@extends('panel.layouts.index')

@section('title', 'Sub Categories | Elmullim')

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
                                <h4 class="card-title">Sub Categories</h4>
                                <a href="{{ route('sub-categories.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Sub Category
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="subcategoriesTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $subcategory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($subcategory->image)
                                                        <img src="{{ asset('storage/' . $subcategory->image) }}"
                                                            alt="{{ $subcategory->name }}" class="img-thumbnail"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <span class="badge bg-secondary">No Image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $subcategory->name }}</td>
                                                <td>
                                                    @if ($subcategory->category)
                                                        <span
                                                            class="badge bg-primary">{{ $subcategory->category->name }}</span>
                                                    @else
                                                        <span class="badge bg-warning">No Category</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($subcategory->description)
                                                        {{ Str::limit($subcategory->description, 50) }}
                                                    @else
                                                        <span class="text-muted">No Description</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        {{-- <a href="{{ route('subcategories.show', $subcategory) }}"
                                                    class="btn btn-link btn-info btn-lg"
                                                    data-bs-toggle="tooltip"
                                                    title="View Sub Category">
                                                    <i class="fa fa-eye"></i>
                                                </a> --}}
                                                        <a href="{{ route('sub-categories.edit', $subcategory) }}"
                                                            class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip"
                                                            title="Edit Sub Category">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('sub-categories.destroy', $subcategory) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-link btn-danger btn-lg"
                                                                data-bs-toggle="tooltip" title="Delete Sub Category"
                                                                onclick="return confirm('Are you sure you want to delete this sub category?')">
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete sub category: <strong id="subcategoryName"></strong>?
                    <br><small class="text-muted">This action cannot be undone.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#subcategoriesTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                "responsive": true,
                "order": [
                    [2, 'asc']
                ],
                "columnDefs": [{
                    "targets": [1, 5],
                    "orderable": false
                }],
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "zeroRecords": "No matching records found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "search": "Search:",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });

            // Delete button functionality
            $(document).on('click', '.delete-btn', function() {
                var subcategoryId = $(this).data('subcategory-id');
                var subcategoryName = $(this).data('subcategory-name');

                $('#subcategoryName').text(subcategoryName);
                $('#deleteForm').attr('action', "{{ url('subcategories') }}" + "/" + subcategoryId);
                $('#deleteModal').modal('show');
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
