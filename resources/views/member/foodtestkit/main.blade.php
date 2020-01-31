@extends('layouts.app')

@section('titlepage', 'ชุดทดสอบ')

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
        $('#tb-foodtestkit').DataTable();
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'ชุดทดสอบ', 'subtitle' => 'ชุดทดสอบ'])

    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col-12 col-xl-8 border-right">
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
            <table id="tb-foodtestkit" class="table table-hover table-bordered">
                <thead class="bg-white">
                    <tr>
                        <th class="text-center col-1">{{ __('ลำดับ') }}</th>
                        <th class="text-left col-9">{{ __('ชื่อชุดทดสอบ') }}</th>
                        <th class="text-right col-2">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($foodtestkits as $foodtestkit)
                    <tr>
                        <td class="text-center col-1 tb-td">{{ $count++ }}</td>
                        <td class="text-left col-9 tb-td">{{ $foodtestkit->name }}</td>
                        <td class="text-center tb-td col-1">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('member.foodtestkit.edit', ['id'=>$foodtestkit->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="text-warning pr-1">
                                        <i class="far fa-edit"></i>
                                    </span>
                                    {{ __('แก้ไข') }}
                                </a>
                                <a href="{{ route('member.foodtestkit.delete', ['id'=>$foodtestkit->id]) }}" class="btn btn-white"
                                    data-toggle="tooltip" data-placement="top" title="ลบ"
                                    onclick="return confirm('คุณต้องการลบ {{ $foodtestkit->name }} ใช่ หรือ ไม่')">
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
                        <td colspan="4"><span class="h3 text-center">{{ __('ไม่มีชุดทดสอบ') }}</span></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-12 col-xl-4">
            <form action="{{ route('member.foodtestkit.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="foodtestkit" class="h3">{{ __('ชุดทดสอบ') }}</label>
                        <input type="text" id="foodtestkit" class="form-control form-control-lg" name="name" value="{{ old('name') }}" placeholder="ชื่อชุดทดสอบ" required>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-block btn-lg btn-success">{{ __('เพิ่ม') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
