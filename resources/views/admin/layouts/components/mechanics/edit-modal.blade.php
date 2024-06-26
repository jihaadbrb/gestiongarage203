@if(isset($mechanic))
<div class="modal fade" id="editmechanicModal" tabindex="-1" aria-labelledby="editmechanicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="editmechanicModalLabel">{{ __('Edit Mechanic') }}</h5>
            </div>
            <div class="modal-body">
                <form id="editmechanicForm" method="post" action="{{ route('user.update', $mechanic->id) }}">
                    @csrf
                    @method('put')
                    <!-- Hidden input field to store mechanic ID -->
                    <input type="hidden" id="editmechanicId" name="mechanic_id" value="{{ $mechanic->id }}">
                    <!-- Form fields -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $mechanic->name }}" style="background-color: #f3f4f6; color: black;">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $mechanic->email }}" style="background-color: #f3f4f6; color: black;">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <textarea class="form-control" id="address" name="address" style="background-color: #f3f4f6; color: black;">{{ $mechanic->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label" >{{ __('Phone Number') }}</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $mechanic->phoneNumber }}" style="background-color: #f3f4f6; color: black;">
                    </div>
                    <!-- Other form fields here -->
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
        console.log("Document ready");

        $('.edit-mechanic').click(function() {
            var mechanicId = $(this).data('mechanic-id');
            var mechanicName = $(this).data('mechanic-name');
            var mechanicEmail = $(this).data('mechanic-email');
            var mechanicAddress = $(this).data('mechanic-address');
            var mechanicPhone = $(this).data('mechanic-phone');
            console.log(mechanicId);

            $('#editmechanicId').val(mechanicId);
            $('#name').val(mechanicName);
            $('#email').val(mechanicEmail);
            $('#address').val(mechanicAddress);
            $('#phoneNumber').val(mechanicPhone);

            $('#editmechanicModal').modal('show');
        });

        $('#editmechanicForm').submit(function(event) {
            event.preventDefault();

        var mechanicId = $('#editmechanicId').val();
            var formData = $(this).serialize();

            axios({
                method: 'post',
                url: '/clients/' + mechanicId,
                data: formData
            })
            .then(function(response) {

            location.reload();

            })
            .catch(function(error) {
               
                    // Log other errors to console
                    console.error("Error occurred:", error);
                
            });
        });
    });
</script> 
@endif


