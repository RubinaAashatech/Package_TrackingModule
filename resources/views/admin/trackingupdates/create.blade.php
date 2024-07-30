@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Create New Tracking Update</h1>

    {{-- Uncomment this block if you want to display validation errors --}}
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
            <label for="parcel_id">Receiver</label>
            <select name="parcel_id" id="parcel_id" class="form-control" required>
                <option value="">Select a Receiver</option>
                @foreach($parcels as $parcel)
                    <option value="{{ $parcel->id }}" data-tracking="{{ $parcel->tracking_number }}">
                        {{ $parcel->receiver->fullname ?? 'Unknown Receiver' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tracking_number">Tracking Number</label>
            <input type="text" name="tracking_number" id="tracking_number" class="form-control" readonly>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const parcelSelect = document.getElementById('parcel_id');
        const trackingNumberInput = document.getElementById('tracking_number');

        parcelSelect.addEventListener('change', function() {
            const selectedOption = parcelSelect.options[parcelSelect.selectedIndex];
            const trackingNumber = selectedOption.getAttribute('data-tracking');
            trackingNumberInput.value = trackingNumber ? trackingNumber : '';
        });
    });
</script>
@endsection
