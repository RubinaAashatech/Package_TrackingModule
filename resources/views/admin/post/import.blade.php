@extends('admin.layouts.master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Import Posts</h1>
        <form action="{{ route('admin.post.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choose File:</label>
                <input type="file" name="file" id="file" accept=".csv">
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
@endsection
