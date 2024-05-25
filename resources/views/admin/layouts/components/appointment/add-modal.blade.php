<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">{{ __('Add New Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="addAppointmentForm" method="post" action="{{ route('store.appointements') }}">
                    @csrf
                    <!-- Form fields for adding a new appointment -->
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div> 
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">{{ __('Appointment Date') }}</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment_time" class="form-label">{{ __('Appointment Time') }}</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                    </div>
                    @if (Auth::user()->role === "admin")
                       <div class="mb-3">
                        <label for="appointment_date" class="form-label">{{ __('Customer') }}</label>
                        <input type="text" class="form-control" id="user_id" name="user_id">
                    </div> 
                    @else
                    <div class="mb-3">
                        <input type="text" class="form-control" id="user_id" name="user_id" hidden readonly>
                    </div>
                    @endif
                    

                    <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary submitAppointment">{{ __('Add Appointment') }}</button>
                        <button type="button" class="btn btn-secondary" style="background-color:red;"data-bs-dismiss="modal">{{ __('Close') }}</button>
 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
    $(document).ready(function() {
        console.log("Document ready");
        $('.add-appointement').click(function() {
            $('#addAppointmentModal').modal('show');
        });

        $('.submitAppointment').click(function(event) {
            event.preventDefault();
        var formData = $('#addAppointmentForm').serialize();

        axios({
            method: 'post',
            url: '/appointments/create',
            data: formData
        })
        .then(function(response) {
         
            location.reload();

        })
        .catch(function(error) {
            console.error(error);

        });
    });
    });
</script>