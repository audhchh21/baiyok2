@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'กราฟ'])
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
        <div class="col-12 col-xl-5 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    {!! $ChartProvince->render() !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-7 mb-3">
            <div class="card h-100">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('ชุดทดสอบ') }}</th>
                            <th class="text-center">{{ __('ตรวจพบ') }}</th>
                            <th class="text-center">{{ __('ตรวจพบปลอดภัย') }}</th>
                            <th class="text-center">{{ __('ตรวจไม่พบ') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testkids as $testkid)
                        <tr>
                            <td class="text-center">{{ $testkid->name }}</td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-xl-5 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    {!! $ChartDistrict->render() !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-7 mb-3">
            <div class="card h-100">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('อำเภอ') }}</th>
                            @foreach ($testkids as $testkid)
                            <th class="text-center">{{ $testkid->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($districts as $district)
                        <tr>
                            <td class="text-center">{{ $district->name }}</td>
                            @foreach ($testkids as $testkid)
                            <td class="text-center"></td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="4"></td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
