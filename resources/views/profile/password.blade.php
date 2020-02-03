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
    <div class="row mb-5">
        <div class="col-12 col-xl-12">
            <div class="text-right">
                @if (Auth::user()->type == 'Admin')
                <a href="{{ route('admin.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('admin.profile.password') }}"
                    class="btn btn-outline-dark">{{ __('เปลี่ยนรหัสผ่าน') }}</a>
                @elseif(Auth::user()->type == 'Manager')
                <a href="{{ route('manager.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('manager.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('manager.profile.password') }}"
                    class="btn btn-outline-dark">{{ __('เปลี่ยนรหัสผ่าน') }}</a>
                @elseif(Auth::user()->type == 'User')
                <a href="{{ route('member.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('member.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('member.profile.password') }}"
                    class="btn btn-outline-dark">{{ __('เปลี่ยนรหัสผ่าน') }}</a>
                @endif
                <hr>
            </div>
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form @if (Auth::user()->type == 'Admin')
                action="{{ route('admin.profile.password.update') }}"
                @elseif(Auth::user()->type == 'Manager')
                action="{{ route('manager.profile.password.update') }}"
                @elseif(Auth::user()->type == 'User')
                action="{{ route('member.profile.password.update') }}"
                @endif
                method="post">
                @csrf
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('รหัสผ่านเดิม') }}</td>
                            <td class="text-left col-12 col-xl-9">
                                <input class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" type="password" value=""
                                    placeholder="รหัสผ่านเดิม" required>
                                @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $errors->first('current_password') }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('รหัสผ่านใหม่') }}</td>
                            <td class="text-left col-12 col-xl-9">
                                <input class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" type="password" value=""
                                    placeholder="รหัสผ่านใหม่" required autocomplete="new-password">
                                @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $errors->first('new_password') }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('ยืนยันรหัสผ่านใหม่') }}</td>
                            <td class="text-left col-12 col-xl-9">
                                <input class="form-control @error('password_confirm') is-invalid @enderror"
                                    id="password_confirm" name="password_confirm" type="password" value=""
                                    placeholder="ยืนยันรหัสผ่านใหม่" required autocomplete="new-password">
                                @error('password_confirm')
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirm') }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-left">
                    <button type="submit" class="btn btn-success">{{ __('เปลี่ยนรหัสผ่าน') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
