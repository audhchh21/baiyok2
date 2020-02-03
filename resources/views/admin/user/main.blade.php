@extends('layouts.app')

@section('titlepage', 'บัญชีผู้ใช้งาน')

@push('style')
{{--Css Datatable bootstrap4 --}}
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
        $('#tb-office').DataTable();
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'บัญชีผู้ใช้งาน', 'subtitle' => 'บัญชีผู้ใช้งานทั้งหมด'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-3">
        <div class="col">
            <div class="text-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-info"><i
                        class="fas fa-plus-circle"></i>{{ __(' เพิ่มผู้ใช้ใหม่')   }}</a>
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
            <table class="table table-hover table-bordered" id="tb-office">
                <thead class="bg-white">
                    <tr>
                        <th class="col-1 text-center">{{ __('ลำดับ') }}</th>
                        <th class="col-2 text-left">{{ __('อีเมล') }}</th>
                        <th class="col-2 text-left">{{ __('ชื่อ - นามสกุล') }}</th>
                        <th class="col-2 text-left">{{ __('หน่วยงาน') }}</th>
                        <th class="col-1 text-right">{{ __('เบอร์โทรศัพท์') }}</th>
                        <th class="col-1 text-center">{{ __('ระดับบัญชี') }}</th>
                        <th class="col-1 text-center">{{ __('สถานะบัญชี') }}</th>
                        <th class="col-1 text-center">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($users as $user)
                    <tr>
                        <td class="col-1 text-center tb-td">{{ $count++ }}</td>
                        <td class="col-2 text-left tb-td">{{ $user->email }}</td>
                        <td class="col-2 text-left tb-td">{{ $user->Fullname }}</td>
                        <td class="col-2 text-left tb-td">{{ $user->offices->name }}</td>
                        <td class="col-1 text-right tb-td">{{ $user->phone }}</td>
                        <td class="col-1 text-center tb-td">
                            @if($user->type == 'Admin')
                            <span class="badge badge-danger pl-3 pr-3 pt-2 pb-2">{{ __('ผู้ดูแลระบบ') }}</span>
                            @elseif($user->type == 'Manager')
                            <span class="badge badge-primary pl-3 pr-3 pt-2 pb-2">{{ __('ผู้บริหาร') }}</span>
                            @elseif($user->type == 'User')
                            <span class="badge badge-dark pl-3 pr-3 pt-2 pb-2">{{ __('เจ้าหน้าที่') }}</span>
                            @endif
                        </td>
                        <td class="col-1 text-center tb-td">
                            @if($user->status == '0')
                            <span class="badge badge-pill badge-warning pl-3 pr-3 pt-2 pb-2">{{ __('รอกำหนดสิทธิ์') }}</span>
                            @elseif($user->status == '1')
                            <span class="badge badge-pill badge-success pl-3 pr-3 pt-2 pb-2">{{ __('อนุมัติสิทธิ์') }}</span>
                            @elseif($user->status == '2')
                            <span class="badge badge-pill badge-danger pl-3 pr-3 pt-2 pb-2">{{ __('ยกเลิกสิทธิ์') }}</span>
                            @endif
                        </td>
                        <td class="text-center tb-td col-1">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.user.edit', ['id'=>$user->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span>
                                    {{ __('แก้ไข') }}
                                </a>
                                <a href="{{ route('admin.user.delete', ['id'=>$user->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบ {{ $user->name }} ใช่ หรือ ไม่')">
                                    <span class="text-danger pr-1">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                    {{ __('ลบ') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center h3">{{ __('ไม่มีรายการ') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
