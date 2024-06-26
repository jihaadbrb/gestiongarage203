@extends('admin.layouts.home')
@section('content')
<div class="main-content">


        <style>
        
    
    /* CSS */
    .toast {
        background-color: #2ecc71;
        color: #fff;
        padding: 12px 20px;
        border-radius: 5px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        position: absolute;
        top: 10px;
        right: 07px;
    }
    .table-bordered tr, .table-bordered th, .table-bordered td{
    border-color: #436850 !important;
}
thead{
    background-color:#436850;
    color:white;
}
th{
    color:#f7e300;
}
    .textup{
        width:100%;
        display: flex;
        align-items:center;
        height:100px;
        justify-content:center;
    }

    .edit-client{
        background-color:#1a4d2e;
        border:none;
    }
    .edit-client:hover{
        background-color:#436850;
        border:none;
    }
    .toast-close-button {
        background: transparent;
        border: none;
        color: inherit;
        cursor: pointer;
        font-size: 16px;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
    }


    .toast-message {
        margin-top: 5px;
    }
    
        </style>
        <div class="page-content">
            <div class="container-fluid">
                @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    
    
                    <div class="toast toast-success" aria-live="polite" style="display: none;">
                    <div class="toast-progress" style="width: 0%;"></div>
                    <button type="button" class="toast-close-button" role="button">×</button>
                    <div class="toast-message"></div>
                </div>
                
                <div class="toast toast-danger" aria-live="polite" style="display: none;">
                    <div class="toast-progress" style="width: 0%;"></div>
                    <button type="button" class="toast-close-button" role="button">×</button>
                    <div class="toast-message"></div>
                </div>
    
    
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="textup">
                            <h4 >{{ __('Admins List') }}</h4>
                            <p class="card-title-desc">
                            </p>
</div>

                            <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('Phone Number') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($admins as $client)
                                        <tr data-client-id="{{$client->id}}">
                                            <td>{{ $client->name }}</td>
                                            <td>{{$client->email}}</td>
                                            <td>{{$client->address}}</td>
                                            <td>{{$client->phoneNumber}}</td>
                                            <td>{{$client->created_at}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary edit-client"
                                                data-client-id="{{$client->id}}"
                                                data-client-name="{{$client->name}}"
                                                data-client-email="{{$client->email}}"
                                                data-client-address="{{$client->address}}"
                                                data-client-phone="{{$client->phoneNumber}}"
                                            >
                                            {{ __('Edit') }}
                                            </button>
                                            </td>
                                        </tr>



                                        @include('admin.layouts.components.users.edit-modal')

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;" >

    <div class="text-center p-3" style="background-color:#e4dcc7; display:flex;align-items:center;justify-content:center;">
      
   <a class="text-body" href="https://mdbootstrap.com/"> © 2024 Garagiste.com  | Jihad Bourbab</a>
</div>

</footer>
</div>

</div>

<!-- Modal for editing mechanic -->
<div class="modal fade" id="editMechanicModal" tabindex="-1" aria-labelledby="editMechanicModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMechanicModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                  <form id="editMechanicForm">
                    <!-- Form fields -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                    </div>
                  </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="submitEditMechanicForm">Save changes</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
{{-- <script>
    $(document).ready(function() {
        // Handle click event for edit mechanic button
        $('.edit-mechanic').click(function() {
            // Get the mechanic ID from data attribute
            var mechanicId = $(this).data('mechanic-id');

            // Perform AJAX request to fetch mechanic details
            $.ajax({
                url: '/mechanics/' + mechanicId + '/edit',
                type: 'GET',
                success: function(response) {
                    // Populate the modal body with the fetched data
                    $('#editMechanicModal .modal-body').html(response);

                    // Show the modal
                    $('#editMechanicModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> --}}
@endpush
