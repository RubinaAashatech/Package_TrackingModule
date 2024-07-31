@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Tracking Updates</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tracking Updates Table -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tracking Number</th>
                <th>Receiver Name</th>
                <th>Status</th>
                <th>Location</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trackingUpdates as $update)
            <tr id="row-{{ $update->id }}" data-disabled="false">
                <td>{{ $update->id }}</td>
                <td>{{ $update->tracking_number }}</td>
                <td>{{ $update->parcel->receiver->fullname ?? 'N/A' }}</td>
                <td>{{ $update->status }}</td>
                <td>{{ $update->location }}</td>
                <td>{{ $update->description }}</td>
                <td>{{ $update->created_at->format('Y-m-d') }}</td>
                <td>{{ $update->updated_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('api.tracking-updates.edit', $update) }}" class="btn btn-warning btn-sm edit-btn">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm disable-btn" 
                            onclick="disableRow('{{ $update->id }}')">Disable</button>
                    <button type="button" class="btn btn-info btn-sm update-status-btn" 
                            onclick="openUpdateStatusModal('{{ $update->id }}')">Update Status</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $trackingUpdates->links() }}

    <!-- Modal for Updating Status -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Tracking Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update-status-form" method="POST" action="{{ route('api.tracking-updates.updateStatus') }}">
                    @csrf
                    <input type="hidden" name="tracking_update_id" id="tracking_update_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .disabled-row {
        opacity: 0.5;
        pointer-events: none;
    }
</style>
<script>
    function openUpdateStatusModal(trackingUpdateId) {
        document.getElementById('tracking_update_id').value = trackingUpdateId;
        var updateStatusModal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
        updateStatusModal.show();
    }

    function disableRow(updateId) {
    if (confirm('Are you sure you want to disable this tracking update?')) {
        var row = document.getElementById('row-' + updateId);
        
        if (row.dataset.disabled === 'true') {
            return;
        }

        row.classList.add('disabled-row');
        row.dataset.disabled = 'true';

        var buttons = row.querySelectorAll('button, a');
        buttons.forEach(function(button) {
            button.disabled = true;
        });

        localStorage.setItem('tracking_update_' + updateId + '_disabled', 'true');

        alert('Tracking update disabled successfully.');
    }
}

    function applyDisabledStates() {
        var rows = document.querySelectorAll('[id^="row-"]');
        rows.forEach(function(row) {
            var updateId = row.id.split('-')[1];
            if (localStorage.getItem('tracking_update_' + updateId + '_disabled') === 'true') {
                row.classList.add('disabled-row');
                row.dataset.disabled = 'true';
                var buttons = row.querySelectorAll('button, a');
                buttons.forEach(function(button) {
                    button.disabled = true;
                });
            }
        });
    }

document.addEventListener('DOMContentLoaded', applyDisabledStates);
</script>
@endsection
