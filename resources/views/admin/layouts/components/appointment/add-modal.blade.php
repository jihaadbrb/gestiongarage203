<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">{{ __('Add New Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="addAppointmentForm" method="post" action="{{ route('store.appointments') }}">
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
                        <label for="appointment_date" class="form-label">{{ __('User ID') }}</label>
                        <input type="text" class="form-control" id="user_id" name="user_id">
                    </div> 
                    @else
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">{{ __('User ID') }}</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" readonly>
                    </div> 
                    @endif
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary submitAppointment">{{ __('Add Appointment') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
