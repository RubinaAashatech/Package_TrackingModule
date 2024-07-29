@extends('admin.layouts.master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Site Settings</h1>
        <div class="lead">
            {{-- <a href="{{ route('admin.sitesetting.create') }}" class="btn btn-primary btn-sm float-right">Create Site Setting</a> --}}
        </div>
        <br><br>

        <table id="sitesettingTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Office Name</th>
                    <th>Office Phone</th>
                    <th>Office Mail</th>
                    <th>Office Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#sitesettingTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.sitesetting.index') }}",
                "columns": [
                    { "data": "id" },
                    { 
                        "data": "main_logo",
                        "render": function (data, type, full, meta) {
                            return '<img src="' + data + '" height="50"/>';
                        },
                        "orderable": false,
                        "searchable": false
                    },
                    { "data": "office_name", "name": "office_name" },
                    { "data": "office_phone","name": "office_phone"  },
                    { "data": "office_mail","name": "office_mail"  },
                    { "data": "office_address","name": "office_address"  },
                    { "data": "actions", "orderable": false, "searchable": false }
                ]
            });
        });
    </script>
@endsection
