@extends('wallet::layouts.css')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-4">
            <!-- Logo -->
            <img src="/path/to/logo.png" alt="Logo" class="logo mb-3">
            <!-- Heading -->
            <h3 class="text-primary">Kích hoạt ví</h3>
        </div>

        <!-- Status Bar -->
        <div class="status-bar d-flex justify-content-center mb-4">
            <ul class="wizard-nav">
                <li class="wizard-list-item">
                    <div class="list-item">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Seller Details">
                            <i class="bx bx-user-circle"></i>
                        </div>
                        <span>Thông tin cơ bản</span>
                    </div>
                </li>
                <li class="wizard-list-item ms-3">
                    <div class="list-item ">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                             aria-label="Company Document">
                            <i class="bx bx-file"></i>
                        </div>
                        <span>Thông tin cá nhân</span>
                    </div>
                </li>
                <li class="wizard-list-item ms-3">
                    <div class="list-item active ">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bank Details">
                            <i class="bx bx-edit"></i>
                        </div>
                        <span>Điều khoản sử dụng</span>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Card -->
        <div class="card">
            <a href="{{ route('ekyc.verifyadress') }}"> <i class="bx bx-arrow-back"></i> Quay lại từ đầu</a>
            <div class="card-body">
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
                <form class="needs-validation" method="POST" action="{{ route('ekyc.registerwallet') }}" novalidate>
                    @csrf
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary">Điều khoản sử dụng dịch vụ ví tiền</h5>
                                <p class="text-muted">
                                    Vui lòng đọc kỹ và đồng ý với điều khoản sử dụng dịch vụ ví tiền của chúng tôi.
                                </p>
                                <p><strong>Điều 1: Giới thiệu</strong></p>
                                <p>
                                    "Ví tiền" (sau đây gọi tắt là "Dịch vụ") được cung cấp bởi PCV Fashion
                                    (sau đây gọi tắt là "Chúng tôi"). Dịch vụ cho phép người dùng tạo tài khoản,
                                    nạp, rút và thanh toán tiền qua ví điện tử.
                                </p>

                                <p><strong>Điều 2: Sử dụng dịch vụ</strong></p>
                                <ul>
                                    <li>Người dùng phải đảm bảo rằng họ có đủ tuổi (tối thiểu 18 tuổi) để sử dụng Dịch vụ.</li>
                                    <li>Người dùng phải cung cấp thông tin chính xác và đầy đủ khi đăng ký tài khoản.</li>
                                    <li>Người dùng phải tuân thủ các quy định và hướng dẫn sử dụng Dịch vụ.</li>
                                </ul>

                                <p><strong>Điều 3: Nạp, rút và thanh toán</strong></p>
                                <ul>
                                    <li>Người dùng có thể nạp tiền vào ví điện tử thông qua các phương thức được chấp nhận bởi Chúng tôi.</li>
                                    <li>Người dùng có thể rút tiền từ ví điện tử sang tài khoản ngân hàng hoặc các phương thức khác được chấp nhận bởi Chúng tôi.</li>
                                    <li>
                                        Người dùng chỉ có thể sử dụng Dịch vụ để thanh toán cho các giao dịch hợp lệ
                                        và không được phép sử dụng Dịch vụ để thực hiện bất kỳ giao dịch trái pháp luật nào.
                                    </li>
                                </ul>

                                <p><strong>Điều 4: Chính sách bảo vệ thông tin cá nhân</strong></p>
                                <ul>
                                    <li>Khi đăng ký tài khoản, người dùng phải tải lên ảnh chứng minh thư nhân dân hoặc hộ chiếu.</li>
                                    <li>
                                        Chúng tôi cam kết bảo vệ thông tin cá nhân của người dùng và sẽ không chia sẻ thông tin này
                                        với bất kỳ bên thứ ba nào ngoại trừ trường hợp được quy định tại Điều 8.
                                    </li>
                                    <li>
                                        Người dùng có thể yêu cầu cập nhật, sửa đổi hoặc xóa thông tin cá nhân của mình
                                        bằng cách liên hệ với Chúng tôi.
                                    </li>
                                </ul>

                                <p><strong>Điều 5: Xác thực</strong></p>
                                <ul>
                                    <li>Khi đăng ký tài khoản, người dùng phải xác thực thông tin cá nhân của mình bằng cách tải lên ảnh chứng minh thư nhân dân hoặc hộ chiếu.</li>
                                    <li>Chúng tôi có quyền yêu cầu người dùng cung cấp thêm thông tin để xác thực tài khoản nếu cần thiết.</li>
                                </ul>
                                <p><strong>Điều 6: Trách nhiệm của người dùng</strong></p>
                                <ul>
                                    <li>Người dùng phải tuân thủ các quy định và hướng dẫn sử dụng Dịch vụ.</li>
                                    <li>Người dùng phải chịu trách nhiệm về tất cả hoạt động trên tài khoản, bao gồm nhưng không giới hạn ở: Sử dụng Dịch vụ để nạp, rút và thanh toán tiền.
                                        Cập nhật thông tin cá nhân.</li>
                                </ul>
                                <p><strong>Điều 7: Trách nhiệm của Chúng tôi</strong></p>
                                <ul>
                                    <li>Chúng tôi cam kết cung cấp dịch vụ ổn định và an toàn.</li>
                                    <li>Chúng tôi sẽ không chịu trách nhiệm về bất kỳ thiệt hại hoặc mất mát nào do sử dụng Dịch vụ gây ra, ngoại trừ trường hợp được quy định tại Điều 8.</li>
                                </ul>
                                <p><strong>Điều 8: Giới hạn trách nhiệm</strong></p>
                                <ul>
                                    <li>Chúng tôi chỉ chịu trách nhiệm trong phạm vi cho phép bởi luật pháp Việt Nam.</li>
                                    <li>Chúng tôi không có trách nhiệm về bất kỳ thiệt hại hoặc mất mát nào do sử dụng Dịch vụ gây ra, bao gồm nhưng không giới hạn ở: Thiệt hại về tài sản, Mất mát thời gian, Thiệt hại về danh dự.
                                </ul>
                                <p><strong>Điều 9: Cập nhật ToS</strong></p>
                                <ul>
                                    <li> Chúng tôi có quyền cập nhật ToS bất cứ lúc nào mà không cần thông báo trước.</li>
                                    <li>Người dùng phải thường xuyên kiểm tra ToS để biết các thay đổi mới nhất.</li>
                                </ul>
                                <p><strong>Điều 10: Giải quyết tranh chấp</strong></p>
                                <ul>
                                    <li>Trong trường hợp xảy ra tranh chấp, người dùng và Chúng tôi sẽ nỗ lực giải quyết bằng cách thương lượng.</li>
                                    <li>Nếu không thể giải quyết bằng thương lượng, tranh chấp sẽ được giải quyết theo pháp luật Việt Nam.</li>
                                </ul>
                                <p><strong>Điều 11: Quyền sở hữu trí tuệ</strong></p>
                                <ul>
                                    <li>Dịch vụ và nội dung trên trang web đều là tài sản trí tuệ của Chúng tôi.</li>
                                    <li>Người dùng không được phép sử dụng hoặc phân phối bất kỳ phần nào của Dịch vụ mà không có sự đồng ý trước bằng văn bản từ Chúng tôi.</li>
                                </ul>
                                <p><strong>Điều 12: Hiệu lực và ràng buộc</strong></p>
                                <ul>
                                    <li>ToS sẽ có hiệu lực ngay từ khi người dùng đăng ký tài khoản.</li>
                                    <li> ToS sẽ ràng buộc với người dùng cho đến khi được hủy bỏ bởi người dùng hoặc Chúng tôi.</li>
                                </ul>
                                <p><strong>Bằng việc sử dụng Dịch vụ, người dùng đã đồng ý với các điều khoản và điều kiện trên.</strong></p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="TOS" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Đồng ý sử dụng điều khoản dịch vụ ví tiền
                                </label>
                                <div class="invalid-feedback">Bạn cần đồng ý với điều khoản sử dụng dịch vụ</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary w-100" type="submit">Kích hoạt ví ngay</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        (function () {
            "use strict";
            window.addEventListener("load", function () {
                var forms = document.getElementsByClassName("needs-validation");
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener("submit", function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    }, false);
                });
            }, false);
        })();
    </script>
    <script src="{{ Module::asset('wallet:libs/dropzone/dropzone-min.js') }}"></script>
@endsection
