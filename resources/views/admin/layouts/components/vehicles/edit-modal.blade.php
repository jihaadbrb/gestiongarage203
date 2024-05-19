@if(isset($vehicle))

<div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehicleModalLabel">@lang('Edit Vehicle')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="editVehicleForm" method="put" action="{{ route('admin.updateVehicle',$vehicle->id ) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <input type="hidden" id="vehicleId" name="vehicleId" value="{{$vehicle->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="vehicleMake">@lang('Make')</label>
                        <input type="text" class="form-control" id="vehicleMake" name="make" required>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleModel">@lang('Model')</label>
                        <input type="text" class="form-control" id="vehicleModel" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleFuelType">@lang('Fuel Type')</label>
                        <input type="text" class="form-control" id="vehicleFuelType" name="fuelType" required>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleRegistration">@lang('Registration')</label>
                        <input type="text" class="form-control" id="vehicleRegistration" name="registration">
                    </div>
                    <div class="mb-3">
                        <label for="photos" class="form-label">@lang('Photos')</label>
                        <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                    </div>
                    <div class="mb-3"></div>
                    @if (Auth::user()->role === "client")
                        <div class="mb-3">
                            <label for="vehicleUserId">@lang('User ID')</label>
                            <input type="text" class="form-control" id="vehicleUserId" readonly name="user_id" readonly>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="vehicleUserId">@lang('User ID')</label>
                            <input type="text" class="form-control" id="vehicleUserId" readonly name="user_id">
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">@lang('Save Changes')</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<script>
    $(document).ready(function() {
        console.log("Document vehicle ready");

        $(document).on('click', '.edit-vehicle', function() {
            var vehicleMake = $(this).data('vehicle-make');
            var vehicleModel = $(this).data('vehicle-model');
            var vehicleFuelType = $(this).data('vehicle-fueltype');
            var vehicleRegistration = $(this).data('vehicle-registration');
            var vehiclePhotos = $(this).data('vehicle-photos');
            var vehicleUserId = $(this).data('vehicle-userid');
            var vehicleId = $(this).data('vehicles-id');

            $('#vehicleMake').val(vehicleMake);
            $('#vehicleModel').val(vehicleModel);
            $('#vehicleFuelType').val(vehicleFuelType);
            $('#vehicleRegistration').val(vehicleRegistration);
            $('#vehiclePhotos').val(vehiclePhotos);
            $('#vehicleUserId').val(vehicleUserId);
            $('#vehicleId').val(vehicleId);

            $('#editVehicleModal').modal('show');
        });

        $('#editVehicleForm').submit(function(event) {
            event.preventDefault();

            var vehicleId = $('#vehicleId').val();

            var formData = new FormData($('#editVehicleForm')[0]);

            var vehiclePhotos = $('#photos')[0].files; 
            for (var i = 0; i < vehiclePhotos.length; i++) {
                formData.append('photos', vehiclePhotos[i]);
            }


            axios.post('/vehicles/' + vehicleId, formData)
                .then(function(response) {
                   location.reload();
                })
                .catch(function(error) {
                  console.log(error);
                });
        });


    });
</script>

@endif


