{{-- @dd(Auth::user()) --}}
@section('css-setting')
    <style>
        #search-results {
            position: absolute;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }

        #search-results div {
            padding: 10px;
            cursor: pointer;
        }

        #search-results div:hover {
            background-color: #f0f0f0;
        }
    </style>
@endsection
<header class="main-header_area">
    @include('client::assets.header-contents.transparent-header')
    @include('client::assets.header-contents.header-sticky')
    @include('client::assets.header-contents.header-miniCart')
    @include('client::assets.header-contents.header-mobileMenu')

    <div class="offcanvas-menu_wrapper" id="offcanvasMenu">
        <div class="offcanvas-menu-inner">
            <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
            <div class="offcanvas-inner_logo">
                <a href="shop-left-sidebar.html">
                    <img src="{{ asset('theme/client/images/menu/logoF.png') }}" alt="Munoz's Offcanvas Logo">
                </a>
            </div>
            <div class="short-desc">
                <p>Thời trang Phong cách Việt-Fashion là sự hòa quyện giữa truyền thống và hiện đại của văn hóa Việt.
                </p>
            </div>
            {{-- <div class="offcanvas-component">
                <span class="offcanvas-component_title">Ngôn ngữ</span>
                <ul class="offcanvas-component_menu">
                    <li class="active"><a href="javascript:void(0)">Tiếng Việt</a></li>
                    <li><a href="javascript:void(0)">Tiếng Anh</a></li>
                </ul>
            </div> --}}
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
            <div class="offcanvas-component">
                <span class="offcanvas-component_title">Tài khoản của tôi</span>
                @if (Auth::user())
                    <ul class="offcanvas-component_menu">
                        <li>
                            <a href="{{ route('my-account') }}">Chi tiết tài khoản</a>
                        </li>
                        <br>
                        <hr>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">Đăng xuất</button>
                            </form>
                        </li>
                        <br>

                    </ul>
                @else
                    <ul class="offcanvas-component_menu">
                        <li><a href="{{ route('formReg') }}">Đăng ký</a></li>
                        <li><a href="{{ route('showForm') }}">Đăng nhập</a></li>
                    </ul>
                @endif
            </div>
            <div class="offcanvas-inner-social_link">
                <div class="kenne-social_link">
                    <ul>
                        <li class="facebook">
                            <a href="https://www.facebook.com/" data-bs-toggle="tooltip" target="_blank"
                                title="Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="https://twitter.com/" data-bs-toggle="tooltip" target="_blank" title="Twitter">
                                <i class="fab fa-twitter-square"></i>
                            </a>
                        </li>
                        <li class="youtube">
                            <a href="https://www.youtube.com/" data-bs-toggle="tooltip" target="_blank" title="Youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="google-plus">
                            <a href="https://www.plus.google.com/discover" data-bs-toggle="tooltip" target="_blank"
                                title="Google Plus">
                                <i class="fab fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="instagram">
                            <a href="https://rss.com/" data-bs-toggle="tooltip" target="_blank" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-search_wrapper" id="searchBar">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <div class="offcanvas-search">
                    <form action="{{ route('search') }}" method="GET" class="hm-searchbox">
                        @csrf
                        <input type="text" name="keywd" placeholder="Tìm kiếm tại đây ..."
                            onkeyup="searchCustomer()" autocomplete="off" id="searchbar" required>
                        <div id="search-results" class="search-results"></div>

                        <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function searchCustomer() {
            let keyword = $('#searchbar').val();
            let crftoken = $('input[name="_token"]').val(); // Lấy CSRF token từ input ẩn
            if (keyword.length > 2) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/v1/hintseach',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "keywd": keyword
                    }),
                    success: function(data) {
                        let resultBox = $('#search-results');
                        resultBox.empty(); // Xóa kết quả trước đó
                        if (data.length > 0) {
                            data.forEach(function(item) {
                                resultBox.append('<div onclick="selectCustomer(\'' + item.name +
                                    '\')">' + item.name + '</div>');
                            });
                        } else {
                            resultBox.append('');
                        }
                    }
                });
            } else {
                $('#search-results').empty();
            }
        }

        function selectCustomer(keyword) {
            let crftoken = $('input[name="_token"]').val(); // Lấy lại CSRF token
            $.ajax({
                url: 'http://127.0.0.1:8000/search',
                method: 'POST',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': crftoken // Gửi token trong headers để bảo mật hơn
                },
                data: JSON.stringify({
                    "keywd": keyword
                }),
                success: function(response) {
                    //location to search page
                    window.location.href = 'search/' + keyword;

                }
            });
        }
    </script>

    <div class="global-overlay"></div>
</header>
