@extends('layouts.pdf')

@section('content')
<header>
    <img src="images/web/logopdf.png" alt="" style="width:125px;height:125px;margin-top:15px;">
    <div style="font-size:28px;margin-top:15px;text-align:center;">
        {{ 'หน่วยงาน '.Auth::user()->offices->name.' '.Auth::user()->offices->Fulladdress }}
    </div>
    <div style="font-size:32px;margin-top:40px;text-align:center;">
        {{ __('รายงานแผนงานการตรวจสอบสารปนเปื้อนในอาหาร') }}
    </div>
</header>
<footer style="text-align:right">
    <span>{{ 'ผู้ออกรายงาน '.Auth::user()->Fullname.' วันที่ออกรายงาน '.now() }}</span>
</footer>
<main>

    <table border="1" style="border-color:black;width:100%;">
        <thead>
            <tr>
                <th style="text-align:center;">{{ __('ร้านค้า') }}</th>
                <th style="text-align:center;">{{ __('ผู้กำหนดแผนงาน') }}</th>
                <th style="text-align:center;">{{ __('ผู้ตรวจวิเคราะห์') }}</th>
                <th style="text-align:center;">{{ __('ระยะเวลาการตรวจ') }}</th>
                <th style="text-align:center;">{{ __('สถานะแผนงาน') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
            <tr>
                <td style="text-align:center;">{{ $plan->Shops->name }}</td>
                <td style="text-align:center;">{{ $plan->to_user->Fullname }}</td>
                <td style="text-align:center;">{{ $plan->by_user->Fullname }}</td>
                <td style="text-align:center;">{{ $plan->Fulltime }}</td>
                <td style="text-align:center;">
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
