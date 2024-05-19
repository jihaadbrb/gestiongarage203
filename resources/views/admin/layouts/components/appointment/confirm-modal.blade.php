<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-centered">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteForm" method="post">
                    @csrf
                    <input type="hidden" id="deleteAppointmentId" name="deleteId" value="" />
                </form>
                Are you sure you want to delete This Appointment ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirmDeleteBtnApp" id="confirmDeleteBtnApp">Delete</button>
            </div>
        </div>
    </div>
</div>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<script>
    $(document).ready(function() {
    $('.delete-appointment').click(function() {
        var appointmentId = $(this).data('appointment-id');
        $('#deleteAppointmentId').val(appointmentId);
        $('#confirmDeleteModal').modal('show');
    });

    $('.confirmDeleteBtnApp').click(function() {

        var formData = $('#deleteForm').serialize(); 
        console.log(formData)
        axios.post('{{ route("destroy.appointements") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $("#row").remove(); 
                    $('#confirmDeleteModal').modal('hide');
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

  
});

</script>