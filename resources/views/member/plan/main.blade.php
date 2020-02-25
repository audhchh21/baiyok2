@extends('layouts.app')

@section('titlepage', 'แผนงาน')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style type="text/css">
    .tb-td {
        vertical-align: middle !important;
    }

</style>
@endpush

@push('javascript')
<!-- thai extension -->
{{-- javascript Datatable bootstrap4 --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
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

        $('#start_plan').datepicker({
            language:'th-th',
            format:'dd-mm-yyyy',
        }).on('changeDate', function(e) {
            // console.log(e.format())
            $('#end_plan').datepicker('setStartDate', e.format());
        });

        $('#end_plan').datepicker({
            language:'th-th',
            format:'dd-mm-yyyy',
        }).on('changeDate', function(e) {
            // console.log(e.format())
            $('#start_plan').datepicker('setEndDate', e.format());
        });
    });

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แผนงาน'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-3">
        <div class="col-xl-12">
            <div class="text-right">
                <a href="{{ route('member.plan.create') }}" class="btn btn-info"><i
                        class="fas fa-plus-circle"></i>{{ __('เพิ่มแผนงาน')   }}</a>
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
                    {{ request()->start_plan }}
                    <form action="/" method="get">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-3 mb-0">
                                <label for="start_plan">{{ __('วันที่เริ่มตรวจแผนงาน') }}</label>
                                <input type="text" class="form-control" id="start_plan" name="start"
                                    value="{{ old('start_plan') ?? null }}" placeholder="" required>
                            </div>
                            <div class="form-group col-3 mb-0">
                                <label for="end_plan">{{ __('วันที่สิ้นสุดตรวจแผนงาน') }}</label>
                                <input type="text" class="form-control" id="end_plan" name="end"
                                    value="{{ old('end_plan') ?? null }}" placeholder="" required>
                            </div>
                            <div class="form-group col-2 mb-0">
                                <label for="status_plan">{{ __('สถานะแผนงาน') }}</label>
                                {!! Form::select('status_plan',
                                ['s1'=>'แสดงทั้งหมด','s2'=>'ตรวจแล้ว','s3'=>'ยังไม่ได้ตรวจ','s4'=>'ตรวจล่าช้า',], old('status_plan'),
                                ['id'=>'status_plan', 'class'=>'form-control']) !!}
                            </div>
                            <div class="form-group col-2 mb-0">
                                <label for="show_plan">{{ __('การแสดงผล') }}</label>
                                {!! Form::select('show_plan', ['d1'=>'หน่วยงาน','d2'=>'ของฉัน'], old('show_plan'), ['id'=>'show_plan',
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
    <div class="row mb-5">
        <div class="col-12 col-xl-12">
            <table id="tb-plan" class="table table-hover table-bordered">
                <thead class="bg-white">
                    <tr>
                        <th class="text-center">{{ __('ลำดับ') }}</th>
                        <th class="text-left">{{ __('ร้านค้า') }}</th>
                        <th class="text-left">{{ __('ชื่อผู้ตรวจ') }}</th>
                        <th class="text-left">{{ __('ชื่อผู้ออกแผนตรวจ') }}</th>
                        <th class="text-center">{{ __('ระยะเวลา') }}</th>
                        <th class="text-center">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($plans as $plan)
                    <tr>
                        <td class="text-center tb-td">{{ $count++ }}</td>
                        <td class="text-left tb-td">{{ $plan->shops->name }}</td>
                        <td class="text-left tb-td">{{ $plan->to_user->Fullname }}</td>
                        <td class="text-left tb-td">{{ $plan->by_user->Fullname }}</td>
                        <td class="text-center tb-td">{{ $plan->Fulltime }}</td>
                        <td class="text-center tb-td col-1">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('member.inspectiondetail.check', ['id'=>$plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ตรวจแผนงาน">
                                    <span class="text-dark pr-1">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a href="{{ route('member.plan.edit', ['id'=>$plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span>
                                </a>
                                <a href="{{ route('member.plan.delete', ['id'=>$plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบแผนงาน {{ $plan->to_user->Fullname }} ใช่ หรือ ไม่')">
                                    <span class="text-danger pr-1">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center tb-td"><span class="h3">{{ __('ไม่มีแผนงานตรวจสอบ') }}</span></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
