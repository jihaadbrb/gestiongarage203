<div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="addVehicleForm" method="post" action="{{ route('admin.storeVehicle') }}">
                    @csrf
                    <!-- Form fields for adding a new client -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="modal" class="form-label">modal</label>
                        <input type="text" class="form-control" id="modal" name="modal" value="">
                    </div>
                    <div class="mb-3">
                        <label for="regestration" class="form-label">regestration</label>
                        <input type="text" class="form-control" id="regestration" name="regestration">
                    </div>
                    <div class="mb-3">
                        <label for="fueltype" class="form-label">fueltype</label>
                        <input type="text" class="form-control" id="fueltype" name="fueltype">
                    </div>
                    <div class="mb-3">
                        <label for="user-id" class="form-label">user id</label>
                        <input type="number" class="form-control" id="user_id" name="user_id">
                    </div>
                    <div class="mb-3">
                        <label for="photos" class="form-label" >Photos</label>
                        <input type="file" class="form-control" id="photos" name="photos" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ">Add Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
