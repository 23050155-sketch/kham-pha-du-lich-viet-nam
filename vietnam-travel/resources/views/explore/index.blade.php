<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Khám phá Việt Nam</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            padding-top: 105px;

            font-family:
                Inter,
                Arial,
                Helvetica,
                sans-serif;

            background: #f8fafc;

            color: #0f172a;
        }

        .explore-container {
            width: min(100% - 40px, 1200px);

            margin:
                40px auto
                80px;
        }

        /* ============================= */
        /* HEADER */
        /* ============================= */

        .explore-header {
            max-width: 760px;

            margin:
                0 auto
                42px;

            text-align: center;
        }

        .explore-header h1 {
            margin:
                0 0
                14px;

            color: #0f172a;

            font-size:
                clamp(32px, 5vw, 48px);

            line-height: 1.15;

            letter-spacing: -0.8px;
        }

        .explore-header p {
            max-width: 680px;

            margin: 0 auto;

            color: #64748b;

            font-size: 15px;

            line-height: 1.75;
        }

        /* ============================= */
        /* SEARCH */
        /* ============================= */

        .search-box {
            margin-bottom: 46px;

            padding: 18px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 18px;

            box-shadow:
                0 8px 30px
                rgba(15, 23, 42, 0.06);
        }

        .search-form {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                210px
                auto;

            gap: 10px;
        }

        .form-control {
            width: 100%;

            min-height: 48px;

            padding: 0 14px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 11px;

            outline: none;

            background: #f8fafc;

            color: #334155;

            font-size: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-control:focus {
            background: white;

            border-color: #14b8a6;

            box-shadow:
                0 0 0 3px
                rgba(20, 184, 166, .10);
        }

        .search-button {
            min-height: 48px;

            padding: 0 22px;

            border: none;
            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .search-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(13, 148, 136, .22);
        }

        .filter-bottom {
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .result-count {
            color: #6b7280;
            font-size: 14px;
        }

        .clear-filter {
            color: #0f766e;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        /* ============================= */
        /* TITLE */
        /* ============================= */

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 24px;
        }

        .section-header h2 {
            margin: 0;

            color: #0f172a;

            font-size:
                clamp(26px, 3vw, 34px);

            letter-spacing: -0.5px;
        }

        /* ============================= */
        /* PROVINCE GRID */
        /* ============================= */

        .province-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 22px;
        }

        /* ============================= */
        /* CARD */
        /* ============================= */

        .province-card {
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
                rgba(15, 23, 42, .05);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .province-card:hover {
            transform:
                translateY(-6px);

            border-color:
                rgba(13, 148, 136, .30);

            box-shadow:
                0 18px 40px
                rgba(15, 23, 42, .11);
        }

        .province-image {
            position: relative;

            width: 100%;

            aspect-ratio: 16 / 10;

            overflow: hidden;

            background: #d1d5db;
        }

        .province-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform .4s ease;
        }

        .province-card:hover
        .province-image img {
            transform:
                scale(1.06);
        }

        .province-type {
            position: absolute;

            top: 13px;
            left: 13px;

            padding: 6px 10px;

            border:
                1px solid
                rgba(255,255,255,.5);

            border-radius: 999px;

            background:
                rgba(255,255,255,.90);

            backdrop-filter: blur(8px);

            color: #0f766e;

            font-size: 11px;
            font-weight: 700;
        }

        .province-content {
            flex: 1;

            display: flex;
            flex-direction: column;

            padding: 19px;
        }

        .province-content h3 {
            margin:
                0 0
                8px;

            color: #0f172a;

            font-size: 20px;
        }

        .place-count {
            margin-bottom: 12px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;
        }

        .province-description {
            margin-bottom: 18px;

            color: #64748b;

            font-size: 13px;

            line-height: 1.65;

            display: -webkit-box;

            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        .province-action {
            margin-top: auto;
        }

        .explore-button {
            display: flex;

            align-items: center;
            justify-content: center;

            width: 100%;

            min-height: 44px;

            padding: 0 15px;

            border-radius: 11px;

            background: #f0fdfa;

            border:
                1px solid
                #ccfbf1;

            color: #0f766e;

            text-align: center;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            transition:
                background .2s ease,
                color .2s ease;
        }

        .explore-button:hover {
            background: #0f766e;

            color: white;
        }

        /* ============================= */
        /* NO IMAGE */
        /* ============================= */

        .no-image {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #ccfbf1,
                #99f6e4
            );

            color: #0f766e;
            font-size: 20px;
            font-weight: bold;
        }

        /* ============================= */
        /* EMPTY */
        /* ============================= */

        .empty-state {
            background: white;
            padding: 50px 25px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
        }

        .empty-state h3 {
            margin-top: 0;
        }

        .empty-state p {
            color: #6b7280;
        }

        /* ============================= */
        /* RESPONSIVE */
        /* ============================= */

        @media (max-width: 992px) {

            body {
                padding-top: 115px;
            }

            .province-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .search-form {
                grid-template-columns:
                    1fr
                    190px;
            }

            .search-button {
                grid-column:
                    1 / -1;
            }

        }


        @media (max-width: 650px) {

            body {
                padding-top: 125px;
            }

            .explore-container {
                width:
                    calc(100% - 28px);

                margin:
                    28px auto
                    55px;
            }

            .explore-header {
                margin-bottom: 30px;
            }

            .search-box {
                padding: 14px;

                border-radius: 16px;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .search-button {
                grid-column: auto;
            }

            .filter-bottom {
                flex-direction: column;

                align-items: flex-start;
            }

            .province-grid {
                grid-template-columns: 1fr;

                gap: 18px;
            }

        }


        .selected-category {
            width: fit-content;

            margin: 15px auto 25px;

            padding: 10px 16px;

            background: #ccfbf1;

            border-radius: 30px;

            color: #0f766e;

            font-size: 14px;
        }

        .selected-category strong {
            margin-left: 5px;
        }

        .selected-category a {
            margin-left: 12px;

            color: #dc2626;

            font-weight: 600;

            text-decoration: none;
        }



        .section-header {
            margin-bottom: 24px;
        }

        .section-label {
            display: inline-block;

            margin-bottom: 7px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1.3px;

            text-transform: uppercase;
        }

        .section-header h2 {
            margin: 0;

            color: #0f172a;

            font-size:
                clamp(26px, 3vw, 34px);

            letter-spacing: -0.5px;
        }




        .category-filter {
            margin-top: 16px;
            padding-top: 16px;

            border-top: 1px solid #e2e8f0;
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

            background: #f8fafc;

            border: 1px solid #dbe3ec;
            border-radius: 999px;

            color: #475569;

            font-size: 12px;
            font-weight: 600;

            transition: 0.2s;
        }

        .category-option:hover span {
            border-color: #14b8a6;

            color: #0f766e;
        }

        .category-option input:checked + span {
            background: #0f766e;

            border-color: #0f766e;

            color: white;
        }

        @media (max-width: 650px) {

            .category-options {
                gap: 7px;
            }

            .category-option span {
                min-height: 34px;

                padding: 0 11px;

                font-size: 11px;
            }

        }
    </style>
</head>


<body>

@include('components.navbar')


<div class="explore-container">

    {{-- ===================================== --}}
    {{-- HEADER --}}
    {{-- ===================================== --}}

    <div class="explore-header">

        <h1>
            Khám phá Việt Nam
        </h1>

        <p>
            Khám phá các tỉnh, thành phố và những
            địa điểm du lịch nổi bật trên khắp Việt Nam.
            Hãy lựa chọn điểm đến cho hành trình tiếp theo
            của bạn.
        </p>

        @if($selectedCategory)

            <div class="selected-category">

                <span>
                    Đang khám phá theo sở thích:
                </span>

                <strong>
                    {{ $selectedCategory->name }}
                </strong>

                <a href="{{ route('explore.index') }}">
                    × Bỏ lọc
                </a>

            </div>

        @endif

    </div>


    {{-- ===================================== --}}
    {{-- TÌM KIẾM --}}
    {{-- ===================================== --}}

    <div class="search-box">

        <form
            method="GET"
            action="{{ route('explore.index') }}"
            class="search-form"
            id="exploreFilterForm"
        >

            <input
                type="text"
                name="search"
                class="form-control"
                value="{{ request('search') }}"
                placeholder="Tìm kiếm tỉnh / thành phố..."
            >


            <select
                name="type"
                class="form-control"
            >

                <option value="">
                    Tất cả
                </option>

                <option
                    value="Tỉnh"
                    @selected(
                        request('type') === 'Tỉnh'
                    )
                >
                    Tỉnh
                </option>

                <option
                    value="Thành phố"
                    @selected(
                        request('type') === 'Thành phố'
                    )
                >
                    Thành phố
                </option>

            </select>


            <button
                type="submit"
                class="search-button"
            >
                Tìm kiếm
            </button>

        </form>


        <div class="category-filter">

            <div class="category-filter-title">
                Loại hình du lịch
            </div>

            <div class="category-options">

                @foreach($categories as $category)

                    <label class="category-option">

                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}"
                            form="exploreFilterForm"

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

        </div>


        <div class="filter-bottom">

            <div class="result-count">

                Tìm thấy

                <strong>
                    {{ $provinces->count() }}
                </strong>

                tỉnh / thành phố

            </div>


            @if(
                request()->filled('search') ||
                request()->filled('type') ||
                request()->filled('categories') ||
                request()->filled('category')
            )

                <a
                    href="{{ route('explore.index') }}"
                    class="clear-filter"
                >
                    Xóa bộ lọc
                </a>

            @endif

        </div>

    </div>


    {{-- ===================================== --}}
    {{-- DANH SÁCH --}}
    {{-- ===================================== --}}

    <div class="section-header">

        <div>
            <span class="section-label">
                Khám phá Việt Nam
            </span>

            <h2>
                Điểm đến
            </h2>
        </div>

    </div>


    @if($provinces->isEmpty())

        <div class="empty-state">

            <h3>
                Không tìm thấy kết quả
            </h3>

            <p>
                Không có tỉnh hoặc thành phố nào
                phù hợp với nội dung tìm kiếm của bạn.
            </p>


            <a
                href="{{ route('explore.index') }}"
                class="explore-button"
                style="
                    width: auto;
                    padding-left: 25px;
                    padding-right: 25px;
                "
            >
                Xem tất cả tỉnh / thành phố
            </a>

        </div>

    @else


        <div class="province-grid">


            @foreach($provinces as $province)

                <div class="province-card">


                    {{-- ========================== --}}
                    {{-- ẢNH --}}
                    {{-- ========================== --}}

                    <div class="province-image">


                        @if($province->cover_image)

                            <img
                                src="{{ asset(
                                    $province->cover_image
                                ) }}"
                                alt="{{ $province->name }}"
                            >

                        @else

                            <div class="no-image">
                                {{ $province->name }}
                            </div>

                        @endif


                        <span class="province-type">
                            {{ $province->administrative_type }}
                        </span>

                    </div>


                    {{-- ========================== --}}
                    {{-- NỘI DUNG --}}
                    {{-- ========================== --}}

                    <div class="province-content">

                        <h3>
                            {{ $province->name }}
                        </h3>


                        <div class="place-count">

                            {{ $province->places_count }}

                            địa điểm du lịch

                        </div>


                        <div class="province-description">

                            @if($province->description)

                                {{ $province->description }}

                            @else

                                Khám phá những địa điểm du lịch
                                nổi bật tại {{ $province->name }}
                                và tìm điểm đến phù hợp cho
                                chuyến đi của bạn.

                            @endif

                        </div>


                        <div class="province-action">

                            <a
                                href="{{
                                    url('/provinces/' . $province->slug)
                                    .
                                    (
                                        !empty($selectedCategoryIds)
                                            ? '?' . http_build_query([
                                                'categories' => $selectedCategoryIds
                                            ])
                                            : ''
                                    )
                                }}"
                                class="explore-button"
                            >
                                Khám phá →
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>


@include('components.footer')


</body>

</html>