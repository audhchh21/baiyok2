@extends('layouts.app')

@section('titlepage', 'เพิ่มแผนงาน')

@push('style')
{{-- css select2 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css">
{{-- Select2 Bootstrap4 --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
@endpush

@push('javascript')
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
{{-- javascript select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/locales/bootstrap-datepicker.th.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai.js') }}"></script>
<script>
    $(document).ready(() => {
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $('#plan_start').datepicker({language:'th-th',format:'yyyy-mm-dd'})
        $('#plan_end').datepicker({language:'th-th',format:'yyyy-mm-dd'})
        $('#user').select2()
        $('#shop').select2()
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มแผนงาน', 'subtitle' => 'เพิ่มแผนงานตรวจสอบ'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-3">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('member.plan') }}" class="btn btn-dark"><i class="fas fa-angle-double-left" data-toggle="tooltip" data-placement="right" title="หน้าแผนงาน"></i>
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
            <form action="{{ route('member.plan.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col">
                        <label for="plan_start" class="h3">{{ __('เริ่มวันที่') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="plan_start" name="plan_start" value="{{ old('plan_start') ?? date('Y-m-d') }}" placeholder="">
                    </div>
                    <div class="form-group col">
                        <label for="plan_end" class="h3">{{ __('สิ้นสุดวันที่') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="plan_end" name="plan_end" value="{{ old('plan_end') ?? date('Y-m-d') }}" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="user" class="h3">{{ __('ผู้ตรวจสอบวิเคราะห์') }}<span class="text-danger">*</span></label>
                        <select class="form-control form-control-lg" name="user" id="user">
                            @forelse ($users as $user)
                            <option {{ $user->id == Auth::user()->id ? ' selected':''}} value="{{ $user->id }}">{{ $user->Fullname }}</option>
                            @empty
                            <option>{{ __('ไม่มีผู้ใช้งาน') }}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="shop" class="h3">{{ __('ร้านค้าที่ไปตรวจ') }}<span class="text-danger">*</span></label>
                        <select class="form-control form-control-lg" name="shop" id="shop">
                            @forelse ($shops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->name.' ('.$shop->Fullname.')' }}</option>
                            @empty
                            <option>{{ __('ไม่มีร้านค้า') }}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="office" class="h3">{{ __('หน่วยงาน') }}</label>
                        <select class="form-control form-control-lg" name="office" id="office" disabled>
                            @forelse ($offices as $office)
                            <option {{ $office->id == Auth::user()->office_id ? ' selected':''}} value="{{  $office->id   }}" >{{ $office->name }}</option>
                            @empty
                            <option>{{ __('ไม่มีร้านค้า') }}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success">{{ __('เพิ่ม') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
