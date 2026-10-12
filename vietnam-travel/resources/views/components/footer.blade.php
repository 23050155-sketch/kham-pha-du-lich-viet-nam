<footer class="site-footer">

    <div class="footer-container">

        {{-- ===================================== --}}
        {{-- GIỚI THIỆU WEBSITE --}}
        {{-- ===================================== --}}

        <div class="footer-column footer-brand">

            <h2>
                TPDĐ Travel
            </h2>

            <p class="footer-slogan">
                Khám phá vẻ đẹp Việt Nam
            </p>

            <p>
                Website hỗ trợ người dùng khám phá
                các địa điểm du lịch nổi tiếng trên
                34 tỉnh/thành Việt Nam, tìm kiếm điểm đến
                phù hợp và xây dựng lịch trình cho
                chuyến đi của mình.
            </p>

            <div class="footer-features">

                <span>
                    📍 34 tỉnh/thành
                </span>

                <span>
                    🗺️ Địa điểm du lịch
                </span>

                <span>
                    📅 Lịch trình
                </span>

            </div>

        </div>


        {{-- ===================================== --}}
        {{-- KHÁM PHÁ --}}
        {{-- ===================================== --}}

        <div class="footer-column">

            <h3>
                Khám phá
            </h3>

            <a href="{{ url('/') }}">
                Trang chủ
            </a>

            <a href="{{ route('explore.index') }}">
                Khám phá địa điểm
            </a>

            <a href="{{ route('explore.index', [
                'category' => 'Biển'
            ]) }}">
                Du lịch biển
            </a>

            <a href="{{ route('explore.index', [
                'category' => 'Thiên nhiên'
            ]) }}">
                Thiên nhiên
            </a>

            <a href="{{ route('explore.index', [
                'category' => 'Văn hóa'
            ]) }}">
                Văn hóa
            </a>

            <a href="{{ route('explore.index', [
                'category' => 'Lịch sử'
            ]) }}">
                Lịch sử
            </a>

        </div>


        {{-- ===================================== --}}
        {{-- TIỆN ÍCH --}}
        {{-- ===================================== --}}

        <div class="footer-column">

            <h3>
                Tiện ích
            </h3>

            <a href="{{ route('itineraries.create') }}">
                Tạo lịch trình
            </a>

            <a href="{{ route('itineraries.index') }}">
                Lịch trình của tôi
            </a>

            @auth

                <a href="{{ route('favorites.index') }}">
                    Địa điểm yêu thích
                </a>

            @endauth

            <a href="{{ url('/statistics') }}">
                Thống kê du lịch
            </a>

        </div>


        {{-- ===================================== --}}
        {{-- TÀI KHOẢN & HỖ TRỢ --}}
        {{-- ===================================== --}}

        <div class="footer-column">

            <h3>
                Tài khoản & Hỗ trợ
            </h3>

            @guest

                <a href="{{ route('login') }}">
                    Đăng nhập
                </a>

                <a href="{{ route('register') }}">
                    Đăng ký tài khoản
                </a>

            @else

                <a href="{{ route('favorites.index') }}">
                    Danh sách yêu thích
                </a>

                <a href="{{ route('itineraries.index') }}">
                    Quản lý lịch trình
                </a>

            @endguest

            <a href="{{ url('/') }}#search">
                Tìm kiếm địa điểm
            </a>

            <a href="{{ route('explore.index') }}">
                Xem tất cả điểm đến
            </a>

        </div>


        {{-- ===================================== --}}
        {{-- MẠNG XÃ HỘI --}}
        {{-- ===================================== --}}

        <div class="footer-column">

            <h3>
                Theo dõi chúng tôi trên
            </h3>

            <a
                href="https://www.facebook.com/dungbui48/"
                target="_blank"
                rel="noopener noreferrer"
                class="social-link"
            >
                <span class="social-icon">📘</span>
                Facebook
            </a>

            <a
                href="https://www.instagram.com/ah_dzun/"
                target="_blank"
                rel="noopener noreferrer"
                class="social-link"
            >
                <span class="social-icon">📷</span>
                Instagram
            </a>

            <a
                href="https://www.tiktok.com/@mancity"
                target="_blank"
                rel="noopener noreferrer"
                class="social-link"
            >
                <span class="social-icon">🎵</span>
                TikTok
            </a>

        </div>


    </div>


    <div class="footer-bottom">

        <div class="footer-bottom-content">

            <p>
                © {{ date('Y') }}
                <strong>TPDĐ Travel</strong>.
                Khám phá vẻ đẹp Việt Nam.
            </p>

            <p>
                Website khám phá và hỗ trợ
                lập kế hoạch du lịch Việt Nam.
            </p>

        </div>

    </div>

