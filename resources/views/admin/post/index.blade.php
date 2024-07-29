@extends('admin.layouts.master')

@section('content')
    <div class="bg-light p-4 rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>{{ trans('admin.Post') }}</h1>
                <div class="lead">
                    <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-sm">Add new post</a><br>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ route('admin.post.import') }}" class="btn btn-primary btn-sm mt-6">Import</a>
                <form id="importForm" action="{{ route('admin.post.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm mt-6">Export</button>
                </form>
            </div>
        </div>

        {{-- <div class="form-group">
            <label for="category">Select Category:</label>
            <select name="category" id="Category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div><br> --}}

        {{-- <button type="button" id="searchButton" class="btn btn-primary btn-sm">Search</button> --}}

        <table id="postTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#postTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.post.index') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "slug" },
                    { "data": "description" },
                    { 
                        "data": "image",
                        "render": function(data, type, full, meta) {
                            return '<img src="/storage/' + data + '" alt="Post Image" style="max-width: 100px; max-height: 100px;">';
                        }
                    },
                    { "data": "category" },
                    { "data": "actions", "searchable": false, "orderable": false }
                ]
            });
    
            $('#Category').change(function () {
                var category = $(this).val();
                table.columns(5).search(category).draw();
            });
        });
    </script>
    
    
@endsection
