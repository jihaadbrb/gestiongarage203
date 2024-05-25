<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-body text-center">
                <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
                <form id="deleteForm" method="post">
                    @csrf
                    <input type="hidden" id="deleteId" name="deleteId" value="" />
                </form>
                {{ __('Are you sure you want to delete this invoice?') }} 
            </div>
            <div class="modal-footer justify-content-center">
                
                <button type="button" class="btn btn-danger" style="background-color:red;"id="confirmDeleteBtn">{{ __('Delete') }}</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>



<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function() {
    $('.delete-invoice').click(function() {
        var invoiceId = $(this).data('invoice-id'); 
        $('#deleteId').val(invoiceId);
        $('#confirmDeleteModal').modal('show'); 
    });

    $('#confirmDeleteBtn').click(function() {
        var formData = $('#deleteForm').serialize();
        axios.post('{{ route("admin.destroyInvoice") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $("#row").remove(); 
                    $('#confirmDeleteModal').modal('hide')
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    });
</script>