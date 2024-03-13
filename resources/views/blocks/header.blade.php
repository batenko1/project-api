<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
{{--        <div class="navbar-nav align-items-center">--}}
{{--            <div class="nav-item navbar-search-wrapper mb-0">--}}
{{--                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">--}}
{{--                    <i class="ti ti-search ti-md me-2"></i>--}}
{{--                    <span class="d-none d-md-inline-block text-muted">Поиск (Ctrl+/)</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->


            <!-- Style Switcher -->


            <!-- Notification -->
{{--            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">--}}
{{--                <a--}}
{{--                    class="nav-link dropdown-toggle hide-arrow"--}}
{{--                    href="javascript:void(0);"--}}
{{--                    data-bs-toggle="dropdown"--}}
{{--                    data-bs-auto-close="outside"--}}
{{--                    aria-expanded="false">--}}
{{--                    <i class="ti ti-bell ti-md"></i>--}}
{{--                    <span class="badge bg-danger rounded-pill badge-notifications">5</span>--}}
{{--                </a>--}}
{{--                <ul class="dropdown-menu dropdown-menu-end py-0">--}}
{{--                    <li class="dropdown-menu-header border-bottom">--}}
{{--                        <div class="dropdown-header d-flex align-items-center py-3">--}}
{{--                            <h5 class="text-body mb-0 me-auto">Уведомления</h5>--}}
{{--                            <a--}}
{{--                                href="javascript:void(0)"--}}
{{--                                class="dropdown-notifications-all text-body"--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-bs-placement="top"--}}
{{--                                title="Mark all as read"--}}
{{--                            ><i class="ti ti-mail-opened fs-4"></i--}}
{{--                                ></a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="dropdown-notifications-list scrollable-container">--}}
{{--                        <ul class="list-group list-group-flush">--}}
{{--                            <li class="list-group-item list-group-item-action dropdown-notifications-item">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="flex-shrink-0 me-3">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow-1">--}}
{{--                                        <h6 class="mb-1">Congratulation Lettie 🎉</h6>--}}
{{--                                        <p class="mb-0">Won the monthly best seller gold badge</p>--}}
{{--                                        <small class="text-muted">1h ago</small>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-shrink-0 dropdown-notifications-actions">--}}
{{--                                        <a href="javascript:void(0)" class="dropdown-notifications-read"--}}
{{--                                        ><span class="badge badge-dot"></span--}}
{{--                                            ></a>--}}
{{--                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"--}}
{{--                                        ><span class="ti ti-x"></span--}}
{{--                                            ></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item list-group-item-action dropdown-notifications-item">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="flex-shrink-0 me-3">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <span class="avatar-initial rounded-circle bg-label-danger">CF</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow-1">--}}
{{--                                        <h6 class="mb-1">Charles Franklin</h6>--}}
{{--                                        <p class="mb-0">Accepted your connection</p>--}}
{{--                                        <small class="text-muted">12hr ago</small>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-shrink-0 dropdown-notifications-actions">--}}
{{--                                        <a href="javascript:void(0)" class="dropdown-notifications-read"--}}
{{--                                        ><span class="badge badge-dot"></span--}}
{{--                                            ></a>--}}
{{--                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"--}}
{{--                                        ><span class="ti ti-x"></span--}}
{{--                                            ></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="dropdown-menu-footer border-top">--}}
{{--                        <a--}}
{{--                            href="javascript:void(0);"--}}
{{--                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">--}}
{{--                            View all notifications--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    {{auth()->user()->name }} / {{ auth()->user()->email }}
{{--                    <div class="avatar avatar-online">--}}
{{--                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />--}}
{{--                        <p>{{ auth()->user()->email }}</p>--}}
{{--                    </div>--}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>

                        <a class="dropdown-item" href="javascript:void(0);">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">Изменить пароль</span>
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">Выйти</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
{{--    <div class="navbar-search-wrapper search-input-wrapper d-none">--}}
{{--        <input--}}
{{--            type="text"--}}
{{--            class="form-control search-input container-xxl border-0"--}}
{{--            placeholder="Поиск..."--}}
{{--            aria-label="Search..." />--}}
{{--        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>--}}
{{--    </div>--}}
</nav>
