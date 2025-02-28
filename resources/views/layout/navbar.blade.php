<style>
    .notification {
        position: absolute;
        top: 9px;
        right: -5px;
        background-color: #f43506;
        color: white;
        font-size: 14px;
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
        opacity: 0.5;
        cursor: not-allowed;
       
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
        @php
            $locale = app()->getLocale();
            $flag = ($locale == 'en') ? 'english.png' : 'cambodia.png';
        @endphp
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('admin_dashboard/assets/images/flags/' . $flag) }}" alt="user-image"
                    class="me-0 me-sm-1" height="20px">
                <span class="align-middle d-none d-sm-inline-block font">@lang('label.language')</span>
                <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">
                <!-- item-->
                <a href="{{ route('locale.switch', ['lang' => 'en']) }}" class="dropdown-item notify-item">
                    <img src="{{ asset('admin_dashboard/assets/images/flags/english.png') }}" alt="user-image"
                        class="me-1" height="12">
                    <span class="align-middle font">@lang('label.english')</span>
                </a>
                <!-- item-->
                <a href="{{ route('locale.switch', ['lang' => 'kh']) }}" class="dropdown-item notify-item">
                    <img src="{{ asset('admin_dashboard/assets/images/flags/cambodia.png') }}" alt="user-image"
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
                </div>
               
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
                <a href="{{ route('homepage') }}" class="btn btn-sm mt-1 btn-primary">@lang('label.website')</a>
            </div>
        </form>
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
