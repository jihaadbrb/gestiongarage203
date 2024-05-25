<div class="modal fade" id="cconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="cconfirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
            </div>
            <div class="modal-body text-center" style="color:black;">
                <form id="cdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="cdeleteId" name="cdeleteId" value="" />
                </form>
                {{ __('Do You Really Want To Delete This User') }}  ?
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" style="background-color:red;"id="cconfirmDeleteBtn">{{ __('Delete') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        $(document).ready(function() {
        $('.delete-client').click(function() {
            var clientId = $(this).data('client-id'); 
            $('#cdeleteId').val(clientId); 
           
            $('#cconfirmDeleteModal').modal('show'); 
        });

        $('#cconfirmDeleteBtn').on('click',function() {
            var formData = $('#cdeleteForm').serialize(); 
            axios.post('{{ route("user.destroy") }}', formData)
                .then(function (response) {
                    if (response.data == "ok") {
                        $("#row").remove(); 
                        $('#cconfirmDeleteModal').modal('hide');
                    }
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                });
        });

        });
    </script>