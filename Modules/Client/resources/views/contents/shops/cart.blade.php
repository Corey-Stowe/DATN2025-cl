@extends('client::layouts.master')

@section('title')
    Giỏ hàng | Thời trang Phong cách Việt
@endsection

@section('css-setting')
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('contents')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Thời trang Phong cách Việt</h2>
                <ul>
                    <li><a href="{{ route('index') }}">Trang Chủ</a></li>
                    <li class="active">Giỏ Hàng</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="kenne-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th class="kenne-product-thumbnail">Hình ảnh</th>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th class="kenne-product-price">Đơn giá</th>
                                    <th class="kenne-product-quantity">Số lượng</th>
                                    <th class="kenne-product-subtotal">Tổng cộng</th>
                                    <th class="kenne-product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                {{-- <tr>
                                        <td class="kenne-product-thumbnail"><a href="javascript:void(0)"><img
                                                    src="assets/images/product/small-size/1.jpg"
                                                    alt="Uren's Cart Thumbnail"></a></td>
                                        <td class="kenne-product-name"><a href="javascript:void(0)">Juma rema pola</a></td>
                                        <td class="kenne-product-price"><span class="amount">$46.80</span></td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">$46.80</span></td>
                                        <td class="kenne-product-remove"><a href="javascript:void(0)"><i class="fa fa-trash"
                                                    title="Remove"></i></a></td>
                                    </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                        placeholder="Mã giảm giá" type="text">
                                    <input class="button" name="apply_coupon" value="Áp dụng mã" type="submit">
                                    <br>
                                    <button class="button btn-coupon-delete kenne-register_btn">Xóa mã giảm giá</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Tổng giỏ hàng</h2>
                                <ul>
                                    <li>Tạm tính <span class="totalAmount">0 VNĐ</span></li>
                                    <li>Giảm giá : @session('discount_code')
                                            {{ session('discount_code') ? session('discount_code') : '' }}
                                        @endsession <span class="discount"> 0 VNĐ</span></li>
                                    <li>Tổng cộng <span class="total">0 VNĐ</span></li>
                                </ul>
                                <div class="btn-checkout">
                                    <a href="{{ route('cart.checkout') }}">Tiến hành thanh toán</a>

                                </div>
                                {{-- <a href="{{ route('cart.checkout') }}">Tiến hành thanh toán</a> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-setting')
    @if (session('errorSP'))
        <script>
            Swal.fire({
                icon: 'info',
                title: '{{ session('errorSP') }}',
                text: '{{ session('messageSP') }}',
            });
        </script>
    @endif


    <script>
        const appurl = "{{ env('APP_URL') }}";
        $(document).ready(function() {

            function loadCartItems() {
                $.ajax({
                    url: '/cart/list',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#minicart').empty();
                        response.cartItems.forEach(function(item) {
                            let product = item.product_variant.product;
                            let quantity = item.quantity;
                            let price = item.price;
                            let imgURL = item.product_image;
                            if (!imgURL.includes('http')) {
                                imgURL = `{{ Storage::url('${ item.product_image}') }}`;
                            }

                            let productHTML = `
                                <li class="minicart-product">
                                    <a class="product-item_remove" href="javascript:void(0)" onclick="removeFromMiniCart(${item.id})"><i class="ion-android-close"></i></a>
                                    <div class="product-item_img">
                                        <img src="/storage/${product.image_avatar}" alt="${product.name}">
                                    </div>
                                    <div class="product-item_content">
                                        <a class="product-item_title" href="/shop/product-detail/${product.slug}">${product.name}</a>
                                        <div>
                                            - Size: ${item.product_variant.size.size_value}
                                            <br>
                                            - Màu: <input type="color" value="${item.product_variant.color.color_value}" disabled>
                                        </div>
                                        <span class="product-item_quantity">${quantity} x ${formatVND(price)}</span>
                                    </div>
                                </li>
                            `;
                            $('#minicart').append(productHTML);
                        });

                        $('#totalAmount').text(formatVND(response.totalAmount));
                    },
                    error: function(xhr, status, error) {
                        $('#minicart').empty();
                        // console.error('Giỏ hàng của bạn đang trống!:', error);
                    }
                });
            }

            function loadCartItemCount() {
                $.ajax({
                    url: '/cart/list',
                    method: 'GET',
                    success: function(response) {
                        var itemCount = response.cartItems.length;
                        $('.item-count').text(itemCount);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.item-count').text(0);
                        // console.error("Lỗi khi lấy sản phẩm:", textStatus, errorThrown);
                    }
                });
            }

            function formatVND(amount) {
                return amount.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
            }

            function fetchCartItems() {
                $.ajax({
                    url: '/cart/list',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === "Lấy danh sách giỏ hàng thành công!") {
                            displayCartItems(response.cartItems);
                            loadCartItems();
                            loadCartItemCount();
                        } else {
                            console.error("Lỗi khi lấy danh sách giỏ hàng:", response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#cart-table-body').empty();
                        $('.item-count').text(0);
                        loadCartItems();
                        loadCartItemCount();
                        $('#totalAmount').text(formatVND(0));
                        console.error("Yêu cầu AJAX thất bại:", textStatus, errorThrown);
                    }
                });
            }

            function formatPrice(price) {
                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
            }

            function displayCartItems(cartItems) {
                $('#cart-table-body').empty();
                cartItems.forEach(item => {
                    $('#cart-table-body').append(generateCartRow(item));
                })


            }

            function generateCartRow(item) {
                var imgURL = item.product_image.includes('http') ? item.product_image :
                    `/storage/${item.product_image}`;
                return `
        <tr>
            <td class="kenne-product-thumbnail">
                <a href="javascript:void(0)">
                    <img src="${imgURL}" alt="${item.product_id} Thumbnail" width="160">
                </a>
            </td>
            <td class="kenne-product-name">
                <a href="/shop/product-detail/${item.product_variant.product.slug}">
                    ${item.product_variant.product.name}
                </a>
                <br>
                <div>
                    - Size: ${item.product_variant.size.size_value}
                    <br>
                    - Màu: <input type="color" value="${item.product_variant.color.color_value}" disabled>
                </div>
            </td>
            <td class="kenne-product-price"><span class="amount">${formatPrice(item.price)}</span></td>
            <td class="quantity">
                <label>Số lượng</label>
                <div class="cart-plus-minus">
                    <input class="cart-plus-minus-box" data-id="${item.id}" value="${item.quantity}" type="number" min="1">
                    <button class="dec qtybutton" data-id="${item.id}" data-action="decrease">-</button>
                    <button class="inc qtybutton" data-id="${item.id}" data-action="increase">+</button>
                </div>
            </td>
            <td class="product-subtotal"><span class="amount">${formatPrice(item.total_price)}</span></td>
            <td class="kenne-product-remove">
                <a href="javascript:void(0)" onclick="removeFromCart(${item.id})">
                    <i class="fa fa-trash" title="Xóa"></i>
                </a>
            </td>
        </tr>
    `;
            }

            // Gắn sự kiện cho nút tăng/giảm số lượng bằng Event Delegation

            $('#cart-table-body').on('click', '.qtybutton', function() {
                const itemId = $(this).data('id');
                const action = $(this).data('action');
                const inputField = $(`input.cart-plus-minus-box[data-id="${itemId}"]`);
                let currentQuantity = parseInt(inputField.val());

                if (action === "increase") {
                    currentQuantity++;
                } else if (action === "decrease" && currentQuantity > 1) {
                    currentQuantity--;
                } else {
                    return;
                }

                inputField.val(currentQuantity);
                updateCartItemQuantity(itemId, currentQuantity);
            });

            $('#cart-table-body').on('change', '.cart-plus-minus-box', function() {
                const itemId = $(this).data('id');
                const newQuantity = parseInt($(this).val());

                if (newQuantity > 0) {
                    updateCartItemQuantity(itemId, newQuantity);
                } else {
                    alert("Số lượng phải lớn hơn 0");
                    $(this).val(1);
                    updateCartItemQuantity(itemId, 1);
                }
            });

            function updateCartItemQuantity(itemId, quantity) {
                $.ajax({
                    type: 'POST',
                    url: '/cart/update/' + itemId,
                    data: {
                        '_method': 'PUT',
                        'id': itemId,
                        'quantity': quantity,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            fetchCartItems();
                            updateCartTotal();
                        } else {
                            console.error("Lỗi khi cập nhật số lượng:", response.message);
                            alert(response.message);
                            fetchCartItems();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Lỗi khi cập nhật số lượng:", textStatus, errorThrown);
                    }
                });
            }

            window.removeFromCart = function(itemId) {
                $.ajax({
                    type: 'POST',
                    url: '/cart/remove/' + itemId,
                    data: {
                        '_method': 'DELETE',
                        'id': itemId,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log("Xóa sản phẩm thành công:", response.message);
                            fetchCartItems();
                            updateCartTotal();
                        } else {
                            console.error("Lỗi khi xóa sản phẩm:", response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Lỗi khi xóa sản phẩm:", textStatus, errorThrown);
                    }
                });
            };

            function updateCartTotal() {
                $.ajax({
                    url: '/cart/list',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let discount = response.discount ? response.discount : 0;
                        let totalAmount = response.totalAmount ? response.totalAmount : 0;
                        let total = totalAmount - discount;
                        $('.cart-page-total ul li .totalAmount').text(formatPrice(totalAmount));
                        $('.cart-page-total ul li .discount').text(formatPrice(discount));
                        $('.cart-page-total ul li .total').text(formatPrice(total));
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.cart-page-total ul li .totalAmount').text(formatPrice(0));
                        $('.cart-page-total ul li .discount').text(formatPrice(0));
                        $('.cart-page-total ul li .total').text(formatPrice(0));
                        console.error("Yêu cầu AJAX thất bại:", textStatus, errorThrown);
                    }
                });
            }

            $('.button[name="apply_coupon"]').on('click', function(e) {
                e.preventDefault();
                var couponCode = $('#coupon_code').val();

                if (couponCode) {
                    $.ajax({
                        type: 'POST',
                        url: '/cart/apply-coupon',
                        data: {
                            'coupon_code': couponCode,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                updateCartTotal();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Lỗi khi áp dụng mã giảm giá:", textStatus,
                                errorThrown);
                        }
                    });
                } else {
                    alert("Vui lòng nhập mã giảm giá!");
                }
            });

            updateCartTotal();
            fetchCartItems();
        });

        $(document).ready(function() {
            $('.btn-coupon-delete').click(function() {
                var tr = $(this).closest('tr');
                if (confirm('Bạn có chắc chắn muốn xóa mã giảm giá này không?')) {
                    $.ajax({
                        url: "{{ route('cart.removeDiscountCode') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Mã giảm giá đã được xóa thành công.');
                                location.reload();
                            } else {
                                alert('Có lỗi xảy ra khi xóa mã giảm giá.');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Lỗi khi xóa mã giảm giá:", textStatus, errorThrown);
                        }
                    });
                }
            });
        });
    </script>
@endsection
