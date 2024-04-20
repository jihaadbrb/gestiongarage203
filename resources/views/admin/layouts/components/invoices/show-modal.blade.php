<div class="modal fade" id="invoiceInfoModal" tabindex="-1" aria-labelledby="invoiceInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceInfoModalLabel">Invoice Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="additionalCharges" class="form-label">Additional Charges:</label>
                        <input type="text" class="form-control" id="additionalCharges" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="totalAmount" class="form-label">Total Amount:</label>
                        <input type="text" class="form-control" id="totalAmount" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="user" class="form-label">User:</label>
                        <input type="text" class="form-control" id="user" readonly>
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="mechanic" class="form-label">Mechanic:</label>
                        <input type="text" class="form-control" id="mechanic" readonly>
                    </div> --}}
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="vehicleMake" class="form-label">Vehicle Make:</label>
                        <input type="text" class="form-control" id="vehicleMake" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleRegistration" class="form-label">Vehicle Registration:</label>
                        <input type="text" class="form-control" id="vehicleRegistration" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="startDate" class="form-label">Start Date:</label>
                        <input type="text" class="form-control" id="startDate" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="endDate" class="form-label">End Date:</label>
                        <input type="text" class="form-control" id="endDate" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Print</button>
            </div>
        </div>
    </div>
</div>
