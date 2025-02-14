<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            @include('admin.includes.sidebar')
            <div class="content">
                @include('admin.includes.navbar')
                @yield('content')
                @include('admin.includes.footer')
            </div>
        </div>
    </main>
    @include('admin.includes.customsidebar')
    @include('admin.includes.scripts')

    <!-- Summernote JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true
            });

            
            $('#thetable').DataTable({
                dom: 'lBfrtip',
                "iDisplayLength": 30,
                "lengthMenu": [10, 25, 30, 50, 75, 100, 200],
                buttons: [
                    'copy', 'print',
                    {extend: 'excel', filename: 'PartDetails', footer: true},
                    {extend: 'pdf', filename: 'PartDetails'},
                    {extend: 'csvHtml5', filename: 'PartDetails'},
                    {extend: 'collection', text: 'columns', buttons: ['columnsVisibility']}
                ],
                searching: true,
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true
            });
        });
    </script> --}}
     
</body>
</html>
