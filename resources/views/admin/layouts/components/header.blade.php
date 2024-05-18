<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
            <img src="assets/images/logoheader.png" alt="logo-md" style="filter: invert(1) brightness(2);" height="80">
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logoheader.png" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="assets/images/logo-dark.png" alt="logo-dark" height="20"> --}}
                    </span>
                </a>

                <a href="{{route('admin.dashboard')}}" class="logo logo-light">

                    <span class="logo-sm">
                        {{-- <img src="assets/images/logo-sm.png" alt="logo-sm-light" height="22"> --}}
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="assets/images/logo-light.png" alt="logo-light" height="20"> --}}
                    </span>
                </a>
            </div>



            
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>  {{Auth::user()->name}}
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(app()->getlocale() == 'ar')
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/67/Flag_of_Morocco_hexagram.svg" alt="Arabic" height="16">
                    @elseif(app()->getlocale() == 'es')
                        <img src="assets/images/flags/spain.jpg" alt="Spanish" height="16">
                    @elseif(app()->getlocale() == 'fr')
                        <img src="assets/images/flags/french.jpg" alt="French" height="16">
                    @else
                        <img src="assets/images/flags/us.jpg" alt="English" height="16">
                    @endif
                </button>
                <select class="dropdown-menu dropdown-menu-end selectLocale">
                    <option @if(app()->getlocale() == 'ar') selected @endif value="ar">
                        <img src="assets/images/flags/ar.jpg" alt="Arabic" class="me-1" height="12">
                        <span class="align-middle">ar</span>
                    </option>
                    <option @if(app()->getlocale() == 'es') selected @endif value="es">
                        <img src="assets/images/flags/spain.jpg" alt="Spanish" class="me-1" height="12">
                        <span class="align-middle">es</span>
                    </option>
                    <option @if(app()->getlocale() == 'en') selected @endif value="en">
                        <img src="assets/images/flags/us.jpg" alt="English" class="me-1" height="12">
                        <span class="align-middle">en</span>
                    </option>
                    <option @if(app()->getlocale() == 'fr') selected @endif value="fr">
                        <img src="assets/images/flags/french.jpg" alt="French" class="me-1" height="12">
                        <span class="align-middle">fr</span>
                    </option>
                </select>
            </div>
            

            

            

            
            

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                        

                 
                            <!-- Default avatar image or placeholder -->
                            <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" 
                            alt="Default Avatar" class="rounded-circle header-profile-user" id="avatar-image">
                        
                        


                    <span class="d-none d-xl-inline-block ms-1">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item text-danger" href="#">
                        <i class="ri-shut-down-line align-middle me-1 text-danger">
                            </i> Logout</a> --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                            </a>

                </div>
            </div>



        </div>
    </div>
</header>