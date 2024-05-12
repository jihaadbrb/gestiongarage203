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
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#vehiclePicsCarousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
