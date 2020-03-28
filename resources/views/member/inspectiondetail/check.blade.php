@extends('layouts.app')

@section('titlepage', 'บันทึกแผนการตรวจ')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
<style>
    .tb-td {
        vertical-align: middle !important;
    }

</style>
@endpush

@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {

        var count = 1
        var html = `
            <tr id="${count}">
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('foodsample[]', $foodsample, null, ['id' => 'foodsample', 'class' => 'form-control foodsample', 'placeholder' => '----- เลือก -----', 'required'=>'']) }}
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('foodsamplesource[]', $foodsamplesource, null, ['id' => 'foodsamplesource', 'class' => 'form-control foodsamplesource', 'placeholder' => '----- เลือก -----', 'required'=>'']) }}
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('foodtestkit[]', $foodtestkit, null, ['id' => 'foodtestkit', 'class' => 'form-control foodtestkit', 'placeholder' => '----- เลือก -----', 'required'=>'']) }}
                </td>
                <td class="text-left col-12 col-lg-1 tb-td">
                    <input type="file" class="form-control-file border p-1" id="customfile" name="uploadimage[]">
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('status[]', $check, null, ['id' => 'status', 'class' => 'form-control']) }}
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    <input type="text" class="form-control" id="" name="detail[]"  placeholder="กรณีตรวจผลสารปนเปื้อน">
                </td>
                <td class="text-center col-12 col-lg-1 tb-td">

                </td>
            </tr>
            `
        $('#tb-plandetail tbody').append(html)
        $('#remove').prop('disabled', true)

        $('#add').click(function () {
            count++
            html = `
            <tr id="tb-${count}">
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('foodsample[]', $foodsample, null, ['id' => 'foodsample', 'class' => 'form-control foodsample', 'placeholder' => '----- เลือก -----', 'required'=>'']) }}
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('foodsamplesource[]', $foodsamplesource, null, ['id' => 'foodsamplesource', 'class' => 'form-control foodsamplesource', 'placeholder' => '----- เลือก -----', 'required'=>'']) }}
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('foodtestkit[]', $foodtestkit, null, ['id' => 'foodtestkit', 'class' => 'form-control foodtestkit', 'placeholder' => '----- เลือก -----', 'required'=>'']) }}
                </td>
                <td class="text-left col-12 col-lg-1 tb-td">
                    <input type="file" class="form-control-file border p-1" id="customfile" name="uploadimage[]">
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    {{ Form::select('status[]', $check, null, ['id' => 'status', 'class' => 'form-control']) }}
                </td>
                <td class="text-left col-12 col-lg-2 tb-td">
                    <input type="text" class="form-control" id="" name="detail[]"  placeholder="กรณีตรวจผลสารปนเปื้อน">
                </td>
                <td class="text-center col-12 col-lg-1 tb-td">
                    <button type="button" class="btn btn-sm btn-dark" onclick="deleterow(${count})"><i class="far fa-times-circle"></i></button>
                </td>
            </tr>
            `
            let row = $('#tb-plandetail tbody tr').length
            $('#tb-plandetail tbody').append(html)
            if (row >= 1) {
                $('#remove').prop('disabled', false)
            }
        })
        $('#remove').click(function () {
            let row = $('#tb-plandetail tbody tr').length
            if (row > 2) {
                $('#tb-plandetail tbody tr:last').remove()
            } else if (row == 2) {
                $('#tb-plandetail tbody tr:last').remove()
                $('#remove').prop('disabled', true)
            }
            count--
        })
        $('[data-toggle="tooltip"]').tooltip();
    })

    function deleterow(count) {
        $(`#tb-${count}`).remove()
        console.log(`#tb-${count}`)
    }

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'บันทึกแผนการตรวจ'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="#" onclick="window.location.reload(history.back());" class="btn btn-secondary"><i
                        class="fas fa-angle-double-left"></i>
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
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="card pt-2">
                <table class="table">
                    <tr>
                        <td class="col-2">{{ __('ชื่อร้านค้า') }}</td>
                        <td class="col-10">{{ $plan->shops->name }}</td>
                    </tr>
                    <tr>
                        <td class="col-2">{{ __('ชื่อผู้ตรวจ') }}</td>
                        <td class="col-10">{{ $plan->to_user->Fullname }}</td>
                    </tr>
                    <tr>
                        <td class="col-2">{{ __('ระยะเวลาตรวจสอบ') }}</td>
                        <td class="col-10">{{ $plan->Fulltime }}</td>
                    </tr>
                    <tr>
                        <td class="col-2">{{ __('ผู้ออกแผนงาน') }}</td>
                        <td class="col-10">{{ $plan->by_user->Fullname }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="text-right mt-3 mb-2">
                <button type="button" class="btn bg-white text-dark p-0">
                    <i id="add" class="far fa-plus-square fa-2x"></i>
                </button>
                |
                <button type="button" class="btn bg-white text-dark p-0">
                    <i id="remove" class="far fa-minus-square fa-2x"></i>
                </button>
            </div>
            <form action="{{ route('member.inspectiondetail.confirm', ['id' => $plan->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <table id="tb-plandetail" class="table table-bordered table-striped table-hover">
                    <thead class="bg-white">
                        <tr>
                            <th class="text-left col-12 col-lg-2">{{ __('ตัวอย่างอาหาร') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('แหล่งที่มาตัวอย่างอาหาร') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('ชุดทดสอบ') }}</th>
                            <th class="text-left col-12 col-lg-1">{{ __('รูป') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('ผลการตรวจสอบ') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('แนวทางการจัดการ') }}</th>
                            <th class="text-right col-12 col-lg-1">{{ __('') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white"></tbody>
                </table>
                <hr>
                <div class="form-row justify-content-md-center">
                    <div class="col-xl-6">
                        <button type="submit" class="btn btn-block btn-success">{{ __('ตรวจบันทึก') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
