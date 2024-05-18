<div class="modal fade" id="addRepairModal" tabindex="-1" aria-labelledby="addRepairModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable    ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRepairModalLabel">{{ __('Add New Repair') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <form id="addRepairForm" method="post" action="{{ route('admin.storeRepair') }}">
                    @csrf
                    <input type="hidden" name="mechanic_id" id="mechanic_id_hidden">

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">{{ __('Start Date') }}</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">{{ __('End Date (Optional)') }}</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="mechanicNotes" class="form-label">{{ __('Mechanic Notes (Optional)') }}</label>
                        <textarea class="form-control" id="mechanicNotes" name="mechanicNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="clientNotes" class="form-label">{{ __('Client Notes') }}</label>
                        <textarea class="form-control" id="clientNotes" name="clientNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="test_id" class="form-label">{{ __('User ID') }}</label>
                        <input type="text" class="form-control" id="test_id" name="user_id" readonly>
                        <label for="vehicle_id" class="form-label">{{ __('Vehicle ID') }}</label>
                        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mechanic_id" class="form-label">{{ __('Mechanic (Optional)') }}</label>
                        <select class="form-select" id="mechanic_id" name="mechanic_id">
                            <option value="">{{ __('-- Select Mechanic --') }}</option>
                            <!-- Populate mechanic options dynamically if needed -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn submitRepair btn-primary">{{ __('Add Repair') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
