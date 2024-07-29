@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h1>Edit Parcel</h1>
    <form action="{{ route('api.parcels.update', $parcel) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tracking_number">Tracking Number</label>
            <input type="text" class="form-control" id="tracking_number" name="tracking_number" value="{{ $parcel->tracking_number }}" required>
        </div>
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->id == $parcel->customer_id ? 'selected' : '' }}>
                        {{ $customer->fullname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="receiver_id">Receiver</label>
            <select class="form-control" id="receiver_id" name="receiver_id" required>
                @foreach($receivers as $receiver)
                    <option value="{{ $receiver->id }}" {{ $receiver->id == $parcel->receiver_id ? 'selected' : '' }}>
                        {{ $receiver->fullname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="carrier">Carrier</label>
            <input type="text" class="form-control" id="carrier" name="carrier" value="{{ $parcel->carrier }}" required>
        </div>
        <div class="form-group">
            <label for="sending_date">Sending Date</label>
            <input type="date" class="form-control" id="sending_date" name="sending_date" value="{{ $parcel->sending_date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" step="0.01" value="{{ $parcel->weight }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $parcel->status }}" required>
        </div>
        <div class="form-group">
            <label for="estimated_delivery_date">Estimated Delivery Date</label>
            <input type="date" class="form-control" id="estimated_delivery_date" name="estimated_delivery_date" value="{{ $parcel->estimated_delivery_date->format('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Parcel</button>
    </form>
</div>

@endsection
