
@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        .add-client,.import-clients {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
        }
        #importForm {
  display: flex;
  flex-direction: column;
  gap: 10px; /* Adjust spacing between elements */
}

#file {
  padding: 5px;
  border: 1px solid #ccc;
}

#importButton {
  background-color: #007bff; /* Adjust button color */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px; /* Add rounded corners */
  cursor: pointer; /* Indicate clickable element */
}
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

         

            <div class="row">
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
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="add-new">

                                @if(Auth::user()->role === 'admin')

                                <h4 class="card-title">{{ __('Client List') }}</h4>
                            @else
                                <h4 class="card-title">{{ __('Profile') }}</h4>

                            @endif
                                @if(Auth::user()->role === 'admin')
                                <button class="btn-primary add-client">{{ __('Add New Client') }}</button>
                                <button class="btn-primary import-clients">
                                    <i class="fas fa-upload"></i> {{ __('Import Clients') }}
                                </button>
                                @endif
                                  
                                    {{-- <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data" id="importForm">
                                        @csrf
                                        <div class="form-group">
                                        <label for="file">Select Excel File</label>
                                        <input type="file" name="file" id="file" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="importButton">Import Users</button>
                                    </form> --}}
                                  
                                <p class="card-title-desc">

                                </p>
                            </div>
                        @if (Auth::user()->role === "admin")
                        {{--  --}}
                
                         
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">


                                <thead>
                                    <tr>
                                        <th>{{ __('Avatar') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone Number') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>


                                <tbody>
                               
                                    @foreach ($clients as $client)
                                    <tr data-client-id="{{ $client->deleteId }}" id="row">

                                        <td>

                                            


                                            @if ($client->avatar)
                                                <img src="{{ asset('storage/' . $client->avatar) }}" class="avatar-sm rounded-circle" id="avatar-image">
                                            @else
                                                <!-- Default avatar image or placeholder -->
                                                <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" 
                                                alt="Default Avatar" class="avatar-sm rounded-circle" id="avatar-image">
                                            @endif
                                        </td>

                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phoneNumber }}</td>
                                        <td>{{ $client->created_at }}</td>
                                        <td>
                                            <!-- Display edit, delete, and show buttons -->
                                            <button type="button" class="btn edit-client" data-client-id="{{ $client->id }}" data-client-name="{{ $client->name }}" data-client-email="{{ $client->email }}" data-client-address="{{ $client->address }}" data-client-phone="{{ $client->phoneNumber }}">
                                                <i class="ri-edit-2-line"></i>
                                            </button>
                                                @if (Auth::user()->role ==="admin")
                                                    <button type="button" class="btn delete-client" data-client-id="{{ $client->id }}">
                                                        <i class="ri-delete-bin-3-line"></i>
                                                    </button>
                                                 @endif    
                                               
                                            

                                            <button type="button" class="btn show-client" data-client-id="{{ $client->id }}">
                                                <i class="ri-file-info-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                  

                                </tbody>
                        </table>
                            @else
                            <div class="col-lg-6">
                                @foreach ($clients as $client)
                                <div class="card">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-4">

                                            <div class="">
                                                <form action="{{ route('upload.avatar') }}" method="POST" enctype="multipart/form-data" id="avatar-upload-form">
                                                    @csrf
                                                    <input type="file" name="avatar" id="avatar-input" style="display: none;">
                                                </form>
                                                <label for="avatar-input">
                                                    @if (Auth::user()->avatar)
                                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="card-img img-fluid" id="avatar-image">
                                                    @else
                                                        <!-- Default avatar image or placeholder -->
                                                        <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" 
                                                        alt="Default Avatar" class="card-img img-fluid" id="avatar-image">
                                                    @endif
                                                </label>
                                            </div>

                                          
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $client->name }}</h5>
                                                <p class="card-text">Email: {{ $client->email }}</p>
                                                <p class="card-text">Address: {{ $client->address }}</p>
                                                <p class="card-text">Phone Number: {{ $client->phoneNumber }}</p>
                                                <p class="card-text"><small class="text-muted">Start Date: {{ $client->created_at }}</small></p>
                                                <button type="button" class="btn edit-client" data-client-id="{{ $client->id }}" data-client-name="{{ $client->name }}" data-client-email="{{ $client->email }}" data-client-address="{{ $client->address }}" data-client-phone="{{ $client->phoneNumber }}">
                                                    <i class="ri-edit-2-line"></i>
                                                </button>
                                                <button type="button" class="btn show-client" data-client-id="{{ $client->id }}">
                                                    <i class="ri-file-info-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endforeach
                                
                            </div>
                            @endif
                          
                        </div>
                       
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © elklie.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        {{ __('crafted_with_love') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@include('admin.layouts.components.users.edit-modal')
@include('admin.layouts.components.users.add-modal')
@include('admin.layouts.components.users.import-modal')
@include('admin.layouts.components.users.confirm-modal')
@include('admin.layouts.components.users.show-modal')




<!-- Modal for editing client -->
@endsection