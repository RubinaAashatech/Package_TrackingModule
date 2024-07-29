@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h1>Create Parcel</h1>
    <form action="{{ route('api.parcels.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tracking_number">Tracking Number</label>
            <input type="text" class="form-control" id="tracking_number" name="tracking_number" required>
        </div>
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="receiver_id">Receiver</label>
            <select class="form-control" id="receiver_id" name="receiver_id" required>
                @foreach($receivers as $receiver)
                    <option value="{{ $receiver->id }}">{{ $receiver->fullname }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="carrier">Carrier</label>
            <input type="text" class="form-control" id="carrier" name="carrier" required>
        </div>

        <div class="form-group">
            <label for="carrier">Sending Date</label>
            <input type="date" class="form-control" name="sending_date" value="{{ \Illuminate\Support\Carbon::now()->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <div class="form-group">
            <label for="estimated_delivery_date">Estimated Delivery Date</label>
            <input type="date" class="form-control" id="estimated_delivery_date" name="estimated_delivery_date" required>
        </div>

        <!-- Hidden input field for sending_date -->
      

        <button type="submit" class="btn btn-primary">Create Parcel</button>
    </form>
</div>

@endsection
