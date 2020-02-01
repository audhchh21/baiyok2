@extends('layouts.app')

@section('titlepage', 'ผลการตรวจสอบสารปนเปิ้อนยังไม่ได้ตรวจบันทึก')

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
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'ผลการตรวจสอบสารปนเปิ้อนทั้งหมด', 'subtitle' =>
    'ผลการตรวจสอบสารปนเปิ้อนทั้งหมด'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-5">
        <div class="col">
            <div class="text-left">
                <a href="#" onclick="window.location.reload(history.back());" class="btn btn-dark"><i class="fas fa-angle-double-left"></i>
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
                                @if ($plan->status == '0' && $plan->to_user_id == Auth::user()->id)
                                <a href="{{ route('member.inspectiondetail.check', ['id' => $plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ตรวจแผนงาน">
                                    <span class="text-dark pr-1">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                    {{ __('ตรวจแผนงาน') }}
                                </a>
                                <a href="{{ route('member.plan.edit', ['id' => $plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span>
                                    {{ __('แก้ไข') }}
                                </a>
                                <a href="{{ route('member.plan.delete', ['id' => $plan->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบแผนงาน {{ $plan->to_user->Fullname }} ใช่ หรือ ไม่')">
                                    <span class="text-danger pr-1">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                    {{ __('ลบ') }}
                                </a>
                                @endif
                                @if ($plan->status == '1' || $plan->status == '2')
                                <a href="{{ route('member.inspection.detail', ['id' => $plan->id]) }}" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="รายละเอียด">
                                    <span class="text-success pr-1">
                                        <i class="fas fa-info-circle"></i>
                                    </span> {{ __('รายละเอียด') }} </a>
                                @endif
                                @if (($plan->status == '1' || $plan->status == '2') && $plan->to_user_id == Auth::user()->id)
                                <a href="{{ route('member.inspection.edit', ['id' => $plan->id]) }}" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span> {{ __('แก้ไข') }} </a>
                                @endif
                                @if (($plan->status == '1' || $plan->status == '2') && $plan->createby_user_id == Auth::user()->id)
                                <a href="{{ route('member.inspection.delete', ['id' => $plan->id]) }}" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบแผนงานตรวจสอบ {{ $plan->shops->name }} ใช่ หรือ ไม่')">
                                    <span class="text-danger pr-1">
                                        <i class="far fa-trash-alt"></i>
                                    </span> {{ __('ลบ') }} </a>
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
