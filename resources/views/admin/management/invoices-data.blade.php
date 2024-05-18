@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        .add-client {
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
.textup{
    display: flex;
    width:100%;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    height:100px;

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
.edit-client{
            background-color:#1a4d2e;
            color:white;
        }
        .edit-client:hover{
            background-color:#1a4d2e;
            color:white;
        }
        .delete-invoice{
            background-color:red;
            color:white;
        }
        .delete-invoice:hover{
            background-color:red;
            color:white;
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
                    <div class="card">
                        <div class="card-body">
                            <div class="add-new">
                                <div class="textup">
                                <h4 >{{ __('Invoices Management') }}</h4>
                                <p class="card-title-desc">

                                </p>
                            </div>  
                            </div>

                    
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top:0;">                                           
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Mechanic Name') }}</th>
                                        <th>{{ __('Make') }}</th>
                                        <th>{{ __('Registration') }}</th>
                
                                        <th>{{ __('Additional Charges') }}</th>
                                        <th>{{ __('TotalAmount') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($invoices as $invoice)

                                    <tr data-invoice-id="{{ $invoice->deleteId }}" id="row">
                                        <td>{{ $invoice->repair->user->name }}</td>
                                        <td>{{ $invoice->repair->mechanic->name }}</td>
                                        <td>{{ $invoice->repair->vehicle->make }}</td>
                                        <td>{{ $invoice->repair->vehicle->registration }}</td>
                               
                                        <td>{{ $invoice->additionalCharges }}</td>
                                        <td>{{ $invoice->totalAmount }}</td>
                                        <td>
                                            {{-- <button type="button" class="btn  edit-client"
                                                data-client-id="{{ $client->id }}"
                                                data-client-name="{{ $client->name }}"
                                                data-client-email="{{ $client->email }}"
                                                data-client-address="{{ $client->address }}"
                                                data-client-phone="{{ $client->phoneNumber }}">
                                                Edit
                                            </button>--}}
                                            <button type="button" class="btn  delete-invoice"
                                                data-invoice-id="{{ $invoice->id }}">
                                                Delete
                                            </button>

                                            </button> 
                                        </td>
                                    </tr>
                                    @endforeach

                                    {{-- @include('admin.layouts.components.users.edit-modal')
                                    @include('admin.layouts.components.users.add-modal')--}}
                                    @include('admin.layouts.components.invoices.confirm-modal') 
                                    @include('admin.layouts.components.invoices.show-modal')

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

    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;" >

<div class="text-center p-3" style="background-color:#e4dcc7; display:flex;align-items:center;justify-content:center;">
     
   <a class="text-body" href="https://mdbootstrap.com/">  © 2024 Garagiste.com  | Jihad Bourbab</a>
</div>

</footer>

</div>

<!-- Modal for editing repair -->


@endsection
