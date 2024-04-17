<!doctype html>
<html @if(app()->getLocale() == 'ar') dir="rtl" @endif
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<<<<<<< HEAD
    @include('admin.layouts.partials.header')
    <body data-topbar="dark">
=======
<head>

        <meta charset="utf-8" />
        <title>Reda's Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- jquery.vectormap css -->
        <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
>>>>>>> a63bff53d02d02b02a2f38cebe847790765bc0eb
        <div id="layout-wrapper">
            @include('admin.layouts.components.header')
<<<<<<< HEAD
          @include('admin.layouts.components.leftside')
=======


            <!-- ========== Left Sidebar Start ========== -->
          @include('admin.layouts.components.leftside')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
>>>>>>> a63bff53d02d02b02a2f38cebe847790765bc0eb
           @yield('content')
        </div>
        @include('admin.layouts.components.rightbar')

        <div class="rightbar-overlay"></div>
<<<<<<< HEAD
        @include('admin.layouts.partials.scripts')
=======

<!-- Button trigger modal -->


  <!-- Edit Mechanic Modal -->

  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
        console.log("Edit button clicked");
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
    console.log("Submit button clicked");
    var clientId = $('#editClientId').val();
    var formData = $('#editClientForm').serialize();

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
        axios.post('{{ route("admin.destroy") }}', formData)
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

        <!-- JAVASCRIPT -->



        <script>
            $(".btnCloseShow").on('click',function(){
               $("#myModalShowProduct").hide();
           })


           </script>


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
        $(".show-mechanic").on("click", function() {
            var mechanicId = $(this).attr("data-client-id");
            var data = { 'id': mechanicId };
            console.log(data);
            axios.post('/mechanics/showModalMechanic', data)
                .then(response => {
                    // Populate mechanic information
                    $('#mechanicInfoName').val(response.data.mechanic.name);
                    $('#mechanicInfoRole').val(response.data.mechanic.role);

                    // Populate assigned repairs
                    var assignedRepairsHtml = '';
                    response.data.repairs.forEach(function(repair) {
                        assignedRepairsHtml += '<div><strong>Description:</strong> ' + repair.description + '</div>';
                        assignedRepairsHtml += '<div><strong>Mechanic Notes:</strong> ' + repair.mechanicNotes + '</div>';
                        assignedRepairsHtml += '<div><strong>Client Notes:</strong> ' + repair.clientNotes + '</div>';
                        assignedRepairsHtml += '<div><strong>Status:</strong> ' + repair.status + '</div>';
                        assignedRepairsHtml += '<div><strong>Start Date:</strong> ' + repair.startDate + '</div>';
                        assignedRepairsHtml += '<div><strong>End Date:</strong> ' + repair.endDate + '</div>';
                        assignedRepairsHtml += '<hr>'; // Add horizontal line for separation between repairs
                    });
                    $('#assignedRepairs').html(assignedRepairsHtml);

                    // Populate tasks and responsibilities (if available)
                    var tasksHtml = '';
                    response.data.tasks.forEach(function(task) {
                        tasksHtml += '<div><strong>Task:</strong> ' + task.name + '</div>';
                        tasksHtml += '<div><strong>Status:</strong> ' + task.status + '</div>';
                        // Add more fields as needed
                        tasksHtml += '<hr>'; // Add horizontal line for separation between tasks
                    });
                    $('#tasksResponsibilities').html(tasksHtml);

                    // Populate spare parts usage (if available)
                    var sparePartsHtml = '';
                    response.data.spareParts.forEach(function(part) {
                        sparePartsHtml += '<div><strong>Part Name:</strong> ' + part.name + '</div>';
                        sparePartsHtml += '<div><strong>Part Reference:</strong> ' + part.reference + '</div>';
                        sparePartsHtml += '<div><strong>Supplier:</strong> ' + part.supplier + '</div>';
                        sparePartsHtml += '<div><strong>Price:</strong> ' + part.price + '</div>';
                        // Add more fields as needed
                        sparePartsHtml += '<hr>'; // Add horizontal line for separation between parts
                    });
                    $('#sparePartsUsage').html(sparePartsHtml);

                    // Populate performance metrics
                    $('#averageRepairTime').text('Average Repair Time: ' + response.data.averageRepairTime + ' days');
                    $('#repairSuccessRate').text('Repair Success Rate: ' + response.data.repairSuccessRate + '%');

                    // Show the modal
                    $("#mechanicInfoModal").modal('show');
                })
                .catch(error => {
                    console.error(error);
                });
        });

      </script>


<script>
    $(document).ready(function() {
        console.log("Document ready");
        // Show modal and populate fields when the edit button is clicked
        $('.add-vehicle').click(function() {
            // Show the modal
            $('#addVehicleModal').modal('show');
            console.log("good")
        });

        // Handle form submission via AJAX using Axios
        $('#addVehicleForm').click(function() {
        console.log("Submit button clicked");
        var formData = $('#addVehicleForm').serialize();
            alert(formData)
        // Axios request
        axios({
            method: 'post',
            url: '/vehicles/store',
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




        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>


        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

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





        <!-- App js -->






>>>>>>> a63bff53d02d02b02a2f38cebe847790765bc0eb
      </body>

</html>
