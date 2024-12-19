<div class="mobile-menu_wrapper" id="mobileMenu">
    <div class="offcanvas-menu-inner">
        <div class="container">
            <a href="#" class="btn-close white-close_btn"><i class="ion-android-close"></i></a>
            <div class="offcanvas-inner_logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('theme/client/images/menu/logoF.png') }}" alt="Header Logo">
                </a>
            </div>
            <div class="offcanvas-component">
                <span class="offcanvas-component_title">Trang chính</span>
            <nav class="main-nav d-flex justify-content-center">
                <ul>
                    <li class="dropdown-holder">
                        <a href="{{ route('index') }}">Trang chủ</a>
                    </li>
                    <li class="megamenu-holder position-static">
                        <a href="{{ route('shop.shopIndex') }}">Cửa hàng
                            {{-- <i class="ion-chevron-down"></i> --}}
                        </a>
                        {{-- <ul class="kenne-megamenu">
                            <li>
                                <span class="megamenu-title">Shop Page Layout</span>
                                <ul>
                                    <li><a href="shop-fullwidth.html">Grid Fullwidth</a></li>
                                    <li><a href="shop-left-sidebar.html">Left Sidebar</a></li>
                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                    <li><a href="shop-list-fullwidth.html">List Fullwidth</a>
                                    </li>
                                    <li><a href="shop-list-left-sidebar.html">List Left
                                            Sidebar</a>
                                    </li>
                                    <li><a href="shop-list-right-sidebar.html">List Right
                                            Sidebar</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span class="megamenu-title">Single Product Style</span>
                                <ul>
                                    <li><a href="single-product-gallery-left.html">Gallery
                                            Left</a>
                                    </li>
                                    <li><a href="single-product-gallery-right.html">Gallery
                                            Right</a>
                                    </li>
                                    <li><a href="single-product-tab-style-left.html">Tab Style
                                            Left</a>
                                    </li>
                                    <li><a href="single-product-tab-style-right.html">Tab Style
                                            Right</a>
                                    </li>
                                    <li><a href="single-product-sticky-left.html">Sticky
                                            Left</a>
                                    </li>
                                    <li><a href="single-product-sticky-right.html">Sticky
                                            Right</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span class="megamenu-title">Single Product Type</span>
                                <ul>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="single-product-sale.html">Single Product
                                            Sale</a>
                                    </li>
                                    <li><a href="single-product-group.html">Single Product
                                            Group</a>
                                    </li>
                                    <li><a href="single-product-variable.html">Single Product
                                            Variable</a>
                                    </li>
                                    <li><a href="single-product-affiliate.html">Single Product
                                            Affiliate</a>
                                    </li>
                                    <li><a href="single-product-slider.html">Single Product
                                            Slider</a>
                                    </li>
                                </ul>
                            </li>
                            <li><span class="megamenu-title">Tài khoản</span>
                                <ul>
                                    <li><a href="{{ route('auth.myAcc') }}">Tài khoản của tôi</a>
                                    </li>
                                    <li><a href="{{ route('other.aboutUs') }}">Đăng nhập | Đăng
                                            ký</a></li>
                                    <li><a href="wishlist.html">Yêu thích</a></li>
                                    <li><a href="{{ route('cart.list') }}">Giỏ hàng</a></li>
                                    <li><a href="checkout.html">Thanh toán</a></li>
                                    <li><a href="compare.html">So sánh</a></li>
                                </ul>
                            </li>
                        </ul> --}}
                    </li>
                    <li><a href="{{ route('other.posts.index') }}">Tin tức</a></li>
                    <li><a href="{{ route('other.contactUs') }}">Liên hệ</a></li>
                    <li><a href="{{ route('other.aboutUs') }}">Giới thiệu</a></li>
                </ul>
            </nav>
            </div>
            <nav class="offcanvas-navigation user-setting_area">
                <ul class="mobile-menu">
                    <li class="menu-item-has-children active">
                        <a href="#">
                            <span class="mm-text">
                                Tài khoản
                            </span>
                        </a>
                        <ul class="sub-menu">
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('my-account') }}">
                                        <span class="mm-text">Tài khoản của tôi</span>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit">Đăng xuất</button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('showForm') }}">
                                        <span class="mm-text">Đăng nhập</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('formReg') }}">
                                        <span class="mm-text"> Đăng ký</span>
                                    </a>
                                </li>
                            @endif


                            {{-- <li>
                                <a href="checkout.html">
                                    <span class="mm-text">Thanh toán</span>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- <li class="menu-item-has-children">
                        <a href="#"><span class="mm-text">Ngôn ngữ</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">Tiếng Anh</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">Tiếng Việt</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</div>
