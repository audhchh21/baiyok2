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
    <div style="
    margin:auto;
    width:100%;
    ">
        <table border="1" style="border-color:black;">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align:center;width:110px;">{{ __('ร้านค้า') }}</th>
                    <th rowspan="2" style="text-align:center;width:90px;">{{ __('ตัวอย่างอาหาร') }}</th>
                    <th rowspan="2" style="text-align:center;width:90px;">{{ __('แหล่งที่มา') }}</th>
                    <th colspan="{{ $testkits->count() }}" style="text-align:center;width:auto;">{{ __('ชุดทดสอบสาร') }}</th>
                    <th rowspan="2" style="text-align:center;width:80px;">{{ __('วันที่ตรวจบันทึก') }}</th>
                    <th rowspan="2" style="text-align:center;width:80px;">{{ __('ผลดำเนินการ') }}</th>
                    <th rowspan="2" style="text-align:center;width:150px;">{{ __('ผู้ตรวจ') }}</th>
                    <th rowspan="2" style="text-align:center;width:130px;">{{ __('หน่วยงาน') }}</th>
                </tr>
                <tr>
                    @foreach ($testkits as $testkit)
                    <th style="text-align:center;width:60px;">{{ $testkit->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                @foreach ($plan->inspection->inspectiondetails as $foodtest)
                <tr>
                    <td style="text-align:center;width:110px;">{{ $plan->Shops->name }}</td>
                    <td style="text-align:center;width:90px;">{{ $foodtest->foodsample->name }}</td>
                    <td style="text-align:center;width:90px;">{{ $foodtest->foodsamplesource->name }}</td>
                    @foreach ($testkits as $testkit)
                    <td style="text-align:center;width:60px;">
                        @if ($foodtest->foodtestkit_id == $testkit->id)
                            @if ($foodtest->inspection_result == '1')
                            {{ __('ไม่พบ') }}
                            @elseif($foodtest->inspection_result == '2')
                            {{ __('พบปลอดภัย') }}
                            @elseif($foodtest->inspection_result == '3')
                            {{ __('พบไม่ปลอดภัย') }}
                            @endif
                        @endif
                    </td>
                    @endforeach
                    <td style="text-align:center;width:80px;">{{ date('d/m/Y', strtotime($plan->inspection->date)) }}</td>
                    <td style="text-align:center;width:80px;">{{ $foodtest->actuation_after ?? 'ไม่มีผลดำเนินการ' }}</td>
                    <td style="text-align:center;width:150px;">{{ $plan->to_user->Fullname }}</td>
                    <td style="text-align:center;width:130px;">{{ $plan->to_user->offices->name }}</td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
