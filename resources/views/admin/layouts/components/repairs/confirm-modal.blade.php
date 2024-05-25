<div class="modal fade" id="rconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="rconfirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
            </div>
            <div class="modal-body text-center" style="color:black;">
                <form id="rdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="rdeleteId" name="rdeleteId" value="" />
                </form>
                {{ __('Are you sure you want to delete This Repair ?') }}
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" style="background-color:red;"id="rconfirmDeleteBtn">{{ __('Delete') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
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