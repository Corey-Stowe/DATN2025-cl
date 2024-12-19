<!-- jQuery JS -->
<script src="{{ asset('theme/client/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('theme/client/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
<!-- Modernizer JS -->
<script src="{{ asset('theme/client/js/vendor/modernizr-3.11.2.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('theme/client/js/vendor/bootstrap.bundle.min.js') }}"></script>

<!-- Slick Slider JS -->
<script src="{{ asset('theme/client/js/plugins/slick.min.js') }}"></script>
<!-- Barrating JS -->
<script src="{{ asset('theme/client/js/plugins/jquery.barrating.min.js') }}"></script>
<!-- Counterup JS -->
<script src="{{ asset('theme/client/js/plugins/jquery.counterup.js') }}"></script>
<!-- Nice Select JS -->
<script src="{{ asset('theme/client/js/plugins/jquery.nice-select.js') }}"></script>
<!-- Sticky Sidebar JS -->
<script src="{{ asset('theme/client/js/plugins/jquery.sticky-sidebar.js') }}"></script>
<!-- Jquery-ui JS -->
<script src="{{ asset('theme/client/js/plugins/jquery-ui.min.js') }}"></script>
<script src="{{ asset('theme/client/js/plugins/jquery.ui.touch-punch.min.js') }}"></script>
<!-- Theia Sticky Sidebar JS -->
<script src="{{ asset('theme/client/js/plugins/theia-sticky-sidebar.min.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ asset('theme/client/js/plugins/waypoints.min.js') }}"></script>
<!-- jQuery Zoom JS -->
<script src="{{ asset('theme/client/js/plugins/jquery.zoom.min.js') }}"></script>
<!-- Timecircles JS -->
<script src="{{ asset('theme/client/js/plugins/timecircles.js') }}"></script>
@yield('js-libs')
<!-- Main JS -->
<script src="{{ asset('theme/client/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function(e) {
            e.preventDefault(); // Ngăn form submit mặc định

            let productId = $(this).data('product-id');
            let productSize = $('#id_size').val();
            let productColor = $('input[name="product-color"]:checked').val();
            let quantity = $('#quantity-input').val();

            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    product_id: productId,
                    size_attribute_id: productSize,
                    color_attribute_id: productColor,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    loadCartItems();
                    loadCartItemCount();

                },
                error: function(error,response) {
                    alert(response.message);
                    console.error(error);
                }
            });
        });

        $('.add-to-cart-wishlist').click(function(e) {
                e.preventDefault(); // Ngăn form submit mặc định

                let productId = $(this).data('product-id');
                let productSize = $(this).data('size-id');
                let productColor = $(this).data('color-id');

                $.ajax({
                    url: '{{ route('cart.add') }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        size_attribute_id: productSize,
                        color_attribute_id: productColor,
                        quantity: 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        loadCartItems();
                        loadCartItemCount();

                    },
                    error: function(error, response) {
                        console.error(error);
                    }
                });
            });
        function formatVND(amount) {
            return amount.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
        }

        function loadCartItems() {
            $.ajax({
                url: '/cart/list',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
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
                                     <img src="${imgURL}" alt="${product.name}">
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
                    $('#totalAmount').text(formatVND(0));
                    // console.error('Giỏ hàng của bạn đang trống!:', error);
                }
            });
        }

        window.removeFromMiniCart = function(itemId) {
            $.ajax({
                type: 'POST',
                url: '/cart/remove/' + itemId, // API xóa sản phẩm
                data: {
                    '_method': 'DELETE', // Override phương thức HTTP thành DELETE
                    'id': itemId, // ID sản phẩm
                    '_token': '{{ csrf_token() }}' // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        console.log("Xóa sản phẩm thành công:", response.message);
                        loadCartItems();
                        loadCartItemCount();


                    } else {
                        console.error("Lỗi khi xóa sản phẩm:", response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Lỗi khi xóa sản phẩm:", textStatus, errorThrown);
                }
            });
        };

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

        loadCartItemCount();
        setInterval(loadCartItemCount, 60000);
        loadCartItems();
    });
</script>
@yield('js-setting')
