@extends('layouts.pdf')

@section('content')
<header class="text-center mt-3">
    <img src="images/web/logopdf.png" alt="" style="width:155px;height:155px;">
    <p style="font-size:24px;font-weight: bold;">{{ __('รายงานตรวจสอบสารปนเปื้อนในระดับอำเภอ') }}</p>
    <p style="font-size:18px;">{{ 'หน่วยงาน '.Auth::user()->offices->name.' '.Auth::user()->offices->Fulladdress }}</p>
</header>
<footer class="text-right">
    <span>{{ 'ผู้ออกรายงาน '.Auth::user()->Fullname.' วันที่ออกรายงาน '.now() }}</span>
</footer>
<main>
    <table class="table-bordered mt-2" style="table-layout:fixed; width:100%;">
        <thead>
            <tr>
                <th class="text-left px-2 py-1" rowspan="2">{{ __('อำเภอ') }}</th>
                <th class="text-left px-2 py-1" rowspan="2">{{ __('ตัวอย่างอาหาร') }}</th>
                <th class="text-center px-2 py-1" colspan="{{ $testkits->count() }}">{{ __('ชุดทดสอบสาร') }}</th>
                <th class="text-center px-2 py-1" rowspan="2">{{ __('วันที่ตรวจบันทึก') }}</th>
                <th class="text-left px-2 py-1" rowspan="2">{{ __('ผลดำเนินการ') }}</th>
                <th class="text-left px-2 py-1" rowspan="2">{{ __('ผู้ตรวจ') }}</th>
            </tr>
            <tr>
                @foreach ($testkits as $testkit)
                <th class="text-center px-1 py-1 ">{{ $testkit->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
            <tr>
                <td class="text-left px-2 py-1" style="width:15%;">
                    {{ $plan->district->name}}</td>
                <td class="text-left px-2 py-1" style="width:10%;">{{ $plan->inspectiondetail->foodsample->name }}</td>
                @foreach ($testkits as $testkit)
                <td class="text-center px-1 py-1">
                    @if ($plan->inspectiondetail->foodtestkit_id == $testkit->id)
                    @if ($plan->inspectiondetail->inspection_result == '1')
                    {{ __('ไม่พบ') }}
                    @elseif($plan->inspectiondetail->inspection_result == '2')
                    {{ __('พบปลอดภัย') }}
                    @elseif($plan->inspectiondetail->inspection_result == '3')
                    {{ __('พบไม่ปลอดภัย') }}
                    @endif
                    @endif
                </td>
                @endforeach
                <td class="text-center px-2 py-1" style="width:10%;">
                    {{ $plan->inspectiondetail->created_at->format('d/m/Y H:i') }}</td>
                <td class="text-left px-2 py-1" style="width:15%;">
                    {{ $plan->inspectiondetail->inspection->plan->to_user->fullname }}</td>
                <td class="text-left px-2 py-1" style="width:15%;">
                    {{ $plan->inspectiondetail->inspection->plan->by_user->fullname }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
