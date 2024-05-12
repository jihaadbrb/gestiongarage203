    @extends('admin.layouts.home')
    @section('content')
    <div class="main-content">
    
        <style>
            .add-new {
                display: flex;
                width: 100%;
                justify-content: space-between;
            }

            .add-appointment{
                border: 0;
                border-radius: 5px;
                padding: 8px 19px;
            }
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
                </div
                        <div class="card">
                            <div class="card-body">
                                <div class="add-new">

                                    @if(Auth::user()->role === 'admin')

                                    <h4 class="card-title">{{ __('Appointment List') }}</h4>
                                @else
                                    <h4 class="card-title">{{ __('Your Appointment') }}</h4>

                                @endif
                                <button class="btn-primary add-appointment">{{ __('Add New Appointment') }}</button>
                                        
                                    
                                    <p class="card-title-desc">

                                    </p>
                                </div>
                                

                                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable_length">
                                
                                </div></div><div class="col-sm-12 col-md-6"><div id="datatable_filter" class="dataTables_filter">
                                    </div></div></div><div class="row"><div class="col-sm-12">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                
                                    <thead>
                                        <tr role="row">
                                            <th>{{ __('Description') }}</th>
                                            <th>{{ __('user name') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Time') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($appointments as $appointment)

                                        <tr data-invoice-id="{{ $appointment->deleteId }}" id="row">
                                            <td>{{ $appointment->description}}</td>
                                            <td>{{ $appointment->user->name}}</td>
                                            <td>{{ $appointment->appointment_date }}</td>
                                            <td>{{ $appointment->appointment_time }}</td>
                                            <td>
                                                @if(Auth::user()->role === 'admin')
                                                    <select class="form-select update-appointment-status" data-appointment-id="{{ $appointment->id }}">
                                                        <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                        <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                                                        <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                                        <option value="canceled" {{ $appointment->status === 'canceled' ? 'selected' : '' }}>{{ __('Canceled') }}</option>
                                                    </select>
                                                @else
                                                    {{ $appointment->status }}
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <button type="button" class="btn delete-appointment"
                                                    data-appointment-id="{{ $appointment->id }}">
                                                    <i class="r ri-delete-bin-3-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach

                                        {{-- @include('admin.layouts.components.users.edit-modal')
                                        @include('admin.layouts.components.users.add-modal')--}}
                                        @include('admin.layouts.components.appointment.confirm-modal') 
                                        @include('admin.layouts.components.appointment.add-modal')

                                    </tbody>
                                

                                
                                </table>
                            </div></div>
                            <div class="row">
                            <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <ul class="pagination pagination-rounded"><li class="paginate_button page-item previous disabled" id="datatable_previous">
                                    <a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li><li class="paginate_button page-item next disabled" id="datatable_next">
                                    <a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                </li></ul></div></div></div></div>

                            </div>
                        </div>
                    </div> <!-- end col -->
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

    <!-- Modal for editing repair -->


    @endsection
