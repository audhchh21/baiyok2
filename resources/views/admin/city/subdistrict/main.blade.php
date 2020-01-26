@extends('layouts.app')

@section('titlepage', 'จัดการจังหวัด')

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
        $('#tb-subdistrict').DataTable();
    })

</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'จัดการตำบล', 'subtitle'=>'รายการตำบล'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-5">
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
            <table class="table table-hover table-bordered" id="tb-subdistrict">
                <thead class="bg-white">
                    <tr>
                        <th class="col-1 text-center">{{ __('ลำดับ') }}</th>
                        <th class="col-9 text-left">{{ __('ตำบล') }}</th>
                        <th class="col-2 text-right">{{ __('การจัดการ') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subdistricts as $subdistrict)
                    <tr>
                        <td class="col-1 text-center tb-td">{{ $count++ }}</td>
                        <td class="col-9 text-left tb-td">{{ $subdistrict->name }}</td>
                        <td class="col-2 text-right tb-td">
                            <a href="{{ route('admin.subdistrict.edit', ['id'=>$subdistrict->id]) }}"
                                class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i
                                    class="far fa-edit"></i></a>
                            <a href="{{ route('admin.subdistrict.delete', ['id'=>$subdistrict->id]) }}"
                                class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบ {{ $subdistrict->name }} ใช่ หรือ ไม่')"
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
        <div class="col-12 col-xl-4">
            <form action="{{ route('admin.subdistrict.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col">
                        <label for="province" class="h3">{{ __('เลือกจังหวัด') }}<span class="text-danger">*</span></label>
                        {!! Form::select('province', $provinces,  session('province') ?? null, ['id' => 'province', 'class' => 'form-control form-control-lg']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="district" class="h3">{{ __('เลือกอำเภอ') }}<span class="text-danger">*</span></label>
                        {!! Form::select('district', $districts,  session('district') ?? null, ['id' => 'district', 'class' => 'form-control form-control-lg']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="subdistrict" class="h3">{{ __('เพิ่มตำบล') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" id="subdistrict" name="name" value="{{ old('name') }}" placeholder="ตำบล" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="zipcode" class="h3">{{ __('เพิ่มรหัสไปรษณีย์') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('zipcode') is-invalid @enderror form-control form-control-lg" id="zipcode" name="zipcode" value="{{ old('zipcode') }}" placeholder="รหัสรหัสไปรษณีย์" required>
                        @error('zipcode')
                        <div class="invalid-feedback">
                            {{ $errors->first('zipcode') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-success">{{ __('เพิ่ม') }}</button>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
