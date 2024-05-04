<div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">Add Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addInvoiceForm" method="POST" >
                    {{-- action="{{route('admin.generateInvoice')}}" --}}
                    @csrf
                    <div class="mb-3">
                        <label for="additionalCharges" class="form-label">Additional Charges</label>
                        <input type="number" class="form-control" id="additionalCharges" name="additionalCharges">
                    </div>
                    <div class="mb-3">
                        <label for="totalAmount" class="form-label">Total Amount</label>
                        <input type="number" disabled class="form-control" id="totalAmount" name="totalAmount">
                    </div>
                    
                        <input type="hidden" class="form-control" id="invoicerepair_id" name="repair_id">
                  
                    <!-- Add other fields related to invoices here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn submitInvoice btn-primary" id="submitInvoice">Add Invoice</button>
            </div>
        </div>
    </div>
</div>
