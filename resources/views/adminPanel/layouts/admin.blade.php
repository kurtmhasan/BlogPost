<!DOCTYPE html>
<html
    lang="tr"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('adminPanel/assets/') }}/" data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title', 'Admin Panel') - Sneat</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('adminPanel/assets/img/favicon/favicon.ico') }}" /> <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('adminPanel/assets/vendor/css/core.css') }}" class="template-customizer-core-css" /> <link rel="stylesheet" href="{{ asset('adminPanel/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" /> <link rel="stylesheet" href="{{ asset('adminPanel/assets/css/demo.css') }}" /> <link rel="stylesheet" href="{{ asset('adminPanel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" /> <script src="{{ asset('adminPanel/assets/vendor/js/helpers.js') }}"></script> <script src="{{ asset('adminPanel/assets/js/config.js') }}"></script> @stack('styles')
    @yield('styles')
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{-- route('admin.dashboard') --}}" class="app-brand-link">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <li class="menu-item">
                    <a href="{{route('admin.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Akış</div>
                    </a>
                </li>

                <li class="menu-item ">
                    <a href="{{ route('admin.page.userList')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-file"></i>
                        <div data-i18n="Tables">kullanıcılar</div>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="layout-page">

            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none"
                                placeholder="Ara..."
                                aria-label="Ara..."
                            />
                        </div>
                    </div>
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset('adminPanel/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" /> </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ asset('adminPanel/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" /> </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">Admin Adı</span>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('show.posts')}}">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">Uygulamaya git</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="border:0; background:transparent; padding:0;">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Çıkış Yap</span>
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , Blog Projesi
                        </div>
                    </div>
                </footer>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<script src="{{ asset('adminPanel/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('adminPanel/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('adminPanel/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('adminPanel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('adminPanel/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('adminPanel/assets/js/main.js') }}"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

@yield('scripts')
@stack('scripts')

</body>
</html>
