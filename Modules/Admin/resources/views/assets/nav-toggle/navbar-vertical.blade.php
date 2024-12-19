<?php
// Lấy thông tin người dùng hiện tại
use App\Models\Role;
$user = \App\Models\User::query()
    ->select(
        'users.id as id',
        'users.user_name as user_name',
        'users.full_name as full_name',
        'users.phone as phone',
        'users.email as email',
        'users.password as password',
        'users.address as address',
        'users.user_image as user_image',
        'users.roles_id as roles_id',
        'roles.name as role_type',
        'users.status as status',
        'users.verify as verify'
    )
    ->join('roles', 'users.roles_id', '=', 'roles.id')
    ->where('users.id', '=', Auth::user()->id)
    ->first();

// Lấy danh sách quyền
$roles = Role::whereNotIn('id', [15])->get();

// Lấy các role mà người dùng hiện tại đang có
$userRoleIds = $user->roles->pluck('id')->toArray();
// Mảng quyền và menu
$permissions = [
    'comment_manager' => 'admin.comment.listComment',
    'coupon_manager' => 'admin.coupons.index',
    'category_manager' => 'admin.categories.list',
    'post_manager' => 'admin.posts.list',
    'product_manager' => 'admin.product.list',
    'attribute_manager' => 'admin.attributes.listAttr',
    'tag_manager' => 'admin.tags.list',
    'ticket_manager' => 'admin.ticket.index',
    'banner_manager' => 'admin.banner.slider',
    'order_manager' => 'admin.orders.list',
    'wallet_manager' => 'admin.wallet.list',
    'customer_manager' => 'admin.users.index',
    'statistical_viewer' => 'admin.statistical.listStatistical',
];

?>

