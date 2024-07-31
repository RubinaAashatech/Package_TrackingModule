@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Track Your Parcel</h1>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <form id="trackingForm">
                        @csrf
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="Enter your tracking number" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Track Parcel</button>
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
                    var updates = response.tracking_updates;
                    var receiver = response.receiver;

                    var html = '<div class="card shadow-sm border-light">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">Parcel Information</h5>' +
                        '<table class="table table-striped table-bordered">' +
                        '<tbody>' +
                        '<tr><th>Tracking Number</th><td>' + parcel.tracking_number + '</td></tr>' +
                        '<tr><th>Carrier</th><td>' + parcel.carrier + '</td></tr>' +
                        '<tr><th>Sending Date</th><td>' + parcel.sending_date + '</td></tr>' +
                        '<tr><th>Weight</th><td>' + parcel.weight + ' kg</td></tr>' +
                        '<tr><th>Status</th><td>' + parcel.status + '</td></tr>' +
                        '<tr><th>Estimated Delivery Date</th><td>' + parcel.estimated_delivery_date + '</td></tr>' +
                        '</tbody>' +
                        '</table>' +
                        '<h6 class="mt-4">Receiver Information</h6>' +
                        '<table class="table table-striped table-bordered">' +
                        '<tbody>' +
                        '<tr><th>Receiver Name</th><td>' + receiver.fullname + '</td></tr>' +
                        '</tbody>' +
                        '</table>' +
                        '<h6 class="mt-4">Tracking Updates</h6>' +
                        '<table class="table table-striped table-bordered">' +
                        '<thead>' +
                        '<tr><th>Date & Time</th><th>Location</th><th>Activity</th></tr>' +
                        '</thead>' +
                        '<tbody>';

                    updates.forEach(function(update) {
                        html += '<tr>' +
                            '<td>' + update.created_at + '</td>' +
                            '<td>' + (update.location || 'N/A') + '</td>' +
                            '<td>' + update.status + '</td>' +
                            '</tr>';
                    });

                    html += '</tbody>' +
                        '</table>' +
                        '</div></div>';

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
