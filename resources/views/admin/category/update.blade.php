@extends('admin.layouts.master')

@section('content')<html>
    <head>
        <title>Update</title>
        {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
        {{-- <link rel="stylesheet" href={{asset('css/style.css')}}> --}}
    </head>
    <body>
                    <form action="{{ route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input id="id" value="{{ $category->id }}" hidden> 
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{$category->title}}" class="form-control">
                        </div>
                    

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                    @endsection

    </body>
</html>