<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div>
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <div class="d-flex align-items-center py-3"><img class="me-2"
                                                            src="{{ asset('theme/admin/img/icons/spot-illustrations/falcon.png') }}" alt=""
                                                            width="200" /><span class="font-sans-serif text-primary"></span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>
                </li>
                @if(!in_array(1, $userRoleIds))
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Quản lý chung</div>
                    <div class="col ps-0">
                        <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                </div>
               @endif
                <!-- Quản lý chung -->
                @if(in_array(2, $userRoleIds)) <!-- Check if the user has the 'super_admin' role -->

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comment.listComment') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-comment-alt"></span></span>
                                <span class="nav-link-text ps-1">Bình luận</span>
                            </div>
                        </a>
                    </li>

                @endif
                @if(in_array(3, $userRoleIds)) <!-- Check if the user has the 'coupon_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.coupons.index') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-ticket-alt"></span></span>
                                <span class="nav-link-text ps-1">Mã Giảm giá</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(4, $userRoleIds)) <!-- Check if the user has the 'category_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.list') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-list-alt"></span></span>
                                <span class="nav-link-text ps-1">Danh mục</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(5, $userRoleIds)) <!-- Check if the user has the 'post_manager' role -->
                <a class="nav-link dropdown-indicator" href="#blogs" role="button" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="blogs">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                        <span class="far fa-newspaper"></span>
                    </span>
                    <span class="nav-link-text ps-1">Bài Viết</span>
                </div>
            </a>
            <ul class="nav collapse" id="blogs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.posts.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Danh sách bài viết</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.posts.create') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Thêm bài viết</span>
                        </div>
                    </a>
                </li>
            </ul>
                @endif

                @if(in_array(6, $userRoleIds)) <!-- Check if the user has the 'product_manager' role -->
                <a class="nav-link dropdown-indicator" href="#product" role="button" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="product">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                        <span class="fas fa-boxes"></span>
                    </span>
                    <span class="nav-link-text ps-1">Sản phẩm</span>
                </div>
            </a>
            <ul class="nav collapse" id="product">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Danh sách sản phẩm</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.addProduct') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Thêm sản phẩm</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.listTrashed') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Sản phẩm đã xóa</span>
                        </div>
                    </a>
                </li>
            </ul>
                @endif

                @if(in_array(7, $userRoleIds)) <!-- Check if the user has the 'attribute_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.attributes.listAttr') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-layer-group"></span></span>
                                <span class="nav-link-text ps-1">Thuộc tính</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(8, $userRoleIds)) <!-- Check if the user has the 'tag_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tags.list') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-tag"></span></span>
                                <span class="nav-link-text ps-1">Thẻ</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(9, $userRoleIds)) <!-- Check if the user has the 'ticket_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.ticket.index') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="far fa-user"></span></span>
                                <span class="nav-link-text ps-1">Hỗ trợ khách hàng</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(10, $userRoleIds)) <!-- Check if the user has the 'banner_manager' role -->
                <a class="nav-link dropdown-indicator" href="#banner" role="button" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="blogs">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                        <span class="fas fa-image"></span>
                    </span>
                    <span class="nav-link-text ps-1">Banner - Slider</span>
                </div>
            </a>
            <ul class="nav collapse" id="banner">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.banner.slider') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Slider</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.banner.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text ps-1">Banner</span>
                        </div>
                    </a>
                </li>
            </ul>
                @endif

                @if(in_array(11, $userRoleIds)) <!-- Check if the user has the 'order_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.list') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="far fa-file-alt"></span></span>
                                <span class="nav-link-text ps-1">Đơn hàng</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(12, $userRoleIds)) <!-- Check if the user has the 'wallet_manager' role -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Ví Tiền</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.wallet.list') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh sách yêu cầu rút tiền</span>
                        </div>
                    </a>
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                          <a class="nav-link" href="{{ route('admin.wallet.listallwallet') }}">  <span class="nav-link-text ps-1">Quản lý ví tiền</span> </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <a class="nav-link" href="{{ route('admin.wallet.listUserPending') }}">  <span class="nav-link-text ps-1">Yêu cầu duyệt thông tin</span> </a>
                        </div>


                </li>

                @endif

                @if(in_array(13, $userRoleIds)) <!-- Check if the user has the 'customer_manager' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-user-alt"></span></span>
                                <span class="nav-link-text ps-1">Khách hàng</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(in_array(14, $userRoleIds)) <!-- Check if the user has the 'statistical_viewer' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.statistical.listStatistical') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span>
                                <span class="nav-link-text ps-1">Báo cáo</span>
                            </div>
                        </a>
                    </li>
                @endif
                @if(in_array(1, $userRoleIds)) <!-- Check if the user has the 'statistical_viewer' role -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Quản lý chung</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.comment.listComment') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-comment-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Bình luận</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.coupons.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-ticket-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Mã Giảm giá</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.categories.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-list-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh mục</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#blogs" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="blogs">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="far fa-newspaper"></span>
                            </span>
                            <span class="nav-link-text ps-1">Bài Viết</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="blogs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.posts.list') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Danh sách bài viết</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.posts.create') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Thêm bài viết</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a class="nav-link dropdown-indicator" href="#product" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="product">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-boxes"></span>
                            </span>
                            <span class="nav-link-text ps-1">Sản phẩm</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="product">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.list') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Danh sách sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.addProduct') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Thêm sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.listTrashed') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Sản phẩm đã xóa</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a class="nav-link" href="{{ route('admin.attributes.listAttr') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-layer-group"></span>
                            </span>
                            <span class="nav-link-text ps-1">Thuộc tính</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.tags.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-tag"></span>
                            </span>
                            <span class="nav-link-text ps-1">Thẻ</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.ticket.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="far fa-user"></span>
                            </span>
                            <span class="nav-link-text ps-1">Hỗ trợ khách hàng</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#banner" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="blogs">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-image"></span>
                            </span>
                            <span class="nav-link-text ps-1">Banner - Slider</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="banner">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.banner.slider') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Slider</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.banner.list') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Banner</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a class="nav-link" href="{{ route('admin.orders.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="far fa-file-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Đơn hàng</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Ví Tiền</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.wallet.list') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh sách yêu cầu rút tiền</span>
                        </div>
                    </a>
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                          <a class="nav-link" href="{{ route('admin.wallet.listallwallet') }}">  <span class="nav-link-text ps-1">Quản lý ví tiền</span> </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <a class="nav-link" href="{{ route('admin.wallet.listUserPending') }}">  <span class="nav-link-text ps-1">Yêu cầu duyệt thông tin</span> </a>
                        </div>


                </li>


                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Quản lý tài khoản</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.accounts.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-user-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh sách tài khoản</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Quản lý tài khoản khách hàng</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-user-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh sách tài khoản khách hàng</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Thống kê</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.statistical.listStatistical') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Báo cáo</span>
                        </div>
                    </a>

                </li>

                @endif


            </ul>
        </div>
    </div>
</nav>
