<div class="modal fade" id="cconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cconfirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body" style="color:black;">
                <form id="cdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="cdeleteId" name="cdeleteId" value="" />
                </form>
                {{ __('Do You Really Want To Delete This User') }}  ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="cconfirmDeleteBtn">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        $(document).ready(function() {
        $('.delete-mechanic').click(function() {
            var mechanicId = $(this).data('mechanic-id'); 
            $('#cdeleteId').val(mechanicId); 
           
            $('#cconfirmDeleteModal').modal('show'); 
        });

        $('#cconfirmDeleteBtn').on('click',function() {
            var formData = $('#cdeleteForm').serialize(); 
            axios.post('{{ route("user.destroy") }}', formData)
                .then(function (response) {
                    if (response.data == "ok") {
                        $("#row").remove(); 
                        $('#cconfirmDeleteModal').modal('hide')
                    }
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                });
        });

        });
    </script>