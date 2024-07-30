@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Track Your Parcel</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="trackingForm">
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Track Parcel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="result" class="mt-4"></div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#trackingForm').submit(function(e) {
        e.preventDefault();
        var trackingNumber = $('#tracking_number').val();
        
        $.ajax({
            url: '/api/track',
            method: 'POST',
            data: { tracking_number: trackingNumber },
            success: function(response) {
                var html = '<div class="card">' +
                    '<div class="card-body">' +
                    '<h5 class="card-title">Parcel Information</h5>' +
                    '<p><strong>Tracking Number:</strong> ' + response.parcel.tracking_number + '</p>' +
                    '<p><strong>Carrier:</strong> ' + response.parcel.carrier + '</p>' +
                    '<p><strong>Status:</strong> ' + (response.latest_update ? response.latest_update.status : 'N/A') + '</p>' +
                    '<p><strong>Current Location:</strong> ' + (response.latest_update ? response.latest_update.location : 'N/A') + '</p>' +
                    '<p><strong>Last Update:</strong> ' + (response.latest_update ? response.latest_update.created_at : 'N/A') + '</p>' +
                    '</div></div>';
                $('#result').html(html);
            },
            error: function(xhr) {
                $('#result').html('<div class="alert alert-danger">Parcel not found</div>');
            }
        });
    });
});
</script>
@endpush