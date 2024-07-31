@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Tracking Updates</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('api.tracking-updates.updateOrCreate') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-row">
            <div class="col-md-4">
                <select name="parcel_id" class="form-control" required>
                    <option value="">Select Parcel</option>
                    @foreach($parcels as $parcel)
                        <option value="{{ $parcel->id }}">
                            {{ $parcel->tracking_number }} - {{ $parcel->receiver->full_name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="location" class="form-control" placeholder="Location">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Update/Create Tracking</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tracking Number</th>
                <th>Status</th>
                <th>Location</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trackingUpdates as $update)
                <tr>
                    <td>{{ $update->id }}</td>
                    <td>{{ $update->tracking_number }}</td>
                    <td>{{ $update->status }}</td>
                    <td>{{ $update->location }}</td>
                    <td>{{ $update->description }}</td>
                    <td>{{ $update->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $update->updated_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('api.tracking-updates.edit', $update) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('api.tracking-updates.destroy', $update) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tracking update?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $trackingUpdates->links() }}
</div>
@endsection