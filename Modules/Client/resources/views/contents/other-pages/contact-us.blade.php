@extends('client::layouts.master')

@section('title')
    Liên hệ | Thời trang Phong cách Việt

@endsection
@section('contents')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2 style="margin-top: 30px;">Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active">Liên hệ</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Contact Main Page Area -->
    <div class="contact-main-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">Liên hệ chúng tôi</h3>
                        <p class="contact-page-message">Thời Trang Phong Cách Việt luôn sẵn sàng lắng nghe ý kiến và hỗ trợ bạn. Hãy liên hệ với chúng tôi để được tư vấn và giải đáp.</p>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-fax"></i> Địa chỉ</h4>
                            <p>123 Phố Thời Trang, Quận Phong Cách, TP. Hồ Chí Minh</p>
                        </div>
                        <div class="single-contact-block">

                            <h4><i class="fa fa-phone"></i> Điện thoại</h4>
                            <p>Mobile: 028-8888-5555</p>
                            <p>Hotline: 0359-956-926</p>
                        </div>
                        <div class="single-contact-block last-child">
                            <h4><i class="fa fa-envelope-o"></i> Email</h4>
                            <p>nguyenxuanbinh2k4@gmail.com</p>
                            <p>xuyenqua@fashion.company</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                    <div class="contact-form-content">
                        <h3 class="contact-page-title">Nói với chúng tôi vấn đề của bạn</h3>
                        <div class="contact-form">
                            <form action="{{ route('ticket.addTicket') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Họ và tên <span class="required">*</span></label>
                                    <input type="text" name="con_name" id="con_name"  @if(isset(Auth::user()->full_name)) value={{ Auth::user()->full_name }} @endif required>
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="con_email" id="con_email" @if(isset(Auth::user()->email)) value={{ Auth::user()->email }} @endif>
                                </div>
                                <input type="hidden" name="con_user_id" id="con_user_id" @if(isset(Auth::user()->id)) value={{ Auth::user()->id }} @endif>
                                <div class="form-group">
                                    <label>Loại yêu cầu <span class="required">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Account">Tài khoản</option>
                                        <option value="Order">Mua hàng</option>
                                        <option value="Product">Sản phẩm</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="con_subject" id="con_subject">
                                </div>
                                <div class="form-group form-group-2">
                                    <label>Lời nhắn của bạn</label>
                                    <textarea name="con_message" id="con_message"></textarea>
                                </div>
                                <div class="form-group-2">
                                    <label>File đính kèm</label>
                                    <input type="file" name="con_file" id="con_file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" value="submit" id="submit" class="kenne-contact-form_btn"
                                        name="submit">Gửi</button>
                                </div>
                            </form>
                        </div>
                        <p class="form-message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Main Page Area End Here -->

    <!-- Begin Brand Area -->
    <div class="brand-area ">
        <div class="container">
            <div class="brand-nav border-top ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kenne-element-carousel brand-slider slider-nav"
                            data-slick-options='{
                            "slidesToShow": 6,
                            "slidesToScroll": 1,
                            "infinite": false,
                            "arrows": false,
                            "dots": false,
                            "spaceBetween": 30
                            }'
                            data-slick-responsive='[
                            {"breakpoint":992, "settings": {
                            "slidesToShow": 4
                            }},
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint":576, "settings": {
                            "slidesToShow": 2
                            }}
                        ]'>

                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/1.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/2.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/3.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/4.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/5.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/6.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/1.png') }}" alt="Brand Images">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('theme/client/images/brand/2.png') }}" alt="Brand Images">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ticketId = "{{ session('ticket_id') }}";
            if (ticketId) {
                fetch(`/api/v1/aigenerate/${ticketId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            document.getElementById('aiSummary').innerText = data.message;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
