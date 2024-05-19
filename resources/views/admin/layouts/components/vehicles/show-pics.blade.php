<div class="modal fade" id="showPicsModal" tabindex="-1" aria-labelledby="showPicsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="showPicsModalLabel">@lang('Vehicles Pictures')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div id="vehiclePicsCarousel" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                      <!-- Carousel items will be dynamically added here -->
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#vehiclePicsCarousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon " style="color:black;" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#vehiclePicsCarousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" style="color:black;"aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                  </button>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
          </div>
      </div>
  </div>
</div>


<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showPicsButtons = document.querySelectorAll('.show-pics');
        
        showPicsButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var myId = $(this).attr("data-vehicle-id");
                var data = { 'id': myId };
                
                // Send an Axios request to fetch vehicle pictures
                axios.post('/vehicles/showVehiclePics', data)
                .then(function(response) {
                    // Clear existing carousel inner HTML
                    const carouselInner = document.querySelector('#vehiclePicsCarousel .carousel-inner');
                    carouselInner.innerHTML = '';

                    // Iterate over the received image URLs and extract the filename
                    response.data.pictures.forEach(function(imageUrl, index) {
                        // Extract just the filename from the image URL
                        const filename = imageUrl.split('/').pop();
                        
                        const imageElement = document.createElement('div');
                        imageElement.classList.add('carousel-item');
                        if (index === 0) {
                            imageElement.classList.add('active');
                        }
                        
                        // Update the image source to point to the correct location in the public folder
                        imageElement.innerHTML = '<img src="{{ asset("storage/vehicle_photos") }}/' + filename + '" class="d-block w-100" alt="Vehicle Picture">';
                        carouselInner.appendChild(imageElement);
                    });

                    // Show the modal with the updated carousel
                    const modal = new bootstrap.Modal(document.getElementById('showPicsModal'));
                    modal.show();
                })
                .catch(function(error) {
                    // Handle errors if any
                    console.error(error);
                    alert('Failed to fetch vehicle pictures. Please try again later.');
                });
            });
        });

        // Initialize the carousel
        $('#vehiclePicsCarousel').carousel();

        // Handle carousel control clicks
        $('.carousel-control-prev').click(function() {
            $('#vehiclePicsCarousel').carousel('prev');
        });

        $('.carousel-control-next').click(function() {
            $('#vehiclePicsCarousel').carousel('next');
        });
    });
</script>
