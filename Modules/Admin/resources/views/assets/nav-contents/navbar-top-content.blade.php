<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href={{ route('admin.dashboard') }}>
        <div class="d-flex align-items-center"><img class="me-2"
                src="{{ asset('theme/admin/img/icons/spot-illustrations/falcon.png') }}" alt=""
                width="80" />
    </a>
    {{-- <ul class="navbar-nav align-items-center d-none d-lg-block">
        <li class="nav-item">
            <div class="search-box" data-list='{"valueNames":["title"]}'>
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                    <input class="form-control search-input fuzzy-search" type="search" placeholder="Search..."
                        aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>
                </form>
                <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none"
                    data-bs-dismiss="search">
                    <button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button>
                </div>
                <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                    <div class="scrollbar list py-3" style="max-height: 24rem;">
                        <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">
                            Recently Browsed</h6><a class="dropdown-item fs-10 px-x1 py-1 hover-primary"
                            href="app/events/event-detail.html">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-circle me-2 text-300 fs-11"></span>
                                <div class="fw-normal title">Pages <span
                                        class="fas fa-chevron-right mx-1 text-500 fs-11"
                                        data-fa-transform="shrink-2"></span> Events</div>
                            </div>
                        </a>
                        <a class="dropdown-item fs-10 px-x1 py-1 hover-primary" href="app/e-commerce/customers.html">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-circle me-2 text-300 fs-11"></span>
                                <div class="fw-normal title">E-commerce <span
                                        class="fas fa-chevron-right mx-1 text-500 fs-11"
                                        data-fa-transform="shrink-2"></span> Customers</div>
                            </div>
                        </a>
                        <hr class="text-200 dark__text-900" />
                        <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">
                            Suggested Filter</h6><a class="dropdown-item px-x1 py-1 fs-9"
                            href="app/e-commerce/customers.html">
                            <div class="d-flex align-items-center"><span
                                    class="badge fw-medium text-decoration-none me-2 badge-subtle-warning">customers:</span>
                                <div class="flex-1 fs-10 title">All customers list</div>
                            </div>
                        </a>
                        <a class="dropdown-item px-x1 py-1 fs-9" href="app/events/event-detail.html">
                            <div class="d-flex align-items-center"><span
                                    class="badge fw-medium text-decoration-none me-2 badge-subtle-success">events:</span>
                                <div class="flex-1 fs-10 title">Latest events in current month</div>
                            </div>
                        </a>
                        <a class="dropdown-item px-x1 py-1 fs-9" href="app/e-commerce/product/product-grid.html">
                            <div class="d-flex align-items-center"><span
                                    class="badge fw-medium text-decoration-none me-2 badge-subtle-info">products:</span>
                                <div class="flex-1 fs-10 title">Most popular products</div>
                            </div>
                        </a>
                        <hr class="text-200 dark__text-900" />
                        <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">
                            Files</h6><a class="dropdown-item px-x1 py-2" href="#!">
                            <div class="d-flex align-items-center">
                                <div class="file-thumbnail me-2"><img
                                        class="border h-100 w-100 object-fit-cover rounded-3"
                                        src="{{ asset('theme/admin/img/products/3-thumb.png') }}" alt="" />
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">iPhone</h6>
                                    <p class="fs-11 mb-0 d-flex"><span class="fw-semi-bold">Antony</span><span
                                            class="fw-medium text-600 ms-2">27 Sep at 10:30 AM</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item px-x1 py-2" href="#!">
                            <div class="d-flex align-items-center">
                                <div class="file-thumbnail me-2"><img class="img-fluid"
                                        src="{{ asset('theme/admin/img/icons/zip.png') }}" alt="" /></div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Falcon v1.8.2</h6>
                                    <p class="fs-11 mb-0 d-flex"><span class="fw-semi-bold">John</span><span
                                            class="fw-medium text-600 ms-2">30 Sep at 12:30 PM</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <hr class="text-200 dark__text-900" />
                        <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs-11 pt-0 pb-2">
                            Members</h6><a class="dropdown-item px-x1 py-2" href="pages/user/profile.html">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-l status-online me-2">
                                    <img class="rounded-circle" src="{{ asset('theme/admin/img/team/1.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Anna Karinina</h6>
                                    <p class="fs-11 mb-0 d-flex">Technext Limited</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item px-x1 py-2" href="pages/user/profile.html">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-l me-2">
                                    <img class="rounded-circle" src="{{ asset('theme/admin/img/team/2.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Antony Hopkins</h6>
                                    <p class="fs-11 mb-0 d-flex">Brain Trust</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item px-x1 py-2" href="pages/user/profile.html">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-l me-2">
                                    <img class="rounded-circle" src="{{ asset('theme/admin/img/team/3.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Emma Watson</h6>
                                    <p class="fs-11 mb-0 d-flex">Google</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="text-center mt-n3">
                        <p class="fallback fw-bold fs-8 d-none">No Result Found.</p>
                    </div>
                </div>
            </div>
        </li>
    </ul> --}}
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item ps-2 pe-0">
            <div class="dropdown theme-control-dropdown">
                <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                    href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><span class="fas fa-sun fs-7"
                        data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></span><span
                        class="fas fa-moon fs-7" data-fa-transform="shrink-3"
                        data-theme-dropdown-toggle-icon="dark"></span><span class="fas fa-adjust fs-7"
                        data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></span></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3"
                    aria-labelledby="themeSwitchDropdown">
                    <div class="bg-white dark__bg-1000 rounded-2 py-2"><button
                            class="dropdown-item d-flex align-items-center gap-2" type="button" value="light"
                            data-theme-control="theme"><span class="fas fa-sun"></span>Light<span
                                class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button><button
                            class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark"
                            data-theme-control="theme"><span class="fas fa-moon"
                                data-fa-transform=""></span>Dark<span
                                class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button><button
                            class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto"
                            data-theme-control="theme"><span class="fas fa-adjust"
                                data-fa-transform=""></span>Auto<span
                                class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
               id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
               <span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span>
            </a>

            <div class="dropdown-menu dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                 aria-labelledby="navbarDropdownNotification">
                <div class="card card-notification shadow-none">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h6 class="card-header-title mb-0">Thông báo</h6>
                            </div>
                            <div class="col-auto ps-0 ps-sm-3">
                                <a class="card-link fw-normal" href="#">Đánh dấu tất cả là đã đọc</a>
                            </div>
                        </div>
                    </div>

                    <div class="scrollbar-overlay" style="max-height:19rem;">
                        <!-- Notification List Container -->
                        <div class="list-group list-group-flush fw-normal fs-10" id="list-group-flush">
                            <!-- Dynamic content will be loaded here by JavaScript -->
                        </div>
                    </div>

                    <div class="card-footer text-center border-top">
                        <a class="card-link d-block" href="{{ route('admin.notifications.index') }}">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="{{ Storage::url(Auth::user()->user_image) }}"
                        alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">chi tiết tài khoản</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout.admin')}}">Đăng xuất</a>
                </div>
            </div>
        </li>
    </ul>
</nav>
