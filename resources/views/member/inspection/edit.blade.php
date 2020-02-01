@extends('layouts.app')

@section('titlepage', 'แก้ไขรายละเอียดแผนงาน')

@push('style')
<style type="text/css">
    .tb-td {
        vertical-align: middle !important;
    }

</style>
@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขรายละเอียดแผนงาน', 'subtitle' => 'แก้ไขรายละเอียดแผนงาน'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-5">
        <div class="col">
            <div class="text-left">
                <a href="#" onclick="window.location.reload(history.back());" class="btn btn-dark"><i class="fas fa-angle-double-left"></i>
                    {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
            <span class="h3">{{ __('รายละเอียดแผนงาน') }}</span>
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('ชื่อร้านค้า') }}</td>
                            <td class="col-8 col-xl-10">{{ $inspection->plan->Shops->name }}</td>
                        </tr>
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('ชื่อเจ้าของร้าน') }}</td>
                            <td class="col-8 col-xl-10">{{ $inspection->plan->shops->Fullname }}</td>
                        </tr>
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('ที่อยู่ร้านค้า') }}</td>
                            <td class="col-8 col-xl-10">{{ $inspection->plan->shops->Fulladdress }}</td>
                        </tr>
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('ชื่อผู้ตรวจ') }}</td>
                            <td class="col-8 col-xl-10">{{ $inspection->plan->to_user->Fullname }}</td>
                        </tr>
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('ชื่อผู้ออกแผนตรวจ') }}</td>
                            <td class="col-8 col-xl-10">{{ $inspection->plan->by_user->Fullname }}</td>
                        </tr>
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('ระยะเวลาตรวจ') }}</td>
                            <td class="col-8 col-xl-10">{{ $inspection->plan->Fulltime }}</td>
                        </tr>
                        <tr>
                            <td class="col-4 col-xl-2">{{ __('สถานะแผนงาน') }}</td>
                            <td class="col-8 col-xl-10">
                                @if ($inspection->plan->status == '0')
                                <span class="badge badge-info"><i class="far fa-calendar fa-sm pr-1"></i>{{ __('ยังไม่ได้ทำการบันทึก') }}</span>
                                @elseif ($inspection->plan->status == '1')
                                <span class="badge badge-info"><i class="far fa-calendar-check fa-sm pr-1"></i>{{ __('ทำการบันทึกเรียบร้อย') }}</span>
                                @elseif ($inspection->plan->status == '2')
                                <span class="badge badge-info"><i class="fas fa-calendar-times fa-sm pr-1"></i>{{ __('ทำการบันทึกล่าช้า') }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <span class="h3">{{ __('รายการตรวจสอบ') }}</span>
            <form action="{{ route('member.inspectiondetail.update', ['id' => $inspection->id]) }}" method="post">
                @csrf
                <table class="table table-hover table-bordered table-striped">
                    <thead class="bg-white">
                        <tr>
                            <th class="text-left col-12 col-lg-2">{{ __('ตัวอย่างอาหาร') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('ชุดทดสอบ') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('แหล่งที่มาตัวอย่างอาหาร') }}</th>
                            <th class="text-center col-12 col-lg-2">{{ __('รูป') }}</th>
                            <th class="text-center col-12 col-lg-2">{{ __('ผลการตรวจสอบ') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('หมายเหตุ') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($inspection->inspectiondetails as $detail)
                        <tr>
                            <td class="tb-td text-left col-12 col-lg-2">
                                {!! Form::select('foodsample[]', $foodsample, $detail->foodsample->id, ['id' => 'foodsample', 'class' => 'form-control']) !!}
                            </td>
                            <td class="tb-td text-left col-12 col-lg-2">
                                {!! Form::select('foodsamplesource[]', $foodsamplesource, $detail->foodsamplesource->id, ['id' => 'foodsamplesource', 'class' => 'form-control']) !!}
                            </td>
                            <td class="tb-td text-left col-12 col-lg-2">
                                {!! Form::select('foodtestkit[]', $foodtestkit, $detail->foodtestkit->id, ['id' => 'foodtestkit', 'class' => 'form-control']) !!}
                            </td>
                            <td class="tb-td text-center col-12 col-lg-2">
                                <img src="{{ asset('images/uploads').'/'.$detail->inspection_image }}" class="img-fluid" alt="" style="max-height:60px;">
                                <input type="file" class="form-control-file border p-1" id="customfile" name="uploadimage[]">
                            </td>
                            <td class="tb-td text-center col-12 col-lg-2">
                                {!! Form::select('status[]', $check, $detail->inspection_result, ['id' => 'status', 'class' => 'form-control']) !!}
                            </td>
                            <td class="tb-td text-left col-12 col-lg-2">
                                <input type="text" class="form-control" id="detail" name="detail[]" value="{{ $detail->actuation_after }}" placeholder="{{ $detail->actuation_after ?? 'ไม่มีหมายเหตุ' }}">
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="col-12 text-center"><span class="h3">{{ __('ไม่มีรายการตรวจสอบ') }}</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="text-left">
                    <button type="submit" class="btn btn-lg btn-block btn-success">{{ __('บันทึก') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
