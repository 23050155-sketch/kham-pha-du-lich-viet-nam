<style>

    .navbar {
        position: fixed;
        top: 0;
        left: 0;

        width: 100%;

        z-index: 1000;

        padding: 20px 40px;

        background: rgba(15, 118, 110, 0.9);
        backdrop-filter: blur(10px);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        text-decoration: none;

        color: white;

        font-size: 26px;
        font-weight: bold;

        letter-spacing: 1px;

        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav-links a {
        text-decoration: none;

        color: white;

        font-size: 16px;
        font-weight: 500;

        position: relative;

        transition: 0.25s;
    }

    .nav-links a:not(.login-btn)::after {
        content: "";

        position: absolute;

        left: 0;
        bottom: -6px;

        width: 0;
        height: 2px;

        background: white;

        transition: 0.25s;
    }

    .nav-links a:not(.login-btn):hover::after {
        width: 100%;
    }

    .nav-links a:hover {
        opacity: 0.9;
    }

    .login-btn {
        border: 1px solid rgba(255, 255, 255, 0.8);

        padding: 10px 18px;

        border-radius: 10px;

        transition: 0.25s;
    }

    .login-btn:hover {
        background: white;

        color: #0f766e !important;
    }


    .user-name {
        color: white;
        font-size: 15px;
        font-weight: 600;
    }

    .logout-form {
        margin: 0;
    }

    .logout-btn {
        border: 1px solid rgba(255, 255, 255, 0.8);
        background: transparent;
        color: white;

        padding: 10px 18px;
        border-radius: 10px;

        font-size: 15px;
        font-weight: 500;

        cursor: pointer;

        transition: 0.25s;
    }

    .logout-btn:hover {
        background: white;
        color: #0f766e;
    }



    .user-menu {
        position: relative;
    }

    .user-menu-button {
        display: flex;
        align-items: center;
        gap: 10px;

        border: none;
        background: transparent;

        color: white;

        cursor: pointer;

        font-size: 15px;
    }

    .user-avatar {
        width: 38px;
        height: 38px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: white;
        color: #0f766e;

        font-weight: bold;
        font-size: 16px;

        border: 2px solid rgba(255,255,255,.8);
    }

    .user-name {
        color: white;
        font-weight: 600;
    }

    .dropdown-arrow {
        font-size: 13px;
    }

    .user-dropdown {
        display: none;

        position: absolute;

        top: 50px;
        right: 0;

        width: 210px;

        background: white;

        border-radius: 12px;

        padding: 8px;

        box-shadow: 0 10px 30px rgba(0,0,0,.15);

        z-index: 2000;
    }

    .user-dropdown.show {
        display: block;
    }

    .user-dropdown a {
        display: block;

        padding: 11px 12px;

        color: #374151;

        text-decoration: none;

        border-radius: 8px;

        font-size: 14px;
    }

    .user-dropdown a:hover {
        background: #f0fdfa;
        color: #0f766e;
    }

    .dropdown-divider {
        height: 1px;

        background: #e5e7eb;

        margin: 6px 0;
    }

    .dropdown-logout {
        width: 100%;

        border: none;
        background: transparent;

        text-align: left;

        padding: 11px 12px;

        border-radius: 8px;

        color: #dc2626;

        font-size: 14px;

        cursor: pointer;
    }

    .dropdown-logout:hover {
        background: #fef2f2;
    }


    .user-avatar {
        overflow: hidden;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }



    /* NAVBAR SEARCH */

    .navbar-search {
        width: 300px;
        height: 42px;

        display: flex;
        align-items: center;

        padding-left: 12px;

        background: white;
        border-radius: 10px;

        overflow: visible;

        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
    }

    .navbar-search button {
        border-radius: 0 10px 10px 0;
    }

    .navbar-search-icon {
        flex-shrink: 0;

        color: #64748b;
        font-size: 20px;
    }

    .navbar-search input {
        flex: 1;
        min-width: 0;

        padding: 0 10px;

        border: none;
        outline: none;

        color: #374151;
        background: transparent;

        font-size: 13px;
    }

    .navbar-search input::placeholder {
        color: #94a3b8;
    }

    .navbar-search button {
        height: 100%;

        padding: 0 14px;

        border: none;

        background: #115e59;
        color: white;

        font-size: 12px;
        font-weight: 600;

        cursor: pointer;
    }

    .navbar-search button:hover {
        background: #134e4a;
    }



    .navbar-search {
        position: relative;
    }

    .navbar-search-suggestions {
        display: none;

        position: absolute;

        top: calc(100% + 8px);
        left: 0;

        width: 100%;
        max-height: 350px;

        overflow-y: auto;

        background: white;

        border: 1px solid #e5e7eb;
        border-radius: 10px;

        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);

        z-index: 3000;
    }

    .navbar-search-suggestions.show {
        display: block;
    }

    .navbar-suggestion-item {
        display: block;

        padding: 11px 13px;

        color: #374151 !important;
        text-decoration: none;

        border-bottom: 1px solid #f1f5f9;

        transition: 0.2s;
    }

    .navbar-suggestion-item:last-child {
        border-bottom: none;
    }

    .navbar-suggestion-item:hover {
        background: #f0fdfa;
    }

    .navbar-suggestion-name {
        display: block;

        color: #111827;

        font-size: 13px;
        font-weight: 600;
    }

    .navbar-suggestion-type {
        display: block;

        margin-top: 3px;

        color: #64748b;

        font-size: 11px;
    }

    .navbar-search-empty {
        padding: 14px;

        color: #64748b;

        font-size: 12px;
        text-align: center;
    }


    .navbar-popular-title {
        padding: 11px 13px;

        background: #f8fafc;

        color: #0f766e;

        border-bottom: 1px solid #e2e8f0;

        font-size: 12px;
        font-weight: 700;
    }

    .navbar-popular-item {
        cursor: pointer;
    }




    /* ====================================== */
    /* MOBILE MENU BUTTON */
    /* ====================================== */

    .mobile-menu-button {
        display: none;

        width: 42px;
        height: 42px;

        align-items: center;
        justify-content: center;

        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 10px;

        background: rgba(255, 255, 255, 0.10);

        color: white;

        font-size: 22px;

        cursor: pointer;

        transition: 0.2s;
    }

    .mobile-menu-button:hover {
        background: rgba(255, 255, 255, 0.18);
    }




    /* ====================================== */
    /* TABLET */
    /* ====================================== */

    @media (max-width: 1100px) {

        .navbar {
            padding: 16px 24px;
        }

        .navbar-container {
            gap: 15px;
        }

        .logo {
            font-size: 22px;
            white-space: nowrap;
        }

        .navbar-search {
            width: 230px;
        }

        .nav-links {
            gap: 13px;
        }

        .nav-links a {
            font-size: 14px;
        }

        .login-btn {
            padding: 8px 12px;
        }

        .user-name {
            max-width: 100px;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

    }





    /* ====================================== */
    /* MOBILE */
    /* ====================================== */

    @media (max-width: 768px) {

        .navbar {
            padding: 12px 14px;
        }

        .navbar-container {
            position: relative;

            display: grid;

            grid-template-columns:
                1fr
                auto;

            grid-template-rows:
                auto
                auto;

            align-items: center;

            gap: 10px;
        }


        /* LOGO */

        .logo {
            grid-column: 1;
            grid-row: 1;

            font-size: 20px;

            white-space: nowrap;
        }


        /* HAMBURGER */

        .mobile-menu-button {
            display: flex;

            grid-column: 2;
            grid-row: 1;

            justify-self: end;

            align-items: center;
            justify-content: center;
        }


        /* SEARCH */

        .navbar-search {
            grid-column: 1 / -1;
            grid-row: 2;

            width: 100%;
            height: 42px;

            margin: 0;
        }


        /* MENU */

        .nav-links {
            display: none;

            position: absolute;

            top: calc(100% + 10px);
            right: 0;

            width: min(
                290px,
                calc(100vw - 28px)
            );

            padding: 10px;

            flex-direction: column;

            align-items: stretch;

            gap: 4px;

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 16px;

            box-shadow:
                0 16px 40px
                rgba(15, 23, 42, 0.18);

            z-index: 4000;
        }


        .nav-links.show {
            display: flex;
        }


        .nav-links a {
            width: 100%;

            padding: 11px 12px;

            border-radius: 10px;

            color: #334155;

            font-size: 14px;

            text-align: left;
        }


        .nav-links a:hover {
            background: #f0fdfa;

            color: #0f766e;
        }


        .nav-links a::after {
            display: none;
        }


        .login-btn {
            border: none;

            background: #0f766e;

            color: white !important;

            text-align: center !important;
        }


        .login-btn:hover {
            background: #0d9488;

            color: white !important;
        }


        /* USER MENU */

        .user-menu {
            width: 100%;
        }


        .user-menu-button {
            width: 100%;

            padding: 10px 12px;

            justify-content: flex-start;

            color: #334155;

            border-radius: 10px;
        }


        .user-menu-button:hover {
            background: #f0fdfa;
        }


        .user-name {
            color: #334155;
        }


        .dropdown-arrow {
            margin-left: auto;
        }


        .user-dropdown {
            position: static;

            width: 100%;

            margin-top: 6px;

            border: 1px solid #e2e8f0;

            box-shadow: none;
        }

    }
</style>


@php
    $navbarProvinces = \App\Models\Province::query()
        ->select('name', 'slug')
        ->orderBy('name')
        ->get();

    $navbarPlaces = \App\Models\Place::query()
        ->where('status', 'active')
        ->select(
            'name',
            'slug',
            'province_id'
        )
        ->with('province:id,name')
        ->orderBy('name')
        ->get();

    $popularSearches = \App\Models\SearchHistory::query()
        ->selectRaw('keyword, COUNT(*) as total')
        ->groupBy('keyword')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
@endphp


<nav class="navbar">

    <div class="navbar-container">

        <a href="{{ url('/') }}" class="logo">
            TPDĐ Travel
        </a>


        {{-- NAVBAR SEARCH --}}
        <form
            action="{{ route('search.results') }}"
            method="GET"
            class="navbar-search"
            id="navbarSearchForm"
        >
            <span class="navbar-search-icon">⌕</span>

            <input
                type="text"
                name="q"
                id="navbarSearchInput"  
                value="{{ request('q') }}"
                placeholder="Tìm tỉnh, địa điểm..."
                autocomplete="off"
            >

            <button type="submit">
                Tìm
            </button>

            <div
                class="navbar-search-suggestions"
                id="navbarSearchSuggestions"
            ></div>
        </form>

        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Mở menu"
        >
            ☰
        </button>

        <div
            class="nav-links"
            id="mobileNavLinks"
        >

            <a href="{{ url('/') }}">
                Trang chủ
            </a>

            <a href="{{ route('explore.index') }}">
                Khám phá
            </a>

            @auth
                <a href="{{ route('itineraries.index') }}">
                    Lịch trình
                </a>
            @else
                <a href="{{ route('itineraries.create') }}">
                    Lịch trình
                </a>
            @endauth

            @guest

                <a href="{{ route('login') }}"
                class="login-btn">
                    Đăng nhập
                </a>

            @endguest


            @auth

                <div class="user-menu">

                    <button
                        type="button"
                        class="user-menu-button"
                        onclick="toggleUserMenu()"
                    >

                        <div class="user-avatar">

                            @if(auth()->user()->avatar)

                                <img
                                    src="{{ asset(auth()->user()->avatar) }}"
                                    alt="{{ auth()->user()->name }}"
                                >

                            @else

                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                            @endif

                        </div>

                        <span class="user-name">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="dropdown-arrow">
                            ▾
                        </span>

                    </button>


                    <div
                        class="user-dropdown"
                        id="userDropdown"
                    >

                        <a href="{{ route('profile') }}">
                            Hồ sơ cá nhân
                        </a>

                        <a href="{{ route('favorites.index') }}">
                            Địa điểm yêu thích
                        </a>

                        <a href="{{ route('itineraries.index') }}">
                            Lịch trình của tôi
                        </a>

                        <a href="{{ route('history.index') }}">
                            Lịch sử xem
                        </a>


                        <div class="dropdown-divider"></div>


                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="dropdown-logout"
                            >
                                Đăng xuất
                            </button>

                        </form>

                    </div>

                </div>

            @endauth

        </div>

    </div>

</nav>


<script>

    const navbarProvinces = @json($navbarProvinces);

    const navbarPlaces = @json($navbarPlaces);

    const navbarPopularSearches = @json($popularSearches);


    function normalizeNavbarText(text) {

        return text
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd');

    }


    function showPopularSearches(
        suggestions,
        input
    ) {

        suggestions.innerHTML = '';


        if (navbarPopularSearches.length === 0) {

            suggestions.innerHTML = `
                <div class="navbar-search-empty">
                    Chưa có dữ liệu tìm kiếm phổ biến.
                </div>
            `;

            suggestions.classList.add('show');

            return;
        }


        const title =
            document.createElement('div');

        title.className =
            'navbar-popular-title';

        title.innerHTML =
            '🔥 Tìm kiếm phổ biến';

        suggestions.appendChild(title);


        navbarPopularSearches.forEach(
            function (search) {

                const item =
                    document.createElement('div');

                item.className =
                    'navbar-suggestion-item navbar-popular-item';


                item.innerHTML = `
                    <span class="navbar-suggestion-name">
                        🔍 ${search.keyword}
                    </span>

                    <span class="navbar-suggestion-type">
                        ${search.total} lượt tìm kiếm
                    </span>
                `;


                item.addEventListener(
                    'click',
                    function () {

                        input.value =
                            search.keyword;

                        document
                            .getElementById(
                                'navbarSearchForm'
                            )
                            .submit();

                    }
                );


                suggestions.appendChild(item);

            }
        );


        suggestions.classList.add('show');

    }


    document.addEventListener('DOMContentLoaded', function () {

        const input =
            document.getElementById('navbarSearchInput');

        const suggestions =
            document.getElementById('navbarSearchSuggestions');

        if (!input || !suggestions) {
            return;
        }


        input.addEventListener(
            'focus',
            function () {

                if (this.value.trim() === '') {

                    showPopularSearches(
                        suggestions,
                        input
                    );

                }

            }
        );


        input.addEventListener('input', function () {

            const keyword =
                normalizeNavbarText(this.value.trim());

            suggestions.innerHTML = '';


            if (keyword.length === 0) {

                showPopularSearches(
                    suggestions,
                    input
                );

                return;
            }


            if (keyword.length < 2) {

                suggestions.classList.remove('show');

                return;
            }

            const provinceResults =
                navbarProvinces
                    .filter(function (province) {

                        return normalizeNavbarText(
                            province.name
                        ).includes(keyword);

                    })
                    .slice(0, 3);


            const placeResults =
                navbarPlaces
                    .filter(function (place) {

                        return normalizeNavbarText(
                            place.name
                        ).includes(keyword);

                    })
                    .slice(0, 5);


            provinceResults.forEach(function (province) {

                const item =
                    document.createElement('a');

                item.className =
                    'navbar-suggestion-item';

                item.href =
                    '/provinces/' + province.slug;

                item.innerHTML = `
                    <span class="navbar-suggestion-name">
                        📍 ${province.name}
                    </span>

                    <span class="navbar-suggestion-type">
                        Tỉnh / Thành phố
                    </span>
                `;

                suggestions.appendChild(item);

            });


            placeResults.forEach(function (place) {

                const item =
                    document.createElement('a');

                item.className =
                    'navbar-suggestion-item';

                item.href =
                    '/places/' + place.slug;

                item.innerHTML = `
                    <span class="navbar-suggestion-name">
                        🏞️ ${place.name}
                    </span>

                    <span class="navbar-suggestion-type">
                        ${place.province?.name ?? 'Địa điểm du lịch'}
                    </span>
                `;

                suggestions.appendChild(item);

            });


            if (
                provinceResults.length === 0 &&
                placeResults.length === 0
            ) {

                suggestions.innerHTML = `
                    <div class="navbar-search-empty">
                        Không tìm thấy kết quả phù hợp.
                    </div>
                `;

            }


            suggestions.classList.add('show');

        });


        document.addEventListener('click', function (event) {

            if (
                !event.target.closest('.navbar-search')
            ) {

                suggestions.classList.remove('show');

            }

        });

    });




    document.addEventListener('DOMContentLoaded', function () {

        const mobileMenuButton =
            document.getElementById('mobileMenuButton');

        const mobileNavLinks =
            document.getElementById('mobileNavLinks');


        if (
            mobileMenuButton &&
            mobileNavLinks
        ) {

            mobileMenuButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    mobileNavLinks
                        .classList
                        .toggle('show');

                }
            );


            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !event.target.closest(
                            '.navbar-container'
                        )
                    ) {

                        mobileNavLinks
                            .classList
                            .remove('show');

                    }

                }
            );

        }

    });




    function toggleUserMenu() {

        const dropdown =
            document.getElementById('userDropdown');

        dropdown.classList.toggle('show');

    }


    document.addEventListener('click', function(event) {

        const userMenu =
            document.querySelector('.user-menu');

        const dropdown =
            document.getElementById('userDropdown');

        if (
            userMenu &&
            dropdown &&
            !userMenu.contains(event.target)
        ) {

            dropdown.classList.remove('show');

        }

    });

</script>