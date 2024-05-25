<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                
                    
                <label for="avatar-input">
                   
                        <!-- Default avatar image or placeholder -->
                        <img src="https://thumbs.dreamstime.com/z/mechanic-avatar-character-icon-vector-illustration-design-85859548.jpg"
                        alt="Default Avatar" class="avatar-md rounded-circle">
            
                </label>
            </div>
            
            
            

        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{ __('Menu') }}</li>

                <li>
                    <a href="/" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>{{ __('Dashboard') }}</span>
                </a>
                </li>
                <li>
                    @if (Auth::user()->role==="admin")
                    
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-user-line"></i>
                        <span>{{ __('Users Management') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('user.users') }}" style="color:white;"><i class="ri-user-line"></i> {{ __('Users') }}</a></li>
                            <li><a href="{{ route('admin.admins') }}" style="color:white;" ><i class="ri-admin-line"></i> {{ __('Admins') }}</a></li>
        
                    </ul>
                </li>

                            
                        @else
                            <li><a href="{{ route('user.users') }}"><i class="ri-user-line"></i> {{ __('Profile') }}</a></li>
                        @endif

                            <li><a href="{{ route('admin.mechanics') }}"> <i class="ri-shield-user-fill"></i> </i> {{ __('Mechanics') }}</a></li>

                            <li><a href="{{ route('admin.vehicles') }}"><i class="ri-car-line"></i> {{ __('Vehicle') }}</a></li>
                            <li><a href="{{ route('admin.repairs') }}"> <i class="ri-hammer-fill"></i>  {{ __('Repairs') }}</a></li>
                            <li><a href="{{ route('admin.showSpares') }}"><i class="ri-tools-line"></i> {{ __('Spare Parts') }}</a></li>
                            <li><a href="{{ route('admin.Invoices') }}"><i class="ri-file-text-line"></i> {{ __('Invoices') }}</a></li>
                            <li><a href="{{ route('user.appointements') }}"><i class="ri-calendar-line"></i> {{ __('Appointments') }}</a></li>

              

               

                
            </ul>
        </div>

    </div>
</div>
