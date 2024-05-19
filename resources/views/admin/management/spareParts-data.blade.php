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
.textup{
    display: flex;
    width:100%;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    height:100px;

}

.textupbutton{
    background-color:#1a4d2e;
    border:none;
}
.textupbutton:hover{
    background-color:#436850;
    border:none;
}

.textupbutton:focus{
    background-color:#436850;
    border:none;
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
.edit-vehicle{
            background-color:#1a4d2e;
            color:white;
        }
        .edit-vehicle:hover{
            background-color:#1a4d2e;
            color:white;
        }
        .delete-spare{
            background-color:red;
            color:white;
        }
        .delete-spare:hover{
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-new">
                                <div class="textup">
                                <h4 >{{ __('Spare Part Management') }}</h4>
                                <p class="card-title-desc">

                                </p>
</div>
                            </div>  
                            

                           
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top:0;">                                   
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('Part Name') }}</th>
                                        <th>{{ __('Part Refrence') }}</th>
                                        <th>{{ __('Supplier') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        @if (Auth::user()->role === "admin")
                                        <th>{{ __('Action') }}</th>
                                            
                                        @endif
                                    </tr>
                                </thead>

                               
                                <tbody>
                                    @foreach ($spares as $spare)
                                    <tr data-spare-id="{{ $spare->deleteId }}" id="row">
                                       
                                        <td>{{ $spare->partName}}</td>
                                        <td>{{ $spare->partReference}}</td>
                                        <td>{{ $spare->supplier }}</td>
                                        <td>{{ $spare->price }}</td>
                                        <td>
                                            @if (Auth::user()->role==="admin")
                                                <button type="button" class="btn delete-spare" data-spare-id="{{ $spare->id }}">
                                                Delete
                                            </button>
                                            @endif
                                            
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                     {{-- @include('admin.layouts.components.users.edit-modal')
                                    @include('admin.layouts.components.users.add-modal')--}}
                                    @include('admin.layouts.components.spareParts.confirm-modal') 
                                    {{-- @include('admin.layouts.components.invoices.show-modal') --}}
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
