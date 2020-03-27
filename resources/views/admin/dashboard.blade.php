@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')
<style type="text/css">
    .tb-td {
        vertical-align: middle !important;
    }

</style>
@endpush

@push('javascript')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#up-status').click(function () {
            $('#up-form').submit();
        });
        $('#down-status').click(function () {
            $('#down-form').submit();
        });
    });

</script>
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
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">{{ __('ผู้ใช้งานทั้งหมด') }}</span>
                            <h6 class="stats-small__value count my-3">{{ number_format($user_count, 0,'.',',') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">{{ __('หน่วยงานทั้งหมด') }}</span>
                            <h6 class="stats-small__value count my-3">{{ number_format($office_count, 0,'.',',') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">{{ __('ผู้ใช้งานรอกำหนดสิทธิ์') }}</span>
                            <h6 class="stats-small__value count my-3">
                                {{ number_format($user_status_0_count, 0,'.',',') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span
                                class="stats-small__label text-uppercase">{{ __('ผู้ใช้งานที่ถูกยกเลิกสิทธิ์') }}</span>
                            <h6 class="stats-small__value count my-3">
                                {{ number_format($user_status_2_count, 0,'.',',') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
            <div class="card card-small blog-comments h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('ผู้ใช้งานร้องของอนุมัติสิทธิ์') }}</h6>
                </div>
                <table class="table table-borderless table-hover p-0">
                    <thead class="border-bottom">
                        <tr>
                            <th class="text-left col-5">{{ __('ชื่อ - นามสกุล') }}</th>
                            <th class="text-left col-4">{{ __('อีเมล') }}</th>
                            <th class="text-center col-3">{{ __('การจัดการ') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userstatus as $user)
                        <tr>
                            <td class="text-left col-5">{{ $user->Fullname }}</td>
                            <td class="text-left col-4">{{ $user->email }}</td>
                            <td class="text-center col-3">
                                <button type="button" id="up-status" class="btn btn-sm btn-white"
                                    data-toggle="tooltip" data-placement="top" title="อนุมัติสิทธิ์"
                                    >
                                    <span class="text-success">
                                        <i class="material-icons">check</i>
                                    </span></button>

                                <button type="button" id="down-status" class="btn btn-sm btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ไม่อนุมัติสิทธิ์"
                                    onclick="return confirm('คุณต้องยกเลิกสิทธิ์ ใช่ หรือ ไม่')">
                                    <span class="text-danger">
                                        <i class="material-icons">clear</i>
                                    </span></button>
                                <form id="up-form" action="{{ route('admin.up.status') }}" method="post">
                                    @csrf<input type="hidden" name="id" value="{{ $user->id }}"></form>
                                <form id="down-form" action="{{ route('admin.down.status') }}" method="post">
                                    @csrf<input type="hidden" name="id" value="{{ $user->id }}"></form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="3">{{ __('ไม่มีผู้ใช้ที่ของอนุมัติสิทธิ์') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('หน่วยงาน') }}</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                        @forelse ($offices_ten as $office_t)
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">{{ $office_t->name }}</span>
                            <span
                                class="ml-auto text-right text-semibold text-reagent-gray">{{ __('จำนวนทั้งหมด: '.$office_t->users->count().' คน') }}</span>
                        </li>
                        @empty
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue text-center">{{ __('ไม่มีหน่วยงาน') }}</span>
                        </li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer border-top">
                    <div class="row">
                        <div class="col text-right view-report">
                            <a href="{{ route('admin.office') }}"
                                class="btn btn-sm bg-transparent">{{ __('ทั้งหมด') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Content -->
</div>

@endsection
