@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'โปรไฟล์ของฉัน', 'subtitle'=>'โปรไฟล์ของฉัน'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="text-right">
                <a href="{{ route('admin.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('admin.profile.password') }}" class="btn btn-outline-dark"> {{ __('เปลี่ยนรหัสผ่าน') }}</a>
                <hr>
            </div>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="text-left col-12 col-xl-3">{{ __('อีเมล') }}</td>
                        <td class="text-left col-12 col-xl-9">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-left col-12 col-xl-3">{{ __('ชื่อ') }}</td>
                        <td class="text-left col-12 col-xl-9">{{ $user->Fullname }}</td>
                    </tr>
                    <tr>
                        <td class="text-left col-12 col-xl-3">{{ __('เบอร์โทรศัพท์') }}</td>
                        <td class="text-left col-12 col-xl-9">{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td class="text-left col-12 col-xl-3">{{ __('หน่วยงานที่สังกัด') }}</td>
                        <td class="text-left col-12 col-xl-9">{{ $user->offices->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
