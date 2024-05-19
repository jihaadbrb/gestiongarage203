<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">{{ __('Add New Client') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="addClientForm" method="post" action="{{ route('user.store') }}">
                    @csrf
                    <!-- Form fields for adding a new client -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">{{ __('Phone Number') }}</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="userImage" class="form-label">{{ __('Profile Image') }}</label>
                        <input type="text" class="form-control" id="userImage" name="phoneNumber" value="">
                    </div> --}}
                    <div class="mb-3">
                        <label for="role" class="form-label">{{ __('Role') }}</label>
                        <select class="form-select" id="role" name="role">
                            <option value="client" style="color:black;">{{ __('Client') }}</option>
                            <option value="mechanic" style="color:black;">{{ __('Mechanic') }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add Client') }}</button>
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
        $('.add-client').click(function() {
            $('#addClientModal').modal('show');
        });

        $('#submitAddClientForm').click(function() {
            var formData = $('#addClientForm').serialize();
            // Axios request    
            axios.post('{{ route("user.store") }}', formData)
                .then(function(response) {
                 
                    $('#addClientModal').modal('hide');
                })
                .catch(function(error) {
                   
                    console.error(error);
                    
                });
        });
    });
</script>
