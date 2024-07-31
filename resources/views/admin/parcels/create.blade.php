@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h1>Create Parcel</h1>
    <form action="{{ route('api.parcels.create') }}" method="GET">
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control" id="customer_id" name="customer_id" onchange="this.form.submit()">
                <option value="">Select a Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $selectedCustomer && $selectedCustomer->id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->fullname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="receiver_id">Receiver</label>
            <select class="form-control" id="receiver_id" name="receiver_id" onchange="this.form.submit()">
                <option value="">Select a Receiver</option>
                @foreach($receivers as $receiver)
                    <option value="{{ $receiver->id }}" {{ $selectedReceiver && $selectedReceiver->id == $receiver->id ? 'selected' : '' }}>
                        {{ $receiver->fullname }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <form action="{{ route('api.parcels.store') }}" method="POST">
        @csrf
        <input type="hidden" name="customer_id" value="{{ $selectedCustomer ? $selectedCustomer->id : '' }}">
        <input type="hidden" name="receiver_id" value="{{ $selectedReceiver ? $selectedReceiver->id : '' }}">
        
        <div class="form-group">
            <label for="receiver_country">Country</label>
            <input type="text" class="form-control" id="receiver_country" name="receiver_country" value="{{ $receiverCountry }}" readonly required>
        </div>
        <div class="form-group">
            <label for="receiver_state">State</label>
            <input type="text" class="form-control" id="receiver_state" name="receiver_state" value="{{ $receiverState }}" readonly required>
        </div>
        <div class="form-group">
            <label for="receiver_city">City</label>
            <input type="text" class="form-control" id="receiver_city" name="receiver_city" value="{{ $receiverCity }}" readonly required>
        </div>
        <div class="form-group">
            <label for="receiver_street_address">Street Address</label>
            <input type="text" class="form-control" id="receiver_street_address" name="receiver_street_address" value="{{ $receiverStreetAddress }}" readonly required>
        </div>
        <div class="form-group">
            <label for="receiver_postal_code">Postal Code</label>
            <input type="text" class="form-control" id="receiver_postal_code" name="receiver_postal_code" value="{{ $receiverPostalCode }}" readonly required>
        </div>
        <div class="form-group">
            <label for="carrier">Carrier</label>
            <input type="text" class="form-control" id="carrier" name="carrier" required>
        </div>
        <div class="form-group">
            <label for="sending_date">Sending Date</label>
            <input type="date" class="form-control" name="sending_date" value="{{ \Illuminate\Support\Carbon::now()->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" >
        </div>
        <div class="form-group">
            <label for="estimated_delivery_date">Estimated Delivery Date</label>
            <input type="date" class="form-control" id="estimated_delivery_date" name="estimated_delivery_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Parcel</button>
    </form>
</div>

@endsection
