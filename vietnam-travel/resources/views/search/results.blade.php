<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kết quả tìm kiếm - TPDĐ Travel
    </title>

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


        /* ====================================== */
        /* PAGE */
        /* ====================================== */

        .search-page {
            width: min(100% - 40px, 1200px);
            margin: 0 auto;
            padding: 130px 0 80px;
        }


        /* ====================================== */
        /* HEADER */
        /* ====================================== */

        .search-header {
            margin-bottom: 45px;
            text-align: center;
        }

        .search-header span {
            display: inline-block;

            margin-bottom: 10px;

            color: #0d9488;

            font-size: 14px;
            font-weight: bold;

            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .search-header h1 {
            margin-bottom: 12px;

            color: #111827;

            font-size: clamp(30px, 4vw, 42px);
        }

        .search-header p {
            color: #64748b;

            font-size: 16px;
        }

        .search-header strong {
            color: #0f766e;
        }


        /* ====================================== */
        /* SEARCH AGAIN */
        /* ====================================== */

        .search-again {

            position: relative;
            display: flex;

            max-width: 700px;

            margin: 30px auto 0;

            padding: 8px;

            background: white;

            border: 1px solid #e5e7eb;
            border-radius: 14px;

            box-shadow:
                0 5px 20px
                rgba(0, 0, 0, 0.06);
        }

        .search-again input {
            flex: 1;

            padding: 14px 16px;

            border: none;
            outline: none;

            background: transparent;

            font-size: 15px;
        }

        .search-again button {
            padding: 0 22px;

            border: none;
            border-radius: 10px;

            background: #0d9488;

            color: white;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .search-again button:hover {
            background: #0f766e;
        }



        .result-search-suggestions {
            position: absolute;

            top: calc(100% + 8px);
            left: 0;

            width: 100%;

            max-height: 330px;

            overflow-y: auto;

            background: white;

            border: 1px solid #e2e8f0;
            border-radius: 12px;

            box-shadow:
                0 12px 30px
                rgba(15, 23, 42, .12);

            display: none;

            z-index: 100;
        }

        .result-search-suggestions.show {
            display: block;
        }

        .result-suggestion-item {
            display: flex;

            align-items: center;

            gap: 12px;

            padding: 12px 15px;

            border-bottom: 1px solid #f1f5f9;

            cursor: pointer;

            text-align: left;
        }

        .result-suggestion-item:last-child {
            border-bottom: none;
        }

        .result-suggestion-item:hover {
            background: #f0fdfa;
        }

        .result-suggestion-icon {
            width: 36px;
            height: 36px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: #ccfbf1;

            border-radius: 50%;
        }

        .result-suggestion-info {
            display: flex;

            flex-direction: column;

            gap: 3px;
        }

        .result-suggestion-info strong {
            color: #0f172a;

            font-size: 14px;
        }

        .result-suggestion-info span {
            color: #64748b;

            font-size: 12px;
        }

        .result-search-empty {
            padding: 15px;

            color: #64748b;

            font-size: 13px;

            text-align: center;
        }


        /* ====================================== */
        /* SECTION */
        /* ====================================== */

        .result-section {
            margin-bottom: 50px;
        }

        .result-title {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 22px;
        }

        .result-title h2 {
            color: #111827;

            font-size: 25px;
        }

        .result-count {
            padding: 6px 12px;

            background: #ccfbf1;

            color: #0f766e;

            border-radius: 20px;

            font-size: 13px;
            font-weight: bold;
        }


        /* ====================================== */
        /* PROVINCES */
        /* ====================================== */

        .province-results {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;
        }

        .province-result-card {
            display: flex;

            align-items: center;

            gap: 15px;

            padding: 20px;

            background: white;

            border: 1px solid #e5e7eb;
            border-radius: 14px;

            text-decoration: none;

            box-shadow:
                0 3px 12px
                rgba(0, 0, 0, 0.05);

            transition: 0.25s;
        }

        .province-result-card:hover {
            transform: translateY(-4px);

            border-color: #0d9488;

            box-shadow:
                0 8px 20px
                rgba(0, 0, 0, 0.09);
        }

        .province-icon {
            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: #ccfbf1;

            border-radius: 50%;

            font-size: 22px;
        }

        .province-info h3 {
            margin-bottom: 5px;

            color: #1f2937;

            font-size: 17px;
        }

        .province-info p {
            color: #64748b;

            font-size: 13px;
        }


        /* ====================================== */
        /* PLACES */
        /* ====================================== */

        .place-results {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 24px;
        }

        .place-result-card {
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

        .place-result-card:hover {
            transform: translateY(-6px);

            border-color:
                rgba(13,148,136,.28);

            box-shadow:
                0 18px 40px
                rgba(15,23,42,.10);
        }


        /* IMAGE */

        .place-result-image {
            position: relative;

            width: 100%;

            aspect-ratio:
                16 / 10;

            overflow: hidden;

            background: #e2e8f0;
        }

        .place-result-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .4s ease;
        }

        .place-result-card:hover
        .place-result-image img {
            transform:
                scale(1.05);
        }

        .place-no-image {
            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #0f766e;

            font-weight: bold;
        }



        .place-province-badge {
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


        /* CONTENT */

        .place-result-content {
            display: flex;

            flex-direction: column;

            flex: 1;

            padding: 22px;
        }

        .place-result-content h3 {
            margin:
                0 0
                10px;

            color: #0f172a;

            font-size: 20px;

            line-height: 1.35;
        }

        .place-description {
            margin-bottom: 18px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.65;

            display: -webkit-box;

            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }




        .place-detail-btn {
            min-height: 46px;

            width: 100%;

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

            font-size: 13px;
            font-weight: 700;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .place-detail-btn:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 10px 24px
                rgba(13,148,136,.22);
        }
                


        .place-information {
            margin-top: auto;

            margin-bottom: 18px;

            padding-top: 15px;

            border-top:
                1px solid
                #e5e7eb;
        }

        .place-info-row {
            display: flex;

            justify-content: space-between;

            gap: 14px;

            margin-bottom: 10px;

            font-size: 13px;
        }

        .place-info-row:last-child {
            margin-bottom: 0;
        }

        .place-info-label {
            color: #64748b;
        }

        .place-info-value {
            color: #0f172a;

            font-weight: 700;

            text-align: right;
        }

        .place-info-value.free {
            color: #059669;
        }

        .place-views {
            margin-bottom: 13px;

            color: #64748b;

            font-size: 13px;
        }

        .place-rating {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 9px;

            font-size: 13px;
        }

        .rating-star {
            color: #f59e0b;

            font-size: 18px;
        }

        .rating-score {
            color: #0f172a;

            font-weight: 700;
        }

        .rating-count {
            color: #64748b;
        }


        /* ====================================== */
        /* EMPTY */
        /* ====================================== */

        .empty-result {
            max-width: 600px;

            margin: 30px auto;

            padding: 55px 30px;

            background: white;

            border-radius: 16px;

            text-align: center;

            box-shadow:
                0 4px 18px
                rgba(0, 0, 0, 0.06);
        }

        .empty-icon {
            margin-bottom: 15px;

            font-size: 48px;
        }

        .empty-result h2 {
            margin-bottom: 10px;

            color: #1f2937;
        }

        .empty-result p {
            color: #64748b;

            line-height: 1.6;
        }


        .search-filter-box {
            margin:
                0 auto
                42px;

            padding: 20px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 18px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .search-filter-title {
            margin-bottom: 12px;

            color: #0f172a;

            font-size: 14px;
            font-weight: 700;
        }

        .search-category-options {
            display: flex;
            flex-wrap: wrap;

            gap: 8px;

            margin-bottom: 16px;
        }

        .search-category-option {
            position: relative;

            cursor: pointer;
        }

        .search-category-option input {
            position: absolute;

            opacity: 0;
            pointer-events: none;
        }

        .search-category-option span {
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

        .search-category-option input:checked + span {
            background: #0f766e;

            border-color: #0f766e;

            color: white;
        }

        .search-filter-row {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 240px));

            gap: 14px;

            margin-bottom: 16px;
        }

        .search-filter-group {
            display: flex;

            flex-direction: column;

            gap: 7px;
        }

        .search-filter-group label {
            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .search-filter-group select {
            min-height: 42px;

            padding: 0 12px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 10px;

            background: white;

            color: #334155;
        }

        .search-filter-actions {
            display: flex;

            gap: 10px;
        }

        .search-filter-actions button,
        .search-filter-actions a {
            min-height: 42px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 0 16px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none;
        }

        .search-filter-actions button {
            border: none;

            background: #0f766e;

            color: white;

            cursor: pointer;
        }

        .search-filter-actions a {
            border:
                1px solid
                #fecaca;

            background: white;

            color: #dc2626;
        }


        .search-filter-actions a:hover {
            background: #fee2e2;

            border-color: #f87171;

            color: #b91c1c;

            transform: translateY(-2px);

            box-shadow:
                0 6px 16px
                rgba(220, 38, 38, 0.12);
        }




        /* ================= RESPONSIVE ================= */

        @media (max-width: 992px) {

            .province-results,
            .place-results {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 650px) {

            .search-page {
                width: calc(100% - 28px);
                padding: 155px 0 55px;
            }

            .search-header h1 {
                font-size: 30px;
            }

            .search-again {
                flex-direction: column;
                gap: 8px;
            }

            .search-again button {
                min-height: 44px;
                padding: 0 15px;
            }

            .province-results,
            .place-results {
                grid-template-columns: 1fr;
            }

            .result-title h2 {
                font-size: 21px;
            }

            .place-result-content {
                padding: 18px;
            }

            .place-info-row {
                font-size: 12px;
            }

            .search-filter-row {
                grid-template-columns: 1fr;
            }

            .search-filter-actions {
                flex-direction: column;
            }

            .search-filter-actions button,
            .search-filter-actions a {
                width: 100%;
            }
        }




        
        /* ===== SO SÁNH ĐỊA ĐIỂM - KẾT QUẢ TÌM KIẾM ===== */

        .place-result-actions {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 10px;
            margin-top: auto;
        }

        .place-result-actions .place-detail-btn,
        .place-result-actions .compare-add-btn {
            width: 100%;
            min-width: 0;
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        @media (max-width: 380px) {
            .place-result-actions {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>

<body>

    <x-navbar />


    <main class="search-page">


        {{-- ====================================== --}}
        {{-- HEADER --}}
        {{-- ====================================== --}}

        <div class="search-header">

            <span>
                Khám phá Việt Nam
            </span>

            <h1>
                Kết quả tìm kiếm
            </h1>

            <p>
                Kết quả phù hợp với từ khóa

                <strong>
                    "{{ $originalKeyword }}"
                </strong>
            </p>


            {{-- TÌM KIẾM LẠI --}}

            <form
                action="{{ route('search.results') }}"
                method="GET"
                class="search-again"
                id="resultSearchForm"
            >

                <input
                    type="text"
                    name="q"
                    id="resultSearchInput"
                    value="{{ $originalKeyword }}"
                    placeholder="Nhập tỉnh, thành phố hoặc địa điểm..."
                    autocomplete="off"
                    required
                >

                <div
                    class="result-search-suggestions"
                    id="resultSearchSuggestions"
                ></div>

                <button type="submit">
                    🔍 Tìm kiếm
                </button>

            </form>

            </div>


            {{-- BỘ LỌC ĐỊA ĐIỂM --}}

            <div class="search-filter-box">

                <form
                    method="GET"
                    action="{{ route('search.results') }}"
                >

                    <input
                        type="hidden"
                        name="q"
                        value="{{ $originalKeyword }}"
                    >

                    <div class="search-filter-title">
                        Lọc địa điểm
                    </div>

                    <div class="search-category-options">

                        @foreach($categories as $category)

                            <label class="search-category-option">

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

                    <div class="search-filter-row">

                        <div class="search-filter-group">

                            <label>Giá vé</label>

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

                        <div class="search-filter-group">

                            <label>Đánh giá</label>

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

                    <div class="search-filter-actions">

                        <button type="submit">
                            Áp dụng
                        </button>

                        @if(
                            !empty($selectedCategoryIds) ||
                            request('price') ||
                            request('rating')
                        )

                            <a
                                href="{{
                                    route(
                                        'search.results',
                                        ['q' => $originalKeyword]
                                    )
                                }}"
                            >
                                Xóa bộ lọc
                            </a>

                        @endif

                    </div>

                </form>

            </div>



        {{-- ====================================== --}}
        {{-- TỈNH / THÀNH PHỐ --}}
        {{-- ====================================== --}}

        @if($provinces->isNotEmpty())

            <section class="result-section">

                <div class="result-title">

                    <h2>
                        🏙️ Tỉnh / Thành phố
                    </h2>

                    <span class="result-count">
                        {{ $provinces->count() }}
                        kết quả
                    </span>

                </div>


                <div class="province-results">

                    @foreach($provinces as $province)

                        <a
                            href="{{ url(
                                '/provinces/' .
                                $province->slug
                            ) }}"
                            class="province-result-card"
                        >

                            <div class="province-icon">
                                🏙️
                            </div>

                            <div class="province-info">

                                <h3>
                                    {{ $province->name }}
                                </h3>

                                <p>
                                    {{ $province->administrative_type }}
                                    · Khám phá địa điểm
                                </p>

                            </div>

                        </a>

                    @endforeach

                </div>

            </section>

        @endif



        {{-- ====================================== --}}
        {{-- ĐỊA ĐIỂM DU LỊCH --}}
        {{-- ====================================== --}}

        @if($places->isNotEmpty())

            <section class="result-section">

                <div class="result-title">

                    <h2>
                        📍 Địa điểm du lịch
                    </h2>

                    <span class="result-count">
                        {{ $places->count() }}
                        kết quả
                    </span>

                </div>


                <div class="place-results">

                    @foreach($places as $place)

                        <article class="place-result-card">

                            <div class="place-result-image">

                                @if($place->cover_image)

                                    <img
                                        src="{{ asset($place->cover_image) }}"
                                        alt="{{ $place->name }}"
                                    >

                                @else

                                    <div class="place-no-image">
                                        📍 {{ $place->name }}
                                    </div>

                                @endif


                                @if($place->province)

                                    <span class="place-province-badge">
                                        {{ $place->province->name }}
                                    </span>

                                @endif

                            </div>


                            <div class="place-result-content">

                                <h3>
                                    {{ $place->name }}
                                </h3>


                                <div class="place-rating">

                                    <span class="rating-star">★</span>

                                    @if(($place->ratings_count ?? 0) > 0)

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
                                    👁 {{ number_format($place->view_count ?? 0) }} lượt xem
                                </div>


                                <p class="place-description">
                                    {{
                                        $place->short_description
                                        ?: 'Khám phá địa điểm du lịch nổi bật tại '
                                        . ($place->province?->name ?? 'Việt Nam')
                                        . '.'
                                    }}
                                </p>


                                <div class="place-information">

                                    <div class="place-info-row">

                                        <span class="place-info-label">
                                            Giá vé
                                        </span>

                                        @if(($place->ticket_price ?? 0) > 0)

                                            <span class="place-info-value">
                                                {{ number_format($place->ticket_price) }} VNĐ
                                            </span>

                                        @else

                                            <span class="place-info-value free">
                                                Miễn phí
                                            </span>

                                        @endif

                                    </div>


                                    <div class="place-info-row">

                                        <span class="place-info-label">
                                            Giờ mở cửa
                                        </span>

                                        <span class="place-info-value">

                                            @if($place->open_time && $place->close_time)

                                                {{ substr($place->open_time, 0, 5) }}
                                                -
                                                {{ substr($place->close_time, 0, 5) }}

                                            @else

                                                Không cố định

                                            @endif

                                        </span>

                                    </div>


                                    <div class="place-info-row">

                                        <span class="place-info-label">
                                            Thời gian tham quan
                                        </span>

                                        <span class="place-info-value">
                                            {{ $place->visit_duration_min ?? 120 }} phút
                                        </span>

                                    </div>

                                </div>


                                
                                <div class="place-result-actions">

                                    <a
                                        href="{{ route('places.show', $place->slug) }}"
                                        class="place-detail-btn"
                                    >
                                        Xem chi tiết
                                    </a>

                                    <x-compare-button :place="$place" />

                                </div>


                            </div>

                        </article>

                    @endforeach

                </div>

            </section>

        @endif



        {{-- ====================================== --}}
        {{-- KHÔNG TÌM THẤY --}}
        {{-- ====================================== --}}

        @if(
            $provinces->isEmpty() &&
            $places->isEmpty()
        )

            <div class="empty-result">

                <div class="empty-icon">
                    🔎
                </div>

                <h2>
                    Không tìm thấy kết quả
                </h2>

                <p>
                    Không có tỉnh/thành hoặc địa điểm
                    phù hợp với từ khóa
                    <strong>
                        "{{ $originalKeyword }}"
                    </strong>.
                    Hãy thử với một từ khóa khác.
                </p>

            </div>

        @endif




        @php
            $resultSearchProvinces = \App\Models\Province::query()
                ->select(
                    'name',
                    'slug',
                    'administrative_type'
                )
                ->orderBy('name')
                ->get();

            $resultSearchPlaces = \App\Models\Place::query()
                ->where('status', 'active')
                ->select(
                    'name',
                    'slug',
                    'province_id'
                )
                ->with('province:id,name')
                ->orderBy('name')
                ->get();
        @endphp


    </main>

    <x-footer />


<script>

    const resultSearchData = [

        @foreach($resultSearchProvinces as $province)

            {
                name: @json($province->name),
                type: 'province',
                typeLabel:
                    @json(
                        $province->administrative_type
                        ?? 'Tỉnh / Thành phố'
                    )
            },

        @endforeach


        @foreach($resultSearchPlaces as $place)

            {
                name: @json($place->name),
                type: 'place',
                typeLabel: 'Địa điểm du lịch',
                province:
                    @json(
                        $place->province?->name
                        ?? ''
                    )
            },

        @endforeach

    ];


    function normalizeResultSearch(text) {

        return text
            .toLowerCase()
            .normalize('NFD')
            .replace(
                /[\u0300-\u036f]/g,
                ''
            )
            .replace(/đ/g, 'd')
            .trim();

    }


    const resultSearchInput =
        document.getElementById(
            'resultSearchInput'
        );

    const resultSearchSuggestions =
        document.getElementById(
            'resultSearchSuggestions'
        );

    const resultSearchForm =
        document.getElementById(
            'resultSearchForm'
        );


    resultSearchInput.addEventListener(
        'input',
        function () {

            const keyword =
                normalizeResultSearch(
                    this.value
                );


            resultSearchSuggestions.innerHTML =
                '';


            if (keyword.length < 2) {

                resultSearchSuggestions
                    .classList
                    .remove('show');

                return;
            }


            const results =
                resultSearchData
                    .filter(function (item) {

                        return normalizeResultSearch(
                            item.name
                        ).includes(keyword);

                    })
                    .slice(0, 8);


            if (results.length === 0) {

                resultSearchSuggestions.innerHTML =
                    `
                        <div
                            class="result-search-empty"
                        >
                            Không tìm thấy
                            kết quả phù hợp.
                        </div>
                    `;

                resultSearchSuggestions
                    .classList
                    .add('show');

                return;
            }


            results.forEach(
                function (item) {

                    const suggestion =
                        document.createElement(
                            'div'
                        );


                    suggestion.className =
                        'result-suggestion-item';


                    const icon =
                        item.type === 'province'
                            ? '🏙️'
                            : '📍';


                    let description =
                        item.typeLabel;


                    if (
                        item.type === 'place' &&
                        item.province
                    ) {

                        description =
                            item.province +
                            ' · Địa điểm du lịch';

                    }


                    suggestion.innerHTML =
                        `
                            <div
                                class="
                                    result-suggestion-icon
                                "
                            >
                                ${icon}
                            </div>

                            <div
                                class="
                                    result-suggestion-info
                                "
                            >
                                <strong>
                                    ${item.name}
                                </strong>

                                <span>
                                    ${description}
                                </span>
                            </div>
                        `;


                    suggestion.addEventListener(
                        'click',
                        function () {

                            resultSearchInput.value =
                                item.name;

                            resultSearchForm.submit();

                        }
                    );


                    resultSearchSuggestions
                        .appendChild(
                            suggestion
                        );

                }
            );


            resultSearchSuggestions
                .classList
                .add('show');

        }
    );


    document.addEventListener(
        'click',
        function (event) {

            if (
                !event.target.closest(
                    '.search-again'
                )
            ) {

                resultSearchSuggestions
                    .classList
                    .remove('show');

            }

        }
    );

</script>


<x-compare-bar />


</body>

</html>