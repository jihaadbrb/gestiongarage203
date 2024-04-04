@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new{
            display: flex;
            width: 100% ; 
            justify-content: space-between;
        }.add-client{
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
                                    <h4 class="card-title">Client List</h4>
                                    <button class="btn-primary add-client">Add A new client</button>
                            <p class="card-title-desc">
                      
                            </p>
                                </div>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                          
                                
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Start date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr data-client-id="{{$client->deleteId}}" id="row">
                                            <td>{{ $client->name }}</td> 
                                            <td>{{$client->email}}</td>
                                            <td>{{$client->address}}</td>
                                            <td>{{$client->phoneNumber}}</td>
                                            <td>{{$client->created_at}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary edit-client" 
                                                data-client-id="{{$client->id}}"
                                                data-client-name="{{$client->name}}"
                                                data-client-email="{{$client->email}}"
                                                data-client-address="{{$client->address}}"
                                                data-client-phone="{{$client->phoneNumber}}"
                                            >
                                            <i class="ri-edit-2-fill"></i> 
                                            </button>
                                            <button type="button" class="btn btn-danger delete-client" 
                                            data-client-id="{{$client->id}}">
                                            <i class="r ri-delete-bin-3-line"></i>
                                        </button>
                                        
                                            </td>
                                        </tr>

                                       @endforeach

                                    @include('admin.layouts.components.edit-modal')
                                    @include('admin.layouts.components.add-modal')
                                    @include('admin.layouts.components.confirm-modal')
                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Upcube.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>

<!-- Modal for editing client -->


@endsection





