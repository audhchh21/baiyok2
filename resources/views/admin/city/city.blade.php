@extends('layouts.app')

@section('titlepage', 'จังหวัดทั้งหมด')

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

        $('#tb-city').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'จังหวัดทั้งหมด'])

    <!-- End Page Header -->

    <!-- Start Content -->
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
    <div class="row mb-5">
        <div class="col">
            <div class="text-right">
                <a href="{{ route('admin.province') }}" class="btn btn-sm btn-info"><i class="fas fa-th-list pr-2"></i>{{ __('จัดการจังหวัด') }}</a>
                <a href="{{ route('admin.district') }}" class="btn btn-sm btn-info"><i class="fas fa-th-list pr-2"></i>{{ __('จัดการอำเภอ') }}</a>
                <a href="{{ route('admin.subdistrict') }}" class="btn btn-sm btn-info"><i class="fas fa-th-list pr-2"></i>{{ __('จัดการตำบล') }}</a>
            </div>
            <hr>
            <table class="table table-hover table-bordered" id="tb-city">
                <thead class="bg-white">
                    <tr>
                        <th class="text-left">{{ __('จังหวัด') }}</th>
                        <th class="text-left">{{ __('อำเภอ') }}</th>
                        <th class="text-left">{{ __('ตำบล') }}</th>
                        <th class="text-left">{{ __('รหัสไปรษณีย์') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($citys as $city)
                    <tr>
                        <td class="text-left">{{ $city->districts->provinces->name }}</td>
                        <td class="text-left">{{ $city->districts->name }}</td>
                        <td class="text-left">{{ $city->name }}</td>
                        <td class="text-left">{{ $city->zip_code }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
