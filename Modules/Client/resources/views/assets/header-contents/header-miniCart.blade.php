<div class="offcanvas-minicart_wrapper" id="miniCart">
    <div class="offcanvas-menu-inner">
        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
        <div class="minicart-content">
            <div class="minicart-heading">
                <h4>Giỏ hàng mua sắm</h4>
            </div>
            <ul class="minicart-list" id="minicart">
                {{-- <li class="minicart-product">
                    <a class="product-item_remove" href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    <div class="product-item_img">
                        <img src="{{ asset('theme/client/images/product/1-1.jpg') }}" alt="Kenne's Product Image">
                    </div>
                    <div class="product-item_content">
                        <a class="product-item_title" href="shop-left-sidebar.html">Autem ipsa ad</a>
                        <span class="product-item_quantity">1 x $145.80</span>
                    </div>
                </li> --}}



            </ul>
        </div>
        <div class="minicart-item_total">
            <span>Tổng tiền</span>
            <span class="ammount" id="totalAmount">0 VNĐ</span>
        </div>
        <div class="minicart-btn_area">
            <a href="{{ route('cart.index') }}" class="kenne-btn kenne-btn_fullwidth">Giỏ hàng</a>
        </div>
        <div class="minicart-btn_area">
            <a href="{{ route('cart.checkout') }}" class="kenne-btn kenne-btn_fullwidth">Thanh toán</a>
        </div>
        <div class="minicart-btn_area">
            <a href="{{ route('wishlist.index') }}" class="kenne-btn kenne-btn_fullwidth">Sản phẩm yêu thích</a>
        </div>
    </div>
</div>


