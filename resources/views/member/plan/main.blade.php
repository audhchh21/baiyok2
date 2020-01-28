@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style type="text/css">
    .tb-td {
        vertical-align: middle !important;
    }

</style>
@endpush

@push('javascript')
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<!-- thai extension -->
{{-- javascript Datatable bootstrap4 --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/locales/bootstrap-datepicker.th.js') }}" charset="UTF-8"></script>
<script>
    $(document).ready(() => {
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดงทั้งหมด: _MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด (_TOTAL_) แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('#tb-plan').DataTable();
        $('#start-plan').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy'
        })
        $('#end-plan').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy'
        })
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขหน่วยงาน', 'subtitle' => 'แก้ไขหน่วยงาน'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-3">
        <div class="col-xl-12">
            <div class="text-right">
                <a href="{{ route('member.plan.create') }}" class="btn btn-info"><i
                        class="fas fa-plus-circle"></i>{{ __(' เพิ่มแผนงาน')   }}</a>
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
    <div class="row mb-xl-5">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-3 mb-0">
                                <label for="start-plan">{{ __('วันที่เริ่มตรวจแผนงาน') }}</label>
                                <input type="text" class="form-control" id="start-plan" name="start"
                                    value="{{ old('start') ?? date('Y-m-d') }}" placeholder="" required>
                            </div>
                            <div class="form-group col-3 mb-0">
                                <label for="end-plan">{{ __('วันที่สิ้นสุดตรวจแผนงาน') }}</label>
                                <input type="text" class="form-control" id="end-plan" name="end"
                                    value="{{ old('start') ?? date('Y-m-d') }}" placeholder="" required>
                            </div>
                            <div class="form-group col-2 mb-0">
                                <label for="end-plan">{{ __('สถานะแผนงาน') }}</label>
                                {!! Form::select('',
                                ['s1'=>'แสดงทั้งหมด','s2'=>'ตรวจแล้ว','s3'=>'ยังไม่ได้ตรวจ','s4'=>'ตรวจล่าช้า',], null,
                                ['id'=>'', 'class'=>'form-control']) !!}
                            </div>
                            <div class="form-group col-2 mb-0">
                                <label for="end-plan">{{ __('การแสดงผล') }}</label>
                                {!! Form::select('', ['d1'=>'หน่วยงาน','d2'=>'ของฉัน'], null, ['id'=>'',
                                'class'=>'form-control']) !!}
                            </div>
                            <div class="form-group col-2 mb-0">
                                <div class="text-center">
                                    <a href="" class="btn btn-sm btn-block btn-success">{{ __('แสดงผล') }}</a>
                                    <button type="reset"
                                        class="btn btn-sm btn-block btn-danger">{{ __('ล้างค่า') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-xl-12">
            <table id="tb-plan" class="table table-hover table-bordered">
                <thead class="bg-white">
                    <tr>
                        <th class="text-center">{{ __('ลำดับ') }}</th>
                        <th class="text-left">{{ __('ร้านค้า') }}</th>
                        <th class="text-left">{{ __('ชื่อผู้ตรวจ') }}</th>
                        <th class="text-left">{{ __('ชื่อผู้ออกแผนตรวจ') }}</th>
                        <th class="text-center">{{ __('ระยะเวลา') }}</th>
                        <th class="text-right">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plans as $plan)
                    <tr>
                        <td class="text-center tb-td">{{ $count++ }}</td>
                        <td class="text-left tb-td">{{ $plan->shops->name }}</td>
                        <td class="text-left tb-td">{{ $plan->to_user->Fullname }}</td>
                        <td class="text-left tb-td">{{ $plan->by_user->Fullname }}</td>
                        <td class="text-center tb-td">{{ $plan->Fulltime }}</td>
                        <td class="text-right tb-td">
                            <a href="{{ url('/') }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top"
                                title="ตรวจแผนงาน"><i class="far fa-edit"></i></a>
                            <a href="{{ route('member.plan.edit', ['id'=>$plan->id]) }}" class="btn btn-warning"
                                data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></a>
                            <a href="{{ route('member.plan.delete', ['id'=>$plan->id]) }}" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบแผนงาน {{ $plan->to_user->Fullname }} ใช่ หรือ ไม่')"
                                data-toggle="tooltip" data-placement="top" title="ลบ"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center tb-td"><span class="h3">{{ __('ไม่มีแผนงาน') }}</span></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
