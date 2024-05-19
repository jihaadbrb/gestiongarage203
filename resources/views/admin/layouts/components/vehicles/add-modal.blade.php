<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">@lang('Add New Vehicle')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVehicleForm" method="post" action="{{ route('admin.storeVehicle') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Form fields for adding a new client -->
                    <div class="mb-3">
                        <label for="make" class="form-label">@lang('Make')</label>
                        <input type="text" class="form-control" id="make" name="make" value="">
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">@lang('Model')</label>
                        <input type="text" class="form-control" id="model" name="model" value="">
                    </div>
                    <div class="mb-3">
                        <label for="fuelType" class="form-label">@lang('Fuel Type')</label>
                        <input type="text" class="form-control" id="fuelType" name="fuelType">
                    </div>
                    <div class="mb-3">
                        <label for="registration" class="form-label">@lang('Registration')</label>
                        <textarea class="form-control" id="registration" name="registration"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="photos" class="form-label" >@lang('Photos')</label>
                        <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                    </div>
                    @if (Auth::user()->role === "client"||Auth::user()->role === "mechanic")
                        
                    <div class="mb-3">
                        <label for="user_id" class="form-label">@lang('Owner ID')</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="" disabled>
                    </div>
                    @else
                    <div class="mb-3">
                        <label for="user_id" class="form-label">@lang('Owner ID')</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="">
                    </div>
                    @endif
                
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Add Vehicle')</button>
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
        $('.add-vehicle').click(function() {
            $('#addClientModal').modal('show');
        });

        // Handle form submission via AJAX using Axios
        $('#addVehicleForm').click(function() {
        console.log("Submit button clicked");
        var formData = $('#addVehicleForm').serialize();
            alert(formData);
        // Axios request
        axios({
            method: 'post',
            url: '/vehicles/',
            data: formData
        })
        .then(function(response) {
           location.reload();
            // You can perform additional actions here after successful update
        })
        .catch(function(error) {
            // Log the error to the console
            console.error(error);

            // Display an error message to the user
            // alert("Error updating user. Please try again later.");
        });
    });
    });


</script>