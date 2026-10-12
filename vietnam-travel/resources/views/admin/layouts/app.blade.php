<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin') - TPDĐ Travel
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background:
                linear-gradient(
                    180deg,
                    #f8fafc,
                    #f1f5f9
                );

            color: #0f172a;

            font-family:
                Inter,
                Arial,
                Helvetica,
                sans-serif;

            line-height: 1.5;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }


        /* ============================== */
        /* SIDEBAR */
        /* ============================== */

        .admin-sidebar {
            width: 260px;
            height: 100vh;

            position: fixed;
            top: 0;
            left: 0;

            z-index: 1000;

            display: flex;
            flex-direction: column;

            overflow-y: auto;

            background:
                linear-gradient(
                    180deg,
                    #0f766e,
                    #115e59
                );

            color: white;

            transition:
                transform .3s ease;
        }

        .admin-logo {
            padding: 25px 22px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.15);
        }

        .admin-logo h2 {
            font-size: 22px;
        }

        .admin-logo span {
            display: block;

            margin-top: 5px;

            color: #ccfbf1;
            font-size: 12px;
        }


        /* MENU */

        .admin-menu {
            flex: 1;

            padding: 20px 12px;
        }

        .menu-label {
            margin: 15px 12px 8px;

            color: #99f6e4;

            font-size: 11px;
            font-weight: bold;

            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-menu a {
            display: flex;

            align-items: center;

            gap: 12px;

            padding: 12px 14px;
            margin-bottom: 5px;

            color: #e6fffb;

            border-radius: 11px;

            text-decoration: none;

            font-size: 14px;

            transition: 0.2s;
        }

        .admin-menu a:hover {
            background:
                rgba(255, 255, 255, 0.12);

            color: white;
        }

        .admin-menu a.active {
            background:
                rgba(255,255,255,.95);

            color: #0f766e;

            font-weight: 700;

            box-shadow:
                0 6px 18px
                rgba(0,0,0,.08);
        }

        .menu-icon {
            width: 22px;

            text-align: center;

            font-size: 17px;
        }


        /* SIDEBAR BOTTOM */

        .sidebar-bottom {
            padding: 15px 12px;

            border-top:
                1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar-bottom a {
            display: block;

            padding: 11px 14px;

            color: #ccfbf1;

            border-radius: 8px;

            text-decoration: none;

            font-size: 13px;
        }

        .sidebar-bottom a:hover {
            background:
                rgba(255, 255, 255, 0.1);

            color: white;
        }


        /* ============================== */
        /* MAIN */
        /* ============================== */

        .admin-main {
            width: calc(100% - 260px);
            min-width: 0;

            margin-left: 260px;

            transition:
                margin-left .3s ease,
                width .3s ease;
        }


        /* ============================== */
        /* TOPBAR */
        /* ============================== */

        .admin-topbar {
            min-height: 74px;

            position: sticky;
            top: 0;

            z-index: 500;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding:
                14px
                clamp(18px, 3vw, 32px);

            background:
                rgba(255,255,255,.92);

            backdrop-filter:
                blur(14px);

            border-bottom:
                1px solid #e2e8f0;
        }

        .topbar-title h1 {
            color: #0f172a;

            font-size:
                clamp(18px, 2vw, 22px);
        }

        .topbar-title p {
            margin-top: 3px;

            color: #64748b;

            font-size: 12px;
        }


        /* ADMIN USER */

        .admin-user {
            display: flex;

            align-items: center;

            gap: 11px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #ccfbf1;

            color: #0f766e;

            border-radius: 50%;

            font-weight: bold;
        }

        .admin-user-info strong {
            display: block;

            color: #1f2937;

            font-size: 13px;
        }

        .admin-user-info span {
            color: #64748b;

            font-size: 11px;
        }


        /* ============================== */
        /* CONTENT */
        /* ============================== */

        .admin-content {
            width: 100%;
            max-width: 1500px;

            margin: 0 auto;

            padding:
                clamp(18px, 3vw, 32px);
        }


        .admin-menu-button {
            display: none;

            width: 42px;
            height: 42px;

            flex-shrink: 0;

            align-items: center;
            justify-content: center;

            border:
                1px solid #e2e8f0;

            border-radius: 11px;

            background: white;

            color: #0f766e;

            font-size: 21px;

            cursor: pointer;
        }


        .admin-overlay {
            display: none;

            position: fixed;

            inset: 0;

            z-index: 900;

            background:
                rgba(15,23,42,.45);

            backdrop-filter:
                blur(2px);
        }

        .admin-overlay.show {
            display: block;
        }


        /* ================= RESPONSIVE ================= */

        @media (max-width: 992px) {

            .admin-sidebar {
                width: 250px;

                transform:
                    translateX(-100%);
            }

            .admin-sidebar.show {
                transform:
                    translateX(0);
            }

            .admin-main {
                width: 100%;

                margin-left: 0;
            }

            .admin-menu-button {
                display: flex;
            }

        }


        @media (max-width: 650px) {

            .admin-topbar {
                min-height: 68px;

                gap: 10px;

                padding:
                    12px 14px;
            }

            .topbar-title {
                min-width: 0;
            }

            .topbar-title h1 {
                font-size: 17px;
            }

            .topbar-title p {
                display: none;
            }

            .admin-user {
                gap: 7px;
            }

            .admin-avatar {
                width: 36px;
                height: 36px;
            }

            .admin-user-info {
                display: none;
            }

            .admin-content {
                padding:
                    18px 14px
                    30px;
            }

        }

    </style>

    @stack('styles')

</head>

<body>

<div class="admin-wrapper">


    {{-- ================================= --}}
    {{-- SIDEBAR --}}
    {{-- ================================= --}}

    <aside class="admin-sidebar">

        <div class="admin-logo">

            <h2>
                TPDĐ Admin
            </h2>

            <span>
                Hệ thống quản trị
            </span>

        </div>


        <nav class="admin-menu">

            <div class="menu-label">
                Tổng quan
            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard')
                    ? 'active'
                    : '' }}"
            >
                <span class="menu-icon">📊</span>

                Dashboard
            </a>


            <div class="menu-label">
                Quản lý
            </div>


            <a href="{{ route('admin.places.index') }}"
                class="{{ request()->routeIs('admin.places.*') ? 'active' : '' }}">

                    <span>📍</span>
                    Địa điểm

            </a>


            <a href="{{ route('admin.provinces.index') }}"
                class="{{ request()->routeIs('admin.provinces.*') ? 'active' : '' }}">

                    <span>🗺️</span>
                    Tỉnh / Thành phố

            </a>


            <a href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

                    <span>🏷️</span>
                    Danh mục

            </a>


            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

                    <span>👥</span>
                    Người dùng

            </a>


            <div class="menu-label">
                Nội dung
            </div>


            <a href="{{ route('admin.comments.index') }}"
                class="{{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    <span>💬</span>
                    Bình luận
            </a>


            <a href="{{ route('admin.ratings.index') }}"
                class="{{ request()->routeIs('admin.ratings.*') ? 'active' : '' }}">
                    <span>⭐</span>
                    Đánh giá
            </a>

        </nav>


        <div class="sidebar-bottom">

            <a href="{{ url('/') }}">
                ← Về trang người dùng
            </a>

        </div>

    </aside>


    <div
        class="admin-overlay"
        id="adminOverlay"
    ></div>



    {{-- ================================= --}}
    {{-- MAIN --}}
    {{-- ================================= --}}

    <main class="admin-main">


        {{-- TOPBAR --}}

        <header class="admin-topbar">

            <button
                type="button"
                class="admin-menu-button"
                id="adminMenuButton"
                aria-label="Mở menu quản trị"
            >
                ☰
            </button>

            <div class="topbar-title">

                <h1>
                    @yield('page-title', 'Dashboard')
                </h1>

                <p>
                    Quản lý hệ thống TPDĐ Travel
                </p>

            </div>


            <div class="admin-user">

                <div class="admin-avatar">
                    {{
                        strtoupper(
                            substr(
                                auth()->user()->name,
                                0,
                                1
                            )
                        )
                    }}
                </div>

                <div class="admin-user-info">

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <span>
                        Quản trị viên
                    </span>

                </div>

            </div>

        </header>


        {{-- CONTENT --}}

        <section class="admin-content">

            @yield('content')

        </section>

    </main>

</div>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const menuButton =
                document.getElementById(
                    'adminMenuButton'
                );

            const sidebar =
                document.querySelector(
                    '.admin-sidebar'
                );

            const overlay =
                document.getElementById(
                    'adminOverlay'
                );


            if (
                !menuButton ||
                !sidebar ||
                !overlay
            ) {
                return;
            }


            function openAdminMenu() {

                sidebar
                    .classList
                    .add('show');

                overlay
                    .classList
                    .add('show');

            }


            function closeAdminMenu() {

                sidebar
                    .classList
                    .remove('show');

                overlay
                    .classList
                    .remove('show');

            }


            menuButton.addEventListener(
                'click',
                function () {

                    if (
                        sidebar.classList
                            .contains('show')
                    ) {

                        closeAdminMenu();

                    } else {

                        openAdminMenu();

                    }

                }
            );


            overlay.addEventListener(
                'click',
                closeAdminMenu
            );


            sidebar
                .querySelectorAll('a')
                .forEach(
                    function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                if (
                                    window.innerWidth
                                    <= 992
                                ) {
                                    closeAdminMenu();
                                }

                            }
                        );

                    }
                );

        }
    );

</script>


@stack('scripts')

</body>

</html>