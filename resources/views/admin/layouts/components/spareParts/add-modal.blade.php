<div class="modal fade" id="addSparePartModal" tabindex="-1" aria-labelledby="addSparePartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSparePartModalLabel">{{ __('Add Spare Part') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="addSparePartForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="partName" class="form-label">{{ __('Part Name') }}</label>
                        <input type="text" class="form-control" id="partName" name="partName">
                    </div>
                    <div class="mb-3">
                        <label for="partReference" class="form-label">{{ __('Part Reference') }}</label>
                        <input type="text" class="form-control" id="partReference" name="partReference">
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">{{ __('Supplier') }}</label>
                        <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('Price') }}</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <input type="text" class="form-control" id="sparePartRepairId" name="repair_id">
                    <!-- Add other fields related to spare parts here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary submitSparePart">{{ __('Add Spare Part') }}</button>
            </div>
        </div>
    </div>
</div>


<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
   $(document).ready(function() {
    $('.add-spare-part').click(function() {
        $('#addSparePartModal').modal('show');
        var repairId = $(this).data('repair-id');
        $('#sparePartRepairId').val(repairId);
    });

    $('.submitSparePart').click(function() {
        var formData = $('#addSparePartForm').serialize();
        axios.post('/spare-parts/add', formData)
            .then(function(response) {

                location.reload();
                // Refresh or update spare parts list if needed
            })
            .catch(function(error) {
                console.error(error);
            });
    });
});
</script>  
