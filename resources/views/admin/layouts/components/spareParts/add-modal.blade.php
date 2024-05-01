<!-- Spare Parts Modal -->
<div class="modal fade" id="addSparePartModal" tabindex="-1" aria-labelledby="addSparePartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSparePartModalLabel">Add Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSparePartForm" method="POST">
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
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <input type="text" class="form-control" id="sparePartRepairId" name="repair_id">
                    <!-- Add other fields related to spare parts here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitSparePart">Add Spare Part</button>
            </div>
        </div>
    </div>
</div>
