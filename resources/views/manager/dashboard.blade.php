@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'กราฟ', 'subtitle' => 'กราฟทั้งหมด'])
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
        <div class="col-lg col-md-6 col-sm-6 mb-3">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">{{ __('แผนงานทั้งหมด') }}</span>
                            <h6 class="stats-small__value count my-3">
                                {{ number_format($plan_all ?? 0, 0,'.',',') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-3">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">{{ __('แผนงานวันนี้') }}</span>
                            <h6 class="stats-small__value count my-3">
                                {{ number_format($plan_today ?? 0, 0,'.',',') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-3">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">{{ __('แผนงานที่ตรวจแล้ว') }}</span>
                            <h6 class="stats-small__value count my-3">
                                {{ number_format($plan_check ?? 0, 0,'.',',') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-3">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span
                                class="stats-small__label text-uppercase">{{ __('แผนงานที่ไม่ได้ตรวจ') }}</span>
                            <h6 class="stats-small__value count my-3">
                                {{ number_format($plan_un ?? 0, 0,'.',',') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {!! $dashboardplan->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{-- {!! $result->render() !!} --}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{-- {!! $sample->render() !!} --}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{-- {!! $samplesource->render() !!} --}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{-- {!! $testkit->render() !!} --}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
