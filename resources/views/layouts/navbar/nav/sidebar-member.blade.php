<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <span class="d-none d-md-inline ml-1">{{ __('Shards Dashboard') }}</span>
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
                <a class="nav-link " href="{{ route('member.dashboard') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('กราฟ') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.shop') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('ข้อมูลร้านค้า') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.foodsample') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('ข้อมูลชุดทดสอบ') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.foodsamplesource') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('ข้อมูลตัวอย่างอาหาร') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.foodtestkit') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('แหล่งที่มาตัวอย่างอาหาร') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.plan') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('แผนงานตรวจสอบสารปนเปิ้อน') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.inspection') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('ผลการตรวจสอบสารปนเปิ้อน') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.profile') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('โปรไฟล์ผู้ใช้') }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
