@extends('layouts.app')

@section('titlepage', 'หน่วยงาน')

@push('style')
{{--Css Datatable bootstrap4 --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
    @include('layouts.navbar.nav.title', ['title' => 'หน่วยงาน', 'subtitle' => 'หน่วยงานทั้งหมด'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-right">
                <a href="{{ route('admin.office.create') }}" class="btn btn-info"><i
                        class="fas fa-plus-circle"></i>{{ __(' เพิ่มหน่วยงาน')   }}</a>
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
                        <th class="col-4 text-left">{{ __('คำนำหน้าชื่อ') }}</th>
                        <th class="col-5 text-left">{{ __('ที่อยู่หน่วยงาน') }}</th>
                        <th class="col-2 text-right">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offices as $office)
                    <tr>
                        <td class="col-1 text-center">{{ $count++ }}</td>
                        <td class="col-4 text-left">{{ $office->name }}</td>
                        <td class="col-5 text-left">{{ $office->Fulladdress }}</td>
                        <td class="col-2 text-right">
                            <a href="{{ route('admin.office.edit', ['id'=>$office->id]) }}" class="btn btn-warning"
                                data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></a>
                            <a href="{{ route('admin.office.delete', ['id'=>$office->id]) }}" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบ {{ $office->name }} ใช่ หรือ ไม่')"
                                data-toggle="tooltip" data-placement="top" title="ลบ"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center h3">{{ __('ไม่มีรายการ') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection