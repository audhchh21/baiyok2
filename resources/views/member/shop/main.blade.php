@extends('layouts.app')

@section('titlepage', 'ร้านค้า')

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
        $('#tb-shop').DataTable();
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'ร้านค้า', 'subtitle' => 'ร้านค้าทั้งหมด'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-right">
                <a href="{{ route('member.shop.create') }}" class="btn btn-info"><i
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
            <table id="tb-shop" class="table table-hover table-bordered">
                <thead class="bg-white">
                    <tr>
                        <th class="text-center col-1">{{ __('ลำดับ') }}</th>
                        <th class="text-left col-2">{{ __('ชื่อร้านค้า') }}</th>
                        <th class="text-left col-2">{{ __('ชื่อเจ้าของร้าน') }}</th>
                        <th class="text-left col-4">{{ __('ที่อยู่ร้าน') }}</th>
                        <th class="text-right col-2">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shops as $shop)
                    <tr>
                        <td class="text-center tb-td col-1">{{ $count++ }}</td>
                        <td class="text-left tb-td col-2">{{ $shop->name }}</td>
                        <td class="text-left tb-td col-2">{{ $shop->Fullname }}</td>
                        <td class="text-left tb-td col-4">{{ $shop->Fulladdress }}</td>
                        <td class="text-right tb-td col-2">
                            <a href="{{ route('member.shop.edit', ['id'=>$shop->id]) }}" class="btn btn-warning"
                                data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></a>
                            <a href="{{ route('member.shop.delete', ['id'=>$shop->id]) }}" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบ {{ $shop->name }} ใช่ หรือ ไม่')"
                                data-toggle="tooltip" data-placement="top" title="ลบ"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"><span class="text-center h3">{{ __('ไม่มีร้านค้า') }}</span></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