</footer>


<style>

    /* ===================================== */
    /* FOOTER */
    /* ===================================== */

    .site-footer {
        margin-top: 0;

        background:
            linear-gradient(
                135deg,
                #0f766e,
                #115e59
            );

        color: white;
    }

    .footer-container {
        width: min(100% - 40px, 1200px);

        margin: 0 auto;

        padding:
            56px 0
            42px;

        display: grid;

        grid-template-columns:
            1.8fr
            1fr
            1fr
            1fr;

        gap: 42px;
    }


    /* BRAND */

    .footer-brand h2 {
        margin-bottom: 10px;

        font-size: 27px;
        font-weight: 800;

        letter-spacing: -0.5px;
    }

    .footer-brand p {
        max-width: 360px;

        color:
            rgba(204, 251, 241, 0.86);

        font-size: 13px;
        line-height: 1.75;
    }


    /* COLUMNS */

    .footer-column {
        display: flex;

        flex-direction: column;

        align-items: flex-start;

        gap: 11px;
    }



    .footer-column:last-child {
        grid-column: 2 / -1;

        flex-direction: row;

        align-items: center;

        flex-wrap: wrap;

        gap: 16px;
    }

    .footer-column:last-child h3 {
        margin: 0 10px 0 0;
    }



    .footer-column h3 {
        margin-bottom: 7px;

        font-size: 16px;
    }

    .footer-column a {
        color:
            rgba(204, 251, 241, 0.86);

        font-size: 13px;

        text-decoration: none;

        transition:
            color 0.2s ease,
            transform 0.2s ease;
    }

    .footer-column a:hover {
        color: white;

        transform:
            translateX(4px);
    }


    /* BOTTOM */

    .footer-bottom {
        border-top:
            1px solid
            rgba(255,255,255,.12);

        padding:
            18px 20px;
    }

    .footer-bottom-content p {
        color:
            rgba(204,251,241,.78);

        font-size: 12px;
    }


    /* RESPONSIVE */

    @media (max-width: 992px) {

        .footer-container {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 34px;
        }

        .footer-brand {
            grid-column: 1 / -1;
        }

        .footer-column:last-child {
            grid-column: 1 / -1;

            flex-direction: row;

            flex-wrap: wrap;
        }

    }


    @media (max-width: 600px) {

        .footer-container {
            width:
                calc(100% - 28px);

            padding:
                42px 0
                32px;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:
                28px 18px;
        }

        .footer-brand {
            grid-column: 1 / -1;
        }

        .footer-column h3 {
            font-size: 14px;
        }

        .footer-column a {
            font-size: 12px;
        }

        .footer-features {
            gap: 6px;
        }

        .footer-features span {
            padding: 6px 8px;

            font-size: 11px;
        }

        .footer-column:last-child {
            grid-column: 1 / -1;

            flex-direction: row;

            flex-wrap: wrap;

            gap: 10px;
        }

        .footer-column:last-child h3 {
            width: 100%;
        }

    }



    .footer-slogan {
        margin-bottom: 8px;

        color: white !important;

        font-size: 14px !important;
        font-weight: 700;
    }

    .footer-features {
        display: flex;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .footer-features span {

        background:
            rgba(255, 255, 255, 0.1);

        border:
            1px solid
            rgba(255, 255, 255, 0.15);

        border-radius: 7px;

        color: #ccfbf1;
    }



    .footer-bottom-content {
        width: 90%;
        max-width: 1200px;

        margin: 0 auto;

        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 20px;
    }

    

    @media (max-width: 700px) {

        .footer-bottom-content {
            flex-direction: column;

            text-align: center;

            gap: 7px;
        }

    }



    /* ===================================== */
    /* SOCIAL MEDIA */
    /* ===================================== */

    .social-link {
        display: flex;
        align-items: center;

        gap: 9px;
    }

    .social-icon {
        width: 25px;
        height: 25px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(255, 255, 255, 0.1);

        border-radius: 6px;

        font-size: 14px;
    }

</style>