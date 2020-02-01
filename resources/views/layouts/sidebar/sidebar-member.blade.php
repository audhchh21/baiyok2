<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0" style="height:100px">
            <a class="navbar-brand w-100 h-100 mr-0" href="{{ route('member.dashboard') }}" style="line-height: 25px;">
                <div class="d-table m-auto text-center">
                    <img src="{{ asset('images/web/icon.png') }}" class="img-fluid " alt="" style="width:42px;height:42px;"><br>
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
                <a class="nav-link " href="{{ route('member.dashboard') }}">
                    <i class="fas fa-chart-line"></i>
                    <span>{{ __('กราฟ') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.shop') }}">
                    <i class="far fa-list-alt"></i>
                    <span>{{ __('ร้านค้า') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.foodtestkit') }}">
                    <i class="far fa-list-alt"></i>
                    <span>{{ __('ชุดทดสอบ') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.foodsample') }}">
                    <i class="far fa-list-alt"></i>
                    <span>{{ __('ตัวอย่างอาหาร') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.foodsamplesource') }}">
                    <i class="far fa-list-alt"></i>
                    <span>{{ __('แหล่งที่มาตัวอย่างอาหาร') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('member.plan') }}">
                    <i class="material-icons">edit</i>
                    <span>{{ __('แผนงานตรวจสอบสารปนเปิ้อน') }}</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                    aria-expanded="false">
                    <i class="fas fa-stream"></i>
                    <span>{{ __('ผลการตรวจสอบสารปนเปิ้อน') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small"
                    style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-5px, 52px, 0px);"
                    x-placement="bottom-start">
                    <a class="dropdown-item " href="{{ route('member.inspection') }}"><i class="fas fa-list-ol pr-2"></i>{{ __('ผลการตรวจสอบสารปนเปิ้อน ทั้งหมด') }}</a>
                    <a class="dropdown-item " href="{{ route('member.inspection.successful') }}"><i class="fas fa-list-ol pr-2"></i>{{ __('ผลการตรวจสอบสารปนเปิ้อน สำเร็จ') }}</a>
                    <a class="dropdown-item " href="{{ route('member.inspection.slowsuccessful') }}"><i class="fas fa-list-ol pr-2"></i>{{ __('ผลการตรวจสอบสารปนเปิ้อน ล่าช้า') }}</a>
                    <a class="dropdown-item " href="{{ route('member.inspection.unsuccessful') }}"><i class="fas fa-list-ol pr-2"></i>{{ __('ผลการตรวจสอบสารปนเปิ้อน ไม่ได้ตรวจ') }}</a>
                </div>
            </li>
        </ul>
    </div>
</aside>
