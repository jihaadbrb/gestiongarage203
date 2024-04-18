<div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editVehicleForm" enctype="multipart/form-data" method="post" action="{{ route('admin.updateVehicle',$vehicle->id) }}">
            @csrf
            @method('put')
            <div class="form-group">
              <label for="vehicleId">ID</label>
              <input type="text" class="form-control" id="vehicleId" name="vehicleId" readonly>
            </div>
            <div class="form-group">
              <label for="vehicleMake">Make</label>
              <input type="text" class="form-control" id="vehicleMake" name="vehicleMake" required>
            </div>
            <div class="form-group">
              <label for="vehicleModel">Model</label>
              <input type="text" class="form-control" id="vehicleModel" name="vehicleModel" required>
            </div>
            <div class="form-group">
              <label for="vehicleFuelType">Fuel Type</label>
              <input type="text" class="form-control" id="vehicleFuelType" name="vehicleFuelType" required>
            </div>
            <div class="form-group">
              <label for="vehicleRegistration">Registration</label>
              <input type="text" class="form-control" id="vehicleRegistration" name="vehicleRegistration" required>
            </div>
            <div class="form-group">
                <label for="photos" class="form-label" >photos</label>
                <input type="file" id="photos" name="photos[]" accept="image/*" multiple>                    </div>
            <div class="mb-3">
            </div>
            <div class="form-group">
              <label for="vehicleUserId">User ID</label>
              <input type="text" class="form-control" id="vehicleUserId" name="vehicleUserId" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  