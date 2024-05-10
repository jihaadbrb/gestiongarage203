
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- edit client --}}
    <script>
        $(document).ready(function() {
        console.log("Document ready");
        // Show modal and populate fields when the edit button is clicked
        $('.edit-client').click(function() {
            var clientId = $(this).data('client-id');
            var clientName = $(this).data('client-name');
            var clientEmail = $(this).data('client-email');
            var clientAddress = $(this).data('client-address');
            var clientPhone = $(this).data('client-phone');
            console.log(clientId);
            // Populate modal fields with client data
            $('#editClientId').val(clientId);
            $('#name').val(clientName);
            $('#email').val(clientEmail);
            $('#address').val(clientAddress);
            $('#phoneNumber').val(clientPhone);

            // Show the modal
            $('#editClientModal').modal('show');
        });

        // Handle form submission via AJAX using Axios
        $('#submitEditClientForm').click(function() {
       alert("Submit button clicked");
        var clientId = $('#editClientId').val();
        var formData = $('#editClientForm').serialize();
        //    alert(formData)
        // Axios request
        axios({
            method: 'put',
            url: '/users/' + clientId,
            data: formData
        })
        .then(function(response) {
            alert("Update successful");
            alert(response)
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


  {{-- add Client  --}}
    <script>
            $(document).ready(function() {
                console.log("Document ready");
                // Show modal and populate fields when the edit button is clicked
                $('.add-client').click(function() {

                    // Show the modal
                    $('#addClientModal').modal('show');
                });

                // Handle form submission via AJAX using Axios
                $('#submitEditClientForm').click(function() {
                console.log("Submit button clicked");
                var clientId = $('#editClientId').val();
                var formData = $('#editClientForm').serialize();

                console(formData);
                    alert("good")
                // Axios request    
                axios({
                    method: 'put',
                    url: '/users/' + clientId,
                    data: formData
                })
                .then(function(response) {
                    alert("Update successful");
                    alert(response)
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


{{-- import client  --}}

<script>
    $(document).ready(function() {
        console.log("Document ready");
        $('.import-clients').click(function() {
            $('#importUsersModal').modal('show');
        });

    });



</script>


{{-- delete client  --}}
    <script>
        $(document).ready(function() {
        // Handle deletion of client
        $('.delete-client').click(function() {
            var clientId = $(this).data('client-id'); // Retrieve the client ID
            $('#deleteId').val(clientId); // Populate the deleteId input field with the client ID
            $('#clientIdPlaceholder').text(clientId); // Populate the client ID placeholder in the modal body
            $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
        });

        // Handle confirmation of deletion
        $('#confirmDeleteBtn').click(function() {
            var formData = $('#deleteForm').serialize(); // Serialize form data
            // Axios DELETE request
            axios.delete('{{ route("admin.destroy") }}', formData)
                .then(function (response) {
                    if (response.data == "ok") {
                        $("#row").remove(); // Remove the deleted client row from the table
                        $('#confirmDeleteModal').modal('hide')
                    }
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                });
        });

        // Detach event handler for delete button after confirmation modal is closed
        $('#confirmDeleteModal').on('hidden.bs.modal', function () {
            // $('#confirmDeleteBtn').off('click');
        });
        });
    </script>


    <script>

    $(".selectLocale").on('change',function(){
        var locale = $(this).val();

        window.location.href = "/changeLocale/"+locale;
    })
    </script>

    <script>
        $(".btnCloseShow").on('click',function(){
            $("#myModalShowProduct").hide();
        })


    </script>

{{-- show client --}}
    <script>

      $(".show-client").on("click", function() {
          var myId = $(this).attr("data-client-id");
          var data = { 'id': myId };
          axios.post('/users/showModal', data)
              .then(response => {
                  console.log(response.data.vehicles);
                  // Populate modal fields with user information
                  $('#userInfoName').val(response.data.name);
                  $('#userInfoEmail').val(response.data.email);
                  $('#userInfoAddress').val(response.data.address);
                  $('#userInfoPhoneNumber').val(response.data.phoneNumber);

                  // Populate vehicle information
                  if (response.data.vehicles && response.data.vehicles.length > 0) {
                      var vehicle = response.data.vehicles[0];
                      $('#vehicleMake').val(vehicle.make);
                      $('#vehicleModel').val(vehicle.model);
                      // Populate other vehicle fields as needed
                  } else {
                      $('#vehicleMake').val('N/A');
                      $('#vehicleModel').val('N/A');
                      // Populate other vehicle fields as needed
                  }
                  console.log(response.data)
                  // Populate repairs information
                  if (response.data.repairs && response.data.repairs.length > 0) {
                      var repairsHtml = '';
                      response.data.repairs.forEach(function(repair) {
                          repairsHtml += '<div><strong>Description:</strong> ' + repair.description + '</div>';
                          repairsHtml += '<div><strong>Mechanic Notes:</strong> ' + repair.mechanicNotes + '</div>';
                          repairsHtml += '<div><strong>Client Notes:</strong> ' + repair.clientNotes + '</div>';
                          repairsHtml += '<div><strong>Status:</strong> ' + repair.status + '</div>';
                          repairsHtml += '<div><strong>Start Date:</strong> ' + repair.startDate + '</div>';
                          repairsHtml += '<div><strong>End Date:</strong> ' + repair.endDate + '</div>';
                          // Add more fields as needed
                          repairsHtml += '<hr>'; // Add horizontal line for separation between repairs
                      });
                      $('#repairsInfo').html(repairsHtml);
                  } else {
                      $('#repairsInfo').html('<div>No repairs found</div>');
                  }
                  // Populate invoices information
              if (response.data.repairs && response.data.repairs.length > 0) {
          var invoicesHtml = '';
          response.data.repairs.forEach(function(repair) {
              repair.invoices.forEach(function(invoice) {
                  invoicesHtml += '<div><strong>Additional Charges:</strong> ' + invoice.additionalCharges + '</div>';
                  invoicesHtml += '<div><strong>Total Amount:</strong> ' + invoice.totalAmount +' $' +'</div>';
                  // Add more fields as needed
                  invoicesHtml += '<hr>'; // Add horizontal line for separation between invoices
              });
          });
          $('#invoicesInfo').html(invoicesHtml);
      } else {
          $('#invoicesInfo').html('<div>No invoices found</div>');
      }

                  // Show the modal
                  $("#userInfoModal").modal('show');
              })
              .catch(error => {
                  console.error(error);
              });
      });

    </script>


<script>
    // When the file input changes, submit the form
    document.getElementById('avatar-input').addEventListener('change', function() {
        document.getElementById('avatar-upload-form').submit();
    });
</script>

    <script>
      $(".show-mechanic").on("click", function() {
          var mechanicId = $(this).attr("data-client-id");
          var data = { 'id': mechanicId };
          console.log(data);
          axios.post('/users/showModal', data)
              .then(response => {
                  console.log(response.data.vehicles);
                  // Populate modal fields with user information
                  $('#userInfoName').val(response.data.name);
                  $('#userInfoEmail').val(response.data.email);
                  $('#userInfoAddress').val(response.data.address);
                  $('#userInfoPhoneNumber').val(response.data.phoneNumber);

                  // Populate vehicle information
                  if (response.data.vehicles && response.data.vehicles.length > 0) {
                      var vehicle = response.data.vehicles[0];
                      $('#vehicleMake').val(vehicle.make);
                      $('#vehicleModel').val(vehicle.model);
                      // Populate other vehicle fields as needed
                  } else {
                      $('#vehicleMake').val('N/A');
                      $('#vehicleModel').val('N/A');
                      // Populate other vehicle fields as needed
                  }

                  // Populate repairs information
                  if (response.data.repairs && response.data.repairs.length > 0) {
                      var repairsHtml = '';
                      response.data.repairs.forEach(function(repair) {
                          repairsHtml += '<div><strong>Description:</strong> ' + repair.description + '</div>';
                          repairsHtml += '<div><strong>Mechanic Notes:</strong> ' + repair.mechanicNotes + '</div>';
                          repairsHtml += '<div><strong>Client Notes:</strong> ' + repair.clientNotes + '</div>';
                          repairsHtml += '<div><strong>Status:</strong> ' + repair.status + '</div>';
                          repairsHtml += '<div><strong>Start Date:</strong> ' + repair.startDate + '</div>';
                          repairsHtml += '<div><strong>End Date:</strong> ' + repair.endDate + '</div>';
                          // Add more fields as needed
                          repairsHtml += '<hr>'; // Add horizontal line for separation between repairs
                      });
                      $('#repairsInfo').html(repairsHtml);
                  } else {
                      $('#repairsInfo').html('<div>No repairs found</div>');
                  }
                  // Populate invoices information
              if (response.data.repairs && response.data.repairs.length > 0) {
          var invoicesHtml = '';
          response.data.repairs.forEach(function(repair) {
              repair.invoices.forEach(function(invoice) {
                  invoicesHtml += '<div><strong>Additional Charges:</strong> ' + invoice.additionalCharges + '</div>';
                  invoicesHtml += '<div><strong>Total Amount:</strong> ' + invoice.totalAmount +' $' +'</div>';
                  // Add more fields as needed
                  invoicesHtml += '<hr>'; // Add horizontal line for separation between invoices
              });
          });
          $('#invoicesInfo').html(invoicesHtml);
      } else {
          $('#invoicesInfo').html('<div>No invoices found</div>');
      }

                  // Show the modal
                  $("#userInfoModal").modal('show');
              })
              .catch(error => {
                  console.error(error);
              });
      });

    </script>


{{-- add Vehicles  --}}

<script>
    $(document).ready(function() {
        console.log("Document ready");
        // Show modal and populate fields when the edit button is clicked
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
            alert("added successful");
            alert(response)
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


{{-- show pics vehicles --}}


    <script>

                        $(".show-pics").on("click", function() {
                    var myId = $(this).attr("data-client-id");
                    var data = { 'id': myId };
                    axios.post('/vehicles/showVehiclePics', data)
                        .then(response => {
                        console.log(response.data);

                        // Extract image URLs and populate carousel
                        var carouselHtml = "";
                        var pictures = response.data.pictures;
                        pictures.forEach(function(pictureString, index) {
        // Clean approach using regular expressions:
                    var pictureUrl = pictureString.replace(/^["'\\]|["'\\]$/g, '');
                            // (Optional) Remove leading/trailing backslashes if needed
                            // alert(pictureUrl)
                            var activeClass = index === 0 ? "active" : "";
                            carouselHtml += '<div class="carousel-item ' + activeClass + '">';
                            carouselHtml += '<img src="'+ pictureUrl + '" class="d-block w-100" alt="Vehicle Image ' + (index + 1) + '">';
                            carouselHtml += '</div>';

                        });
                        $("#vehiclePicsCarousel .carousel-inner").html(carouselHtml);
                        $("#showPicsModal").modal('show');

                        // (Optional) Show the modal only if pictures are found (consider user experience)
                        if (pictures.length > 0) {
                            $("#showPicsModal").modal('show');
                        } else {
                            console.log("No pictures found for this vehicle");
                        }
                        })
                        .catch(error => {
                        console.error(error);
                        });
                    });


    </script>

{{-- edit vehicle  --}}

    <script>
        $(document).ready(function() {
            console.log("Document ready");

            // Show modal and populate fields when the edit button is clicked
            $(document).on('click', '.edit-vehicle', function() {
                var vehicleMake = $(this).data('vehicle-make');
                var vehicleModel = $(this).data('vehicle-model');
                var vehicleFuelType = $(this).data('vehicle-fueltype');
                var vehicleRegistration = $(this).data('vehicle-registration');
                var vehiclePhotos = $(this).data('vehicle-photos');
                var vehicleUserId = $(this).data('vehicle-userid');

                // alert(vehiclePhotos)

                // Populate modal fields with client data
                $('#vehicleMake').val(vehicleMake);
                $('#vehicleModel').val(vehicleModel);
                $('#vehicleFuelType').val(vehicleFuelType);
                $('#vehicleRegistration').val(vehicleRegistration);
                $('#vehiclePhotos').val(vehiclePhotos);
                $('#vehicleUserId').val(vehicleUserId);

                // Show the modal
                $('#editVehicleModal').modal('show');
            });

            // Handle form submission via AJAX using Axios
                    $(document).on('click', '.submitVehicle', function() {
            console.log("Submit button clicked");
            var vehicleId = $('#vehicleId').val();
            var formData = new FormData($('#editVehicleForm')[0]);

            // Append the photos to the form data
            var vehiclePhotos = $('#vehiclePhotos')[0].files;
            for (var i = 0; i < vehiclePhotos.length; i++) {
                formData.append('photos', vehiclePhotos[i]);
            }

            axios.put('/vehicles/' + vehicleId, formData)
                .then(function(response) {
                    alert("Update successful");
                    console.log(response);
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




{{-- delete vehicle  --}}
<script>
    $(document).ready(function() {
    // Handle deletion of client
    $('.delete-vehicle').click(function() {
        var vehicleId = $(this).data('vehicle-id'); // Retrieve the client ID
        $('#deleteId').val(vehicleId); // Populate the deleteId input field with the client ID
        $('#clientIdPlaceholder').text(vehicleId); // Populate the client ID placeholder in the modal body
        $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
    });

    // Handle confirmation of deletion
    $('#confirmDeleteBtn').click(function() {
        var formData = $('#deleteForm').serialize(); // Serialize form data
        // Axios DELETE request
        axios.post('{{ route("admin.destroyVehicle") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $("#row").remove(); // Remove the deleted client row from the table
                    $('#confirmDeleteModal').modal('hide')
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    // Detach event handler for delete button after confirmation modal is closed
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // $('#confirmDeleteBtn').off('click');
    });
    });
</script>



{{-- add repairs --}}
<script>
$(document).ready(function() {
    console.log("Document ready");

    // Show modal and populate fields when the add repair button is clicked
    $('.add-repair').click(function() {
        $('#addRepairModal').modal('show');

        // Get the user_id from the data attribute of the clicked button
        var userId = $(this).data('vehicle-iduser');
        console.log(userId);
        $('#test_id').val(userId);

        // Get the vehicle_id from the data attribute of the clicked button
        var vehicleId = $(this).data('vehicle-id');
        $('#vehicle_id').val(vehicleId);

        // var vehicleId = $(this).data('vehicle-id');
        // $('#vehicle_id').val(vehicleId);


        // Store the userId as a data attribute on the form
        // $('#addRepairForm').data('user-id', userId);

        // Check if userId is correctly assigned
        // console.log($('#addRepairForm').data('user-id', userId());
    });

    // Handle form submission via AJAX using Axios
    $('.submitRepair').submit(function(event) {
        event.preventDefault()
        console.log("Submit button clicked");

        // Retrieve the userId from the form data attribute
        var userId = $('#addRepairForm').data('test_id');
        // alert(userId); // Check if userId is correctly retrieved

        // Serialize the form data
        var formData = $('#addRepairForm').serialize();

        var mechanicId = $('#mechanic_id').val();

        // Check if mechanicId is not empty and it's not already in formData
        if (mechanicId && !formData.includes('mechanic_id=')) {
            formData += '&mechanic_id=' + mechanicId;
        }

        // // Check if userId exists and append it to formData, even if it's null
        if (typeof userId !== 'undefined' && !formData.includes('user_id')) {
            formData += '&user_id=' + userId;
        }
        console.log(formData)
        alert(formData); // Check formData with userId appended

        // Append the mechanic ID and user ID to the serialized form data
        axios.post('/repairs/store', formData)
            .then(function(response) {
                // alert("Added successfully");
                console.log(response);
            })
            .catch(function(error) {
                console.error(error);
            });
    });
});

</script>
{{-- <script>
  $(document).ready(function() {
    var vehicleId; // Declare vehicleId outside of the event handlers

    console.log("Document ready");

    // Show modal and populate fields when the edit button is clicked
    $('.add-repair').click(function() {
        vehicleId = $(this).data('vehicle-id'); // Assign value to vehicleId
        $('#addRepairModal').modal('show');

        // No need to update URL since vehicle ID will be in form data

        // Add a hidden form field to store vehicle ID (if not already present)
        if (!$('#vehicle_id').length) { // Check if field exists
            $('#addRepairForm').append($('<input type="hidden" name="vehicle_id" id="vehicle_id" value="' + vehicleId + '">'));
        }
    });

    // Handle form submission via AJAX using Axios
    $('.submitRepair').click(function() {
        console.log("Submit button clicked");
        var formData = new FormData($('#addRepairForm')[0]); // Use FormData for potential file uploads
            alert(formData)
        // Get selected mechanic ID (assuming hidden form field)
        var mechanicId = $('#mechanic_id').val(); // Modify selector as needed
        formData.append('mechanic_id', mechanicId); // Add mechanic ID to FormData

        // Axios request (no need to specify URL since form action is likely defined)
        axios({
            method: 'post',
            url: '/repairs/store',
            data: formData
        })
        .then(function(response) {
            alert("Repair added successfully!");
            $('#addRepairModal').modal('hide'); // Hide modal on success
            // ... other actions after successful update
        })
        .catch(function(error) {
            console.error(error);
            if (error.response && error.response.data) {
                var errors = error.response.data.errors; // Assuming error format
                var errorMessage = "";
                for (var key in errors) {
                    errorMessage += errors[key][0] + "\n"; // Build error message
                }
                alert(errorMessage);
            } else {
                alert("Error adding repair. Please try again later.");
            }
        });
    });
});

</script> --}}

{{-- // fetch mechanic --}}

    <script>
        $(document).ready(function() {
            $('#addRepairModal').on('shown.bs.modal', function () {
                // Fetch mechanics on modal show
                $.ajax({
                    url: "{{ route('admin.fetchMechanics') }}", // Route to fetch mechanics
                    dataType: 'json',
                    success: function(data) {
                        var mechanicSelect = $('#mechanic_id');
                        mechanicSelect.empty(); // Clear existing options
                        mechanicSelect.append($('<option>', { value: '' }).text('-- Select Mechanic --'));
                        $.each(data.mechanics, function(index, mechanic) {
                            mechanicSelect.append($('<option>', { value: mechanic.id }).text(mechanic.name));
                        });
                    }
                });
            });
        });
    </script>


{{-- delete repair  --}}
<script>
    $(document).ready(function() {
    // Handle deletion of client
    $('.delete-repair').click(function() {
        var repairId = $(this).data('repair-id'); // Retrieve the client ID
        $('#deleteId').val(repairId); // Populate the deleteId input field with the client ID
        $('#clientIdPlaceholder').text(repairId); // Populate the client ID placeholder in the modal body
        $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
    });

    // Handle confirmation of deletion
    $('#confirmDeleteBtn').click(function() {
        var formData = $('#deleteForm').serialize(); // Serialize form data
        // Axios DELETE request
        axios.post('{{ route("admin.destroyRepair") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $("#row").remove(); // Remove the deleted client row from the table
                    $('#confirmDeleteModal').modal('hide')
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    // Detach event handler for delete button after confirmation modal is closed
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // $('#confirmDeleteBtn').off('click');
    });
    });
</script>

{{-- // update status  --}}
<script>
    // Add event listener for change event on select element
    document.querySelectorAll('.repair-status').forEach(function(select) {
        select.addEventListener('change', function() {
            // Get the repair ID and new status from the select element
            var repairId = this.dataset.repairId;
            var newStatus = this.value;

            // Send an AJAX request to update the status
            axios.post('/repairs/update-status', {
                repair_id: repairId,
                status: newStatus
            })
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                // Handle error response
                console.error(error);
            });
        });
    });
</script>




{{-- add Invoice  --}}

<script>
    $(document).ready(function() {
        console.log("Document ready");
        var repairInvoiceId;
        // alert("good")
        $('.add-invoice').click(function() {
            $('#addInvoiceModal').modal('show');
            var repairInvoiceId = $(this).data('repairinvoice-id');

            $('#invoicerepair_id').val(repairInvoiceId);

        });
        $('.submitInvoice').click(function() {
        console.log("Submit button clicked");
        var formData = $('#addInvoiceForm').serialize();
            console.log(formData)
        if (repairInvoiceId && !formData.includes('repair_id=')) {
            formData += '&repair_id=' + repairInvoiceId;
        }
        axios({
            method: 'post',
            url: '/invoices/generate',
            data: formData
        })
        .then(function(response) {
            $('#addInvoiceModal').modal('hide');

        })
        .catch(function(error) {
            console.error(error);
        });
    });
    });


</script>



{{-- show Invoice --}}
<script>



    $(".show-invoice").on("click", function() {
        var myId = $(this).attr("data-invoice-id");
        var data = { 'id': myId };
        axios.post('/invoices/showModal', data)
            .then(response => {
                $("#invoiceInfoModal").modal('show');
                var invoice = response.data;
                // console.log(invoice.repair.mechanic.name)
                $("#additionalCharges").val(invoice.additionalCharges);
                $("#totalAmount").val(invoice.totalAmount);
                $("#description").val(invoice.repair.description);
                $("#user").val(invoice.repair.user.name);
                // $("#mechanic").val(invoice.repair.mechanic.name);
                $("#vehicleMake").val(invoice.repair.vehicle.make);
                $("#vehicleRegistration").val(invoice.repair.vehicle.registration);
                $("#startDate").val(invoice.repair.startDate);
                $("#endDate").val(invoice.repair.endDate);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

{{-- delete invoice  --}}
<script>
    $(document).ready(function() {
    // Handle deletion of client
    $('.delete-invoice').click(function() {
        var invoiceId = $(this).data('invoice-id'); // Retrieve the client ID
        $('#deleteId').val(invoiceId); // Populate the deleteId input field with the client ID
        $('#clientIdPlaceholder').text(invoiceId); // Populate the client ID placeholder in the modal body
        $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
    });

    // Handle confirmation of deletion
    $('#confirmDeleteBtn').click(function() {
        var formData = $('#deleteForm').serialize(); // Serialize form data
        // Axios DELETE request
        axios.post('{{ route("admin.destroyInvoice") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $("#row").remove(); // Remove the deleted client row from the table
                    $('#confirmDeleteModal').modal('hide')
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    // Detach event handler for delete button after confirmation modal is closed
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // $('#confirmDeleteBtn').off('click');
    });
    });
</script>

{{-- print / --}}

<script>
    $(".show-invoice").on("click", function() {
        var myId = $(this).attr("data-invoice-id");
        // alert("my id is "+myId)
        $('#inputInvoiceId').val(myId)
        var data = { 'id': myId };
        axios.post('/generate-pdf', data)
            .then(response => {
                // console.log(response)
            //    alert(response);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>





{{-- pirnt invoice --}}




{{-- add spare parts --}}
<script>
   $(document).ready(function() {
    $('.add-spare-part').click(function() {
        $('#addSparePartModal').modal('show');
        var repairId = $(this).data('repair-id');
        $('#sparePartRepairId').val(repairId);
    });

    $('.submitSparePart').click(function() {
        var formData = $('#addSparePartForm').serialize();
        // alert(formData)
        axios.post('/spare-parts/add', formData)
            .then(function(response) {
                $('#addSparePartModal').modal('hide');
                // Refresh or update spare parts list if needed
            })
            .catch(function(error) {
                console.error(error);
            });
    });
});
</script>   
{{-- delete the spare parts  --}}

<script>
    $(document).ready(function() {
        // Handle deletion of spare part
        $('.delete-spare').click(function() {
            var spareId = $(this).data('spare-id'); // Retrieve the spare part ID
            $('#deleteId').val(spareId); // Populate the deleteId input field with the spare part ID
            $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
        });

        // Handle confirmation of deletion
        $('#confirmDeleteBtn').click(function() {
            var formData = $('#deleteForm').serialize(); // Serialize form data
            // Axios DELETE request
            axios.post('{{ route("admin.destroySparePart") }}', formData)
                .then(function (response) {
                    if (response.data == "ok") {
                        $("#row").remove(); // Remove the deleted spare part row from the table
                        $('#confirmDeleteModal').modal('hide');
                    }
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                });
        });

        // Detach event handler for delete button after confirmation modal is closed
        $('#confirmDeleteModal').on('hidden.bs.modal', function () {
            // $('#confirmDeleteBtn').off('click');
        });
    });
</script>

{{-- // compose email --}}

<script>
        $(document).ready(function() {
        $('.compose-email').click(function() {
            $('#composemodal').modal('show');
        });
    
        $('#sendEmailBtn').click(function() {
            var formData = $('#composeForm').serialize();
            console.log(formData);
            axios.post('/send-email', formData)
                .then(function(response) {
                    $('#composemodal').modal('hide');
                })
                .catch(function(error) {
                    console.error("error" + error);
                });
        });
    });
</script>  


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sendEmailBtn = document.getElementById('sendEmailBtn');
        sendEmailBtn.addEventListener('click', function () {
            const formData = new FormData(document.getElementById('composeForm'));
            console.log(formData);
            alert(formData);
            axios.post('/send-email', formData)
                .then(response => {
                    console.log(response.data);
            alert(response.data);

                    // Close the modal
                    $('#composemodal').modal('hide');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script> --}}

{{-- add appointment --}}


<script>
    $(document).ready(function() {
        console.log("Document ready");
        // Show modal and populate fields when the edit button is clicked
        $('.add-appointment').click(function() {
            $('#addAppointmentModal').modal('show');
        });

        // Handle form submission via AJAX using Axios
        $('.submitAppointment').click(function(event) {
            event.preventDefault();
        // console.log("Submit button clicked");
        var formData = $('#addAppointmentForm').serialize();
            // alert(formData);
        // Axios request
        axios({
            method: 'post',
            url: '/appointments/',
            data: formData
        })
        .then(function(response) {
            $('#addAppointmentModal').modal('hide');

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

{{-- // delete appointement --}}




<script>
    $(document).ready(function() {
    // Handle deletion of appointment
    $('.delete-appointment').click(function() {
        var appointmentId = $(this).data('appointment-id');
        $('#deleteAppointmentId').val(appointmentId);
        $('#confirmDeleteModal').modal('show');
    });

    // Handle confirmation of deletion
    $('.confirmDeleteBtnApp').click(function() {
        console.log("dood")
        var formData = $('#deleteForm').serialize(); // Serialize form data
        console.log(formData)
        axios.post('{{ route("distroy.appointments") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    console.log("okkkk")
                    $("#row").remove(); // Remove the deleted appointment row from the table
                    $('#confirmDeleteModal').modal('hide');
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    // Detach event handler for delete button after confirmation modal is closed
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // $('#confirmDeleteBtn').off('click');
    });
});

</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle updating appointment status
        document.querySelectorAll('.update-appointment-status').forEach(function(select) {
            select.addEventListener('change', function(event) {
                var appointmentId = event.target.dataset.appointmentId;
                var newStatus = event.target.value;

                // Send Axios request to update appointment status
                axios.post('{{ route("update.appointment.status") }}', {
                    appointment_id: appointmentId,
                    status: newStatus
                })
                .then(function (response) {
                    console.log(response.data.message);
                    // Update the status text in the user's dashboard
                    document.getElementById('status-' + appointmentId).textContent = newStatus;
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                    // Handle error response if needed
                });
            });
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
    // Handle updating appointment status
    $('.update-appointment-status').change(function() {
        var appointmentId = $(this).data('appointment-id');
        var newStatus = $(this).val();

        // Send Axios request to update appointment status
        axios.post('{{ route("update.appointment.status") }}', {
            appointment_id: appointmentId,
            status: newStatus
        })
        .then(function(response) {
            console.log(response.data.message);
            // Optionally, update the UI to reflect the new status
        })
        .catch(function(error) {
            console.error("Error occurred:", error);
            console.error("Response data:", error.response.data);
            // Handle error response if needed
        });
    });
});

</script>



<script>
 axios.get('/api/notifications')
.then(response => {
    const notifications = response.data.notifications;
    // Get the notifications container
    const notificationsContainer = document.getElementById('notifications-container');

    // // Filter notifications related to completed repairs
    // const completedRepairNotifications = notifications.filter(notification => {
    //     return notification.message.includes('marked as completed');
    // });

    // Check if notifications exist
    if (notifications.length > 0) {
        // Iterate over filtered notifications array and create HTML elements
        notifications.forEach(notification => {

            // Create elements
            const notificationItem = document.createElement('a');
            notificationItem.setAttribute('href', '#');
            notificationItem.classList.add('text-reset', 'notification-item');

            const notificationContent = document.createElement('div');
            notificationContent.classList.add('d-flex');

            const avatarDiv = document.createElement('div');
            avatarDiv.classList.add('avatar-xs', 'me-3');

            const avatarTitle = document.createElement('span');
            avatarTitle.classList.add('avatar-title', 'bg-primary', 'rounded-circle', 'font-size-16');
            avatarTitle.innerHTML = '<i class="ri-settings-cart-line"></i>';

            const notificationDetails = document.createElement('div');
            notificationDetails.classList.add('flex-1');

            const notificationUserName = document.createElement('h6');
            notificationUserName.classList.add('mb-1');
            notificationUserName.textContent = notification.sender;

            const notificationMessage = document.createElement('p');
            notificationMessage.classList.add('mb-1');
            notificationMessage.textContent = notification.message;


                const notificationTime = document.createElement('p');
                notificationTime.classList.add('mb-0');

                // Parse the created_at timestamp
                const createdAt = new Date(notification.created_at);
                const month = createdAt.toLocaleString('default', { month: 'long' });
                const hour = createdAt.getHours();
                const minute = createdAt.getMinutes();

                // Set the content of the notification time element
                notificationTime.innerHTML = `<i class="mdi mdi-clock-outline"></i> ${month} ${hour}:${minute}`;
            // Append elements
            avatarDiv.appendChild(avatarTitle);
            notificationContent.appendChild(avatarDiv);
            notificationDetails.appendChild(notificationUserName);
            notificationDetails.appendChild(notificationMessage);
            notificationDetails.appendChild(notificationTime);
            notificationContent.appendChild(notificationDetails);
            notificationItem.appendChild(notificationContent);
            notificationsContainer.appendChild(notificationItem);
        });
    } else {
        // No notifications related to completed repairs found
        notificationsContainer.innerHTML = '<p>No notifications found</p>';
    }
})
.catch(error => {
    console.error('Error fetching notifications:', error);
});

</script>

{{-- <script>
    // Make an Axios request to fetch notifications
    axios.get('/api/notifications')
    .then(response => {
        console.log("good")
        const notifications = response.data.notifications;
        console.log(notifications);
        const userSenders = response.data.user_senders;
        console.log(userSenders);

        // Get the notifications container
        const notificationsContainer = document.getElementById('notifications-container');

        // Check if notifications exist
        if (notifications.length > 0) {
            // Iterate over notifications array and create HTML elements
            notifications.forEach(notification => {
                // Parse the created_at timestamp
                const createdAt = new Date(notification.created_at);
                const month = createdAt.toLocaleString('default', { month: 'long' });
                const day = createdAt.getDate();

                // Get the sender's name from user_senders using notification id
                const senderName = userSenders[notification.id] ? userSenders[notification.id].name : 'Unknown';

                // Create elements
                const notificationItem = document.createElement('a');
                notificationItem.setAttribute('href', '#');
                notificationItem.classList.add('text-reset', 'notification-item');

                const notificationContent = document.createElement('div');
                notificationContent.classList.add('d-flex');

                const avatarDiv = document.createElement('div');
                avatarDiv.classList.add('avatar-xs', 'me-3');

                const avatarTitle = document.createElement('span');
                avatarTitle.classList.add('avatar-title', 'bg-primary', 'rounded-circle', 'font-size-16');
                avatarTitle.innerHTML = '<i class="ri-shopping-cart-line"></i>';

                const notificationDetails = document.createElement('div');
                notificationDetails.classList.add('flex-1');

                const notificationUserName = document.createElement('h6');
                notificationUserName.classList.add('mb-1');
                notificationUserName.textContent = senderName; // Use sender's name here

                const notificationMessage = document.createElement('p');
                notificationMessage.classList.add('mb-1');
                notificationMessage.textContent = notification.message;

                const notificationTime = document.createElement('p');
                notificationTime.classList.add('mb-0');
                notificationTime.textContent = `${month} ${day}`;

                // Append elements
                avatarDiv.appendChild(avatarTitle);
                notificationContent.appendChild(avatarDiv);
                notificationDetails.appendChild(notificationUserName);
                notificationDetails.appendChild(notificationMessage);
                notificationDetails.appendChild(notificationTime);
                notificationContent.appendChild(notificationDetails);
                notificationItem.appendChild(notificationContent);
                notificationsContainer.appendChild(notificationItem);
            });
        } else {
            // No notifications found
            notificationsContainer.innerHTML = '<p>No notifications found</p>';
        }
    })
    .catch(error => {
        console.error('Error fetching notifications:', error);
    });
</script> --}}




    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>


    <!-- apexcharts -->
    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
