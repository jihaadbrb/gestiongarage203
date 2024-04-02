<!doctype html>
<html lang="en">

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
        <div id="layout-wrapper">

            @include('admin.layouts.components.header')
          

            <!-- ========== Left Sidebar Start ========== -->
          @include('admin.layouts.components.leftside')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
           @yield('content')
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        @include('admin.layouts.components.rightbar')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

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
      console.log("Document ready");

      // Handle deletion of client
      $('.delete-client').click(function() {
          var clientId = $(this).data('client-id');
          // alert(clientId)
          // Show confirmation modal
          $('#confirmDeleteModal').modal('show');

          // Handle confirmation of deletion
          $('#confirmDeleteBtn').click(function() {
              // Axios DELETE request
              axios({
              method: 'delete',
              url: '/users/destroy/' + clientId,
              data: {
                          "_token": "{{ csrf_token() }}"
                        },
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

          // Detach event handler for delete button after confirmation modal is closed
          $('#confirmDeleteModal').on('hidden.bs.modal', function () {
              $('#confirmDeleteBtn').off('click');
          });
      });
  });
</script>


          

        <!-- JAVASCRIPT -->
     


       
      
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





        <!-- App js -->

   
   
   

   
      </body>

</html>