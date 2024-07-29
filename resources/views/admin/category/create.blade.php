@extends('admin.layouts.master')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    
</head>
<body>
    <h1>Add Category</h1><br>
    <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>
</body>
</html>
@endsection