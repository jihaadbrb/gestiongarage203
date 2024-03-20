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
                            <li><a href="#">Dashboard</a></li>
                            /
                            <li><a href="#" class="active">Edit</a></li>
                        </ul>
                    </div>
                
                    {{-- <a href="#" class="report">
                        <i class='bx bx-plus'></i>
                        <a href="/register">Add new Client</a>
                    </a>
                    <a href="#" class="report">
                        <i class='bx bx-cloud-download'></i>
                        <span>Download CSV</span>
                    </a> --}}
                </div>

                

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class='bx bx-edit'></i>
                            <h3>Update Client</h3>
                        </div>
                        <div class="edit-client">
                            <form class="client-update-form" action="{{route('admin.update',['client'=>$client])}}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="firstName">First Name:</label>
                                    <input type="text" id="firstName" value="{{$client->firstName}}"  name="firstName" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name:</label>
                                    <input type="text" id="lastName" value="{{$client->lastName}}" name="lastName" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" id="address" name="address" value="{{$client->address}}" rows="3" required>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number:</label>
                                    <input type="tel" id="phoneNumber" value="{{$client->phoneNumber}}" name="phoneNumber" pattern="[0-9()+-]+">
                                </div>
                                <button type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
    
                    </div>
            </main>
        
        
        </div>
        <script src="{{ asset('js/index.js') }}"></script>
    </body>
    </html>
