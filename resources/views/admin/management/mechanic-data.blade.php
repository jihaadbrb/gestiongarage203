
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
.export-client {
  background-color: #1a4d2e; /* Adjust button color */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px; /* Add rounded corners */
  cursor: pointer; /* Indicate clickable element */
}
.textup{
        width:100%;
        display: flex;
        align-items:center;
        justify-content:center;
        height:100px;
        flex-direction:column;
    }
    .edit-mechanic{
            background-color:#1a4d2e;
            color:white;
        }
        .edit-mechanic:hover{
            background-color:#1a4d2e;
            color:white;
        }
        .delete-mechanic{
            background-color:red;
            color:white;
        }
        .delete-mechanic:hover{
            background-color:red;
            color:white;
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


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                       
                            <div class="textup">
                            <h4>{{ __('Mechanics List') }}</h4>
                            <form action="{{route('export.mechanics')}}" method="get">
                                    <button type="submit" class="export-client"> {{ __('Export Mechanics') }}</button>
                                </form>

                        
</div>
                            <p class="card-title-desc">
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Start date') }}</th>
                                    @if(Auth::user()->role === 'admin')

                                    <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($mechanics as $mechanic)
                                            <tr data-mechanic-id="{{$mechanic->id}}" id="row">
                                              
                                                <td>{{ $mechanic->name }}</td> 
                                                <td>{{$mechanic->email}}</td>
                                                <td>{{$mechanic->phoneNumber}}</td>
                                                <td>{{$mechanic->created_at}}</td>

                                        @if(Auth::user()->role === 'admin' || Auth::user()->id === $mechanic->id)

                                                <td>
                                                    <button type="button" class="btn edit-mechanic" 
                                                    data-mechanic-id="{{$mechanic->id}}"
                                                    data-mechanic-name="{{$mechanic->name}}"
                                                    data-mechanic-email="{{$mechanic->email}}"
                                                    data-mechanic-address="{{$mechanic->address}}"
                                                    data-mechanic-phone="{{$mechanic->phoneNumber}}"
                                                >
                                                {{__('Edit')}}
    
                                                </button>
                                                <button type="button" class="btn  delete-mechanic" 
                                                data-mechanic-id="{{$mechanic->id}}">
                                                {{__('Delete')}}
                                            </button>

                                    
                                                </td>
                                            </tr>

                                      
                                            

                                       
                                        @endif
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
@include('admin.layouts.components.mechanics.confirm-modal')
@include('admin.layouts.components.mechanics.edit-modal')
@endsection 
