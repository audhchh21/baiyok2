@extends('layouts.app')

@section('titlepage', 'แก้ไขแผนงาน')

@push('style')
{{-- css select2 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css">
{{-- Select2 Bootstrap4 --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
@endpush

@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/locales/bootstrap-datepicker.th.js') }}"></script>
<script>
    $(document).ready(() => {
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $('#user').select2()
        $('#shop').select2()
        $('#plan_start').datepicker({
            language:'th-th',
            format:'dd-mm-yyyy',
        }).on('changeDate', function(e) {
            // console.log(e.format())
            $('#plan_end').datepicker('setStartDate', e.format())
        })
        $('#plan_end').datepicker({
            language:'th-th',
            format:'dd-mm-yyyy',
        }).on('changeDate', function(e) {
            // console.log(e.format())
            $('#plan_start').datepicker('setEndDate', e.format())
        })
        $('#save').click( function() {
            return confirm('คุณต้องการบันทึกข้อมูลใช่หรื่อไม่!?') ? true : false
        })
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มแผนงาน'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-3">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('member.plan') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i>
                    {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
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
            <form action="{{ route('member.plan.update', ['id' => $plan->id]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col">
                        <label for="office" class="h4">{{ __('หน่วยงาน') }}</label>
                        <select class="form-control form-control-lg" name="office" id="office" disabled>
                            @forelse ($offices as $office)
                            <option {{ $office->id == Auth::user()->office_id ? ' selected':''}}
                                value="{{  $office->id   }}">{{ $office->name }}</option>
                            @empty
                            <option>{{ __('ไม่มีร้านค้า') }}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="plan_start" class="h5">{{ __('เริ่มวันที่') }}<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="plan_start" name="plan_start"
                            value="{{ old('plan_start') ?? substr($plan->plan_start, 0, 10) }}" data-date-start-date="0d" placeholder="{{ substr($plan->plan_start, 0, 10) }}">
                    </div>
                    <div class="form-group col">
                        <label for="plan_end" class="h5">{{ __('สิ้นสุดวันที่') }}<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="plan_end" name="plan_end"
                            value="{{ old('plan_end') ?? substr($plan->plan_end, 0, 10) }}" data-date-start-date="0d" placeholder="{{ substr($plan->plan_end, 0, 10) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="user" class="h5">{{ __('ผู้ตรวจสอบวิเคราะห์') }}<span
                                class="text-danger">*</span></label>
                        <select class="form-control form-control-lg" name="user" id="user">
                            @forelse ($users as $user)
                            <option {{ $user->id == $plan->user_id ? ' selected':''}} value="{{ $user->id }}">
                                {{ $user->Fullname }}</option>
                            @empty
                            <option>{{ __('ไม่มีผู้ใช้งาน') }}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="shop" class="h5">{{ __('ร้านค้าที่ไปตรวจ') }}<span
                                class="text-danger">*</span></label>
                        <select class="form-control form-control-lg" name="shop" id="shop">
                            @forelse ($shops as $shop)
                            <option {{ $shop->id == $plan->shop_id ? ' selected':''}} value="{{ $shop->id }}">
                                {{ $shop->name.' ('.$shop->Fullname.')' }}</option>
                            @empty
                            <option>{{ __('ไม่มีร้านค้า') }}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success" id="save">{{ __('แก้ไข') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
