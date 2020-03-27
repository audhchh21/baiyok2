@extends('layouts.app')

@section('titlepage', 'ผลการตรวจสอบสารปนเปิ้อนทั้งหมด')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style type="text/css">
    .tb-td {
        vertical-align: middle !important;
    }

</style>
@endpush

@push('javascript')
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
        $('#tb-plan').DataTable();
        $('#edit').click( function() {
            return confirm('คุณต้องการแก้ไขข้อมูลใช่หรื่อไม่!?') ? true : false
        })
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'ผลการตรวจสอบสารปนเปิ้อนทั้งหมด'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-xl-5">
        <div class="col-12 col-xl-12">
            <div class="text-left">
                <a href="#" onclick="window.location.reload(history.back());" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i>
                    {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-row">
                            <div class="form-group col-4 mb-0">
                                <label for="start_plan">{{ __('วันที่เริ่มตรวจแผนงาน') }}</label>
                                <input type="text" class="form-control" id="start_plan" name="start_plan"
                                    value="{{ request()->start_plan ?? null }}" placeholder="วันที่เริ่มตรวจแผนงาน">
                            </div>
                            <div class="form-group col-4 mb-0">
                                <label for="end_plan">{{ __('วันที่สิ้นสุดตรวจแผนงาน') }}</label>
                                <input type="text" class="form-control" id="end_plan" name="end_plan"
                                    value="{{ request()->end_plan ?? null }}" placeholder="วันที่สิ้นสุดตรวจแผนงาน">
                            </div>
                            <div class="form-group col-2 mb-0">
                                <label for="show_plan">{{ __('การแสดงผล') }}</label>
                                {!! Form::select('show_plan', ['d1'=>'หน่วยงาน','d2'=>'ของฉัน'], request()->show_plan, ['id'=>'show_plan',
                                'class'=>'form-control']) !!}
                            </div>
                            <div class="form-group col-2 mb-0">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-block btn-success">{{ __('แสดงผล') }}</button>
                                    <button type="reset" class="btn btn-sm btn-block btn-danger">{{ __('ล้างค่า') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col">
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
            <a href="{{ route('pdf.plan.slowsuccess') }}" class="btn btn-sm btn-dark" target="_blank" data-toggle="tooltip" data-placement="right" title="ออกรายงาน PDF"><i class="fas fa-file-pdf pr-2"></i>{{ __('ออกรายงาน') }}</a>
            <div class="text-right pb-2">
                <span class="badge badge-info"><i class="far fa-calendar fa-sm pr-1"></i>{{ __('ยังไม่ได้ทำการบันทึก') }}</span>
                <span class="badge badge-info"><i class="far fa-calendar-check fa-sm pr-1"></i>{{ __('ทำการบันทึกเรียบร้อย') }}</span>
                <span class="badge badge-info"><i class="fas fa-calendar-times fa-sm pr-1"></i>{{ __('ทำการบันทึกล่าช้า') }}</span>
            </div>

            <table id="tb-plan" class="table table-bordered table-hover">
                <thead class="bg-white">
                    <tr>
                        <th class="text-center col-1">{{ __('ลำดับ') }}</th>
                        <th class="text-left col-2">{{ __('ร้านค้า') }}</th>
                        <th class="text-left col-2">{{ __('ชื่อผู้ตรวจ') }}</th>
                        <th class="text-center col-3">{{ __('ระยะเวลาตรวจ') }}</th>
                        <th class="text-center col-2">{{ __('สถานะแผนงาน') }}</th>
                        <th class="text-center col-2">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($plans as $plan)
                    <tr>
                        <td class="text-center col-1 tb-td">{{ $count++ }}</td>
                        <td class="text-left col-2 tb-td">{{ $plan->shops->name }}</td>
                        <td class="text-left col-2 tb-td">{{ $plan->to_user->Fullname }}</td>
                        <td class="text-center col-3 tb-td">{{ $plan->Fulltime }}</td>
                        <td class="text-center col-2 tb-td">
                            @if ($plan->status == '0')
                            <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="right" title="ยังไม่ได้ทำการบันทึก"><i class="far fa-calendar fa-lg m-1"></i></span>
                            @elseif ($plan->status == '1')
                            <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="right" title="ทำการบันทึกเรียบร้อย"><i class="far fa-calendar-check fa-lg m-1"></i></span>
                            @elseif ($plan->status == '2')
                            <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="right" title="ทำการบันทึกล่าช้า"><i class="fas fa-calendar-times fa-lg m-1"></i></span>
                            @endif
                        </td>
                        <td class="text-center col-2 tb-td">
                            <div class="btn-group btn-group-sm">
                                @if ($plan->status == '0' && $plan->to_user_id == auth()->user()->id)
                                <a href="{{ route('member.inspectiondetail.check', ['id' => $plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="บันทึกผลตรวจ">
                                    <span class="text-dark pr-1">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                @endif
                                @if($plan->status == '0' && $plan->createby_user_id == auth()->user()->id)
                                <a href="{{ route('member.plan.edit', ['id' => $plan->id]) }}" class="btn btn-white" id="edit"
                                    data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span>
                                </a>
                                @endif
                                @if($plan->status == '0' && $plan->createby_user_id == auth()->user()->id)
                                <a href="{{ route('member.plan.delete', ['id' => $plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบแผนงาน {{ $plan->to_user->Fullname }} ใช่ หรือ ไม่')">
                                    <span class="text-danger pr-1">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                </a>
                                @endif
                                @if ($plan->status == '1' || $plan->status == '2')
                                <a href="{{ route('member.inspection.detail', ['id' => $plan->inspection->id]) }}" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="รายละเอียด">
                                    <span class="text-success pr-1">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </a>
                                @endif
                                @if (($plan->status == '1' || $plan->status == '2') && $plan->to_user_id == auth()->user()->id)
                                <a href="{{ route('member.inspection.edit', ['id' => $plan->inspection->id]) }}" class="btn btn-white" id="edit" data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span>
                                 </a>
                                @endif
                                @if (($plan->status == '1' || $plan->status == '2') && $plan->createby_user_id == auth()->user()->id)
                                <a href="{{ route('member.inspection.delete', ['id' => $plan->id]) }}" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบแผนงานตรวจสอบ {{ $plan->shops->name }} ใช่ หรือ ไม่')">
                                    <span class="text-danger pr-1">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center col"><span
                                class="h3">{{ __('ไม่มีผลการตรวจสอบสารปนเปิ้อน') }}</span></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
