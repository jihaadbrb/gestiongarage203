<div class="modal fade" id="importUsersModal" tabindex="-1" aria-labelledby="importUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importUsersModalLabel">{{ __('Import Users') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="importUsersForm" method="post" action="{{ route('import.users') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">{{ __('Select Excel File') }}</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                        <div class="form-text">
                            {{ __('Supported file formats: .xlsx, .xls (older Excel versions)') }}
                        </div>
                    </div>
                    <div class="alert alert-info" role="alert">
                        <p>{{ __('Your Excel file should have columns for name, email (must be unique), password (hashed), role (optional: defaults to "client"), address (required), and phone number (required).') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Import Users') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
