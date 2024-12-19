<div class="kenne-footer_area bg-smoke_color">
    <div class="footer-top_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="newsletter-area">
                        <div class="newsletter-logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('theme/client/images/menu/logoF.png') }}" alt="Footer Logo"
                                    width="200px">
                            </a>
                        </div>
                        {{-- <p class="short-desc">Subscribe to our newsleter, Enter your emil address</p>
                        <div class="newsletter-form_wrap">
                            <form
                                action="https://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                class="newsletters-form validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <div id="mc-form" class="mc-form subscribe-form">
                                        <input id="mc-email" class="newsletter-input" type="email" autocomplete="off"
                                            placeholder="Enter email address" />
                                        <button class="newsletter-btn" id="mc-submit"><i
                                                class="ion-android-mail"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="row footer-widgets_wrap">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>Trang khác</h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    <li><a href="{{ route('shop.shopIndex') }}">Cửa hàng</a></li>
                                    <li><a href="{{ route('other.contactUs') }}">Liên hệ</a></li>
                                    <li><a href="{{ route('other.aboutUs') }}">Giới thiệu</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>Tài khoản</h4>
                            </div>
                            <div class="footer-widgets">
                                @if (Auth::user())
                                    <ul>
                                        <li>
                                            <a href="{{ route('my-account') }}">Chi tiết tài khoản</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit">Đăng xuất</button>
                                            </form>
                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        <li><a href="{{ route('formReg') }}">Đăng ký</a></li>
                                        <li><a href="{{ route('showForm') }}">Đăng nhập</a></li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>Danh mục</h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    @php
                                        $ctgFoot = \DB::table('categories')->get();
                                    @endphp
                                    @foreach ($ctgFoot as $item)
                                        <li><a href="javascript:void(0)">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="copyright">
                        <span>Bản quyền &copy; 2023 <a href="/">Thời trang Phong cách Việt.</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
