<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Lock screen | Upcube - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <style>
        body.auth-body-bg {
            background: url('https://plus.unsplash.com/premium_photo-1664304598312-6de674eb1b79?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8dmVoaWNsZXxlbnwwfHwwfHx8MA%3D%3D') center center no-repeat;
            background-size: cover;
            background-position: center;
        }
        .card {
    backdrop-filter: blur(4px); /* Adjust the blur value as needed */
    background-color: rgba(255, 255, 255, 0); /* Adjust the alpha (fourth value) to change the transparency */
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a shadow for depth */
    padding: 20px;
}

    </style>
</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="index.html" class="auth-logo">
                                <img src="assets/images/logo-dark.png" height="30" class="logo-dark mx-auto" alt="">
                                <img src="assets/images/logo-light.png" height="30" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="p-3">
                        <form class="form-horizontal mt-3" action="{{ route('unlock') }}" method="POST">
                            @csrf
                            <div class="text-center mb-4">

                                
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle avatar-lg img-thumbnail"" id="avatar-image">
                                @else
                                    <!-- Default avatar image or placeholder -->
                                    <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" 
                                    alt="Default Avatar" class="rounded-circle avatar-lg img-thumbnail" id="avatar-image">
                                @endif



                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input type="hidden" name="email" value="{{ $email }}" placeholder="Email" required autofocus>
                                    <input class="form-control" type="password" name="password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group text-center row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                            <div class="form-group mt-4 mb-0 row">
                                <div class="col-12 text-center">
                                    <a href="pages-login.html" class="text-muted">Not you?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>
</body>
</html>
