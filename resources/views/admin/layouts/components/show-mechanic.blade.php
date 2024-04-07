<div class="modal fade" id="mechanicInfoModal" tabindex="-1" aria-labelledby="mechanicInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mechanicInfoModalLabel">Mechanic Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Mechanic Information Section -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="mechanicInfoName" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="mechanicInfoName" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="mechanicInfoRole" class="form-label">Role:</label>
                        <input type="text" class="form-control" id="mechanicInfoRole" readonly>
                    </div>
                </div>

                <!-- Assigned Repairs Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>Assigned Repairs</h5>
                <div id="assignedRepairs" class="mt-3">
                    <!-- Assigned repairs information will be dynamically populated here -->
                </div>

                <!-- Tasks and Responsibilities Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>Tasks and Responsibilities</h5>
                <div id="tasksResponsibilities" class="mt-3">
                    <!-- Tasks and responsibilities information will be dynamically populated here -->
                </div>

                <!-- Spare Parts Usage Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>Spare Parts Usage</h5>
                <div id="sparePartsUsage" class="mt-3">
                    <!-- Spare parts usage information will be dynamically populated here -->
                </div>

                <!-- Performance Metrics Section -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>Performance Metrics</h5>
                <div id="performanceMetrics" class="mt-3">
                    <!-- Performance metrics information will be dynamically populated here -->
                </div>

                <!-- Additional Features Section (if applicable) -->
                <hr> <!-- Add a horizontal line for separation -->
                <h5>Additional Features</h5>
                <div id="additionalFeatures" class="mt-3">
                    <!-- Additional features information will be dynamically populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
