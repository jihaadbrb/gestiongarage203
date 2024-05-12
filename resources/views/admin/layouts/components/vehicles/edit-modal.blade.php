@if(isset($vehicle))

<div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editVehicleModalLabel">@lang('Edit Vehicle')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
          <form id="editVehicleForm" method="put" action="{{ route('admin.updateVehicle',$vehicle->id ) }}" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="form-group">
                <label for="vehicleId">@lang('ID')</label>
                {{-- <input type="text" class="form-control" id="vehicleId" name="id" > --}}
                <input type="hidden" id="vehicleId" name="vehicleId" value="{{$vehicle->id  }}">
              </div>
              <div class="form-group">
                <label for="vehicleMake">@lang('Make')</label>
                <input type="text" class="form-control" id="vehicleMake" name="make" required>
              </div>
              <div class="form-group">
                <label for="vehicleModel">@lang('Model')</label>
                <input type="text" class="form-control" id="vehicleModel" name="model" required>
              </div>
              <div class="form-group">
                <label for="vehicleFuelType">@lang('Fuel Type')</label>
                <input type="text" class="form-control" id="vehicleFuelType" name="fuelType" required>
              </div>
              <div class="form-group">
                <label for="vehicleRegistration">@lang('Registration')</label>
                <input type="text" class="form-control" id="vehicleRegistration" name="registration" >
              </div>
              <div class="form-group">
                  <label for="photos" class="form-label">@lang('Photos')</label>
                  <input type="file" id="photos" name="photos[]" accept="image/*" multiple>                    </div>
              <div class="mb-3">
              </div>
              @if (Auth::user()->role === "client")
                <div class="form-group">
                  <label for="vehicleUserId">@lang('User ID')</label>
                  <input type="text" class="form-control" id="vehicleUserId" name="user_id" readonly >
                </div>
              @else
                <div class="form-group">
                  <label for="vehicleUserId">@lang('User ID')</label>
                  <input type="text" class="form-control" id="vehicleUserId" name="user_id" >
                </div>
              @endif
              <button type="submit" class="btn btn-primary">@lang('Save Changes')</button>
            </form>
        
        </div>
      </div>
    </div>
  </div>
@endif
