<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add New Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVehicleForm" method="post" action="{{ route('admin.storeVehicle') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Form fields for adding a new client -->
                    <div class="mb-3">
                        <label for="make" class="form-label">Make</label>
                        <input type="text" class="form-control" id="make" name="make" value="">
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="">
                    </div>
                    <div class="mb-3">
                        <label for="fuelType" class="form-label">Fuel Type</label>
                        <input type="text" class="form-control" id="fuelType" name="fuelType">
                    </div>
                    <div class="mb-3">
                        <label for="registration" class="form-label">Registration</label>
                        <textarea class="form-control" id="registration" name="registration"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="photos" class="form-label" >Photos</label>
                        <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                    </div>
                    @if (Auth::user()->role === "client")
                        
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="" disabled>
                    </div>
                    @else
                    div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="">
                    </div>
                    @endif
                   
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
