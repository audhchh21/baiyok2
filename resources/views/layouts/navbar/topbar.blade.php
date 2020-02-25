<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <ul class="navbar-nav border-left flex-row ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap pt-4 pl-5 pr-5 mr-2" data-toggle="dropdown" href=""
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block">{{ auth()->user()->Fullname }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    @if ( auth()->user()->type == 'Admin' )
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="material-icons">&#xE7FD;</i> {{ __('โปรไฟล์ของฉัน') }}
                    </a>
                    @elseif ( auth()->user()->type == 'Manager' )
                    <a class="dropdown-item" href="{{ route('manager.profile') }}">
                        <i class="material-icons">&#xE7FD;</i> {{ __('โปรไฟล์ของฉัน') }}
                    </a>
                    @elseif ( auth()->user()->type == 'User' )
                    <a class="dropdown-item" href="{{ route('member.profile') }}">
                        <i class="material-icons">&#xE7FD;</i> {{ __('โปรไฟล์ของฉัน') }}
                    </a>
                    @endif

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
