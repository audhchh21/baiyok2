@extends('layouts.app')

@section('titlepage', 'แก้ไขจังหวัด')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขจังหวัด'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.province') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
                <form action="{{ route('admin.province.update',['id' => $province->id]) }}" method="post">
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
                        <label for="province" class="h3">{{ __('จังหวัด') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('province') is-invalid @enderror form-control form-control-lg " id="province" name="name" value="{{ old('province') ?? $province->name }}" placeholder="{{ $province->name }}" required>
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $errors->first('province') }}
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
