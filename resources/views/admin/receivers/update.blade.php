@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h1>Edit Receiver</h1>
    <form action="{{ route('api.receivers.update', $receiver) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="fullname">Fullname:</label>
            <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname', $receiver->fullname) }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $receiver->address) }}">
        </div>
        <div class="form-group">
            <label for="phone_no">Phone No:</label>
            <input type="number" name="phone_no" id="phone_no" class="form-control" value="{{ old('phone_no', $receiver->phone_no) }}" min="1" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $receiver->email) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('api.receivers.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection 