    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        Garagist
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
                            <li><a href="#" class="active">Dashboard</a></li>
                        </ul>
                    </div>
                
                    <a href="#" class="report">
                        <i class='bx bx-plus'></i>
                        <a href="/register">Add new Client</a>
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
                            <h3>{{$clients->count()}}</h3>
                            <p>Total Clients</p>
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
                            <i class='bx bx-receipt'></i>
                            <h3>Recent Clients</h3>
                            <i class='bx bx-filter'></i>
                            <i class='bx bx-search'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last Name</th>
                                    <th>Phone number</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->firstName }}</td> 
                                        <td>{{ $client->lastName }}</td> 
                                        <td>{{$client->phoneNumber}}</td>
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
                                                <button type="submit">
                                                    <i class="bx bx-trash"></i> </button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>

                    <!-- Reminders -->
                    <div class="reminders">
                        <div class="header">
                            <i class='bx bx-note'></i>
                            <h3>Reminders</h3>
                            <i class='bx bx-filter'></i>
                            <i class='bx bx-plus'></i>
                        </div>
                        <ul class="task-list">
                            <li class="completed">
                                <div class="task-title">
                                    <i class='bx bx-check-circle'></i>
                                    <p>Start Our Meeting</p>
                                </div>
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </li>
                            <li class="completed">
                                <div class="task-title">
                                    <i class='bx bx-check-circle'></i>
                                    <p>Analyse Our Site</p>
                                </div>
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </li>
                            <li class="not-completed">
                                <div class="task-title">
                                    <i class='bx bx-x-circle'></i>
                                    <p>Play Football</p>
                                </div>
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </li>
                        </ul>
                    </div>
                    <!-- End of Reminders -->
                </div>
            </main>
        
        
        </div>
        <script src="{{ asset('js/index.js') }}"></script>
    </body>
    </html>
