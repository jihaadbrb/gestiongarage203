@extends('admin.layouts.home')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('Mechanic List') }}</h4>
                            <p class="card-title-desc">
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>Email</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Start date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($mechanics as $client)
                                        <tr data-client-id="{{$client->id}}" id="row">
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
                                                {{ __('Edit') }}
                                            </button>
                                            <button type="button" class="btn btn-danger delete-client" 
                                            data-client-id="{{$client->id}}">
                                            <i class="r ri-delete-bin-3-line"></i>
                                        </button>
                                            </td>
                                        </tr>


                                       
                                    @endforeach
                                    @include('admin.layouts.components.confirm-modal')
                                    @include('admin.layouts.components.edit-modal')

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
                        {{ __('Crafted with') }} <i class="mdi mdi-heart text-danger"></i> {{ __('by Themesdesign') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>



@endsection


