@extends('admin.layouts.master')

@section('content')<html><html>
    <head>
        <title>Update</title>
        {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
        {{-- <link rel="stylesheet" href={{asset('css/style.css')}}> --}}
    </head>
    <body>
                    <form action="{{ route('admin.post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{$post->title}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Description</label>
                            <textarea name="description"  class="form-control">{{$post->description}}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" value="{{$post->image}}" class="form-control" id="ImageInput">
                            <img src="{{ asset('storage/' . $post->image) }}" id="ImagePreview">

                        </div>
                        <div class="form-group mb-3">
                        <label for="categories">Select Categories:</label>
                         <select name="categories[]" multiple>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                         @endforeach
                        </select>
                        </div>
                        

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>

    </body>
</html>

<!-- JavaScript for image preview -->
<script>
    $(document).ready(function() {
        // Image preview
        $('#ImageInput').change(function() {
            readURL(this, '#ImagePreview');
        });


        // Function to read selected image and display it in the preview
        function readURL(input, previewElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(previewElement).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endsection