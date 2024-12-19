@extends('wallet::layouts.css')

@section('content')
<div class="">

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Chào mừng bạn đến với Ví điện tử </h3>
            <p class="card-text">Để bắt đầu sử dụng dịch vụ ví tiền của chúng tôi, bạn cần xác minh thông tin cá nhân của mình. Hãy bắt đầu ngay bây giờ.</p>
            <a href="{{ route('ekyc.verifyadress') }}" class="btn btn-primary waves-effect waves-light w-100">Bắt đầu quá trình xác thực</a>
        </div>
    </div>

</div>
@endsection
