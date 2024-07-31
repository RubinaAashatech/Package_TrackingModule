@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Track Your Parcel</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="trackingForm">
                        @csrf
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
                    var updates = response.tracking_updates; // All tracking updates
                    var receiver = response.receiver;
                    
                    var html = '<div class="card">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">Parcel Information</h5>' +
                        '<p><strong>Tracking Number:</strong> ' + parcel.tracking_number + '</p>' +
                        '<p><strong>Carrier:</strong> ' + parcel.carrier + '</p>' +
                        '<p><strong>Sending Date:</strong> ' + parcel.sending_date + '</p>' +
                        '<p><strong>Weight:</strong> ' + parcel.weight + ' kg</p>' +
                        '<p><strong>Status:</strong> ' + parcel.status + '</p>' +
                        '<p><strong>Estimated Delivery Date:</strong> ' + parcel.estimated_delivery_date + '</p>' +
                        '<h6 class="mt-4">Receiver Information</h6>' +
                        '<p><strong>Receiver Name:</strong> ' + receiver.fullname  + '</p>' +
                        '<h6 class="mt-4">Tracking Updates</h6>';
    
                    if (updates.length > 0) {
                        updates.forEach(function(update) {
                            html += '<div class="update-card">' +
                                '<p><strong>Status:</strong> ' + update.status + '</p>' +
                                '<p><strong>Last Updated:</strong> ' + update.created_at + '</p>' +
                                '<hr>' +
                                '</div>';
                        });
                    } else {
                        html += '<p>No tracking updates available.</p>';
                    }
    
                    html += '</div></div>';
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