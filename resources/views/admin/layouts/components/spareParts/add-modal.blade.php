<div class="modal fade" id="addSparePartModal" tabindex="-1" aria-labelledby="addSparePartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSparePartModalLabel">Add New Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSparePartForm" method="post" action="{{ route('admin.storeSparePart') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="partName" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="partName" name="partName">
                    </div>
                    <div class="mb-3">
                        <label for="partReference" class="form-label">Part Reference</label>
                        <input type="text" class="form-control" id="partReference" name="partReference">
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <input type="hidden" name="repair_id" id="repair_id_hidden">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn submitSparePart btn-primary">Add Spare Part</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
