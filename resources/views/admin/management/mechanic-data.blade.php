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
                                    @if(Auth::user()->role === 'admin')

                                    <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($mechanics as $mechanic)
                                            <tr data-client-id="{{$mechanic->id}}" id="row">
                                                <td>{{ $mechanic->name }}</td> 
                                                <td>{{$mechanic->email}}</td>
                                                <td>{{$mechanic->address}}</td>
                                                <td>{{$mechanic->phoneNumber}}</td>
                                                <td>{{$mechanic->created_at}}</td>
                                                <td>
                                                    @if(Auth::user()->role === 'admin')
                                                        <!-- Display buttons for admin -->
                                                        <button type="button" class="btn edit-client" 
                                                        data-client-id="{{$mechanic->id}}"
                                                        data-client-name="{{$mechanic->name}}"
                                                        data-client-email="{{$mechanic->email}}"
                                                        data-client-address="{{$mechanic->address}}"
                                                        data-client-phone="{{$mechanic->phoneNumber}}"
                                                        >
                                                        <i class="ri-edit-2-line"></i>
                                                        </button>
                                                        <button type="button" class="btn  delete-client" 
                                                        data-client-id="{{$mechanic->id}}">
                                                        <i class="ri-delete-bin-3-line"></i>
                                                        </button>
                                                        <button type="button" class="btn  show-mechanic"
                                                        data-client-id="{{ $mechanic->id }}">
                                                        <i class="ri-file-info-line"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                       
                                    @endforeach
                                    @include('admin.layouts.components.users.confirm-modal')
                                    @include('admin.layouts.components.users.edit-modal')
                                    @include('admin.layouts.components.users.show-modal')
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

@endsection
