<div class="modal fade" id="invoiceInfoModal" tabindex="-1" aria-labelledby="invoiceInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="invoicePrintForm" action="{{ route('invoice.generatePdf') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceInfoModalLabel">@lang('Invoice Information')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="additionalCharges" class="form-label">@lang('Additional Charges'):</label>
                            <input type="text" class="form-control" id="additionalCharges" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="totalAmount" class="form-label">@lang('Total Amount'):</label>
                            <input type="text" class="form-control" id="totalAmount" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="user" class="form-label">@lang('User'):</label>
                            <input type="text" class="form-control" id="user" readonly>
                        </div>
                        <input type="hidden" id="inputInvoiceId" name="id">
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="vehicleMake" class="form-label">@lang('Vehicle Make'):</label>
                            <input type="text" class="form-control" id="vehicleMake" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="vehicleRegistration" class="form-label">@lang('Vehicle Registration'):</label>
                            <input type="text" class="form-control" id="vehicleRegistration" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">@lang('Start Date'):</label>
                            <input type="text" class="form-control" id="startDate" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label">@lang('End Date'):</label>
                            <input type="text" class="form-control" id="endDate" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary"  id="printButton" data-bs-dismiss="modal">@lang('Print')</button>
                </div>
            </div>
        </form>
    </div>
</div>
