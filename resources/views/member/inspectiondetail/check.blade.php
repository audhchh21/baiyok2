@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขหน่วยงาน', 'subtitle' => 'แก้ไขหน่วยงาน'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <h1>Hello World</h1>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
