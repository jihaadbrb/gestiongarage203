@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            flex-direction:column;
            gap:10px;
            align-items:center;
            justify-content:center;
        }
        .add-new button{
            background-color:#1a4d2e;
        }
        .add-vehicle {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
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

.edit-vehicle{
            background-color:#1a4d2e;
            color:white;
        }
        .edit-vehicle:hover{
            background-color:#1a4d2e;
            color:white;
        }
        .delete-vehicle{
            background-color:red;
            color:white;
        }
        .add-repair{
            background-color:#e1c134;
            color:white;
        }
        .delete-vehicle:hover{
            background-color:red;
            color:white;
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
                                <h4 >{{ __('Vehicles List') }}</h4>
                                <div>
                                <button class="btn-primary add-vehicle">{{ __('add new vehicle') }}</button>
                                </div>
                                <p class="card-title-desc"></p>
                            </div>  
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Make') }}</th>
                                        <th>{{ __('Model') }}</th>
                                        <th>{{ __('Fuel Type') }}</th>
                                        <th>{{ __('Registration') }}</th>
                                        <th>{{ __('Owner') }}</th>
                                        <th>{{ __('Photos') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($vehicles) 
                                    @foreach ($vehicles as $vehicle)
                                            <tr data-vehicle-id="{{ $vehicle->vehicleId }}" id="row">
                                                <td>{{ $vehicle->make }}</td>
                                                <td>{{ $vehicle->model }}</td>
                                                <td>{{ $vehicle->fuelType }}</td>
                                                <td>{{ $vehicle->registration }}</td>
                                                <td>{{ $vehicle->user->name }}</td>
                                                <td>
                                                    <button type="button" class="btn show-pics" data-vehicle-id="{{ $vehicle->id }}">
                                                        </i>{{ __('Show Pictures') }}
                                                    </button>
                                                </td>
                                                <td>

                                                    <!-- Display edit and delete buttons for admin -->
                                                    @if(Auth::user()->role === 'admin')
                                                        <button type="button" class="btn edit-vehicle"
                                                            data-vehicles-id="{{ $vehicle->id }}"
                                                            data-vehicle-make="{{ $vehicle->make }}"
                                                            data-vehicle-model="{{ $vehicle->model }}"
                                                            data-vehicle-fueltype="{{ $vehicle->fuelType }}"
                                                            data-vehicle-registration="{{ $vehicle->registration }}"
                                                            data-vehicle-photos="{{ $vehicle->photos }}"
                                                            data-vehicle-userid="{{ $vehicle->user_id }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn delete-vehicle"
                                                            data-vehicle-id="{{ $vehicle->id }}">
                                                            Delete
                                                        </button>
                                                        <button type="button" class="btn add-repair"
                                                            data-vehicle-id="{{ $vehicle->id }}"
                                                            data-vehicle-iduser="{{ $vehicle->user_id }}">
                                                            Repair
                                                        </button>
                                                    <!-- Display edit and delete buttons for vehicle owner -->
                                                    @elseif(Auth::id() === $vehicle->user_id)
                                                        <button type="button" class="btn edit-vehicle"
                                                            data-vehicles-id="{{ $vehicle->id }}"
                                                            data-vehicle-make="{{ $vehicle->make }}"
                                                            data-vehicle-model="{{ $vehicle->model }}"
                                                            data-vehicle-fueltype="{{ $vehicle->fuelType }}"
                                                            data-vehicle-registration="{{ $vehicle->registration }}"
                                                            data-vehicle-photos="{{ $vehicle->photos }}"
                                                            data-vehicle-userid="{{ $vehicle->user_id }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn delete-vehicle"
                                                            data-vehicle-id="{{ $vehicle->id }}">
                                                            Delete
                                                        </button>
                                                        <button type="button" class="btn add-repair"
                                                            data-vehicle-id="{{ $vehicle->id }}"
                                                            data-vehicle-iduser="{{ $vehicle->user_id }}">
                                                            <i class="ri-tools-fill"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                @include('admin.layouts.components.vehicles.edit-modal')
                                @include('admin.layouts.components.vehicles.add-modal')
                                @include('admin.layouts.components.repairs.add-modal')
                                @include('admin.layouts.components.vehicles.confirm-modal')
                                @include('admin.layouts.components.vehicles.show-pics')
                            </table>
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
<!-- Modal for editing client -->
@endsection
