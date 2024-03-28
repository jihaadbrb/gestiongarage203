@extends('admin.layouts.home')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Clients List</h4>
                            <p class="card-title-desc">
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Start date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($admins as $client)
                                        <tr data-client-id="{{$client->id}}">
                                            <td>{{ $client->name }}</td> 
                                            <td>{{$client->email}}</td>
                                            <td>{{$client->address}}</td>
                                            <td>{{$client->phoneNumber}}</td>
                                            <td>{{$client->created_at}}</td>
                                            <td>
                                                @foreach ($client->repairs as $repair)
                                                    <span class="status {{$repair->status}}"> {{$repair->status}}</span>
                                                @endforeach
                                            
                                            </td>
                                           
                                            {{-- <td>
                                                <a href="{{route('admin.edit',['client'=>$client])}}"><i class="bx bx-edit"></i></a>  
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.destroy', ['client' => $client]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" id="trash">
                                                        <i class="bx bx-trash"></i> </button>
                                                </form>
                                                
                                            </td> --}}
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
@endsection