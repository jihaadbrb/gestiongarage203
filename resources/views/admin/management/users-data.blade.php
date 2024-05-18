
@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items:center;
            flex-direction:column;
            height:fit-content;
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
        .actionbutton{
            display: flex;
            flex-direction:column;
            align-items:center;
            gap:10px;
            
            padding:20px;
            
        }
        .actionbutton button{
            background-color:#1a4d2e;
        }
        .actionbutton button:hover{
            background-color:#436850;
        }
        .edit-client{
            background-color:#1a4d2e;
            color:white;
        }
        .edit-client:hover{
            background-color:#1a4d2e;
            color:white;
        }
        .delete-client{
            background-color:red;
            color:white;
        }
        .delete-client:hover{
            background-color:red;
            color:white;
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

                                <h4 >{{ __('Clients List') }}</h4>
                            @else
                                <h4 class="card-title">{{ __('Profile') }}</h4>

                            @endif
                                @if(Auth::user()->role === 'admin')
                                <div class="actionbutton">
                                <button class="btn-primary add-client">{{ __('Add New Client') }}</button>
                                <button class="btn-primary import-clients">
                                    {{ __('Import Clients') }}
                                </button>
                                </div>
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
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top:0;">


                                <thead>
                                    <tr>
                                   
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

                                       
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phoneNumber }}</td>
                                        <td>{{ $client->created_at }}</td>
                                        <td>
                                            <!-- Display edit, delete, and show buttons -->
                                            <button type="button" class="btn edit-client " data-client-id="{{ $client->id }}" data-client-name="{{ $client->name }}" data-client-email="{{ $client->email }}" data-client-address="{{ $client->address }}" data-client-phone="{{ $client->phoneNumber }}">
                                                Edit
                                            </button>
                                                @if (Auth::user()->role ==="admin")
                                                    <button type="button" class="btn delete-client danger" data-client-id="{{ $client->id }}">
                                                        Delete
                                                    </button>
                                                 @endif    
                                               
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
                                                <p class="card-text">{{ __('Email') }}: {{ $client->email }}</p>
                                                <p class="card-text">{{ __('Address') }}: {{ $client->address }}</p>
                                                <p class="card-text">{{ __('Phone Number') }}: {{ $client->phoneNumber }}</p>
                                                <p class="card-text"><small class="text-muted"{{ __('>Start Date') }}: {{ $client->created_at }}</small></p>
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

    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;" >

<div class="text-center p-3" style="background-color:#e4dcc7; display:flex;align-items:center;justify-content:center;">
     
   <a class="text-body" href="https://mdbootstrap.com/">  © 2024 Garagiste.com  | Jihad Bourbab</a>
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