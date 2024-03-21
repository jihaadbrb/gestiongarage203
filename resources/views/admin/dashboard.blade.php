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
                            <li><a href="#">admin</a></li>
                            /
                            <li><a href="{{route('admin.dashboard')}}" class="active">Dashboard</a></li>
                        </ul>
                    </div>
                
                    <a href="{{route('admin.create')}}" class="report">
                        <i class='bx bx-plus'></i>
                        <span>Add new Client</span>
                    </a>
                    <a href="#" class="report">
                        <i class='bx bx-cloud-download'></i>
                        <span>Download CSV</span>
                    </a>
                </div>

                <!-- Insights -->
                <ul class="insights">
                    <li>
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>{{$clients->count()}} / {{$mechanics->count()}}</h3>
                            <p>Total Clients / Mechanics</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-show-alt'></i>
                        <span class="info">
                            <h3>3,944</h3>
                            <p>Site Visit</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-line-chart'></i>
                        <span class="info">
                            <h3>14,721</h3>
                            <p>Searches</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-dollar-circle'></i>
                        <span class="info">
                            <h3>$6,742</h3>
                            <p>Total Sales</p>
                        </span>
                    </li>
                </ul>
                <!-- End of Insights -->

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class='bx bx-user'></i>
                            <h3>Recent Clients</h3>
                            <i class='bx bx-filter'></i>
                            <i class='bx bx-search'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr class="row" data-client-id="{{$client->id}}">
                                        <td>{{ $client->name }}</td> 
                                        <td>{{$client->phoneNumber}}</td>
                                        <td>
                                           
                                        
                                            @foreach ($client->repairs as $repair)
                                                <span class="status {{$repair->status}}"> {{$repair->status}}</span>
                                            @endforeach
                                        
                                        </td>
                                        {{-- {{ Str::limit(implode(' ', explode(' ', $client->address)), 3, '...') }} --}}
                                        {{-- $truncated = Str::limit('The quick brown fox jumps over the lazy dog', 20, ' (...)'); --}}
                                            {{-- <td>{{$client->address}}</td> --}}
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
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>

                    <!-- Reminders -->
                    <div class="orders">
                        <div class="header">
                            <i class='bx bx-receipt'></i>
                            <h3>Recent Mechanics</h3>
                            <i class='bx bx-filter'></i>
                            <i class='bx bx-search'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mechanics as $client)
                                <tr class="row" data-client-id="{{$client->id}}">

                                        <td>{{ $client->name }}</td> 
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
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <!-- End of Reminders -->
                </div>
            </main>
        
        
        </div>
        <script src="{{ asset('js/index.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const rows = document.querySelectorAll(".row");
                rows.forEach(row => {
                    row.addEventListener("click", function() {
                        const clientId = this.getAttribute("data-client-id");
                        window.location.href = "/profile/" + clientId; // Replace with your desired URL
                    });
                });
            });
        </script>
    </body>
    </html>
