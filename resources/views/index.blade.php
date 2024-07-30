@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 page-title">Track Your Parcel</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card tracking-card">
                <div class="card-body">
                    <form id="trackingForm">
                        @csrf
                        <div class="form-group">
                            <label for="tracking_number" class="font-weight-bold">Tracking Number</label>
                            <input type="text" class="form-control form-control-lg" id="tracking_number" name="tracking_number" placeholder="Enter your tracking number" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Track Parcel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="result" class="mt-4">
        <!-- Result will be displayed here -->
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-title {
        color: #2c3e50;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .tracking-card {
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tracking-card .card-body {
        padding: 2rem;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 1.1rem;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    #result .card {
        border-radius: 15px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #result .card-body {
        padding: 1.5rem;
    }

    .card-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .parcel-info p {
        margin: 0.5rem 0;
    }

    .parcel-info p strong {
        color: #3498db;
    }

    .parcel-info .address {
        background-color: #f9f9f9;
        padding: 1rem;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .latest-update {
        background-color: #f2f2f2;
        padding: 1rem;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .latest-update h6 {
        font-weight: bold;
        color: #3498db;
    }

    .alert-danger {
        border-radius: 15px;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#trackingForm').submit(function(e) {
        e.preventDefault();
        var trackingNumber = $('#tracking_number').val();
        
        $.ajax({
            url: '{{ route("api.track") }}',
            method: 'POST',
            data: { tracking_number: trackingNumber },
            dataType: 'json',
            success: function(response) {
                var parcel = response.parcel;
                var receiver = response.receiver;
                var latestUpdate = response.latest_update;
                
                var html = '<div class="card tracking-card">' +
                    '<div class="card-body parcel-info">' +
                    '<h5 class="card-title">Parcel Information</h5>' +
                    '<p><strong>Tracking Number:</strong> ' + parcel.tracking_number + '</p>' +
                    '<p><strong>Carrier:</strong> ' + parcel.carrier + '</p>' +
                    '<p><strong>Sending Date:</strong> ' + parcel.sending_date + '</p>' +
                    '<p><strong>Weight:</strong> ' + parcel.weight + ' kg</p>' +
                    '<p><strong>Status:</strong> ' + parcel.status + '</p>' +
                    '<p class="address"><strong>Address:</strong> ' + 
                        receiver.country + ', ' + 
                        receiver.state + ', ' + 
                        receiver.city + ', ' + 
                        receiver.street_address + ', ' + 
                        receiver.postal_code + 
                        '</p>' +
                    '<p><strong>Estimated Delivery Date:</strong> ' + parcel.estimated_delivery_date + '</p>' +
                    '</div>' +
                    '<div class="latest-update mt-4">' +
                    '<h6>Latest Update</h6>' +
                    '<p><strong>Status:</strong> ' + (latestUpdate ? latestUpdate.status : 'N/A') + '</p>' +
                    '<p><strong>Location:</strong> ' + (latestUpdate ? latestUpdate.location : 'N/A') + '</p>' +
                    '<p><strong>Description:</strong> ' + (latestUpdate ? latestUpdate.description : 'N/A') + '</p>' +
                    '<p><strong>Last Updated:</strong> ' + (latestUpdate ? latestUpdate.created_at : 'N/A') + '</p>' +
                    '</div>' +
                    '</div>';
                $('#result').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
                $('#result').html('<div class="alert alert-danger">Parcel not found or an error occurred</div>');
            }
        });
    });
});
</script>
@endpush
