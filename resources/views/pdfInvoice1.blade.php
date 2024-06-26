<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Your Page Title</title>
<style>

body{margin-top:20px;
background:#87CEFA;
}

.card-footer-btn {
    display: flex;
    align-items: center;
    border-top-left-radius: 0!important;
    border-top-right-radius: 0!important;
}
.text-uppercase-bold-sm {
    text-transform: uppercase!important;
    font-weight: 500!important;
    letter-spacing: 2px!important;
    font-size: .85rem!important;
}
.hover-lift-light {
    transition: box-shadow .25s ease,transform .25s ease,color .25s ease,background-color .15s ease-in;
}
.justify-content-center {
    justify-content: center!important;
}
.btn-group-lg>.btn, .btn-lg {
    padding: 0.8rem 1.85rem;
    font-size: 1.1rem;
    border-radius: 0.3rem;
}
.btn-dark {
    color: #fff;
    background-color: #1e2e50;
    border-color: #1e2e50;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(30,46,80,.09);
    border-radius: 0.25rem;
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}

.p-5 {
    padding: 3rem!important;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.5rem 1.5rem;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}

.table td, .table th {
    border-bottom: 0;
    border-top: 1px solid #edf2f9;
}
.table>:not(caption)>*>* {
    padding: 1rem 1rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}
.px-0 {
    padding-right: 0!important;
    padding-left: 0!important;
}
.table thead th, tbody td, tbody th {
    vertical-align: middle;
}
tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}

.mt-5 {
    margin-top: 3rem!important;
}

.icon-circle[class*=text-] [fill]:not([fill=none]), .icon-circle[class*=text-] svg:not([fill=none]), .svg-icon[class*=text-] [fill]:not([fill=none]), .svg-icon[class*=text-] svg:not([fill=none]) {
    fill: currentColor!important;
}
.svg-icon>svg {
    width: 1.45rem;
    height: 1.45rem;
}
</style>

</head>
<body>












<div class="container mt-6 mb-7">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xl-7">
        <div class="card">
          <div class="card-body p-5">
            <h2>
              Hey M.{{ $invoice->repair->user->name }}
            </h2>
            <p class="fs-sm">
              This is the receipt for a payment of <strong>{{ $invoice->totalAmount }}$</strong>  you made to Jihad's Garage
            </p>

            <div class="border-top border-gray-200 pt-4 mt-4">
              <div class="row">

                <div class="col-md-6 text-md-end">
                  <div class="text-muted mb-2">Payment Date</div>
                  <strong>{{ date('Y-m-d H:i') }}</strong>
                </div>
              </div>
            </div>

            <div class="border-top border-gray-200 mt-4 py-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="text-muted mb-2">Client</div>
                  <strong>
                  {{ $invoice->repair->user->name }}
                  </strong>
                  <p class="fs-sm">
                  {{ $invoice->repair->user->address }}
                    <br>
                    <a href="#!" class="text-purple">{{ $invoice->repair->user->email }}
                    </a>
                  </p>
                </div>
                <div class="col-md-6 text-md-end">
                  <div class="text-muted mb-2">Payment To</div>
                  <strong>
                    Jihad Garage
                  </strong>
                  <p class="fs-sm">
                    AV ALLAL EL FASSI RUE 1 WILAYA
                    <br>
                    <a href="#!" class="text-purple">yuj4xoncrack@gmail.com
                    </a>
                  </p>
                </div>
              </div>
            </div>

            
            <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Make</th>
      <th scope="col">Registration</th>
      <th scope="col">fuelType</th>
      <th scope="col">model</th>
    </tr>
  </thead>
  <tbody>
    <tr>

    <td>{{ $invoice->repair->vehicle->make }}</td>
                        <td>{{ $invoice->repair->vehicle->registration }}</td>
                        <td>{{ $invoice->repair->vehicle->fueltype }}</td>
                        <td>{{ $invoice->repair->vehicle->model }}</td>
    </tr>
   
  </tbody>
</table>

            <div class="mt-5">
             
            
              <div class="d-flex justify-content-end mt-3">
                <h5 class="me-3">Total:</h5>
                <h5 class="text-success">{{ $invoice->totalAmount }} $</h5>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>

</body>