<div class="modal fade" id="cconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cconfirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="cdeleteId" name="cdeleteId" value="" />
                </form>
                Are you sure you want to delete client with ID: <span id="clientIdPlaceholder"></span> ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="cconfirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
