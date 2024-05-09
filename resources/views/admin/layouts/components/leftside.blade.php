<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <form action="{{ route('upload.avatar') }}" method="POST" enctype="multipart/form-data" id="avatar-upload-form">
                    @csrf
                    <input type="file" name="avatar" id="avatar-input" style="display: none;">
                </form>
                <label for="avatar-input">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar-md rounded-circle" id="avatar-image">
                    @else
                        <!-- Default avatar image or placeholder -->
                        <img src="https://i.pinimg.com/originals/06/3b/bf/063bbf0665eaf9c1730bccdc5c8af1b2.jpg" 
                        alt="Default Avatar" class="avatar-md rounded-circle" id="avatar-image">
                    @endif
                </label>
            </div>
            
            
            
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> {{Auth::user()->role}}</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{ __('Menu') }}</li>

                <li>
                    <a href="/" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li>
                    @if (Auth::user()->role==="admin" || Auth::user()->role==="mechanic")
                            <li><a href="{{ route('admin.users') }}"><i class="ri-user-line"></i> {{ __('Users') }}</a></li>
                            <li><a href="{{ route('admin.admins') }}"><i class="ri-admin-line"></i> {{ __('Admins') }}</a></li>
                        @else
                            <li><a href="{{ route('admin.users') }}"><i class="ri-user-line"></i> {{ __('Profile') }}</a></li>
                        @endif

                            <li><a href="{{ route('admin.mechanics') }}"> <i class="ri-shield-user-fill"></i> </i> {{ __('Mechanics') }}</a></li>

                            <li><a href="{{ route('admin.vehicles') }}"><i class="ri-car-line"></i> {{ __('Vehicle') }}</a></li>
                            <li><a href="{{ route('admin.repairs') }}"> <i class="ri-hammer-fill"></i>  {{ __('Repairs') }}</a></li>
                            <li><a href="{{ route('admin.showSpares') }}"><i class="ri-tools-line"></i> {{ __('Spare Parts') }}</a></li>
                            <li><a href="{{ route('admin.Invoices') }}"><i class="ri-file-text-line"></i> {{ __('Invoices') }}</a></li>

              

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>{{ __('Email') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.mails')}}">Inbox</a></li>
                        {{-- <li><a href="email-read.html">Read Email</a></li> --}}
                    </ul>
                </li>

               

                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
