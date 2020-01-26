@extends('layouts.app')

@section('titlepage', 'แก้ไขหน่วยงาน')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขหน่วยงาน', 'subtitle' => 'แก้ไขหน่วยงาน'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
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
                        <textarea name="address" id="address" cols="30" rows="10"
                            class="@error('address') is-invalid @enderror form-control form-control-lg"
                            required>{{ $office->address ?? old('address') ?? __('ที่อยู่') }}</textarea>
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
                        {!! Form::select('province', $provinces, $office->province, ['id' => 'province', 'class' => 'form-control
                        form-control-lg'.( $errors->has('province') ? ' is-invalid' : '' )]) !!}
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $errors->first('province') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="district" class="h3">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts, $office->district, ['id' => 'district', 'class' => 'form-control
                        form-control-lg'.( $errors->has('district') ? ' is-invalid' : '' )]) !!}
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="subdistrict" class="h3">{{ __('ตำบล') }}<span class="text-danger">*</span></label>
                        {!! Form::select('subdistrict', $subdistricts, $office->subdistrict, ['id' => 'subdistrict', 'class' =>
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
                        {!! Form::select('zipcode', $zipcodes, $office->zip_code, ['id' => 'zipcode', 'class' => 'form-control
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
