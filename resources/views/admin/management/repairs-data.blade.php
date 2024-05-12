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

                
            

                
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-new">
                                @if(Auth::user()->role === "mechanic")
                                    <h4 class="card-title">{{ __('My Assigned Repairs') }}</h4>
                                @elseif(Auth::user()->role === "client")
                                    <h4 class="card-title">{{ __('Scheduled Repairs') }}</h4>
                                @else
                                    <h4 class="card-title">{{ __('Repairs Management') }}</h4>
                                @endif
                                <p class="card-title-desc">
                                    <form method="GET" action="{{route('admin.sendAll')}}" >
                                        @if(Auth::user()->role === 'admin' && $completedRepairsCount > 3)
                                            <button type="submit" class="btn btn-primary">
                                                
                                                {{ __('Send Mail for All Completed Repairs') }}  
                                            </button>
                                        @endif
                                    </form>
                                </p>
                            </div>
                             
                            

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable_length">
                               
                            </div></div><div class="col-sm-12 col-md-6"><div id="datatable_filter" class="dataTables_filter">
                                </div></div></div><div class="row"><div class="col-sm-12">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                              
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('End Date') }}</th>
                                        <th>{{ __('user name') }}</th>
                                        <th>{{ __('Vehicle registration') }}</th>
                                        @if(Auth::user()->role === 'admin' ||Auth::user()->role === 'mechanic')

                                        <th>{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($repairs as $repair)
                                        <tr data-client-id="{{ $repair->deleteId }}" id="row">
                                            <td>{{ $repair->description }}</td>
                                            <td>
                                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'mechanic')
                                                    <select class="form-select repair-status" data-repair-id="{{ $repair->id }}">
                                                        <option value="pending" {{ $repair->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }} </option>
                                                        <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }} </option>
                                                        <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>{{ __('Completed') }} </option>
                                                    </select>
                                                @else
                                                    <span class="badge bg-{{ $repair->status === 'completed' ? 'success' : ($repair->status === 'in_progress' ? 'warning' : 'danger') }}" style="font-size: 15px; color: rgb(255, 255, 255);">{{ ucfirst($repair->status) }}</span>
                                                @endif
                                            </td>
                                            
                                            <td>{{ $repair->startDate }}</td>
                                            <td>{{ $repair->endDate }}</td>
                                            <td>{{ $repair->user->name }}</td>
                                            <td>{{ $repair->vehicle->registration }}</td>
                                            <td>
                                                @if ($repair->status === 'completed' && Auth::user()->role === "admin")
                                                    <button type="button" class="btn delete-repair" data-repair-id="{{ $repair->id }}">
                                                        <i class="r ri-delete-bin-3-line"></i>
                                                    </button>
                                                    <button type="button" class="btn add-invoice" data-repairinvoice-id="{{ $repair->id }}">
                                                        <i class="ri-printer-line"></i>
                                                    </button>
                                                    <form action="/send-mail" method="GET" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="repair_id" value="{{ $repair->id }}">
                                                        <button type="submit" class="btn">{{ __('Send Mail') }} </button>
                                                    </form>
                                                @elseif($repair->status === 'completed' && Auth::user()->role === "admin" || Auth::user()->role === "mechanic")
                                                <form action="/send-mail" method="GET" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="repair_id" value="{{ $repair->id }}">
                                                    <button type="submit" class="btn">{{ __('Send Mail') }} </button>
                                                </form>
                                                @endif
                                                @if ($repair->status !== 'completed' && (Auth::user()->role === "admin" || Auth::user()->role === "mechanic"))
                                                    <button type="button" class="btn add-spare-part" data-repair-id="{{ $repair->id }}">
                                                        <i class="ri-send-plane-line"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @include('admin.layouts.components.repairs.confirm-modal')
                                    @include('admin.layouts.components.invoices.add-modal')
                                    @include('admin.layouts.components.spareParts.add-modal')


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
