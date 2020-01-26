@extends('layouts.guest')

@section('titlepage', 'เข้าสู่ระบบ')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow pt-3 mb-5">
                <div class="card-header text-center h3 text-white bg-success">{{ __('บัญชีของคุณยังไม่ได้รับอนุมัติธิ์') }}</div>

                <div class="card-body text-center pb-5">
                   <h1 class="pt-5">{{ __('บัญชีของคุณยังไม่ได้รับอนุมัติธิ์') }}</h1>
                    <a href="{{ route('logout') }}" class="text-dark" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{  __('กลับไปยังหน้าหลัก')   }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
