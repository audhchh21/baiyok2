@extends('layouts.app')

@section('titlepage', 'แก้ไขร้านค้า')

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
        $.fn.select2.defaults.set( "theme", "bootstrap" )
        $('#province').select2()
        $('#district').select2()
        $('#subdistrict').select2()
        $('#zipcode').select2()

        var opt_province = '<option value="selected">----- เลือก จังหวัด -----</option>'
        var opt_district = '<option value="selected">----- เลือก อำเภอ -----</option>'
        var opt_subdistrict = '<option value="selected">----- เลือก ตำบล -----</option>'
        var opt_zipcode = '<option value="selected">----- เลือก รหัสไปรษณีย์ -----</option>'

        $('#province').on('select2:select', function() {
            let val_province = $(this).val()
            let op_district = opt_district
            $.ajax({
                url : '{{ route("api.district") }}',
                type: 'get',
                data:({
                    'id': val_province
                }),
                dataType:'json',
                success: function(result) {
                    // console.log(result)
                    $.each(result.data, function (count, value) {
                        // console.log(value);
                        op_district += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                    })
                    $('#district').html(op_district)
                    $('#subdistrict').html(opt_subdistrict)
                    $('#zipcode').html(opt_zipcode)
                }
            })
        })

        $('#district').on('select2:select', function() {
            let val_district = $(this).val()
            let op_subdistrict = opt_subdistrict
            $.ajax({
                url : '{{ route("api.subdistrict") }}',
                type: 'get',
                data:({
                    'id': val_district
                }),
                dataType:'json',
                success: function(result) {
                    // console.log(result)
                    $.each(result.data, function (count, value) {
                        // console.log(value);
                        op_subdistrict += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                    })
                    $('#subdistrict').html(op_subdistrict)
                    $('#zipcode').html(opt_zipcode)
                }
            })
        })

        $('#subdistrict').on('select2:select', function() {
            let val_zipcode = $(this).val()
            let op_zipcode = opt_zipcode
            $.ajax({
                url : '{{ route("api.zipcode") }}',
                type: 'get',
                data:({
                    'id': val_zipcode
                }),
                dataType:'json',
                success: function(result) {
                    // console.log(result)
                    $.each(result, function (count, value) {
                        console.log(value);
                        op_zipcode += '<option value="' + value['id'] + '" selected>' + value['zip_code'] + '</option>'
                    })
                    $('#zipcode').html(op_zipcode)
                }
            })
        })
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขร้านค้า', 'subtitle' => 'แก้ไขร้านค้า'])

    <!-- End Page Header -->

    <!-- Start Content -->

    <div class="row mb-5">
        <div class="col-12 col-xl-12 mb-3">
            <div class="text-left">
                <a href="{{ route('member.shop') }}" class="btn btn-dark" data-toggle="tooltip" data-placement="right" title="หน้าร้านค้า"><i class="fas fa-angle-double-left"></i>
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
            <form action="{{ route('member.shop.update', ['id' => $shop->id]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="shop" class="h4">{{ __('ชื่อร้านค้า') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="shop" name="name" value="{{ old('name') ?? $shop->name }}" placeholder="{{ $shop->name }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-2">
                        <label for="titlename" class="h4">{{ __('คำนำหน้าชื่อ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('titlename', $titlenames, old('titlename') ?? $shop->titlename_id, ['id' => 'titlename', 'class' => 'form-control form-control-lg']) !!}
                    </div>
                    <div class="form-group col-12 col-xl-5">
                        <label for="f_name" class="h4">{{ __('ชื่อ') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="f_name" name="f_name" value="{{ old('f_name') ?? $shop->f_name }}" placeholder="{{ $shop->f_name }}" required>
                    </div>
                    <div class="form-group col-12 col-xl-5">
                        <label for="l_name" class="h4">{{ __('นามสกุล') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="l_name" name="l_name" value="{{ old('l_name') ?? $shop->l_name }}" placeholder="{{ $shop->l_name }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-5">
                        <label for="tel" class="h4">{{ __('เบอร์โทรศัพท์') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="tel" name="tel" value="{{ old('tel') ?? $shop->tel }}" placeholder="{{ $shop->tel }}" required>
                    </div>
                    <div class="form-group col-12 col-xl-7">
                        <label for="place" class="h4">{{ __('สถานที่เก็บตัวอย่าง') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="place" name="place" value="{{ old('place') ?? $shop->place }}" placeholder="{{ $shop->place }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="address" class="h4">{{ __('ที่อยู่') }}<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-lg" name="address" id="address" cols="30" rows="8">{{ old('address') ?? $shop->address }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-3">
                        <label for="province" class="h4">{{ __('จังหวัด') }}<span class="text-danger">*</span></label>
                        {!! Form::select('province', $provinces, null, ['id' => 'province', 'placeholder' => '----- เลือก จังหวัด -----', 'class' => 'form-control
                        form-control-lg'.( $errors->has('province') ? ' is-invalid' : '' )]) !!}
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $errors->first('province') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="district" class="h4">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts, null, ['id' => 'district', 'placeholder' => '----- เลือก อำเภอ -----', 'class' => 'form-control
                        form-control-lg'.( $errors->has('district') ? ' is-invalid' : '' )]) !!}
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="subdistrict" class="h4">{{ __('ตำบล') }}<span class="text-danger">*</span></label>
                        {!! Form::select('subdistrict', $subdistricts, null, ['id' => 'subdistrict', 'placeholder' => '----- เลือก ตำบล -----', 'class' =>
                        'form-control form-control-lg'.( $errors->has('subdistrict') ? ' is-invalid' : '' )]) !!}
                        @error('subdistrict')
                        <div class="invalid-feedback">
                            {{ $errors->first('') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="zipcode" class="h4">{{ __('รหัสไปรษณีย์') }}<span
                                class="text-danger">*</span></label>
                        {!! Form::select('zipcode', $zipcodes, null, ['id' => 'zipcode', 'placeholder' => '----- เลือก รหัสไปรษณีย์ -----', 'disabled' => '', 'class' => 'form-control
                        form-control-lg'.( $errors->has('zipcode') ? ' is-invalid' : '' )]) !!}
                        @error('zipcode')
                        <div class="invalid-feedback">
                            {{ $errors->first('zipcode') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success">{{ __('บันทึก') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
