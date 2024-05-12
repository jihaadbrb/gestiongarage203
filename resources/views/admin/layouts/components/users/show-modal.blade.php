<div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userInfoModalLabel">{{ __('User Information') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <!-- User Information Section -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="userInfoName" class="form-label">{{ __('Name:') }}</label>
                        <input type="text" class="form-control" id="userInfoName" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="userInfoEmail" class="form-label">{{ __('Email:') }}</label>
                        <input type="email" class="form-control" id="userInfoEmail" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="userInfoAddress" class="form-label">{{ __('Address:') }}</label>
                        <textarea class="form-control" id="userInfoAddress" readonly></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="userInfoPhoneNumber" class="form-label">{{ __('Phone Number:') }}</label>
                        <input type="text" class="form-control" id="userInfoPhoneNumber" readonly>
                    </div>
                </div>

                <!-- Vehicle Information Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>{{ __('Vehicle Information') }}</h5>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="vehicleMake" class="form-label">{{ __('Make:') }}</label>
                        <input type="text" class="form-control" id="vehicleMake" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleModel" class="form-label">{{ __('Model:') }}</label>
                        <input type="text" class="form-control" id="vehicleModel" readonly>
                    </div>
                    <!-- Add more fields as needed for other vehicle information -->
                </div>

                <!-- Repairs Information Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>{{ __('Repairs Information') }}</h5>
                <div id="repairsInfo" class="mt-3">
                    <!-- Repairs information will be dynamically populated here -->
                </div>

                <!-- Invoices Information Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>{{ __('Invoices Information') }}</h5>
                <div id="invoicesInfo" class="mt-3">
                    <!-- Invoices information will be dynamically populated here -->
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
