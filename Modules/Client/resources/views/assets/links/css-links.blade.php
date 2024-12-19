<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('theme/client/css/bootstrap.min.css') }}">
<!-- Fontawesome -->
<link rel="stylesheet" href="{{ asset('theme/client/css/font-awesome.min.css') }}">
<!-- Fontawesome Star -->
<link rel="stylesheet" href="{{ asset('theme/client/css/fontawesome-stars.min.css') }}">
<!-- Ion Icon -->
<link rel="stylesheet" href="{{ asset('theme/client/css/ion-fonts.css') }}">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{ asset('theme/client/css/slick.css') }}">
<!-- Animation -->
<link rel="stylesheet" href="{{ asset('theme/client/css/animate.min.css') }}">
<!-- jQuery Ui -->
<link rel="stylesheet" href="{{ asset('theme/client/css/jquery-ui.min.css') }}">
<!-- Nice Select -->
<link rel="stylesheet" href="{{ asset('theme/client/css/nice-select.css') }}">
<!-- Timecircles -->
<link rel="stylesheet" href="{{ asset('theme/client/css/timecircles.css') }}">
@yield('css-libs')
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{ asset('theme/client/css/style.css') }}">
<script>
    window.addEventListener('beforeunload', function(event) {
        // Kiểm tra URL hiện tại và URL đích
        if (window.location.pathname !== '/cart/checkout' && !event.target.activeElement.href.includes(
                '/cart/checkout')) {
            // Gửi yêu cầu AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/cart/remove-discount-code', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // Thêm CSRF token
            xhr.send(JSON.stringify({
                '_token': '{{ csrf_token() }}' // Thêm CSRF token vào dữ liệu gửi đi
            }));
        }
    });
</script>
@yield('css-setting')
