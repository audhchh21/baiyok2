@extends('layouts.app')

@section('titlepage', 'เพิ่มร้านค้า')

@push('style')
{{-- css select2 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css">
{{-- Select2 Bootstrap4 --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
@endpush

@push('javascript')
{{-- javascript select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(() => {
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $('#province').select2()
        $('#district').select2()
        $('#subdistrict').select2()
        $('#zipcode').select2()
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มร้านค้า', 'subtitle' => 'เพิ่มร้านค้า'])

    <!-- End Page Header -->

    <!-- Start Content -->

    <div class="row">
        <div class="col-12 col-xl-12 mb-3">
            <div class="text-left">
                <a href="{{ route('member.shop') }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i>
                    {{ __('ย้อนกลับ')   }}</a>
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
            <form action="{{ route('member.shop.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="shop" class="h3">{{ __('ชื่อร้านค้า') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="shop" name="name" value="{{ old('name') ?? 'ร้านค้า' }}" placeholder="ร้านค้า" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-2">
                        <label for="titlename" class="h3">{{ __('คำนำหน้าชื่อ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('titlename', $titlenames, old('titlename') ?? null, ['id' => 'titlename', 'class' => 'form-control form-control-lg']) !!}
                    </div>
                    <div class="form-group col-12 col-xl-5">
                        <label for="f_name" class="h3">{{ __('ชื่อ') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="f_name" name="f_name" value="{{ old('f_name') }}" placeholder="ชื่อ" required>
                    </div>
                    <div class="form-group col-12 col-xl-5">
                        <label for="l_name" class="h3">{{ __('นามสกุล') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="l_name" name="l_name" value="{{ old('l_name') }}" placeholder="นามสกุล" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-5">
                        <label for="tel" class="h3">{{ __('เบอร์โทรศัพท์') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="tel" name="tel" value="{{ old('tel') }}" placeholder="เบอร์โทรศัพท์" required>
                    </div>
                    <div class="form-group col-12 col-xl-7">
                        <label for="place" class="h3">{{ __('สถานที่เก็บตัวอย่าง') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="place" name="place" value="{{ old('place') }}" placeholder="สถานที่เก็บตัวอย่าง" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="address" class="h3">{{ __('ที่อยู่') }}<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-lg" name="address" id="address" cols="30" rows="8">{{ old('address') ?? 'ที่อยู่' }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-3">
                        <label for="province" class="h3">{{ __('จังหวัด') }}<span class="text-danger">*</span></label>
                        {!! Form::select('province', $provinces, null, ['id' => 'province', 'class' => 'form-control
                        form-control-lg'.( $errors->has('province') ? ' is-invalid' : '' )]) !!}
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $errors->first('province') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="district" class="h3">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts, null, ['id' => 'district', 'class' => 'form-control
                        form-control-lg'.( $errors->has('district') ? ' is-invalid' : '' )]) !!}
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="subdistrict" class="h3">{{ __('ตำบล') }}<span class="text-danger">*</span></label>
                        {!! Form::select('subdistrict', $subdistricts, null, ['id' => 'subdistrict', 'class' =>
                        'form-control form-control-lg'.( $errors->has('subdistrict') ? ' is-invalid' : '' )]) !!}
                        @error('subdistrict')
                        <div class="invalid-feedback">
                            {{ $errors->first('') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="zipcode" class="h3">{{ __('รหัสไปรษณีย์') }}<span
                                class="text-danger">*</span></label>
                        {!! Form::select('zipcode', $zipcodes, null, ['id' => 'zipcode', 'class' => 'form-control
                        form-control-lg'.( $errors->has('zipcode') ? ' is-invalid' : '' )]) !!}
                        @error('zipcode')
                        <div class="invalid-feedback">
                            {{ $errors->first('zipcode') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success">{{ __('เพิ่ม') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
