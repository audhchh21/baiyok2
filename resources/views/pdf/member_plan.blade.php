@extends('layouts.pdf')

@section('content')
<header>
    <img src="images/web/logopdf.png" class="img-fluid mt-2" alt="" style="width:125px;height:125px;">
    <div class="text-center mt-5" style="font-size:28px">
        {{ 'หน่วยงาน '.Auth::user()->offices->name.' '.Auth::user()->offices->Fulladdress }}
    </div>
</header>
<footer class="text-right">
    <span>{{ 'วันที่ออกรายงาน '.now() }}</span>
    <span>{{ 'ผู้ออกรายงาน '.Auth::user()->Fullname }}</span>
</footer>
<main>
    <div class="container-fluid">
        <div class="row pt-5">
            <div class="col">
                <div class="text-center" style="font-size:32px">
                    {{ __('รายงานแผนงานการตรวจสอบสารปนเปื้อนในอาหาร') }}
                </div>
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-left col-3 tb-td">{{ __('ร้านค้า') }}</th>
                            <th class="text-left col-2 tb-td">{{ __('ผู้กำหนดแผนงาน') }}</th>
                            <th class="text-left col-2 tb-td">{{ __('ผู้ตรวจ') }}</th>
                            <th class="text-center col-3 tb-td">{{ __('ระยะเวลาการตรวจ') }}</th>
                            <th class="text-center col-2 tb-td">{{ __('สถานะแผนงาน') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                        <tr>
                            <td class="text-left col-3 tb-td"><span class="pl-2">{{ $plan->Shops->name }}</span></td>
                            <td class="text-left col-2 tb-td"><span class="pl-2">{{ $plan->to_user->Fullname }}</span>
                            </td>
                            <td class="text-left col-2 tb-td"><span class="pl-2">{{ $plan->by_user->Fullname }}</span>
                            </td>
                            <td class="text-center col-3 tb-td"><span class="pl-2">{{ $plan->Fulltime }}</span></td>
                            <td class="text-center col-2 tb-td">
                                @if ($plan->status == '0')
                                <span class="pl-2">{{ __('ยังไม่ได้ทำการบันทึก') }}</span>
                                @elseif($plan->status == '1')
                                <span class="pl-2">{{ __('ทำการบันทึกเรียบร้อย') }}</span>
                                @elseif($plan->status == '2')
                                <span class="pl-2">{{ __('ทำการบันทึกล่าช้า') }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
