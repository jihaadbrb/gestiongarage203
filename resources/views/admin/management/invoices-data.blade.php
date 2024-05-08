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
    </style>
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-new">
                                <h4 class="card-title">{{ __('Repairs Management') }}</h4>
                                <p class="card-title-desc">

                                </p>
                            </div>  
                            

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable_length">
                               
                            </div></div><div class="col-sm-12 col-md-6"><div id="datatable_filter" class="dataTables_filter">
                                </div></div></div><div class="row"><div class="col-sm-12">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                              
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Mechanic Name') }}</th>
                                        <th>{{ __('Make') }}</th>
                                        <th>{{ __('Registration') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('End Date') }}</th>
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
                                        <td>{{ $invoice->repair->startDate }}</td>
                                        <td>{{ $invoice->repair->endDate }}</td>
                                        <td>{{ $invoice->additionalCharges }}</td>
                                        <td>{{ $invoice->totalAmount }}</td>
                                        <td>
                                            {{-- <button type="button" class="btn  edit-client"
                                                data-client-id="{{ $client->id }}"
                                                data-client-name="{{ $client->name }}"
                                                data-client-email="{{ $client->email }}"
                                                data-client-address="{{ $client->address }}"
                                                data-client-phone="{{ $client->phoneNumber }}">
                                                <i class=" ri-edit-2-line "></i>
                                            </button>--}}
                                            <button type="button" class="btn  delete-invoice"
                                                data-invoice-id="{{ $invoice->id }}">
                                                <i class="r ri-delete-bin-3-line"></i>
                                            </button>
                                            <button type="button" class="btn  show-invoice"
                                            data-invoice-id="{{ $invoice->id }}">
                                            <i class=" ri-file-info-line
                                            "></i>
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
