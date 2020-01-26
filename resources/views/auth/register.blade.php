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
            <a href="{{ route('login') }}" class="btn btn-sm btn-dark mb-3"><i class="fas fa-angle-double-left"></i>
                {{  __('ย้อนกลับ')   }}</a>
            <div class="card shadow pt-3 mb-5">
                <div class="card-header border-top h3 text-center text-white bg-success">{{ __('ลงทะเบียน') }}</div>

                <div class="card-body">
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
                    <form method="POST" action="{{ url('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-xl-12">
                                <label for="email">{{ __('อีเมล') }} <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email"
                                    value="{{ old('email') }}" placeholder="example@mail.com"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-12">
                                <label for="password">{{ __('รหัสผ่าน') }} <span class="text-danger">*</span></label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    name="password" id="password" placeholder="รหัสผ่าน" required
                                    autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-12">
                                <label for="conf-password">{{ __('ยืนยันรหัสผ่าน') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password-confirm" placeholder="ยืนยันรหัสผ่าน" required
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-xl-2">
                                <label for="titlename_id">{{ __('คำนำหน้าชื่อ') }}</label>
                                <select class="form-control" name="titlename_id" id="titlename_id">
                                    @forelse ($titlenames as $titlename)
                                    <option value="{{ $titlename->id }}">{{ $titlename->name }}</option>
                                    @empty
                                    <option>{{ __('ไม่มีคำนำหน้าชื่อ') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-xl-5">
                                <label for="f_name">{{ __('ชื่อ') }} <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="f_name" id="f_name"
                                    value="{{ old('f_name') }}" placeholder="ชื่อ" required>
                            </div>
                            <div class="form-group col-xl-5">
                                <label for="l_name">{{ __('นามสกุล') }} <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="l_name" id="l_name"
                                    value="{{ old('l_name') }}" placeholder="นามสกุล" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-12">
                                <label for="phone">{{ __('เบอร์โทรศัพท์') }} <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" id="phone"
                                    value="{{ old('phone') }}" placeholder="เบอร์โทรศัพท์" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-12">
                                <select class="form-control" name="office_id" id="office_id">
                                    @forelse ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @empty
                                    <option>{{ __('ไม่มีหน่วยงาน') }}</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-2">
                                <a class="btn btn-light btn-block" href="{{ url('/') }}">
                                    {{ __('เข้าสู่ระบบ') }}
                                </a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{ __('ลงทะเบียนใช้งาน') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
