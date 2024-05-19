<div class="modal fade" id="sconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sconfirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="sdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="sdeleteId" name="sdeleteId" value="" />
                </form>
                {{ __('Are you sure you want to delete This Spare Part ?') }} 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="sconfirmDeleteBtn">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>



<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
    $(document).ready(function() {
        $('.delete-spare').click(function() {
            var spareId = $(this).data('spare-id'); 
            $('#sdeleteId').val(spareId); 
            $('#sconfirmDeleteModal').modal('show'); 
        });

        $('#sconfirmDeleteBtn').on('click',function() {
            var formData = $('#sdeleteForm').serialize(); 
            axios.post('{{ route("admin.destroySparePart") }}', formData)
                .then(function (response) {
                    if (response.data == "ok") {
                       
                        $("#row").remove();
                        $('#sconfirmDeleteModal').modal('hide');
                    }
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                });
        });

    
    });
</script>