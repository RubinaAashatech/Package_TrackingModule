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
</div>

<div id="trackingDetails" class="container mt-4" style="display: none;">
    <div class="card">
        <div class="card-header bg-purple text-white">
            <h2 class="mb-0">AWB No: <span id="awb-number"></span></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Label Created</span>
                        <span>Pick Up</span>
                        <span>In Transit</span>
                        <span>Out for Delivery</span>
                        <span>Delivered</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <h4 class="mb-3">Tracking Details</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-purple text-white">
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Location</th>
                                    <th>Activity</th>
                                </tr>
                            </thead>
                            <tbody id="tracking-updates">
                                <!-- Tracking updates will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <h5 class="mb-0">Consignee Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Delivery Date:</strong> <span id="delivery-date"></span></p>
                            <p><strong>Delivery Address:</strong> <span id="delivery-address"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-purple {
        background-color: #4B0082;
    }
    .progress {
        height: 5px;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.05);
    }
</style>
@endpush

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
            $('#trackingDetails').hide(); // Hide tracking details before loading new data

            $.ajax({
                url: '{{ route("api.track") }}',
                method: 'POST',
                data: { tracking_number: trackingNumber },
                dataType: 'json',
                success: function(response) {
                    var parcel = response.parcel;
                    var updates = response.tracking_updates;
                    var receiver = response.receiver;

                    $('#awb-number').text(parcel.tracking_number);
                    $('#delivery-date').text(parcel.estimated_delivery_date);
                    $('#delivery-address').text(receiver.country + ', ' + receiver.city + ', ' + receiver.postal_code);

                    // Update progress bar width based on parcel status
                    var progressPercent = calculateProgressPercent(parcel.status);
                    $('.progress-bar').css('width', progressPercent + '%');

                    var updatesHtml = '';
                    updates.forEach(function(update) {
                        updatesHtml += '<tr>' +
                            '<td>' + update.created_at + '</td>' +
                            '<td>' + update.location + '</td>' +  // Uncomment if location is available
                            '<td>' + update.status + '</td>' +
                            '</tr>';
                    });
                    $('#tracking-updates').html(updatesHtml);

                    $('#trackingDetails').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                    alert('Parcel not found or an error occurred');
                }
            });
        });

        function calculateProgressPercent(status) {
            // Example implementation, adjust based on your status data
            switch(status) {
                case 'Delivered': return 100;
                case 'Out for Delivery': return 80;
                case 'In Transit': return 60;
                case 'Pick Up': return 40;
                case 'Label Created': return 20;
                default: return 0;
            }
        }
    });
</script>
@endpush
