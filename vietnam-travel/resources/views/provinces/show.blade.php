<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Du lịch {{ $province->name }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f8fafc;
            color: #1f2937;
        }

        

        /* ================= HERO ================= */

        .province-hero {
            min-height: 390px;

            display: flex;
            align-items: flex-end;

            background-size: cover;
            background-position: center;

            position: relative;
            overflow: hidden;
        }

        .province-hero::before {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    180deg,
                    rgba(15, 23, 42, .15),
                    rgba(15, 23, 42, .78)
                );
        }

        .hero-content {
            position: relative;
            z-index: 2;

            width: min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                0 0
                55px;

            color: white;
        }

        .hero-label {
            display: inline-flex;

            align-items: center;

            padding:
                7px 13px;

            margin-bottom: 14px;

            border:
                1px solid
                rgba(255,255,255,.25);

            border-radius: 999px;

            background:
                rgba(13,148,136,.88);

            backdrop-filter:
                blur(8px);

            color: white;

            font-size: 12px;
            font-weight: 700;
        }

        .hero-content h1 {
            margin:
                0 0
                10px;

            max-width: 800px;

            font-size:
                clamp(36px, 6vw, 58px);

            line-height: 1.08;

            letter-spacing: -1px;
        }

        .hero-content p {
            max-width: 680px;

            margin: 0;

            color:
                rgba(255,255,255,.88);

            font-size:
                clamp(14px, 2vw, 17px);

            line-height: 1.7;
        }

        /* ================= MAIN ================= */

        .main-container {
            width:
                min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                58px 0
                80px;
        }

        .section-header {
            margin-bottom: 26px;
        }

        .section-header h2 {
            margin:
                0 0
                8px;

            color: #0f172a;

            font-size:
                clamp(28px, 4vw, 36px);

            letter-spacing: -0.6px;
        }

        .section-header p {
            margin: 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }


        /* ================= FILTER ================= */

        .filter-bar {
            display: flex;

            gap: 10px;

            flex-wrap: wrap;

            margin-bottom: 18px;
        }

        .filter-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 40px;

            padding:
                0 16px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 999px;

            background: white;

            color: #475569;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease;
        }

        .filter-btn:hover {
            border-color: #14b8a6;

            color: #0f766e;
        }

        .filter-btn.active {
            border-color: transparent;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;
        }


        /* ================= CARDS ================= */

        .places-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 24px;
        }

        .place-card {
            display: flex;

            flex-direction: column;

            overflow: hidden;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .place-card:hover {
            transform:
                translateY(-6px);

            border-color:
                rgba(13,148,136,.28);

            box-shadow:
                0 18px 40px
                rgba(15,23,42,.10);
        }

        .place-image {
            position: relative;

            width: 100%;

            aspect-ratio:
                16 / 10;

            overflow: hidden;

            background: #e2e8f0;
        }

        .place-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform .4s ease;
        }

        .place-card:hover
        .place-image img {
            transform:
                scale(1.05);
        }

        .province-badge {
            position: absolute;

            top: 15px;
            left: 15px;

            padding:
                6px 11px;

            border-radius: 999px;

            background:
                rgba(13,148,136,.95);

            color: white;

            font-size: 12px;
            font-weight: 600;
        }


        .card-favorite-form {
            position: absolute;

            top: 15px;
            right: 15px;

            z-index: 10;

            margin: 0;
        }

        .card-favorite-button {
            width: 44px;
            height: 44px;

            display: flex;

            align-items: center;
            justify-content: center;

            border: none;

            border-radius: 50%;

            background:
                rgba(255,255,255,.95);

            color: #64748b;

            font-size: 24px;

            cursor: pointer;

            box-shadow:
                0 3px 12px
                rgba(0,0,0,.15);

            transition:
                transform .2s ease,
                color .2s ease;
        }

        .card-favorite-button:hover {
            transform:
                scale(1.08);

            color: #ef4444;
        }

        .card-favorite-button.active {
            color: #ef4444;
        }



        .place-image > a.card-favorite-button {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }


        .place-content {
            display: flex;

            flex-direction: column;

            flex: 1;

            padding: 22px;
        }

        .place-content h3 {
            margin:
                0 0
                10px;

            color: #0f172a;

            font-size: 21px;

            line-height: 1.35;
        }


        .place-rating {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 10px;

            font-size: 14px;
        }

        .rating-star {
            color: #f59e0b;

            font-size: 19px;
        }

        .rating-score {
            color: #0f172a;

            font-weight: 700;
        }

        .rating-count {
            color: #64748b;
        }

        .place-views {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 14px;

            color: #64748b;

            font-size: 13px;
        }


        .description {
            margin-bottom: 18px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.65;

            display: -webkit-box;

            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        .place-info {
            margin-top: auto;

            margin-bottom: 18px;

            padding-top: 15px;

            border-top:
                1px solid
                #e5e7eb;
        }

        .info-row {
            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 10px;

            font-size: 14px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #64748b;
        }

        .info-value {
            color: #0f172a;

            font-weight: 700;

            text-align: right;
        }

        .free {
            color: #059669;
        }

        .detail-btn {
            width: 100%;

            min-height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            text-align: center;

            text-decoration: none;

            font-size: 14px;
            font-weight: 700;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .detail-btn:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 10px 24px
                rgba(13,148,136,.22);
        }

        /* ================= EMPTY ================= */

        .empty-message {
            padding:
                65px 25px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            color: #64748b;

            text-align: center;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .empty-message h3 {
            margin-bottom: 8px;

            color: #0f172a;
        }
        

        .favorite-alert {
            width: 100%;
            margin-bottom: 25px;
            padding: 14px 18px;

            background: #ecfdf5;
            color: #047857;

            border: 1px solid #a7f3d0;
            border-radius: 10px;

            font-weight: 600;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
        }

        .category-filter {
            display: flex;

            align-items: center;

            gap: 12px;

            flex-wrap: wrap;

            margin-bottom: 34px;
        }

        .clear-filter-btn {
            min-height: 42px;

            display: inline-flex;

            align-items: center;

            padding:
                0 14px;

            border:
                1px solid
                #fecaca;

            border-radius: 10px;

            background: white;

            color: #dc2626;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: .2s;
        }

        .clear-filter-btn:hover {
            background: #fef2f2;

            color: #b91c1c;
        }




        /* ================= RESPONSIVE ================= */

        @media (max-width: 992px) {

            .places-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 650px) {

            .province-hero {
                min-height: 320px;
            }

            .hero-content {
                width:
                    calc(100% - 28px);

                padding-bottom: 38px;
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .main-container {
                width:
                    calc(100% - 28px);

                padding:
                    42px 0
                    60px;
            }

            .filter-bar {
                gap: 8px;
            }

            .filter-btn {
                padding:
                    0 13px;

                font-size: 12px;
            }

            .category-filter {
                align-items: stretch;
            }

            .clear-filter-btn {
                width: 100%;

                justify-content: center;
            }

            .places-grid {
                grid-template-columns: 1fr;
            }

            .place-content {
                padding: 18px;
            }

            .category-filter-actions {
                flex-direction: column;
            }

            .category-submit-btn,
            .clear-filter-btn {
                width: 100%;

                justify-content: center;
            }


            .advanced-filter-row {
                grid-template-columns: 1fr;
            }

        }




        .province-category-form {
            width: 100%;
        }

        .category-filter-title {
            margin-bottom: 10px;

            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .category-options {
            display: flex;
            flex-wrap: wrap;

            gap: 9px;

            margin-bottom: 14px;
        }

        .category-option {
            position: relative;

            cursor: pointer;
        }

        .category-option input {
            position: absolute;

            opacity: 0;
            pointer-events: none;
        }

        .category-option span {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 36px;

            padding: 0 13px;

            border: 1px solid #dbe3ec;
            border-radius: 999px;

            background: white;

            color: #475569;

            font-size: 12px;
            font-weight: 600;
        }

        .category-option:hover span {
            border-color: #14b8a6;

            color: #0f766e;
        }

        .category-option input:checked + span {
            border-color: #0f766e;

            background: #0f766e;

            color: white;
        }

        .category-filter-actions {
            display: flex;

            gap: 10px;

            flex-wrap: wrap;
        }

        .category-submit-btn {
            min-height: 42px;

            padding: 0 16px;

            border: none;
            border-radius: 10px;

            background: #0f766e;

            color: white;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }




        .advanced-filter-row {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 240px));

            gap: 14px;

            margin-bottom: 16px;
        }

        .advanced-filter-group {
            display: flex;

            flex-direction: column;

            gap: 7px;
        }

        .advanced-filter-group label {
            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .advanced-filter-group select {
            min-height: 42px;

            padding: 0 12px;

            border: 1px solid #dbe3ec;
            border-radius: 10px;

            outline: none;

            background: white;

            color: #334155;

            font-size: 13px;

            cursor: pointer;
        }

        .advanced-filter-group select:focus {
            border-color: #14b8a6;

            box-shadow:
                0 0 0 3px
                rgba(20, 184, 166, .10);
        }





        
        /* ===== HAI NUT CUOI CARD ===== */

        .place-card-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .place-card-actions .detail-btn,
        .place-card-actions .compare-add-btn {
            width: 100%;
            min-width: 0;
        }

        @media (max-width: 380px) {
            .place-card-actions {
                grid-template-columns: 1fr;
            }
        }


    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->


<x-navbar />


<!-- ================= HERO ================= -->

<section
    class="province-hero"
    style="
        background-image:
            url('{{ $province->cover_image
                ? asset($province->cover_image)
                : asset('images/home-banner.jpg') }}');
    "
>

    <div class="hero-content">

        <span class="hero-label">
            {{ $province->administrative_type }}
        </span>

        <h1>
            Khám phá {{ $province->name }}
        </h1>

        <p>
            Khám phá những địa điểm du lịch hấp dẫn tại
            {{ $province->name }}
        </p>

    </div>

</section>


<!-- ================= DANH SÁCH ĐỊA ĐIỂM ================= -->

<main class="main-container">

    @if(session('favorite_success'))
        <div class="favorite-alert">
            {{ session('favorite_success') }}
        </div>
    @endif

    <div class="section-header">

        <h2>
            Khám phá {{ $province->name }}
        </h2>

        <p>
            Có {{ $province->places->count() }} địa điểm du lịch tại {{ $province->name }}
        </p>

    </div>


    <div class="filter-bar">

        <a
            href="{{
                url()->current() .
                (
                    !empty($selectedCategoryIds)
                        ? '?' . http_build_query([
                            'categories' => $selectedCategoryIds,
                            'price' => request('price'),
                            'rating' => request('rating')
                        ])
                        : ''
                )
            }}"
            class="filter-btn {{ !request('filter') ? 'active' : '' }}"
        >
            Tất cả
        </a>

        <a
            href="{{
                url()->current() . '?' .
                http_build_query([
                    'filter' => 'popular',
                    'categories' => $selectedCategoryIds,
                    'price' => request('price'),
                    'rating' => request('rating')
                ])
            }}"
            class="filter-btn {{ request('filter') === 'popular' ? 'active' : '' }}"
        >
            Phổ biến
        </a>

    </div>


    <div class="category-filter">

        <form
            method="GET"
            action="{{ url()->current() }}"
            class="province-category-form"
        >

            @if(request('filter'))
                <input
                    type="hidden"
                    name="filter"
                    value="{{ request('filter') }}"
                >
            @endif


            <div class="category-filter-title">
                Loại hình du lịch:
            </div>


            <div class="category-options">

                @foreach($categories as $category)

                    <label class="category-option">

                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}"

                            @checked(
                                in_array(
                                    $category->id,
                                    $selectedCategoryIds ?? []
                                )
                            )
                        >

                        <span>
                            {{ $category->name }}
                        </span>

                    </label>

                @endforeach

            </div>


            <div class="advanced-filter-row">

                <div class="advanced-filter-group">

                    <label for="price">
                        Giá vé
                    </label>

                    <select
                        name="price"
                        id="price"
                    >

                        <option value="">
                            Tất cả mức giá
                        </option>

                        <option
                            value="free"
                            @selected(
                                request('price') === 'free'
                            )
                        >
                            Miễn phí
                        </option>

                        <option
                            value="under_100"
                            @selected(
                                request('price') === 'under_100'
                            )
                        >
                            Dưới 100.000 VNĐ
                        </option>

                        <option
                            value="100_300"
                            @selected(
                                request('price') === '100_300'
                            )
                        >
                            100.000 - 300.000 VNĐ
                        </option>

                        <option
                            value="over_300"
                            @selected(
                                request('price') === 'over_300'
                            )
                        >
                            Trên 300.000 VNĐ
                        </option>

                    </select>

                </div>


                <div class="advanced-filter-group">

                    <label for="rating">
                        Đánh giá
                    </label>

                    <select
                        name="rating"
                        id="rating"
                    >

                        <option value="">Tất cả đánh giá</option>
                        <option value="1" @selected(request('rating') === '1')>1★</option>
                        <option value="2" @selected(request('rating') === '2')>2★</option>
                        <option value="3" @selected(request('rating') === '3')>3★</option>
                        <option value="4" @selected(request('rating') === '4')>4★</option>
                        <option value="5" @selected(request('rating') === '5')>5★</option>

                    </select>

                </div>

            </div>


            <div class="category-filter-actions">

                <button
                    type="submit"
                    class="category-submit-btn"
                >
                    Áp dụng
                </button>


                @if(
                    !empty($selectedCategoryIds) ||
                    request('filter') ||
                    request('price') ||
                    request('rating')
                )

                    <a
                        href="{{ url()->current() }}"
                        class="clear-filter-btn"
                    >
                        Xóa bộ lọc
                    </a>

                @endif

            </div>

        </form>

    </div>


    @if($province->places->count() > 0)

        <div class="places-grid">

            @foreach($province->places as $place)

                <article class="place-card">

                    <div class="place-image">

                        <img
                            src="{{ asset($place->cover_image) }}"
                            alt="{{ $place->name }}"
                        >

                        <span class="province-badge">
                            {{ $province->name }}
                        </span>


                        @auth
                            <form
                                method="POST"
                                action="{{ route('favorites.toggle', $place->id) }}"
                                class="card-favorite-form"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="card-favorite-button {{ $place->is_favorite ? 'active' : '' }}"
                                    title="{{ $place->is_favorite ? 'Bỏ yêu thích' : 'Thêm vào yêu thích' }}"
                                >
                                    {{ $place->is_favorite ? '♥' : '♡' }}
                                </button>
                            </form>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="card-favorite-button"
                                title="Đăng nhập để yêu thích"
                            >
                                ♡
                            </a>

                        @endauth

                    </div>


                    <div class="place-content">

                        <h3>
                            {{ $place->name }}
                        </h3>


                        <div class="place-rating">

                            <span class="rating-star">
                                ★
                            </span>

                            @if($place->ratings_count > 0)

                                <span class="rating-score">
                                    {{ number_format($place->ratings_avg_rating, 1) }}
                                </span>

                                <span class="rating-count">
                                    ({{ $place->ratings_count }} đánh giá)
                                </span>

                            @else

                                <span class="rating-count">
                                    Chưa có đánh giá
                                </span>

                            @endif

                        </div>


                        <div class="place-views">
                            👁 {{ $place->view_count }} lượt xem
                        </div>


                        <p class="description">
                            {{ $place->short_description }}
                        </p>


                        <div class="place-info">

                            <div class="info-row">

                                <span class="info-label">
                                    Giá vé
                                </span>

                                @if($place->ticket_price == 0)

                                    <span class="info-value free">
                                        Miễn phí
                                    </span>

                                @else

                                    <span class="info-value">
                                        {{ number_format($place->ticket_price) }} VNĐ
                                    </span>

                                @endif

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Giờ mở cửa
                                </span>

                                <span class="info-value">

                                    @if($place->open_time && $place->close_time)

                                        {{ substr($place->open_time, 0, 5) }}
                                        -
                                        {{ substr($place->close_time, 0, 5) }}

                                    @else

                                        Không cố định

                                    @endif

                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Thời gian tham quan
                                </span>

                                <span class="info-value">
                                    {{ $place->visit_duration_min }} phút
                                </span>

                            </div>

                        </div>


                        
                        
                        <div class="place-card-actions">

                            <a
                                href="{{ route('places.show', $place->slug) }}"
                                class="detail-btn"
                            >
                                Xem chi tiết
                            </a>

                            <x-compare-button :place="$place" />

                        </div>



                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="empty-message">

            <h3>Chưa có địa điểm</h3>

            <p>
                Hiện chưa có địa điểm du lịch nào được cập nhật
                cho {{ $province->name }}.
            </p>

        </div>

    @endif

</main>



@include('components.footer')

<x-compare-bar />

</body>
</html>
