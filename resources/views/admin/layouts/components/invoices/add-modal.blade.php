<div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">{{ __('Add Invoice') }}</h5>
            </div>
            <div class="modal-body">
                <form id="addInvoiceForm" method="POST" >
                    {{-- action="{{route('admin.generateInvoice')}}" --}}
                    @csrf
                    <div class="mb-3">
                        <label for="additionalCharges" class="form-label">{{ __('Additional Charges') }}</label>
                        <input type="number" class="form-control" id="additionalCharges" name="additionalCharges">
                    </div>
                    <div class="mb-3">
                        <label for="totalAmount" class="form-label">{{ __('Total Amount') }}</label>
                        <input type="number" disabled class="form-control" id="totalAmount" name="totalAmount">
                    </div>
                    
                    <input type="hidden" class="form-control" id="invoicerepair_id" name="repair_id">
                  
                    <!-- Add other fields related to invoices here -->
                </form>
            </div>
            <div class="modal-footer justify-content-center">
            <button type="button" class="btn submitInvoice btn-primary" id="submitInvoice">{{ __('Add Invoice') }}</button>
                <button type="button" class="btn btn-secondary" style="background-color:red;" data-bs-dismiss="modal">{{ __('Close') }}</button>

            </div>
        </div>
    </div>
</div>



<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<script>
    $(document).ready(function() {
        console.log("Document ready");
        var repairInvoiceId;
        $('.add-invoice').click(function() {
            $('#addInvoiceModal').modal('show');
            var repairInvoiceId = $(this).data('repairinvoice-id');

            $('#invoicerepair_id').val(repairInvoiceId);

        });
        $('.submitInvoice').click(function() {
        console.log("Submit button clicked");
        var formData = $('#addInvoiceForm').serialize();
            console.log(formData)
        if (repairInvoiceId && !formData.includes('repair_id=')) {
            formData += '&repair_id=' + repairInvoiceId;
        }
        axios({
            method: 'post',
            url: '/invoices/add',
            data: formData
        })
        .then(function(response) {
        
            location.reload();

        })
        .catch(function(error) {
            console.error(error);
        });
    });
    });


</script>