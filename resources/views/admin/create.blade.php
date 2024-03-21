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
                        <a href="#">admin</a>
                        /
                        <a href="/dashboard">Dashboard</a>
                        /
                        <a href="#" class="active">Create</a>
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
                        <h3>Add a new Client</h3>
                    </div>
                    <div class="edit-client">
                        <form class="client-update-form" action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name"   name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" id="email"  name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" rows="3" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number:</label>
                                <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9()+-]+">
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="passowrd" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <select id="role" name="role" class="block mt-1 w-full" required>
                                    <option value="client">Client</option>
                                    <option value="mechanic">Mechanic</option>
                                </select>
                            </div>
                           
                           
                            <button type="submit">Add New Client</button>
                        </form>
                    </div>
                </div>

                </div>
        </main>
    
    
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
