@extends('layouts.app')

@section('titlepage', 'รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร', 'subtitle' => 'รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร'])
    <!-- End Page Header -->

    <!-- Start Content -->
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
    <div class="row">
        <div class="col-12 col-xl-3">
            <div class="card h-100">
                <div class="card-body text-danger">
                    <div class="text-center pb-3">
                        <i class="far fa-file-pdf fa-10x"></i>
                    </div>
                    <span class="h6 text-center">{{ __('รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร') }}</span>
                    <span class="h5 text-center">{{ __('ระดับจังหวัด') }}</span>
                    <form action="{{ route('manager.result.province') }}" method="get" target="_blank">
                        {!! Form::select('province', $provinces, old('province'), ['id' => 'province' ,'class' => 'form-control form-control-sm mb-3']) !!}
                        <button type="submit" class="btn btn-sm btn-block btn-primary">{{ __('ออกรายงาน') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-3">
            <div class="card h-100">
                <div class="card-body text-danger">
                    <div class="text-center pb-3">
                        <i class="far fa-file-pdf fa-10x"></i>
                    </div>
                    <span class="h6 text-center">{{ __('รายงานสรุปผลการตรวจสอบสารปนเปื้อนในอาหาร') }}</span>
                    <span class="h5 text-center">{{ __('ระดับอำเภอ') }}</span>
                    <form action="{{ route('manager.result.district') }}" method="get" target="_blank">
                        {!! Form::select('district', $districts, old('district'), ['id' => 'district' ,'class' => 'form-control form-control-sm mb-3']) !!}
                        <button type="submit" class="btn btn-sm btn-block btn-primary">{{ __('ออกรายงาน') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
