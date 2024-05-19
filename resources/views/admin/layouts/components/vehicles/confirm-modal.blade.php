<div class="modal fade" id="vconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vconfirmDeleteModalLabel">@lang('Confirm Delete')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="vdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="vdeleteId" name="vdeleteId" value="" />
                </form>
                @lang('Are you sure you want to delete This Vehicle ? ') 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                <button type="button" class="btn btn-danger" id="vconfirmDeleteBtn">@lang('Delete')</button>
            </div>
        </div>
    </div>
</div>



<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
    $(document).ready(function() {
    $('.delete-vehicle').click(function() {
        var vehicleId = $(this).data('vehicle-id'); 
        $('#vdeleteId').val(vehicleId); 
        $('#vconfirmDeleteModal').modal('show'); 
    });

    $('#vconfirmDeleteBtn').on('click',function() {
        var formData = $('#vdeleteForm').serialize(); 
        axios.post('{{ route("admin.destroyVehicle") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $('#vconfirmDeleteModal').modal('hide');
                    $("#row").remove();
                
                    
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    });
</script>