@extends('layouts.app')

@section('titlepage', 'บันทึกแผนการตรวจ')

@push('style')

@endpush

@push('javascript')
<script>
    $(document).ready( function () {
        var i = 1 // row
        var html = `
            <tr id="${i++}">
                <td class="text-left col-12 col-lg-2">
                    <div class="form-group">
                        {{ Form::select('foodsample[]', $foodsample, null, ['id' => 'foodsample', 'class' => 'form-control']) }}
                    </div>
                </td>
                <td class="text-left col-12 col-lg-2">
                    {{ Form::select('foodsamplesoure[]', $foodsamplesoure, null, ['id' => '', 'class' => 'form-control']) }}
                </td>
                <td class="text-left col-12 col-lg-2">
                    {{ Form::select('foodtestkit[]', $foodtestkit, null, ['id' => '', 'class' => 'form-control']) }}
                </td>
                <td class="text-left col-12 col-lg-2">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="uploadimage[]">
                        <label class="custom-file-label" for="customFile">เลือกไฟล์</label>
                    </div>
                </td>
                <td class="text-left col-12 col-lg-2">
                    {{ Form::select('status[]', $check, null, ['id' => 'status', 'class' => 'form-control']) }}
                </td>
                <td class="text-left col-12 col-lg-2">
                    <input type="text" class="form-control" id="" name="detail[]"  placeholder="หมายเหตุ">
                </td>
            </tr>
            `
            $('#tb-plandetail tbody').append(html)

        $('#add').click( function () {
            $('#tb-plandetail tbody').append(html)
        })

        $('#remove').click( function() {
            let row = $('#tb-plandetail tbody tr').length
            if(row > 1)
            {
                $('#tb-plandetail tbody tr:last').remove()
            }else{
                alert('ไม่สามารถลบได้!!')
            }
        })

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName); 
        });
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'บันทึกแผนการตรวจ', 'subtitle' => 'บันทึกรายละเอียดแผนการตรวจ'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('member.plan') }}" class="btn btn-dark"><i class="fas fa-angle-double-left"></i>
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
                        <td>{{ __('ชื่อร้านค้า') }}</td>
                        <td>{{ $plan->shops->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('ชื่อผู้ตรวจ') }}</td>
                        <td>{{ $plan->to_user->Fullname }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('ระยะเวลาตรวจสอบ') }}</td>
                        <td>{{ $plan->Fulltime }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('ผู้ออกแผนงาน') }}</td>
                        <td>{{ $plan->by_user->Fullname }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="text-right mt-3 mb-2">
                <button type="button" id="add" class="btn btn-sm btn-dark"><i class="far fa-plus-square"></i></button>
                <button type="button" id="remove" class="btn btn-sm btn-dark"><i class="far fa-minus-square"></i></button>
            </div>
            <form action="{{ route('member.inspectiondetail.confirm', ['id' => $plan->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <table id="tb-plandetail" class="table table-bordered table-striped table-hover">
                    <thead class="bg-white">
                        <tr>
                            <th class="text-left col-12 col-lg-2">{{ __('ตัวอย่างอาหาร') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('ชุดทดสอบ') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('แหล่งที่มาตัวอย่างอาหาร') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('รูป') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('ผลการตรวจสอบ') }}</th>
                            <th class="text-left col-12 col-lg-2">{{ __('หมายเหตุ') }}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <hr>
                <button type="submit" class="btn btn-block btn-lg btn-success">{{ __('ตรวจบันทึก') }}</button>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
