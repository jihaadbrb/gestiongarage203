<div class="modal fade" id="sconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="sconfirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
            </div>
            <div class="modal-body text-center" style="color:black;">
                <form id="sdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="sdeleteId" name="sdeleteId" value="" />
                </form>
                {{ __('Are you sure you want to delete This Spare Part ?') }} 
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" style="background-color:red;"id="sconfirmDeleteBtn">{{ __('Delete') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
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