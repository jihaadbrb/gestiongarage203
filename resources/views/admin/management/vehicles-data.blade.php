@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        .add-vehicle {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-new">
                                <h4 class="card-title">{{ __('Vehicles') }}</h4>
                                <button class="btn-primary add-vehicle">{{ __('add new vehicle') }}</button>
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
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Photos') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($vehicles) {
                                    @foreach ($vehicles as $vehicle)
                                            <tr data-vehicle-id="{{ $vehicle->vehicleId }}" id="row">
                                                <td>{{ $vehicle->make }}</td>
                                                <td>{{ $vehicle->model }}</td>
                                                <td>{{ $vehicle->fuelType }}</td>
                                                <td>{{ $vehicle->registration }}</td>
                                                <td>{{ $vehicle->user->name }}</td>
                                                <td>
                                                    <button type="button" class="btn show-pics"
                                                        data-vehicle-id="{{ $vehicle->id }}">
                                                        <i class="ri-eye-line"></i> Show Pictures
                                                    </button>
                                                </td>
                                                <td>

                                                    <!-- Display edit and delete buttons for admin -->
                                                    @if(Auth::user()->role === 'admin')
                                                        <button type="button" class="btn edit-vehicle"
                                                            data-vehicle-id="{{ $vehicle->id }}"
                                                            data-vehicle-make="{{ $vehicle->make }}"
                                                            data-vehicle-model="{{ $vehicle->model }}"
                                                            data-vehicle-fueltype="{{ $vehicle->fuelType }}"
                                                            data-vehicle-registration="{{ $vehicle->registration }}"
                                                            data-vehicle-photos="{{ $vehicle->photos }}"
                                                            data-vehicle-userid="{{ $vehicle->user_id }}">
                                                            <i class="ri-edit-2-line"></i>
                                                        </button>
                                                        <button type="button" class="btn delete-vehicle"
                                                            data-vehicle-id="{{ $vehicle->id }}">
                                                            <i class="ri-delete-bin-3-line"></i>
                                                        </button>
                                                        <button type="button" class="btn add-repair"
                                                            data-vehicle-id="{{ $vehicle->id }}"
                                                            data-vehicle-iduser="{{ $vehicle->user_id }}">
                                                            <i class="ri-tools-fill"></i>
                                                        </button>
                                                    <!-- Display edit and delete buttons for vehicle owner -->
                                                    @elseif(Auth::id() === $vehicle->user_id)
                                                        <button type="button" class="btn edit-vehicle"
                                                            data-vehicle-id="{{ $vehicle->id }}"
                                                            data-vehicle-make="{{ $vehicle->make }}"
                                                            data-vehicle-model="{{ $vehicle->model }}"
                                                            data-vehicle-fueltype="{{ $vehicle->fuelType }}"
                                                            data-vehicle-registration="{{ $vehicle->registration }}"
                                                            data-vehicle-photos="{{ $vehicle->photos }}"
                                                            data-vehicle-userid="{{ $vehicle->user_id }}">
                                                            <i class="ri-edit-2-line"></i>
                                                        </button>
                                                        <button type="button" class="btn delete-vehicle"
                                                            data-vehicle-id="{{ $vehicle->id }}">
                                                            <i class="ri-delete-bin-3-line"></i>
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
                                @include('admin.layouts.components.users.show-modal')
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
<!-- Modal for editing client -->
@endsection
