<style>
    .notification {
        position: absolute;
        top: 9px;
        right: -5px;
        background-color: #f43506;
        /* Green background */
        color: white;
        /* White text */
        font-size: 14px;
        /* Adjust font size as needed */
        font-weight: bold;
        padding: 8px;
        border-radius: 100%;
        line-height: 1;
        min-width: 20px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .disabled {
        pointer-events: none;
        /* Prevent click events */
        opacity: 0.5;
        /* Make it look dimmed */
        cursor: not-allowed;
        /* Show "not allowed" cursor */
    }

    .list-group-item {
        border: 1px solid #ddd;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
    }

    .notify-details {
        margin-left: 10px;
    }
</style>
<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..."
                        aria-label="Recipient's username">
                </form>
            </div>
        </li>
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('admin_dashboard') }}/assets/images/flags/world.png" alt="user-image"
                    class="me-0 me-sm-1" height="20px">
                <span class="align-middle d-none d-sm-inline-block font">@lang('label.language')</span> <i
                    class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                <!-- item-->
                <a href="{{ route('locale.switch', ['lang' => 'en']) }}" class="dropdown-item notify-item">
                    <img src="{{ asset('admin_dashboard') }}/assets/images/flags/england.png" alt="user-image"
                        class="me-1" height="12">
                    <span class="align-middle font">@lang('label.english')</span>
                </a>

                <!-- item-->
                <a href="{{ route('locale.switch', ['lang' => 'kh']) }}" class="dropdown-item notify-item">
                    <img src="{{ asset('admin_dashboard') }}/assets/images/flags/cambodia.png" alt="user-image"
                        class="me-1" height="12">
                    <span class="align-middle font">@lang('label.khmer')</span>
                </a>
            </div>
        </li>
        @php
            // Retrieve notifications from the session
            $notifications = session()->get('notifications', []);
            $notificationCount = count($notifications);
        @endphp
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon "></i>
                @if ($notificationCount > 0)
                    <span class="notification">{{ $notificationCount }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="{{ route('notifications.clear') }}" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div style="max-height: 230px;" data-simplebar="">
                    <!-- item-->
                    @forelse ($notifications as $notification)
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">{{ $notification['message'] }}
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($notification['time'])->diffForHumans() }}
                                </small>
                            </p>
                        </a>
                    @empty
                        <p class="text-center text-muted">No new notifications</p>
                    @endforelse

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <p class="notify-details">New user registered.
                            <small class="text-muted">5 hours ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/users/avatar-2.jpg"
                                class="img-fluid rounded-circle" alt="">
                        </div>
                        <p class="notify-details">Cristina Pride</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Hi, How are you? What about our next meeting</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar commented on Admin
                            <small class="text-muted">4 days ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/users/avatar-4.jpg"
                                class="img-fluid rounded-circle" alt="">
                        </div>
                        <p class="notify-details">Karen Robinson</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Wow ! this admin looks good and awesome design</small>
                        </p>
                    </a> --}}

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info">
                            <i class="mdi mdi-heart"></i>
                        </div>
                        <p class="notify-details">Carlos Crouch liked
                            <b>Admin</b>
                            <small class="text-muted">13 days ago</small>
                        </p>
                    </a> --}}
                </div>
                <!-- All-->
                {{-- @if (!empty($notifications))
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all"
               data-bs-toggle="modal" data-bs-target="#notificationsModal">
                View All
            </a>
            @endif --}}
                @if ($notificationCount > 0)
                    <a href="javascript:void(0);"
                        class="dropdown-item text-center bg-primary text-white notify-item notify-all"
                        data-bs-toggle="modal" data-bs-target="#notificationsModal">
                        View All
                    </a>
                @else
                    <a href="javascript:void(0);"
                        class="dropdown-item text-center text-muted notify-item notify-all disabled"
                        aria-disabled="true">
                        View All
                    </a>
                @endif

            </div>
        </li>

        <!-- Modal for Viewing All Notifications -->


        {{-- <li class="dropdown notification-list d-none d-sm-inline-block">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-view-apps noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                <div class="p-2">
                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{ asset('admin_dashboard') }}/assets/images/brands/slack.png" alt="slack">
                                <span>Slack</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{ asset('admin_dashboard') }}/assets/images/brands/github.png"
                                    alt="Github">
                                <span>GitHub</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{ asset('admin_dashboard') }}/assets/images/brands/dribbble.png"
                                    alt="dribbble">
                                <span>Dribbble</span>
                            </a>
                        </div>
                    </div>

                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{ asset('admin_dashboard') }}/assets/images/brands/bitbucket.png"
                                    alt="bitbucket">
                                <span>Bitbucket</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{ asset('admin_dashboard') }}/assets/images/brands/dropbox.png"
                                    alt="dropbox">
                                <span>Dropbox</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{ asset('admin_dashboard') }}/assets/images/brands/g-suite.png"
                                    alt="G Suite">
                                <span>G Suite</span>
                            </a>
                        </div>
                    </div> <!-- end row-->
                </div>

            </div>
        </li> --}}

        {{-- <li class="notification-list">
            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                <i class="dripicons-gear noti-icon"></i>
            </a>
        </li> --}}

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    @if (Auth::user()->gender === 'male')
                        <img src="{{ asset('admin_dashboard/assets/images/users/man.png') }}" alt="user-image"
                            class="rounded-circle">
                    @else
                        <img src="{{ asset('admin_dashboard/assets/images/users/woman.png') }}" alt="user-image"
                            class="rounded-circle">
                    @endif
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->full_name }}</span>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account</span>
                </a> --}}

                <!-- item-->
                {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-edit me-1"></i>
                    <span>Settings</span>
                </a> --}}

                <!-- item-->
                {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-lifebuoy me-1"></i>
                    <span>Support</span>
                </a> --}}

                <!-- item-->
                {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline me-1"></i>
                    <span>Lock Screen</span>
                </a> --}}

                <!-- item-->
                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="app-search dropdown d-none d-lg-block">
        <form>
            <div class="input-group">
                {{-- <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search"> --}}

                {{-- <span class="mdi mdi-magnify search-icon"></span> --}}
                <a href="{{ route('homepage') }}" class="btn btn-sm mt-1 btn-primary">Website</a>
            </div>
        </form>

        {{-- <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
            </div>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-notes font-16 me-1"></i>
                <span>Analytics Report</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-life-ring font-16 me-1"></i>
                <span>How can I help you?</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-cog font-16 me-1"></i>
                <span>User profile settings</span>
            </a>

            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
            </div>

            <div class="notification-list">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="d-flex">
                        <img class="d-flex me-2 rounded-circle"
                            src="{{ asset('admin_dashboard') }}/assets/images/users/avatar-2.jpg"
                            alt="Generic placeholder image" height="32">
                        <div class="w-100">
                            <h5 class="m-0 font-14">Erwin Brown</h5>
                            <span class="font-12 mb-0">UI Designer</span>
                        </div>
                    </div>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="d-flex">
                        <img class="d-flex me-2 rounded-circle"
                            src="{{ asset('admin_dashboard') }}/assets/images/users/avatar-5.jpg"
                            alt="Generic placeholder image" height="32">
                        <div class="w-100">
                            <h5 class="m-0 font-14">Jacob Deo</h5>
                            <span class="font-12 mb-0">Developer</span>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
    </div>
</div>
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">All Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (!empty($notifications))
                    <div class="list-group">
                        @foreach ($notifications as $notification)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>{{ $notification['message'] }}</h6>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($notification['time'])->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">No notifications available.</p>
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{ route('notifications.clear') }}" class="btn btn-danger">Clear All Notifications</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
