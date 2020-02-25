@extends('layouts.app')

@section('titlepage', 'แก้ไขหน่วยงาน')

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
    @include('layouts.pageheader.title', ['title' => 'แก้ไขหน่วยงาน'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-5">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.office') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i>
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
            <form action="{{ route('admin.office.update', ['id' => $office->id]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="name" class="h3">{{ __('ชื่อหน่วยงาน') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('name') is-invalid @enderror form-control form-control-lg"
                            id="name" name="name" value="{{ $office->name ?? old('name') }}" placeholder="ชื่อหน่วยงาน" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="address" class="h3">{{ __('ที่อยู่') }}<span class="text-danger">*</span></label>
                        <textarea name="address" id="address" cols="30" rows="5"
                            class="@error('address') is-invalid @enderror form-control form-control-lg"
                            required>{{ $office->address ?? old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-xl-3">
                        <label for="province" class="h3">{{ __('จังหวัด') }}<span class="text-danger">*</span></label>
                        {!! Form::select('province', $provinces, $office->province, ['id' => 'province', 'placeholder' => '----- เลือก จังหวัด -----', 'class' => 'form-control
                        form-control-lg'.( $errors->has('province') ? ' is-invalid' : '' )]) !!}
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $errors->first('province') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="district" class="h3">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts, $office->district, ['id' => 'district', 'placeholder' => '----- เลือก อำเภอ -----', 'class' => 'form-control
                        form-control-lg'.( $errors->has('district') ? ' is-invalid' : '' )]) !!}
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="subdistrict" class="h3">{{ __('ตำบล') }}<span class="text-danger">*</span></label>
                        {!! Form::select('subdistrict', $subdistricts, $office->subdistrict, ['id' => 'subdistrict', 'placeholder' => '----- เลือก ตำบล -----', 'class' =>
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
                        {!! Form::select('zipcode', $zipcodes, $office->subdistrict, ['id' => 'zipcode', 'placeholder' => '----- เลือก รหัสไปรษณีย์ -----', 'disabled' => '', 'class' => 'form-control
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
