@extends('layouts.app')

@section('titlepage', 'เพิ่มหน่วยงาน')

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

        var val_province = $('#province').val()
        var opt_province = '<option value="selected">----- เลือก จังหวัด -----</option>';
        $.ajax({
                url : '{{ route("api.province") }}',
                type: 'get',
                data:({}),
                dataType:'json',
                success: function(result) {
                    // console.log(result)
                    $.each(result, function (count, value) {
                        // console.log(value);
                        opt_province += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                    })
                    $('#province').html(opt_province)
                }
            })

        $('#province').on('select2:select', function() {

            var opt_district = '<option value="selected">----- เลือก อำเภอ -----</option>';

            // console.log(value)

            $.ajax({
                url : '{{ route("api.district") }}',
                type: 'get',
                data:({
                    'id': val_province
                }),
                dataType:'json',
                success: function(result) {
                    // console.log(result)
                    $.each(result, function (count, value) {
                        // console.log(value);
                        opt_district += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                    })
                    $('#district').html(opt_district)
                }
            })
        })
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มหน่วยงาน', 'subtitle' => 'เพิ่มหน่วยงาน'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-3">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.office') }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i>
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
            <form action="{{ route('admin.office.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12 col-xl-12">
                        <label for="name" class="h3">{{ __('ชื่อหน่วยงาน') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('name') is-invalid @enderror form-control form-control-lg"
                            id="name" name="name" value="{{ old('name') }}" placeholder="ชื่อหน่วยงาน" required>
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
                        <textarea name="address" id="address" cols="30" rows="10"
                            class="@error('address') is-invalid @enderror form-control form-control-lg"
                            required>{{ old('address') ?? __('ที่อยู่') }}</textarea>
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
                        {!! Form::select('province', $provinces, null, ['id' => 'province', 'placeholder' => '----- เลือก จังหวัด -----', 'class' => 'form-control
                        form-control-lg'.( $errors->has('province') ? ' is-invalid' : '' )]) !!}
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $errors->first('province') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="district" class="h3">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts, null, ['id' => 'district', 'placeholder' => '----- เลือก อำเภอ -----', 'class' => 'form-control
                        form-control-lg'.( $errors->has('district') ? ' is-invalid' : '' )]) !!}
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="subdistrict" class="h3">{{ __('ตำบล') }}<span class="text-danger">*</span></label>
                        {!! Form::select('subdistrict', $subdistricts, null, ['id' => 'subdistrict', 'placeholder' => '----- เลือก ตำบล -----', 'class' =>
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
                        {!! Form::select('zipcode', $zipcodes, null, ['id' => 'zipcode', 'placeholder' => '----- เลือก รหัสไปรษณีย์ -----', 'class' => 'form-control
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
