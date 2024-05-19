

<!-- 
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->



{{-- USERS DONE --}}
{{--  ADMINS DONE --}}
{{-- MECHANICS Done--}}
{{-- VEHICLES Done--}}
{{-- REPAIRS DONE--}}
{{-- SPARE PARTS DONE--}}
{{-- INVOICES DONE (PRITN DOESNT WORK )--}}

{{-- APPOINTEMENTS --}}

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
                    $('.toast-success .toast-message').text('@lang("Email sent successfully")');
                        $('.toast-success').fadeIn().delay(3000).fadeOut();
                    $('#composemodal').modal('hide');
                })
                .catch(function(error) {
                    console.error("error" + error);
                });
        });
    });
</script>  







<script>
    $(document).ready(function() {
    $('.update-appointment-status').change(function() {
        var appointmentId = $(this).data('appointment-id');
        var newStatus = $(this).val();

        axios.post('{{ route("edit.status") }}', {
            appointment_id: appointmentId,
            status: newStatus
        })
        .then(function(response) {
      

            location.reload();           
        })
        .catch(function(error) {
            console.error("Error occurred:", error);
            console.error("Response data:", error.response.data);
          
        });
    });
});

</script>







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
