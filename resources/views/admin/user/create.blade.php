@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มบัญชีผู้ใช้งาน'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.user') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i>
                    {{ __('ย้อนกลับ') }}</a>
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
            <form action="{{ route('admin.user.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-xl-8 border-right">
                        <div class="form-row">
                            <div class="form-group col col-xl-12">
                                <label for="email" class="h3">{{ __('อีเมล') }}<span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="example@mail.com" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col col-xl-12">
                                <label for="password" class="h3">{{ __('รหัสผ่าน') }}<span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                    name="password" required>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col col-xl-12">
                                <label for="password_confirmation" class="h3">{{ __('ยืนยันรหัสผ่าน') }}<span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-lg" id="password_confirmation"
                                    name="password_confirmation" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-12 col-xl-3">
                                <label for="titlename" class="h3">{{ __('คำนำหน้าชื่อ') }}<span
                                        class="text-danger">*</span></label>
                                {!! Form::select('titlename', $titlenames, old('titlename') ?? null, ['id' =>
                                'titlename', 'class' =>
                                'form-control form-control-lg']) !!}
                                @error('titlename')
                                <div class="invalid-feedback">
                                    {{ $errors->first('titlename') }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-xl">
                                <label for="f_name" class="h3">{{ __('ชื่อ') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="f_name" name="f_name"
                                    value="{{ old('f_name') }}" placeholder="ชื่อ" required>
                                @error('f_name')
                                <div class="invalid-feedback">
                                    {{ $errors->first('f_name') }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-xl">
                                <label for="l_name" class="h3">{{ __('นามสกุล') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="l_name" name="l_name"
                                    value="{{ old('l_name') }}" placeholder="นามสกุล" required>
                                @error('l_name')
                                <div class="invalid-feedback">
                                    {{ $errors->first('l_name') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-xl-4">
                                <label for="phone" class="h3">{{ __('เบอร์โทรศัพท์') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="phone" name="phone"
                                    value="{{ old('phone') }}" placeholder="เบอร์โทรศัพท์" required>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-xl-8">
                                <label for="office" class="h3">{{ __('หน่วยงาน') }}<span
                                        class="text-danger">*</span></label>
                                {!! Form::select('office', $offices, old('office') ?? null, ['id' => 'office', 'class'
                                => 'form-control
                                form-control-lg']) !!}
                                @error('office')
                                <div class="invalid-feedback">
                                    {{ $errors->first('office') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="form-row">
                            <div class="form-group col-12 col-xl-12">
                                <h3>{{ __('ระดับบัญชีผู้ใช้') }}<span class="text-danger">*</span></h3>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="admin" name="type" value="t1" class="custom-control-input">
                                    <label class="custom-control-label h5" for="admin">{{ __('ผู้ดูแลระบบ') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="manager" name="type" value="t2"
                                        class="custom-control-input">
                                    <label class="custom-control-label h5" for="manager">{{ __('ผู้บริหาร') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="member" name="type" value="t3" class="custom-control-input"
                                        checked="checked">
                                    <label class="custom-control-label h5" for="member">{{ __('เจ้าหน้าที่') }}</label>
                                </div>
                                <hr>
                            </div>
                            <div class="form-group col-12 col-xl-12">
                                <h3>{{ __('สถานะบัญชี') }}<span class="text-danger">*</span></h3>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="statusO" name="status" value="s1"
                                        class="custom-control-input" checked="checked">
                                    <label class="custom-control-label h5"
                                        for="statusO">{{ __('อนุมัติสิทธิ์') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="statusR" name="status" value="s2"
                                        class="custom-control-input">
                                    <label class="custom-control-label h5"
                                        for="statusR">{{ __('รอกำหนดสิทธิ์') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="statusL" name="status" value="s3"
                                        class="custom-control-input">
                                    <label class="custom-control-label h5"
                                        for="statusL">{{ __('ยกเลิกสิทธิ์') }}</label>
                                </div>
                                <hr>
                                <button type="submit"
                                    class="btn btn-block btn-lg btn-success">{{ __('เพิ่ม') }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
