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
                {{ __('Are you sure you want to delete This Repair ?') }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="rconfirmDeleteBtn">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>



<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function() {
    $('.delete-repair').click(function() {
        var repairId = $(this).data('repair-id'); 
        $('#rdeleteId').val(repairId); 
        $('#rconfirmDeleteModal').modal('show');
    });

    $('#rconfirmDeleteBtn').click(function() {
        var formData = $('#rdeleteForm').serialize(); 

        axios.post('{{ route("admin.destroyRepair") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                 
                    $("#row").remove(); 
                    $('#rconfirmDeleteModal').modal('hide')
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });


    });
</script>