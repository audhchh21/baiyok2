@extends('layouts.app')

@section('titlepage', 'หน้าแรก')

@push('style')

@endpush

@push('javascript')

@endpush

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    @include('layouts.pageheader.title', ['title' => 'โปรไฟล์ของฉัน', 'subtitle'=>'โปรไฟล์ของฉัน'])
    <!-- End Page Header -->

    <!-- Start Content -->
    <div class="row mb-5">
        <div class="col-12 col-xl-12">
            <div class="text-right">
                @if (Auth::user()->type == 'Admin')
                <a href="{{ route('admin.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('admin.profile.password') }}"
                    class="btn btn-outline-dark">{{ __('เปลี่ยนรหัสผ่าน') }}</a>
                @elseif(Auth::user()->type == 'Manager')
                <a href="{{ route('manager.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('manager.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('manager.profile.password') }}"
                    class="btn btn-outline-dark">{{ __('เปลี่ยนรหัสผ่าน') }}</a>
                @elseif(Auth::user()->type == 'User')
                <a href="{{ route('member.profile') }}" class="btn btn-outline-dark"> {{ __('โปรไฟล์') }}</a>
                <a href="{{ route('member.profile.edit') }}" class="btn btn-outline-dark"> {{ __('แก้ไข') }}</a>
                <a href="{{ route('member.profile.password') }}"
                    class="btn btn-outline-dark">{{ __('เปลี่ยนรหัสผ่าน') }}</a>
                @endif
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
            <form @if (Auth::user()->type == 'Admin')
                action="{{ route('admin.profile.update', ['id' => $user->id]) }}"
                @elseif(Auth::user()->type == 'Manager')
                action="{{ route('manager.profile.update', ['id' => $user->id]) }}"
                @elseif(Auth::user()->type == 'User')
                action="{{ route('member.profile.update', ['id' => $user->id]) }}"
                @endif
                method="post">
                @csrf
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('อีเมล') }}</td>
                            <td class="text-left col-12 col-xl-9"><input type="text"
                                    class="form-control form=control-lg" id="email" name="email"
                                    value="{{ old('email') ?? $user->email }}" placeholder="{{ $user->email }}"
                                    required></td>
                        </tr>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('ชื่อ') }}</td>
                            <td class="text-left col-12 col-xl-9">
                                <div class="row pl-3 pr-3">
                                    {!! Form::select('titlename', $titlename, $user->titlename_id, ['id' => 'titlename',
                                    'class' => 'form-control col-xl-2']) !!}
                                    <input type="text" class="form-control col-xl-5" id="f_name" name="f_name"
                                        value="{{ old('f_name') ?? $user->f_name }}" placeholder="{{ $user->f_name }}"
                                        required>
                                    <input type="text" class="form-control col-xl-5" id="l_name" name="l_name"
                                        value="{{ old('l_name') ?? $user->l_name }}" placeholder="{{ $user->l_name }}"
                                        required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('เบอร์โทรศัพท์') }}</td>
                            <td class="text-left col-12 col-xl-9"><input type="text"
                                    class="form-control form=control-lg" id="phone" name="phone"
                                    value="{{ old('phone') ?? $user->phone }}" placeholder="{{ $user->phone }}"
                                    required></td>
                        </tr>
                        <tr>
                            <td class="text-left col-12 col-xl-3">{{ __('หน่วยงานที่สังกัด') }}</td>
                            <td class="text-left col-12 col-xl-9">
                                {!! Form::select('office', $office, old('office') ?? $user->office_id, ['id' =>
                                'office', 'class' => 'form-control']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-left">
                    <button type="submit" class="btn btn-success">{{ __('บันทึก') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Content -->
</div>

@endsection
