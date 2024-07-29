
@extends('admin.layouts.master')

@section('content')
    <div class="bg-light p-4 rounded">
      
        <h1>Permissions</h1>
        <div class="lead">
            Manage your permission here.
            <a href="{{ route('admin.permission.create') }}" class="btn btn-primary btn-sm float-right">Add new permission</a>
        </div>
        <br><br>

        <table id="categoryTable" class="table table-striped">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Guard</th>
                    <th>Actions</th>
                   
                </tr>
            </thead>
        </table>
    </div>

    <!-- Include DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.permission.index') }}",
                "columns": [
                    { "data": "name" },
                    { "data": "guard_name" },
                    { "data": "actions", "searchable": false, "orderable": false }
                ]
            });
        });
    </script>
@endsection
