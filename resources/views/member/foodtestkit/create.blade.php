@extends('layouts.app')

@section('titlepage', 'แก้ไขตัวอย่างอาหาร')

@push('style')

@endpush

@push('javascript')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#save').click( function() {
            return confirm('คุณต้องการบันทึกข้อมูลใช่หรื่อไม่!?') ? true : false
        })
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'เพิ่มตัวอย่างอาหาร'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="text-left">
        <a href="{{ route('member.foodtestkit') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i>
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
    <div class="row">
        <div class="col-12 col-xl-4">
            <form action="{{ route('member.foodtestkit.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="foodtestkit" class="h3">{{ __('ตัวอย่างอาหาร') }}</label>
                        <input type="text" id="foodtestkit" class="form-control form-control-lg" name="name"
                            value="{{ old('name') }}" placeholder="ตัวอย่างอาหาร"
                            required>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-block btn-lg btn-success" id="save">{{ __('เพิ่ม') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
