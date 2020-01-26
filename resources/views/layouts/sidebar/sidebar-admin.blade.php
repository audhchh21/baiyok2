<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0"
            style="height:100px">
            <a class="navbar-brand w-100 h-100 mr-0" href="{{ route('admin.dashboard') }}" style="line-height: 25px;">
                <div class="d-table m-auto text-center">
                    <img src="{{ asset('images/web/icon.png') }}" class="img-fluid " alt=""
                        style="width:42px;height:42px;"><br>
                    <span class="d-none d-md-inline ml-1">{{ __('สาธารณสุขจังหวัดปราจีนบุรี') }}</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('กราฟ') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.titlename') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('คำนำหน้าชื่อ') }}</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                    aria-expanded="false">
                    <i class="material-icons">edit</i>
                    <span>{{ __('จัดการจังหวัด') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small"
                    style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-5px, 52px, 0px);"
                    x-placement="bottom-start">
                    <a class="dropdown-item " href="{{ route('admin.province') }}">{{ __('จังหวัด') }}</a>
                    <a class="dropdown-item " href="{{ route('admin.district') }}">{{ __('อำเภอ') }}</a>
                    <a class="dropdown-item " href="{{ route('admin.subdistrict') }}">{{ __('ตำบล') }}</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.office') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('หน่วยงาน') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.user') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('จัดการบัญชีผู้ใช้') }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>