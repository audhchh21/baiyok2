@extends('layouts.app')

@section('titlepage', 'เพิ่มคำนำหน้าชื่อ')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มคำนำหน้าชื่อ', 'subtitle'=>'เพิ่มรายการคำนำหน้าชื่อ'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.titlename') }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i> {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
            <form action="{{ route('admin.titlename.store') }}" method="post">
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
                        <label for="titlename" class="h3">{{ __('คำนำหน้าชื่อ') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('titlename') is-invalid @enderror form-control form-control-lg" id="titlename" name="titlename" value="{{ old('titlename') }}" placeholder="คำนำหน้าชื่อ" required>
                        @error('titlename')
                        <div class="invalid-feedback">
                            {{ $errors->first('titlename') }}
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
