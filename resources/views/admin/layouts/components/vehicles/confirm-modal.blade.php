<div class="modal fade" id="vconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vconfirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="vdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="vdeleteId" name="vdeleteId" value="" />
                </form>
                Are you sure you want to delete vehicle with ID: <span id="vclientIdPlaceholder"></span> ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="vconfirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
