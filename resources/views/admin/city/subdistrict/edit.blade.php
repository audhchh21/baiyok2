@extends('layouts.app')

@section('titlepage', 'แก้ไขตำบล')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขตำบล', 'subtitle'=>'แก้ไขตำบล'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.subdistrict') }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i> {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
                <form action="{{ route('admin.subdistrict.update',['id' => $subdistrict->id]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-xl-4">
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
                        <label for="province" class="h3">{{ __('จังหวัด') }}</label>
                        {!! Form::select('province', $provinces, old('province') ?? $subdistrict->districts->provinces->id, ['id' => 'province', 'class' => 'form-control form-control-lg', 'disabled' => '']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xl-4">
                        <label for="district" class="h3">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts, old('district') ?? $subdistrict->district_id ?? null, ['id' => 'district', 'class' => 'form-control form-control-lg']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xl-4">
                        <label for="subdistrict" class="h3">{{ __('ตำบล') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('subdistrict') is-invalid @enderror form-control form-control-lg " id="subdistrict" name="name" value="{{ old('subdistrict') ?? $subdistrict->name }}" placeholder="{{ $subdistrict->name }}" required>
                        @error('subdistrict')
                        <div class="invalid-feedback">
                            {{ $errors->first('subdistrict') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xl-4">
                        <label for="zipcode" class="h3">{{ __('รหัสไปรษณีย์') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('zipcode') is-invalid @enderror form-control form-control-lg " id="zipcode" name="zipcode" value="{{ old('subdistrict') ?? $subdistrict->zip_code }}" placeholder="{{ $subdistrict->zip_code }}" required>
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
