@extends('admin.layouts.home')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if(Auth::user()->role === 'admin')

                            <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                            <p class="card-title-desc">
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>{{ __('Avatar') }}</th>
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
                                    @foreach ($mechanics as $client)
                                            <tr data-client-id="{{$client->id}}" id="row">
                                                <td>

                                                    @if ($client->avatar)
                                                        <img src="{{ asset('storage/' . $client->avatar) }}" class="avatar-sm rounded-circle" id="avatar-image">
                                                    @else
                                                        <!-- Default avatar image or placeholder -->
                                                        <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" 
                                                        alt="Default Avatar" class="avatar-sm rounded-circle" id="avatar-image">
                                                    @endif
                                                </td>
                                                <td>{{ $client->name }}</td> 
                                                <td>{{$client->email}}</td>
                                                <td>{{$client->phoneNumber}}</td>
                                                <td>{{$client->created_at}}</td>
                                                <td>
                                                    <button type="button" class="btn edit-client" 
                                                    data-client-id="{{$client->id}}"
                                                    data-client-name="{{$client->name}}"
                                                    data-client-email="{{$client->email}}"
                                                    data-client-address="{{$client->address}}"
                                                    data-client-phone="{{$client->phoneNumber}}"
                                                >
                                                <i class=" ri-edit-2-line "></i>
    
                                                </button>
                                                <button type="button" class="btn  delete-client" 
                                                data-client-id="{{$client->id}}">
                                                <i class="r ri-delete-bin-3-line"></i>
                                            </button>
                                            <button type="button" class="btn  show-mechanic"
                                            data-client-id="{{ $client->id }}">
                                            <i class=" ri-file-info-line
                                            "></i>
                                            </button>
                                                </td>
                                            </tr>
                                       
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
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © elklie.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        {{ __('Crafted with') }} <i class="mdi mdi-heart text-danger"></i> {{ __('by reda-elklie') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>
@include('admin.layouts.components.users.confirm-modal')
@include('admin.layouts.components.users.edit-modal')
@include('admin.layouts.components.users.show-modal')
@endsection
