<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <ul class="navbar-nav border-left flex-row ml-auto">
            <li class="nav-item border-right dropdown notifications">
                <a class="nav-link nav-link-icon text-center" href="" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="nav-link-icon__wrapper">
                        <i class="material-icons">&#xE7F4;</i>
                        <span class="badge badge-pill badge-danger">2</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="">
                        <div class="notification__icon-wrapper">
                            <div class="notification__icon">
                                <i class="material-icons">&#xE6E1;</i>
                            </div>
                        </div>
                        <div class="notification__content">
                            <span class="notification__category">Analytics</span>
                            <p>Your website’s active users count increased by
                                <span class="text-success text-semibold">28%</span> in the last week. Great job!</p>
                        </div>
                    </a>
                    <a class="dropdown-item" href="">
                        <div class="notification__icon-wrapper">
                            <div class="notification__icon">
                                <i class="material-icons">&#xE8D1;</i>
                            </div>
                        </div>
                        <div class="notification__content">
                            <span class="notification__category">Sales</span>
                            <p>Last week your store’s sales count decreased by
                                <span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>
                        </div>
                    </a>
                    <a class="dropdown-item notification__all text-center" href=""> View all Notifications </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap pt-4 pl-5 pr-5" data-toggle="dropdown" href=""
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block">{{ Auth::user()->Fullname }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="">
                        <i class="material-icons">&#xE7FD;</i> Profile</a>
                    <a class="dropdown-item" href="">
                        <i class="material-icons">vertical_split</i> Blog Posts</a>
                    <a class="dropdown-item" href="">
                        <i class="material-icons">note_add</i> Add New Post</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger">&#xE879;</i> {{ __('ออกจากระบบ') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <nav class="nav">
            <a href="" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                <i class="material-icons">&#xE5D2;</i>
            </a>
        </nav>
    </nav>
</div>
