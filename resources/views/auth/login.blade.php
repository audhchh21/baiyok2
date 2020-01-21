@extends('layouts.guest')

@section('titlepage', 'เข้าสู่ระบบ')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pt-3 mb-5">
                <div class="card-header border-top h3 text-center">{{ __('เข้าสู่ระบบ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('อีเมล') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" placeholder="example@mail.com" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>อีเมล หรือ รหัสผ่านไม่ถูกต้อง</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="รหัสผ่าน" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>รหัสผ่านไม่ถูกต้อง</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-success mb-3 btn-block">
                                    {{ __('เข้าสู่ระบบ') }}
                                </button>
                            </div>
                            <div class="col-6 col-md-4 offset-md-2">
                                <a class="btn btn-light btn-block h-100" href="{{ route('register') }}">
                                    {{ __('ลงทะเบียนใช้งาน') }}
                                </a>
                            </div>
                            <div class="col-6 col-md-4">
                                <a class="btn btn-light btn-block h-100" href="{{ route('password.request') }}">
                                    {{ __('ลืมรหัสผ่าน') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
