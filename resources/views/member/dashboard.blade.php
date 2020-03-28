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
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'หน้าแรก'])

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
    <div class="row mb-3">
        <div class="col-12 col-xl-7">
            <div class="card h-100">
                <div class="card-body">
                    {!! $testkidchart->render() !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="card h-100">
                <div class="card-header">
                    <span class="h3">{{ __('แผนงานที่ต้องตรวจสอบ') }}</span>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12 col-xl-12">
            <div class="card h-100">
                <div class="card-header">
                    <span class="h3">{{ __('แผนงานที่ต้องตรวจสอบ') }}</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-center col-3">{{ __('ร้านค้า') }}</th>
                                <th class="text-center col-3">{{ __('ระยะเวลา') }}</th>
                                <th class="text-center col-3">{{ __('ผู้กำหนดแผนงาน') }}</th>
                                <th class="text-center col-1">{{ __('สถานะ') }}</th>
                                <th class="text-center col-2">{{ __('การจัดการ') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($plans as $plan)
                            <tr>
                                <td class="text-center col-3 tb-td">{{ $plan->shops->name }}</td>
                                <td class="text-center col-3 tb-td">{{ $plan->Fulltime }}</td>
                                <td class="text-center col-3 tb-td">{{ $plan->by_user->Fullname }}</td>
                                <td class="text-center col-1 tb-td">
                                    @if ($plan->status == '0')
                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                        title="ยังไม่ได้ทำการบันทึก"><i class="far fa-calendar fa-lg m-1"></i></span>
                                    @elseif ($plan->status == '1')
                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                        title="ทำการบันทึกเรียบร้อย"><i
                                            class="far fa-calendar-check fa-lg m-1"></i></span>
                                    @elseif ($plan->status == '2')
                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                        title="ทำการบันทึกล่าช้า"><i class="fas fa-calendar-times fa-lg m-1"></i></span>
                                    @endif
                                </td>
                                <td class="text-center col-2 tb-td">
                                    <div class="btn-group btn-group-sm">
                                        @if ($plan->status == '0' && $plan->to_user_id == Auth::user()->id)
                                        <a href="{{ route('member.inspectiondetail.check', ['id' => $plan->id]) }}"
                                            class="btn btn-white" data-toggle="tooltip" data-placement="top"
                                            title="บันทึกผลตรวจ">
                                            <span class="text-dark pr-1">
                                                <i class="fas fa-check-square"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('member.plan.edit', ['id' => $plan->id]) }}"
                                            class="btn btn-white" data-toggle="tooltip" data-placement="top"
                                            title="แก้ไข">
                                            <span class="text-warning pr-1">
                                                <i class="far fa-edit"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('member.plan.delete', ['id' => $plan->id]) }}"
                                            class="btn btn-white" data-toggle="tooltip" data-placement="top" title="ลบ"
                                            onclick="return confirm('คุณต้องการลบแผนงาน {{ $plan->to_user->Fullname }} ใช่ หรือ ไม่')">
                                            <span class="text-danger pr-1">
                                                <i class="far fa-trash-alt"></i>
                                            </span>
                                        </a>
                                        @endif
                                        @if ($plan->status == '1' || $plan->status == '2')
                                        <a href="{{ route('member.inspection.detail', ['id' => $plan->inspection->id]) }}"
                                            class="btn btn-white" data-toggle="tooltip" data-placement="top"
                                            title="รายละเอียด">
                                            <span class="text-success pr-1">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                        </a>
                                        @endif
                                        @if (($plan->status == '1' || $plan->status == '2') && $plan->to_user_id ==
                                        Auth::user()->id)
                                        <a href="{{ route('member.inspection.edit', ['id' => $plan->inspection->id]) }}"
                                            class="btn btn-white" data-toggle="tooltip" data-placement="top"
                                            title="แก้ไข">
                                            <span class="text-warning pr-1">
                                                <i class="far fa-edit"></i>
                                            </span>
                                        </a>
                                        @endif
                                        @if (($plan->status == '1' || $plan->status == '2') && $plan->createby_user_id
                                        == Auth::user()->id)
                                        <a href="{{ route('member.inspection.delete', ['id' => $plan->id]) }}"
                                            class="btn btn-white" data-toggle="tooltip" data-placement="top" title="ลบ"
                                            onclick="return confirm('คุณต้องการลบแผนงานตรวจสอบ {{ $plan->shops->name }} ใช่ หรือ ไม่')">
                                            <span class="text-danger pr-1">
                                                <i class="far fa-trash-alt"></i>
                                            </span>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center"><span
                                        class="h3">{{ __('ไม่มีแผนงานที่ต้องตรวจสอบ') }}</span></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
