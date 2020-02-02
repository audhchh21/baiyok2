@extends('layouts.app')

@section('titlepage', 'แก้ไขตัวอย่างอาหาร')

@push('style')

@endpush

@push('javascript')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขตัวอย่างอาหาร', 'subtitle' => 'แก้ไขตัวอย่างอาหาร'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="text-left">
        <a href="{{ route('member.foodsamplesource') }}" class="btn btn-dark" data-toggle="tooltip"
            data-placement="right" title="หน้าแหล่งที่มาตัวอย่างอาหาร"><i class="fas fa-angle-double-left"></i>
            {{ __('ย้อนกลับ')   }}</a>
        <hr>
    </div>
    <div class="row">
        <div class="col-12 col-xl-4">
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
            <form action="{{ route('member.foodsamplesource.update', ['id' => $foodsamplesource->id]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="foodsamplesource" class="h3">{{ __('ตัวอย่างอาหาร') }}</label>
                        <input type="text" id="foodsamplesource" class="form-control form-control-lg" name="name"
                            value="{{ old('name') ?? $foodsamplesource->name }}"
                            placeholder="{{ $foodsamplesource->name }}" required>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-block btn-lg btn-success">{{ __('เพิ่ม') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
