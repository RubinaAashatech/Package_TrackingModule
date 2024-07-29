@extends('admin.layouts.master')

@section('content')
    <div class="bg-light p-4 rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Category</h1>
                <div class="lead">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">Add new category</a>
                </div>
            </div>
            <div class="d-flex">
                <form action="{{ route('admin.category.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".csv">
                    <button type="submit" class="btn btn-primary btn-sm mt-6">Import</button>
                </form>
                <form id="exportForm" action="{{ route('admin.category.export') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm mt-6">Export</button>
                </form>
            </div>
        </div>
        <table id="categoryTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.category.index') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "slug" },
                    { "data": "actions", "searchable": false, "orderable": false }
                ]
            });
        });
    </script>
@endsection