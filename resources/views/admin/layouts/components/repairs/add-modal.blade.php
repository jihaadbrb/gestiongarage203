<div class="modal fade" id="addRepairModal" tabindex="-1" aria-labelledby="addRepairModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addRepairModalLabel">{{ __('Add New Repair') }}</h5>
            </div>
            <div class="modal-body">
                <form id="addRepairForm" method="post" action="{{ route('admin.storeRepair') }}">
                    @csrf
                    <input type="hidden" name="mechanic_id" id="mechanic_id_hidden">

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">{{ __('Start Date') }}</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">{{ __('End Date ') }}</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="mechanicNotes" class="form-label">{{ __('Mechanic Notes') }}</label>
                        <textarea class="form-control" id="mechanicNotes" name="mechanicNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="clientNotes" class="form-label">{{ __('Client Notes') }}</label>
                        <textarea class="form-control" id="clientNotes" name="clientNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="test_id" class="form-label">{{ __('Owner ID') }}</label>
                        <input type="text" class="form-control" id="test_id" name="user_id" readonly>
                        <label for="vehicle_id" class="form-label">{{ __('Vehicle ID') }}</label>
                        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" readonly>
                    </div>
                    <div class="mb-3">
                        @if(Auth::user()->role === 'admin')
                        <label for="mechanic_id" class="form-label">{{ __('Mechanic (Optional)') }}</label>
                        <select class="form-select" id="mechanic_id" name="mechanic_id">
                            <option value="">{{ __('-- Select Mechanic --') }}</option>
                        </select>
                        @else
                        
                            <input type="text" class="form-control" id="mechanic_id" name="mechanic_id" value="{{ Auth::user()->id }}" hidden readonly>
                        @endif


                    </div>
                    <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn submitRepair btn-primary">{{ __('Add Repair') }}</button>
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

    $('.add-repair').click(function() {
        $('#addRepairModal').modal('show');

        var userId = $(this).data('vehicle-iduser');

        $('#test_id').val(userId);

        var vehicleId = $(this).data('vehicle-id');
        $('#vehicle_id').val(vehicleId);
    });

    $('.submitRepair').submit(function(event) {
        event.preventDefault()


        var userId = $('#addRepairForm').data('test_id');

        var formData = $('#addRepairForm').serialize();

        var mechanicId = $('#mechanic_id').val();

        if (mechanicId && !formData.includes('mechanic_id=')) {
            formData += '&mechanic_id=' + mechanicId;
        }

        if (typeof userId !== 'undefined' && !formData.includes('user_id')) {
            formData += '&user_id=' + userId;
        }

        axios.post('/repairs/store', formData)
            .then(function(response) {
             location.reload();
            })
            .catch(function(error) {
              console.log(error);
            });
    });
});

</script>

<script>
        $(document).ready(function() {
            $('#addRepairModal').on('shown.bs.modal', function () {
                $.ajax({
                    url: "{{ route('admin.fetchMechanics') }}", 
                    dataType: 'json',
                    success: function(data) {
                        var mechanicSelect = $('#mechanic_id');
                        mechanicSelect.empty(); 
                        mechanicSelect.append($('<option>', { value: '' }).text('-- Select Mechanic --'));
                        $.each(data.mechanics, function(index, mechanic) {
                            mechanicSelect.append($('<option>', { value: mechanic.id }).text(mechanic.name));
                        });
                    }
                });
            });
        });
</script>