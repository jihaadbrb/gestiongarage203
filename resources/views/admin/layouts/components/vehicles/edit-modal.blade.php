@if(isset($vehicle))

<div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehicleModalLabel">@lang('Edit Vehicle')</h5>
            </div>
            <div class="modal-body">
                <form id="editVehicleForm" method="post" action="{{ route('admin.updateVehicle',$vehicle->id ) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <input type="hidden" id="vehicleId" name="vehicleId" value="{{$vehicle->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="vehicleMake">@lang('Make')</label>
                        <input type="text" class="form-control" id="vehicleMake" name="make" required style="background-color: #f3f4f6; color: black;">
                    </div>
                    <div class="mb-3">
                        <label for="vehicleModel">@lang('Model')</label>
                        <input type="text" class="form-control" id="vehicleModel" name="model" required style="background-color: #f3f4f6; color: black;">
                    </div>
                    <div class="mb-3">
                        <label for="vehicleFuelType">@lang('Fuel Type')</label>
                        <input type="text" class="form-control" id="vehicleFuelType" name="fuelType" required style="background-color: #f3f4f6; color: black;">
                    </div>
                    <div class="mb-3">
                        <label for="vehicleRegistration">@lang('Registration')</label>
                        <input type="text" class="form-control" id="vehicleRegistration" name="registration" style="background-color: #f3f4f6; color: black;">
                    </div>
                    <div class="mb-3">
                        <label for="photos" class="form-label">@lang('Photos')</label>
                        <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                    </div>
                    <div class="mb-3"></div>
                    @if (Auth::user()->role === "client")
                        <div class="mb-3">
                            <label for="vehicleUserId">@lang('User ID')</label>
                            <input type="text" class="form-control" id="vehicleUserId" readonly name="user_id" readonly style="background-color: #f3f4f6; color: black;">
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="vehicleUserId">@lang('User ID')</label>
                            <input type="text" class="form-control" id="vehicleUserId" readonly name="user_id" style="background-color: #f3f4f6; color: black;">
                        </div>
                    @endif
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save ') }}</button>
                        <button type="button" class="btn btn-danger" style="background-color:red;"data-bs-dismiss="modal">{{ __('Cancel') }}</button>
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
            // Show the modal
            $('#editVehicleModal').modal('show');
        });

        $('#editVehicleForm').submit(function(event) {
            event.preventDefault();
            console.log("Submit button clicked");

            var vehicleId = $('#vehicleId').val(); 

            var formData = new FormData($('#editVehicleForm')[0]);

            var vehiclePhotos = $('#photos')[0].files; 
            for (var i = 0; i < vehiclePhotos.length; i++) {
                formData.append('photos', vehiclePhotos[i]);
            }

            console.log(formData);
            axios.post('/vehicles/' + vehicleId, formData);
            location.reload();
        });


    });
</script>
@endif


