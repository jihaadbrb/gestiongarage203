


<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // $(".print-invoice").on("click", function() {
    //     var myId = $(this).attr("data-invoice-id");
    //     console.log(myId)
    //     $('#inputInvoiceId').val(myId);
    //     var data = { 'id': myId };
    //     console.log(data);
    //     axios.post('/generate-pdf', data)
    //         .then(response => {
    //             console.log('good');
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //         });
    // });
    

$('.print-invoice').click(async function(){
    var myId = $(this).attr("data-invoice-id");
    console.log(myId);
    const res = await axios.get('/generate-pdf/'+ myId);
}); 

</script>