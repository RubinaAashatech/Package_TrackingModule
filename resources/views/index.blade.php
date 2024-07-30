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
                var parcel = response.parcel;
                var latestUpdate = response.latest_update;
                
                var html = '<div class="card">' +
                    '<div class="card-body">' +
                    '<h5 class="card-title">Parcel Information</h5>' +
                    '<p><strong>Tracking Number:</strong> ' + parcel.tracking_number + '</p>' +
                    '<p><strong>Carrier:</strong> ' + parcel.carrier + '</p>' +
                    '<p><strong>Sending Date:</strong> ' + parcel.sending_date + '</p>' +
                    '<p><strong>Weight:</strong> ' + parcel.weight + ' kg</p>' +
                    '<p><strong>Status:</strong> ' + parcel.status + '</p>' +
                    '<p><strong>Estimated Delivery Date:</strong> ' + parcel.estimated_delivery_date + '</p>' +
                    '<h6 class="mt-4">Latest Update</h6>' +
                    '<p><strong>Status:</strong> ' + (latestUpdate ? latestUpdate.status : 'N/A') + '</p>' +
                    '<p><strong>Location:</strong> ' + (latestUpdate ? latestUpdate.location : 'N/A') + '</p>' +
                    '<p><strong>Description:</strong> ' + (latestUpdate ? latestUpdate.description : 'N/A') + '</p>' +
                    '<p><strong>Last Updated:</strong> ' + (latestUpdate ? latestUpdate.created_at : 'N/A') + '</p>' +
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