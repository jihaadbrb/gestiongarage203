
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
  gap: 10px;      
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
        .export-client{
            background-color:#1a4d2e;
            color:white;
        }
        .export-client:hover{
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
.export-client {
  background-color: #1a4d2e; /* Adjust button color */
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



.profileall{
    display: flex;
    width:600px;
    height:300px;
    align-items:center;
    justify-content:center;
    gap:20px;
    background-color:white;
    
}
.profileimg{
    width: 40%;
    display: flex;
    align-items:center;
    justify-content:center;
}
.profileimg img{
    height:fit-content;
    width:200px;
}
.profilepos{
    width: 100%;
    height:100%;
    display: flex;
    align-items:center;
    justify-content:center;
}

.profileinfo{
    display: flex;
    flex-direction:column;
    align-items:start;
    
    gap:2px;

    width: 60%;

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

                                <h4 >{{ __('Users List') }}</h4>
                            @else
                                <h3>{{ __('Profile') }}</h3>

                            @endif
                                @if(Auth::user()->role === 'admin')
                                <div class="actionbutton">
                                <button class="btn-primary add-client">{{ __('Add New User') }}</button>
                                <button class="btn-primary import-clients">
                                    {{ __('Import Users') }}
                                </button>
                                <form action="{{route('export.clients')}}" method="get">
                                    <button type="submit" class="export-client"> {{ __('Export Users') }}</button>
                                </form>

                                </div>
                                @endif
                                  
             
                                  
                                <p class="card-title-desc">

                                </p>
                            </div>
                        @if (Auth::user()->role === "admin")
               
                
                         
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
                                                {{__('Edit')}}
                                            </button>
                                                @if (Auth::user()->role ==="admin")
                                                    <button type="button" class="btn delete-client danger" data-client-id="{{ $client->id }}">
                                                    {{__('Delete')}}
                                                    </button>
                                                 @endif    
                                               
                                        </td>
                                    </tr>
                                    @endforeach

                                  

                                </tbody>
                        </table>
                            @else
                            <div class="profilepos">
                            <div class="profileall">
                                <div class="profileimg">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
                                </div>
                                <div class="profileinfo">
                                    @foreach($clients as $client)
                                        <h4> Monsieur : {{$client->name}}</h4>
                                        <p>Email : {{$client->email}}</p>
                                        <p>Address : {{$client->address}}</p>
                                        <p>phoneNumber : {{$client->phoneNumber}}</p>
                                        <button type="button" class="btn edit-client " data-client-id="{{ $client->id }}" data-client-name="{{ $client->name }}" data-client-email="{{ $client->email }}" data-client-address="{{ $client->address }}" data-client-phone="{{ $client->phoneNumber }}">
                                                Edit
                                        </button>
                                    @endforeach
                                </div>
                            </div>
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




<!-- Modal for editing client -->
@endsection