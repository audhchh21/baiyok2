@extends('layouts.app')

@section('titlepage', 'แก้ไขอำเภอ')

@push('style')

@endpush

@push('javascript')
<script>
    $(document).ready( function() {
        $('#save').click( function() {
            return confirm('คุณต้องการบันทึกข้อมูลใช่หรื่อไม่!?') ? true : false
        })
    })
</script>
@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'แก้ไขอำเภอ'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row">
        <div class="col">
            <div class="text-left">
                <a href="{{ route('admin.district') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> {{ __('ย้อนกลับ')   }}</a>
                <hr>
            </div>
                <form action="{{ route('admin.district.update',['id' => $district->id]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-xl-4">
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
                        <label for="province" class="h3">{{ __('จังหวัด') }}</label>
                        {!! Form::select('province', $provinces, $district->province_id, ['id' => 'province', 'class' => 'form-control form-control-lg']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xl-4">
                        <label for="district" class="h3">{{ __('อำเภอ') }}<span class="text-danger">*</span></label>
                        <input type="text" class="@error('district') is-invalid @enderror form-control form-control-lg " id="district" name="name" value="{{ old('district') ?? $district->name }}" placeholder="{{ $district->name }}" required>
                        @error('district')
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success" id="save">{{ __('บันทึก') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
