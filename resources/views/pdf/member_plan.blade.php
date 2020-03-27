@extends('layouts.pdf')

@section('content')
<header class="text-center mt-3">
    <img src="images/web/logopdf.png" alt="" style="width:155px;height:155px;">
    <p style="font-size:24px;font-weight: bold;">{{ __('รายงานแผนงานการตรวจสอบสารปนเปื้อนในอาหาร') }}</p>
    <p style="font-size:18px;">{{ 'หน่วยงาน '.Auth::user()->offices->name.' '.Auth::user()->offices->Fulladdress }}</p>
</header>
<footer class="text-right">
    <span>{{ 'ผู้ออกรายงาน '.Auth::user()->Fullname.' วันที่ออกรายงาน '.now() }}</span>
</footer>
<main>
    <table class="table-bordered mt-2" style="table-layout:fixed; width:100%;">
        <thead>
            <tr>
                <th class="text-left px-2 py-1">{{ __('ร้านค้า') }}</th>
                <th class="text-left px-2 py-1">{{ __('ผู้กำหนดแผนงาน') }}</th>
                <th class="text-left px-2 py-1">{{ __('ผู้ตรวจวิเคราะห์') }}</th>
                <th class="text-center px-2 py-1">{{ __('ระยะเวลาการตรวจ') }}</th>
                <th class="text-center px-2 py-1">{{ __('สถานะแผนงาน') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
            <tr>
                <td class="text-left px-2 py-1">{{ $plan->Shops->name }}</td>
                <td class="text-left px-2 py-1">{{ $plan->to_user->Fullname }}</td>
                <td class="text-left px-2 py-1">{{ $plan->by_user->Fullname }}</td>
                <td class="text-center px-2 py-1">{{ $plan->Fulltime }}</td>
                <td class="text-center px-2 py-1">
                    @if ($plan->status == '0')
                    {{ __('ยังไม่ได้ทำการบันทึก') }}
                    @elseif($plan->status == '1')
                    {{ __('ทำการบันทึกเรียบร้อย') }}
                    @elseif($plan->status == '2')
                    {{ __('ทำการบันทึกล่าช้า') }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
