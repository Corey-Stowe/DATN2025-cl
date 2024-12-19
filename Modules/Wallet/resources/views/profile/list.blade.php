@extends('wallet::layouts.master')

@section('content')
<?php
use Carbon\Carbon;
?>
 <div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Cài đặt ví tiền</h4>
            <div class="flex-shrink-0">
                <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home2" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Trạng thái tài khoản</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile2" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Bảo mật</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages2" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Thông tin cá nhân</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div><!-- end card header -->

        <div class="card-body">

            <!-- Tab panes -->
            <div class="tab-content text-muted">
                <div class="tab-pane active" id="home2" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="text-dark">Trạng thái ví tiền: <strong>@if ($data->wallet_status == 1)
                                <span class="btn btn-subtle-success waves-effect waves-light">Đang hoạt động</span>
                            @elseif ($data->wallet_status == 2)
                                <span class="btn btn-subtle-danger waves-effect waves-danger">Dừng hoạt động</span>
                            @elseif ($data->wallet_status == 3)
                                <span class="btn btn-subtle-warning waves-effect waves-danger">Khóa ví</span>
                            @endif </strong></p>
                        </div>
                        <div class="col-sm-4">
                            <p class="text-dark">Độ xác thực ví tiền: @if ($data->wallet_user_level == 1)
                                <span class="btn btn-subtle-warning waves-effect waves-danger">Xác thực cơ bản</span>
                            @elseif ($data->wallet_user_level == 2)
                                <span class="btn btn-subtle-success waves-effect waves-light">Xác thực đầy đủ</span>
                            @endif
                        </p>
                        </div>
                        <div class="col-sm-4">
                            {{-- <p class="text-dark">Trạng thái thông tin  <strong>@if ($data->status == "COMPLETED_BASIC") Cần hoàn thiện thêm thông tin @elseif($data->status == "COMPLETED")Đã hoàn thiện thông tin @else Cần hoàn thiện thêm thông tin @endif</strong></p> --}}
                            <p class="text-dark">Ngày mở ví: <strong>{{$data->created_at }} ( mở được {{ Carbon::parse($data->created_at)->diffInDays() }} ngày)</strong></p>
                            <p class="text-dark">Chủ sở hữu: <strong>{{ $data->frist_name }} {{ $data->last_name }}</strong></p>
                            <p class="text-dark"><strong>{{ $data->admin_note }}</strong></p>
                        </div>
                </div>
                </div>
                <div class="tab-pane" id="profile2" role="tabpanel">
                    <div class="mb-3">
                        <div class="col-md-6">
                            <div>
                             <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i> Xác thực giao dịch bằng OTPless+ </h5>
                             <p class="text-card"> OTPless+ là một giải pháp thay thế thay vì nhập mã xác thực gửi bằng email thì chỉ cần sử dụng Passkey để xác thực giao dịch </p>
                             <form method="POST" action="{{ route('wallet.webautn.action') }}">
                                @csrf
                                <div class="form-check form-switch mb-3" dir="ltr">
                                    <input type="checkbox" name="enable" class="form-check-input" id="customSwitch1"
                                           @if ($webauth_data->isNotEmpty()) checked @endif>
                                    <label class="form-check-label" for="customSwitch1">
                                        @if ($webauth_data->isNotEmpty())
                                            Đang kích hoạt
                                        @else
                                            Kích hoạt ngay
                                        @endif
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </form>

                            </div>
                        </div>

                </div>
                </div>
                <div class="tab-pane" id="messages2" role="tabpanel">
                    <p class="mb-0">
                        Etsy mixtape wayfarers, ethical wes anderson tofu before they
                        sold out mcsweeney's organic lomo retro fanny pack lo-fi
                        farm-to-table readymade. Messenger bag gentrify pitchfork
                        tattooed craft beer, iphone skateboard locavore carles etsy
                        salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                        Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                        mi whatever gluten-free carles.
                    </p>
                </div>
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->


@endsection
