@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Create New Tracking Update</h1>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form action="{{ route('api.tracking-updates.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="parcel_id">Parcel</label>
            <select name="parcel_id" id="parcel_id" class="form-control" required>
                <option value="">Select a Parcel</option>
                @foreach($parcels as $parcel)
                    <option value="{{ $parcel->id }}">{{ $parcel->tracking_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Tracking Update</button>
    </form>
</div>
@endsection