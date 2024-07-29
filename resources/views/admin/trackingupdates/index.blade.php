@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Tracking Updates</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('api.tracking-updates.create') }}" class="btn btn-primary mb-3">Add New Tracking Update</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Parcel Tracking Number</th>
                <th>Status</th>
                <th>Location</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trackingUpdates as $update)
                <tr>
                    <td>{{ $update->id }}</td>
                    <td>{{ $update->parcel->tracking_number }}</td>
                    <td>{{ $update->status }}</td>
                    <td>{{ $update->location }}</td>
                    <td>{{ $update->description }}</td>
                    <td>{{ $update->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('tracking-updates.show', $update) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tracking-updates.edit', $update) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tracking-updates.destroy', $update) }}" method="POST" style="display:inline;">
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