<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('admin_dashboard') }}/assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('admin_dashboard') }}/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('admin_dashboard') }}/assets/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('admin_dashboard') }}/assets/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title side-nav-item">Navigation</li>
            <li class="side-nav-item font">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false"
                    aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>

                    <span> @lang('label.dashboard') </span>
                </a>

            </li>

            {{-- <li class="side-nav-title side-nav-item font">Guest Section</li> --}}
            <li class="side-nav-item font @if (Request::segment(1) == 'guests') active @endif"">
                <a href="{{ url('guests') }}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> @lang('label.guest')  </span>
                </a>
            </li>
            {{-- <li class="side-nav-title side-nav-item font">Room Section</li> --}}
            <li class="side-nav-item font @if (Request::segment(1) == 'rooms') active @endif"">
                <a href="{{url('rooms')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> @lang('label.room')  </span>
                </a>
            </li>

            <li class="side-nav-item font @if (Request::segment(1) == 'roomTypes') active @endif">
                <a href="{{ url('roomtypes') }}" class="side-nav-link">
                    <i class="uil-bed"></i>
                    <span> @lang('label.roomType')  </span>
                </a>
            </li>
            {{-- <li class="side-nav-title side-nav-item font">Reservation Section</li> --}}
            <li class="side-nav-item font @if (Request::segment(1) == 'calenders') active @endif"">
                <a href="{{url('calenders')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> @lang('label.calender') </span>
                </a>
            </li>

            <li class="side-nav-item font @if (Request::segment(1) == 'bookings') active @endif">
                <a href="{{url('bookings')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> @lang('label.reservation') </span>
                </a>
            </li>
            {{-- <li class="side-nav-title side-nav-item font">Management</li> --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> @lang('label.management') </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('users')}}">
                               
                                 @lang('label.userManage') 
                            </a>
                        </li>
                        <li  class="@if (Request::segment(1) == 'permissions') active @endif">
                          
                            <a href="{{url('permissions')}}">
                               
                                @lang('label.permissionList') 
                           </a>
                        </li>
                        <li class="@if (Request::segment(1) == 'roles') active @endif">
                            <a href="{{url('roles')}}">
                               
                                 @lang('label.role') 
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-title side-nav-item font">Transition</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('carousels')}}">Carousel</a>
                        </li>
                        <li>
                            <a href="{{url('queries')}}">User Queries</a>
                        </li>
                        <li>
                            <a href="{{url('facilitys')}}">Facilities</a>
                        </li>
                        <li>
                            <a href="{{url('settings')}}">Settings</a>
                        </li>
                        <li>
                            <a href="pages-pricing.html">Pricing</a>
                        </li>
                        <li>
                            <a href="pages-maintenance.html">Maintenance</a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            
           
        </ul>

        <!-- Help Box -->

        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
