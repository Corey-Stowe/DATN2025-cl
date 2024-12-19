<script>
    $(document).ready(function() {
        // Hàm để lấy thông báo
        function loadNotifications() {
            $.ajax({
                url: '{{ route('api.notifications.index') }}',
                method: 'GET',
                success: function(data) {
                    if (data) {
                        let notificationsHtml = '';
                        data.forEach(notification => {
                            // Parse the `message` field if it's a JSON string
                            let messageContent;
                            try {
                                messageContent = JSON.parse(notification.message);
                            } catch (e) {
                                console.error('Invalid JSON format in notification message',
                                    e);
                                messageContent = {
                                    message: 'Invalid message format'
                                };
                            }

                            // Conditionally add the 'notification-unread' class based on `is_read`
                            const unreadClass = notification.is_read === 1 ? '' :
                                'notification-unread';

                            notificationsHtml += `
                        <div class="list-group-item">
                            <a class="notification notification-flush ${unreadClass}" href="#!">
                                <div class="notification-avatar">
                                    <div class="avatar avatar-2xl me-3">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                                                viewBox="0 0 120 120">
                                                <rect width="16.071" height="15" x="51.964" y="8.999" fill="#ffa400"></rect>
                                                <circle cx="60" cy="97" r="18" opacity=".35"></circle>
                                                <circle cx="60" cy="93" r="18" fill="#ffa400"></circle>
                                                <path fill="#ffc400"
                                                    d="M96,82.999H24V53.115c0-19.882,16.118-36,36-36l0,0c19.882,0,36,16.118,36,36V82.999z">
                                                </path>
                                                <rect width="88" height="16" x="16" y="85" opacity=".35"></rect>
                                                <rect width="88" height="16" x="16" y="81" fill="#ffc400"></rect>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-body">
                                    <p class="mb-1"><strong>${notification.title || 'không có tiêu đề'}</strong></p>
                                    <p class="mb-0">${messageContent.message || 'không'}</p>
                                </div>
                            </a>
                        </div>
                    `;
                        });
                        $('#list-group-flush').html(notificationsHtml);
                    } else {
                        alert(data);
                        $('#list-group-flush').html('<p>Không có thông báo</p>');
                    }
                },
                error: function() {
                    $('#list-group-flush').html('<p>không tải thông báo thành công </p>');
                }
            });
        }

        function checkUnreadNotifications() {
            $.ajax({
                url: '{{ route('api.notifications.count.read') }}',
                method: 'GET',
                success: function(data) {
                    if (data.unread_count > 0) {
                        // Thêm chấm xanh nếu có thông báo chưa đọc
                        $('#navbarDropdownNotification').addClass('notification-indicator');
                    } else {
                        // Xóa chấm xanh nếu không còn thông báo chưa đọc
                        $('#navbarDropdownNotification').removeClass('notification-indicator');
                    }
                },
                error: function() {
                    console.error('Error checking unread notifications');
                }
            });
        }

        // Gọi hàm này khi tải trang
        $(document).ready(function() {
            checkUnreadNotifications();

            // Hoặc gọi định kỳ để kiểm tra, ví dụ mỗi 30 giây
            setInterval(checkUnreadNotifications, 30000);
        });

         // Gọi hàm này khi tải trang
         // Gọi hàm để tải thông báo khi trang được tải
         $(document).ready(function() {
            loadNotifications();

            // Hoặc gọi định kỳ để kiểm tra, ví dụ mỗi 30 giây
            setInterval(loadNotifications, 30000);
        });

        
        // loadNotifications();


        $('.card-link.fw-normal').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('api.notifications.read') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Thêm CSRF token vào đây
                },
                success: function() {
                    // Cập nhật giao diện sau khi đánh dấu
                    $('.notification-unread').removeClass('notification-unread');
                    $('.notification-indicator').removeClass('notification-indicator');
                    // alert('Tất cả thông báo đã được đánh dấu là đã đọc.');
                },
                error: function() {
                    console.error('Error marking notifications as read');
                }
            });
        });

    });
</script>

<!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
<script src="{{ asset('theme/admin/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('theme/admin/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/admin/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('theme/admin/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('theme/admin/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('theme/admin/vendors/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('theme/admin/js/polyfill.min58be.js?features=window.scroll') }}"></script>
<script src="{{ asset('theme/admin/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('theme/admin/js/theme.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
