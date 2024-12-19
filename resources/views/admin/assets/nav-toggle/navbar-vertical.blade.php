<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div><a class="navbar-brand" href={{ route('admin.dashboard') }}>
            <div class="d-flex align-items-center py-3"><img class="me-2"
                    src="{{ asset('theme/admin/img/icons/spot-illustrations/falcon.png') }}" alt=""
                    width="40" /><span class="font-sans-serif text-primary">falcon</span></div>
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
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">E commerce</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-ticket-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Coupons</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.categories.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-list-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Categories</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#product" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="product">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-boxes"></span>
                            </span>
                            <span class="nav-link-text ps-1">Products</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="product">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.list') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">List Products</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.addProduct') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Add Product</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Detail Product</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a class="nav-link" href="{{ route('admin.attributes.listAttr') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-layer-group"></span>
                            </span>
                            <span class="nav-link-text ps-1">Attributes</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#orders" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="orders">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fab fa-opencart"></span>
                            </span>
                            <span class="nav-link-text ps-1">Orders</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="orders">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.list') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">List Orders</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.detail') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Detail Order</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Authentication</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.account.list') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-user-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">List Accounts</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Statistical</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Report</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
