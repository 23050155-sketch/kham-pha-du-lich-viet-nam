<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Địa điểm yêu thích</title>

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

        .favorites-container {
            width:
                min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                125px 0
                80px;
        }


        .favorites-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 22px;
        }

        .empty-favorites {
            padding:
                70px 25px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            text-align: center;

            color: #64748b;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .empty-favorites::before {
            content: "♡";

            display: block;

            margin-bottom: 12px;

            color: #14b8a6;

            font-size: 52px;
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


        .favorite-filter-bar {
            display: flex;

            justify-content: center;

            gap: 10px;

            flex-wrap: wrap;

            margin-bottom: 18px;
        }

        .favorite-filter-btn {
            padding: 9px 16px;

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

        .favorite-filter-btn:hover {
            border-color: #14b8a6;

            color: #0f766e;
        }

        .favorite-filter-btn.active {
            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            border-color: transparent;

            color: white;
        }


        .favorite-category-filter {
            display: flex;

            justify-content: center;
            align-items: center;

            gap: 12px;

            flex-wrap: wrap;

            margin-bottom: 34px;
        }

        .favorite-category-filter form {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .favorite-category-filter label {
            color: #475569;

            font-size: 13px;
            font-weight: 600;
        }

        .favorite-category-filter select {
            min-height: 42px;

            padding: 0 13px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 10px;

            background: white;

            color: #334155;

            font-size: 13px;

            cursor: pointer;
        }

        .favorite-category-filter select:focus {
            outline: none;

            border-color: #14b8a6;

            box-shadow:
                0 0 0 3px
                rgba(20,184,166,.10);
        }

        .favorite-clear-filter {
            min-height: 42px;

            display: inline-flex;

            align-items: center;

            padding: 0 14px;

            border:
                1px solid
                #fecaca;

            border-radius: 10px;

            background: #fff;

            color: #dc2626;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: .2s;
        }

        .favorite-clear-filter:hover {
            background: #fef2f2;

            color: #b91c1c;
        }




        .favorites-heading {
            max-width: 720px;

            margin:
                0 auto
                35px;

            text-align: center;
        }

        .favorites-heading h1 {
            margin:
                0 0
                10px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -0.7px;
        }

        .favorites-heading p {
            margin: 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;
        }




        .favorite-card {
            display: flex;
            flex-direction: column;

            overflow: hidden;

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 8px 28px
                rgba(15, 23, 42, 0.06);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;
        }

        .favorite-card:hover {
            transform: translateY(-6px);

            border-color:
                rgba(13, 148, 136, 0.25);

            box-shadow:
                0 18px 40px
                rgba(15, 23, 42, 0.11);
        }


        /* ================= IMAGE ================= */

        .favorite-image-wrapper {
            position: relative;

            width: 100%;

            aspect-ratio: 16 / 10;

            overflow: hidden;

            background: #e2e8f0;
        }

        .favorite-image {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform 0.4s ease;
        }

        .favorite-card:hover .favorite-image {
            transform: scale(1.05);
        }


        /* ================= PROVINCE BADGE ================= */

        .favorite-province-badge {
            position: absolute;

            top: 15px;
            left: 15px;

            padding: 6px 11px;

            border-radius: 999px;

            background:
                rgba(13, 148, 136, 0.95);

            color: white;

            font-size: 12px;
            font-weight: 600;
        }


        /* ================= HEART ================= */

        .favorite-heart-form {
            position: absolute;

            top: 15px;
            right: 15px;

            margin: 0;

            z-index: 5;
        }

        .favorite-heart-button {
            width: 44px;
            height: 44px;

            display: flex;

            align-items: center;
            justify-content: center;

            border: none;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.95);

            color: #ef4444;

            font-size: 24px;

            cursor: pointer;

            box-shadow:
                0 3px 12px
                rgba(0, 0, 0, 0.15);

            transition:
                transform 0.2s ease,
                background 0.2s ease;
        }

        .favorite-heart-button:hover {
            transform: scale(1.08);

            background: white;
        }


        /* ================= CONTENT ================= */

        .favorite-content {
            display: flex;

            flex-direction: column;

            flex: 1;

            padding: 22px;
        }

        .favorite-name {
            margin:
                0 0
                10px;

            color: #0f172a;

            font-size: 21px;

            line-height: 1.35;
        }


        /* ================= RATING ================= */

        .favorite-rating {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 12px;

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


        /* ================= VIEW ================= */

        .favorite-views {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 14px;

            color: #64748b;

            font-size: 13px;
        }


        /* ================= DESCRIPTION ================= */

        .favorite-description {
            margin-bottom: 18px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.65;

            display: -webkit-box;

            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* ================= INFORMATION ================= */

        .favorite-info {
            margin-top: auto;

            margin-bottom: 18px;

            padding-top: 15px;

            border-top:
                1px solid #e5e7eb;
        }

        .favorite-info-row {
            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 10px;

            font-size: 14px;
        }

        .favorite-info-row:last-child {
            margin-bottom: 0;
        }

        .favorite-info-label {
            color: #64748b;
        }

        .favorite-info-value {
            color: #0f172a;

            font-weight: 700;

            text-align: right;
        }

        .favorite-info-value.free {
            color: #059669;
        }


        /* ================= DETAIL BUTTON ================= */

        .favorite-detail-btn {
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

            text-decoration: none;

            font-size: 14px;
            font-weight: 700;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .favorite-detail-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 24px
                rgba(13, 148, 136, 0.24);
        }




        .favorite-filter-box {
            margin-bottom: 34px;
            padding: 20px;

            background: white;

            border: 1px solid #e2e8f0;
            border-radius: 18px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .favorite-search-row {
            margin-bottom: 18px;
        }

        .favorite-search-row input {
            width: 100%;
            min-height: 44px;

            padding: 0 14px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 10px;

            outline: none;

            font-size: 14px;
        }

        .favorite-search-row input:focus {
            border-color: #14b8a6;

            box-shadow:
                0 0 0 3px
                rgba(20,184,166,.10);
        }

        .favorite-filter-title {
            margin-bottom: 10px;

            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .favorite-category-options {
            display: flex;
            flex-wrap: wrap;

            gap: 8px;

            margin-bottom: 18px;
        }

        .favorite-category-option {
            position: relative;

            cursor: pointer;
        }

        .favorite-category-option input {
            position: absolute;

            opacity: 0;
            pointer-events: none;
        }

        .favorite-category-option span {
            display: inline-flex;

            align-items: center;

            min-height: 36px;

            padding: 0 13px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 999px;

            background: #f8fafc;

            color: #475569;

            font-size: 12px;
            font-weight: 600;
        }

        .favorite-category-option input:checked + span {
            background: #0f766e;

            border-color: #0f766e;

            color: white;
        }

        .favorite-advanced-row {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 240px));

            gap: 14px;

            margin-bottom: 18px;
        }

        .favorite-filter-group {
            display: flex;

            flex-direction: column;

            gap: 7px;
        }

        .favorite-filter-group label {
            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .favorite-filter-group select {
            min-height: 42px;

            padding: 0 12px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 10px;

            background: white;

            color: #334155;
        }

        .favorite-filter-actions {
            display: flex;

            gap: 10px;
        }

        .favorite-filter-actions button,
        .favorite-filter-actions a {
            min-height: 42px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 0 16px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none;

            transition: .2s ease;
        }

        .favorite-filter-actions button {
            border: none;

            background: #0f766e;

            color: white;

            cursor: pointer;
        }

        .favorite-filter-actions button:hover {
            background: #0d9488;

            transform: translateY(-2px);
        }

        .favorite-filter-actions a {
            border:
                1px solid
                #fecaca;

            background: white;

            color: #dc2626;
        }

        .favorite-filter-actions a:hover {
            background: #fee2e2;

            border-color: #f87171;

            color: #b91c1c;

            transform: translateY(-2px);
        }




        /* ================= RESPONSIVE ================= */

        @media (max-width: 992px) {

            .favorites-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 650px) {

            .favorites-container {
                width:
                    calc(100% - 28px);

                padding:
                    125px 0
                    55px;
            }

            .favorites-grid {
                grid-template-columns: 1fr;
            }

            .favorite-content {
                padding: 18px;
            }

            .favorite-info-row {
                font-size: 13px;
            }


            .favorite-advanced-row {
                grid-template-columns: 1fr;
            }

            .favorite-filter-actions {
                flex-direction: column;
            }

            .favorite-filter-actions button,
            .favorite-filter-actions a {
                width: 100%;
            }

        }




        
        .favorite-card-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .favorite-card-actions .favorite-detail-btn,
        .favorite-card-actions .compare-add-btn {
            width: 100%;
            min-width: 0;
        }

        @media (max-width: 380px) {
            .favorite-card-actions {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>

<x-navbar />




<div class="favorites-container">

    @if($favoriteMessage)
        <div class="favorite-alert">
            {{ $favoriteMessage }}
        </div>
    @endif

    <div class="favorites-heading">

        <h1>Địa điểm yêu thích</h1>

        <p>
            Lưu lại những điểm đến bạn quan tâm
            để dễ dàng xem lại và lên kế hoạch cho chuyến đi.
        </p>

    </div>


    <div class="favorite-filter-bar">

        <a
            href="{{ route('favorites.index', array_filter([
                'q' => request('q'),
                'categories' => request('categories'),
                'price' => request('price'),
                'rating' => request('rating')
            ])) }}"
            class="favorite-filter-btn {{ !request('filter') ? 'active' : '' }}"
        >
            Tất cả
        </a>

        <a
            href="{{ route('favorites.index', array_filter([
                'filter' => 'popular',
                'q' => request('q'),
                'categories' => request('categories'),
                'price' => request('price'),
                'rating' => request('rating')
            ])) }}"
            class="favorite-filter-btn {{ request('filter') === 'popular' ? 'active' : '' }}"
        >
            Phổ biến
        </a>

    </div>


    <div class="favorite-filter-box">

        <form
            method="GET"
            action="{{ route('favorites.index') }}"
        >

            @if(request('filter'))
                <input
                    type="hidden"
                    name="filter"
                    value="{{ request('filter') }}"
                >
            @endif


            <div class="favorite-search-row">

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Tìm trong địa điểm yêu thích..."
                >

            </div>


            <div class="favorite-filter-title">
                Loại hình
            </div>


            <div class="favorite-category-options">

                @foreach($categories as $category)

                    <label class="favorite-category-option">

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


            <div class="favorite-advanced-row">

                <div class="favorite-filter-group">

                    <label>
                        Giá vé
                    </label>

                    <select name="price">

                        <option value="">
                            Tất cả mức giá
                        </option>

                        <option
                            value="free"
                            @selected(request('price') === 'free')
                        >
                            Miễn phí
                        </option>

                        <option
                            value="under_100"
                            @selected(request('price') === 'under_100')
                        >
                            Dưới 100.000 VNĐ
                        </option>

                        <option
                            value="100_300"
                            @selected(request('price') === '100_300')
                        >
                            100.000 - 300.000 VNĐ
                        </option>

                        <option
                            value="over_300"
                            @selected(request('price') === 'over_300')
                        >
                            Trên 300.000 VNĐ
                        </option>

                    </select>

                </div>


                <div class="favorite-filter-group">

                    <label>
                        Đánh giá
                    </label>

                    <select name="rating">

                        <option value="">
                            Tất cả đánh giá
                        </option>

                        <option value="1" @selected(request('rating') === '1')>
                            1★
                        </option>

                        <option value="2" @selected(request('rating') === '2')>
                            2★
                        </option>

                        <option value="3" @selected(request('rating') === '3')>
                            3★
                        </option>

                        <option value="4" @selected(request('rating') === '4')>
                            4★
                        </option>

                        <option value="5" @selected(request('rating') === '5')>
                            5★
                        </option>

                    </select>

                </div>

            </div>


            <div class="favorite-filter-actions">

                <button type="submit">
                    Áp dụng
                </button>

                @if(
                    request('q') ||
                    !empty($selectedCategoryIds) ||
                    request('price') ||
                    request('rating') ||
                    request('filter')
                )

                    <a
                        href="{{ route('favorites.index') }}"
                    >
                        Xóa bộ lọc
                    </a>

                @endif

            </div>

        </form>

    </div>


    @if($favorites->count() > 0)

        <div class="favorites-grid">

            @foreach($favorites as $favorite)

                @php
                    $place = $favorite->place;
                @endphp

                <article class="favorite-card">

                    {{-- ẢNH --}}
                    <div class="favorite-image-wrapper">

                        <img
                            src="{{ asset($place->cover_image) }}"
                            alt="{{ $place->name }}"
                            class="favorite-image"
                        >

                        {{-- TỈNH / THÀNH --}}
                        <span class="favorite-province-badge">
                            {{ $place->province->name }}
                        </span>


                        {{-- BỎ YÊU THÍCH --}}
                        <form
                            method="POST"
                            action="{{ route('favorites.toggle', $place->id) }}"
                            class="favorite-heart-form"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="favorite-heart-button active"
                                title="Bỏ yêu thích"
                            >
                                ♥
                            </button>

                        </form>

                    </div>


                    {{-- NỘI DUNG --}}
                    <div class="favorite-content">

                        <h2 class="favorite-name">
                            {{ $place->name }}
                        </h2>


                        {{-- ĐÁNH GIÁ --}}
                        <div class="favorite-rating">

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


                        {{-- LƯỢT XEM --}}
                        <div class="favorite-views">
                            👁 {{ number_format($place->view_count) }} lượt xem
                        </div>


                        {{-- MÔ TẢ --}}
                        <p class="favorite-description">
                            {{ $place->short_description }}
                        </p>


                        {{-- THÔNG TIN --}}
                        <div class="favorite-info">

                            {{-- GIÁ VÉ --}}
                            <div class="favorite-info-row">

                                <span class="favorite-info-label">
                                    Giá vé
                                </span>

                                @if($place->ticket_price == 0)

                                    <span class="favorite-info-value free">
                                        Miễn phí
                                    </span>

                                @else

                                    <span class="favorite-info-value">
                                        {{ number_format($place->ticket_price) }} VNĐ
                                    </span>

                                @endif

                            </div>


                            {{-- GIỜ MỞ CỬA --}}
                            <div class="favorite-info-row">

                                <span class="favorite-info-label">
                                    Giờ mở cửa
                                </span>

                                <span class="favorite-info-value">

                                    @if($place->open_time && $place->close_time)

                                        {{ substr($place->open_time, 0, 5) }}
                                        -
                                        {{ substr($place->close_time, 0, 5) }}

                                    @else

                                        Không cố định

                                    @endif

                                </span>

                            </div>


                            {{-- THỜI GIAN THAM QUAN --}}
                            <div class="favorite-info-row">

                                <span class="favorite-info-label">
                                    Thời gian tham quan
                                </span>

                                <span class="favorite-info-value">
                                    {{ $place->visit_duration_min }} phút
                                </span>

                            </div>

                        </div>


                        
                        {{-- XEM CHI TIẾT + SO SANH --}}
                        <div class="favorite-card-actions">

                            <a
                                href="{{ route('places.show', $place->slug) }}"
                                class="favorite-detail-btn"
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

        <div class="empty-favorites">

            Bạn chưa có địa điểm yêu thích nào.

        </div>

    @endif

</div>

@include('components.footer')

<x-compare-bar />

</body>

</html>