    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        
    </head>
    <body>

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="content">
        <!-- Navbar -->
        @include('layouts.navbar')
            <!-- End of Navbar -->
        
            <main>
            
                <div class="header">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <a href="#">admin</a>
                            /
                            <a href="/dashboard">Dashboard</a>
                            /
                            <a href="#" class="active">{{$client->name}}</a>
                        </ul>
                    </div>
                
                       
                            @foreach ($client->repairs as $repair)

                            @if ($repair->status === 'completed')
                            <a href="#" class="report">
                                <i class='bx bx-complete'></i>
                                <span>Mark as Incomplete</span>
                            </a>
                            @else
                            <a href="#" class="report">
                                <i class='bx bx-good'></i>
                                <span>Mark as Complete</span>
                            </a>
                                @endif

                                @endforeach
                         
                           
                        
                     
                    </a>
                    <a href="#" class="report">
                        <i class='bx bx-cloud-download'></i>
                        <span>Download Invoice</span>
                    </a>
                </div>
           

                </h3>   

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class='bx bx-user'></i>
                            <h3>{{$client->name}} - 
                                @foreach ($client->repairs as $repair)
                                 {{$repair->status}}
                                @endforeach    
                            </h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr class="row" data-client-id="{{$client->id}}">
                                        <td>{{ $client->name }}</td> 
                                        <td>{{$client->email}}</td>
                                        <td>{{$client->role}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->phoneNumber}}</td>
                                        <td>
                                            <a href="{{route('admin.edit',['client'=>$client])}}"><i class="bx bx-edit"></i></a>  
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.destroy', ['client' => $client]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" id="trash">
                                                    <i class="bx bx-trash"></i> </button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                            
                            </tbody>
                        
                        </table>
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>make</th>
                                        <th>model</th>
                                        <th>fuelType</th>
                                        <th>registration</th>
                                    </tr>
                            </thead>
                                <tbody>
                                    
                                    <tr class="row">
                                        <td>
                                            @if($client->vehicle)
                                                {{ $client->vehicle->make ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td> 
                                        <td>
                                            @if($client->vehicle)
                                                {{ $client->vehicle->model ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td> 
                                        <td>
                                            @if($client->vehicle)
                                                {{ $client->vehicle->fuelType ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td> 
                                        <td>
                                            @if($client->vehicle)
                                                {{ $client->vehicle->registration ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td> 
                                    </tr>
                                    
                                
                                </tbody>
                            
                            </table> 
                        </div>
                    </div>

                </div>
            </main>
        
        </div>
        <script src="{{ asset('js/index.js') }}"></script>

    </body>
    </html>
