<div class="modal fade" id="rconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rconfirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="rdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="rdeleteId" name="rdeleteId" value="" />
                </form>
                {{ __('Are you sure you want to delete repair with ID:') }} <span id="rclientIdPlaceholder"></span> ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="rconfirmDeleteBtn">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
