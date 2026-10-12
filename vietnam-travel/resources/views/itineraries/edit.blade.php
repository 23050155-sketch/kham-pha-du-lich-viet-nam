<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Chỉnh sửa lịch trình</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            padding-top: 110px;

            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    180deg,
                    #f8fafc,
                    #f1f5f9
                );

            color: #0f172a;
        }

        .container {
            width:
                min(100% - 40px, 1150px);

            margin:
                36px auto
                80px;
        }

        /* ============================= */
        /* HEADER */
        /* ============================= */

        .page-header {
            display: flex;

            align-items: flex-end;
            justify-content: space-between;

            gap: 24px;

            margin-bottom: 30px;
        }

        .page-header > div::before {
            content: "LỊCH TRÌNH";

            display: inline-block;

            margin-bottom: 8px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1.4px;
        }

        .page-header h1 {
            margin:
                0 0
                8px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -.7px;
        }

        .page-header p {
            margin: 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }

        /* ============================= */
        /* CARD */
        /* ============================= */

        .card {
            margin-bottom: 26px;

            padding: 28px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .card h2 {
            margin:
                0 0
                20px;

            color: #0f172a;

            font-size: 22px;
        }

        /* ============================= */
        /* FORM */
        /* ============================= */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;

            min-height: 46px;

            padding:
                0 13px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 10px;

            background: #f8fafc;

            color: #0f172a;

            font-size: 14px;

            outline: none;

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
                rgba(20,184,166,.10);
        }

        .form-row {
            display: grid;

            grid-template-columns:
                minmax(220px, 2fr)
                minmax(100px, .8fr)
                minmax(120px, 1fr)
                minmax(120px, 1fr);

            gap: 12px;

            align-items: end;
        }

        /* ============================= */
        /* BUTTON */
        /* ============================= */

        .btn {
            min-height: 44px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding:
                0 16px;

            border: none;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .btn-primary {
            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            box-shadow:
                0 7px 18px
                rgba(13,148,136,.16);
        }

        .btn-primary:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 10px 24px
                rgba(13,148,136,.22);
        }

        .btn-secondary {
            background: #f8fafc;

            border:
                1px solid
                #e2e8f0;

            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;

            color: #0f172a;
        }

        .btn-danger {
            background: #fef2f2;

            border:
                1px solid
                #fecaca;

            color: #dc2626;
        }

        .btn-danger:hover {
            background: #fee2e2;

            color: #b91c1c;
        }

        .btn-success {
            background: #0d9488;

            color: white;
        }

        .btn-success:hover {
            background: #0f766e;
        }

        /* ============================= */
        /* MESSAGE */
        /* ============================= */

        .success-message {
            margin-bottom: 20px;

            padding: 14px 16px;

            background: #ecfdf5;

            border:
                1px solid
                #a7f3d0;

            border-radius: 12px;

            color: #047857;

            font-size: 13px;
            font-weight: 600;
        }

        .errors {
            margin-bottom: 20px;

            padding: 14px 16px;

            background: #fef2f2;

            border:
                1px solid
                #fecaca;

            border-radius: 12px;

            color: #b91c1c;

            font-size: 13px;

            line-height: 1.6;
        }

        .errors ul {
            margin: 0;

            padding-left: 18px;
        }

        /* ============================= */
        /* TRIP INFO */
        /* ============================= */

        .trip-info {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 12px;

            margin-bottom: 22px;
        }

        .trip-info span {
            padding: 12px 14px;

            background: #f8fafc;

            border:
                1px solid
                #e2e8f0;

            border-radius: 10px;

            color: #475569;

            font-size: 13px;
        }

        .trip-info strong {
            color: #0f172a;
        }

        /* ============================= */
        /* DAY */
        /* ============================= */

        .day-section {
            margin-bottom: 26px;

            padding: 26px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .day-title {
            margin:
                0 0
                20px;

            color: #0f172a;

            font-size: 23px;
        }

        /* ============================= */
        /* PLACE */
        /* ============================= */

        .place-item {
            margin-bottom: 16px;

            padding: 20px;

            background: #f8fafc;

            border:
                1px solid
                #e2e8f0;

            border-radius: 14px;
        }

        .place-item:last-child {
            margin-bottom: 0;
        }

        .place-header {
            margin-bottom: 16px;
        }

        .place-header h3 {
            margin:
                0 0
                6px;

            color: #0f172a;

            font-size: 18px;
        }

        .place-header p {
            margin: 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }

        .edit-item-row {
            display: grid;

            grid-template-columns:
                minmax(100px, .8fr)
                minmax(120px, 1fr)
                minmax(120px, 1fr)
                auto;

            gap: 10px;

            align-items: end;
        }

        .item-actions {
            display: flex;

            align-items: center;

            gap: 8px;

            flex-wrap: wrap;

            margin-top: 12px;
        }

        .delete-form {
            margin: 0;
        }

        .empty-day {
            padding: 20px;

            background: #f8fafc;

            border:
                1px dashed
                #cbd5e1;

            border-radius: 12px;

            color: #64748b;

            text-align: center;

            font-size: 13px;
        }

        /* ============================= */
        /* RESPONSIVE */
        /* ============================= */

        @media (max-width: 900px) {

            .trip-info {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .edit-item-row {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        @media (max-width: 650px) {

            body {
                padding-top: 125px;
            }

            .container {
                width:
                    calc(100% - 28px);

                margin:
                    28px auto
                    55px;
            }

            .page-header {
                align-items: stretch;

                flex-direction: column;
            }

            .page-header .btn {
                width: 100%;
            }

            .card,
            .day-section {
                padding: 20px;

                border-radius: 18px;
            }

            .form-row,
            .edit-item-row {
                grid-template-columns: 1fr;
            }

            .item-actions {
                flex-direction: column;

                align-items: stretch;
            }

            .item-actions .btn,
            .item-actions form,
            .item-actions form .btn {
                width: 100%;
            }

        }
    </style>
</head>


<body>

@include('components.navbar')

<div class="container">


    {{-- ========================================== --}}
    {{-- HEADER --}}
    {{-- ========================================== --}}

    <div class="page-header">

        <div>

            <h1>
                Chỉnh sửa lịch trình
            </h1>

            <p>
                Tùy chỉnh địa điểm và thời gian theo nhu cầu của bạn.
            </p>

        </div>


        <a
            href="{{ route(
                'itineraries.show',
                $itinerary
            ) }}"
            class="btn btn-secondary"
        >
            ← Quay lại lịch trình
        </a>

    </div>


    {{-- ========================================== --}}
    {{-- THÔNG BÁO --}}
    {{-- ========================================== --}}

    @if(session('itinerary_success'))

        <div class="success-message">
            {{ session('itinerary_success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="errors">

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================== --}}
    {{-- THÔNG TIN CHUNG --}}
    {{-- ========================================== --}}

    <div class="card">

        <h2>
            Thông tin lịch trình
        </h2>


        <div class="trip-info">

            <span>
                <strong>Tỉnh / Thành phố:</strong>
                {{ $itinerary->province->name }}
            </span>


            <span>
                <strong>Thời gian:</strong>

                {{ $itinerary->total_days }} ngày
                {{ $itinerary->total_nights }} đêm
            </span>


            <span>
                <strong>Ngân sách:</strong>

                @if($itinerary->budget !== null)

                    {{
                        number_format(
                            $itinerary->budget,
                            0,
                            ',',
                            '.'
                        )
                    }}
                    VNĐ

                @else

                    Không giới hạn

                @endif

            </span>

        </div>


        {{-- ĐỔI TÊN --}}

        <form
            method="POST"
            action="{{ route(
                'itineraries.update',
                $itinerary
            ) }}"
        >

            @csrf
            @method('PUT')


            <div class="form-group">

                <label for="title">
                    Tên lịch trình
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    class="form-control"
                    value="{{ old(
                        'title',
                        $itinerary->title
                    ) }}"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Lưu tên lịch trình
            </button>

        </form>

    </div>


    {{-- ========================================== --}}
    {{-- THÊM ĐỊA ĐIỂM --}}
    {{-- ========================================== --}}

    <div class="card">

        <h2>
            + Thêm địa điểm
        </h2>


        @if($availablePlaces->isEmpty())

            <p>
                Không còn địa điểm nào có thể thêm
                vào lịch trình này.
            </p>

        @else

            <form
                method="POST"
                action="{{ route(
                    'itinerary-items.store',
                    $itinerary
                ) }}"
            >

                @csrf


                <div class="form-row">


                    {{-- ĐỊA ĐIỂM --}}

                    <div class="form-group">

                        <label>
                            Địa điểm
                        </label>

                        <select
                            name="place_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                -- Chọn địa điểm --
                            </option>


                            @foreach($availablePlaces as $place)

                                <option
                                    value="{{ $place->id }}"
                                    @selected(
                                        old('place_id')
                                        == $place->id
                                    )
                                >
                                    {{ $place->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- NGÀY --}}

                    <div class="form-group">

                        <label>
                            Ngày
                        </label>

                        <select
                            name="day_number"
                            class="form-control"
                            required
                        >

                            @for(
                                $day = 1;
                                $day <= $itinerary->total_days;
                                $day++
                            )

                                <option
                                    value="{{ $day }}"
                                    @selected(
                                        old('day_number')
                                        == $day
                                    )
                                >
                                    Ngày {{ $day }}
                                </option>

                            @endfor

                        </select>

                    </div>


                    {{-- BẮT ĐẦU --}}

                    <div class="form-group">

                        <label>
                            Bắt đầu
                        </label>

                        <input
                            type="time"
                            name="start_time"
                            class="form-control"
                            value="{{ old('start_time') }}"
                            required
                        >

                    </div>


                    {{-- KẾT THÚC --}}

                    <div class="form-group">

                        <label>
                            Kết thúc
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            class="form-control"
                            value="{{ old('end_time') }}"
                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    class="btn btn-success"
                >
                    + Thêm vào lịch trình
                </button>

            </form>

        @endif

    </div>


    {{-- ========================================== --}}
    {{-- DANH SÁCH THEO NGÀY --}}
    {{-- ========================================== --}}

    @for(
        $day = 1;
        $day <= $itinerary->total_days;
        $day++
    )

        @php

            $dayItems = $itinerary->items
                ->where(
                    'day_number',
                    $day
                )
                ->sortBy('sort_order');

        @endphp


        <div class="day-section">

            <h2 class="day-title">
                Ngày {{ $day }}
            </h2>


            @if($dayItems->isEmpty())

                <div class="empty-day">
                    Chưa có địa điểm trong ngày này.
                </div>

            @else


                @foreach($dayItems as $item)

                    <div class="place-item">


                        {{-- TÊN ĐỊA ĐIỂM --}}

                        <div class="place-header">

                            <h3>
                                {{ $item->place->name }}
                            </h3>


                            @if($item->place->short_description)

                                <p>
                                    {{
                                        $item->place
                                            ->short_description
                                    }}
                                </p>

                            @endif

                        </div>


                        {{-- FORM CẬP NHẬT --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'itinerary-items.update',
                                $item
                            ) }}"
                        >

                            @csrf
                            @method('PUT')


                            <div class="edit-item-row">


                                {{-- NGÀY --}}

                                <div class="form-group">

                                    <label>
                                        Ngày
                                    </label>

                                    <select
                                        name="day_number"
                                        class="form-control"
                                        required
                                    >

                                        @for(
                                            $optionDay = 1;
                                            $optionDay <= $itinerary->total_days;
                                            $optionDay++
                                        )

                                            <option
                                                value="{{ $optionDay }}"
                                                @selected(
                                                    $item->day_number
                                                    == $optionDay
                                                )
                                            >
                                                Ngày {{ $optionDay }}
                                            </option>

                                        @endfor

                                    </select>

                                </div>


                                {{-- GIỜ BẮT ĐẦU --}}

                                <div class="form-group">

                                    <label>
                                        Bắt đầu
                                    </label>

                                    <input
                                        type="time"
                                        name="start_time"
                                        class="form-control"
                                        value="{{
                                            \Carbon\Carbon::parse(
                                                $item->start_time
                                            )->format('H:i')
                                        }}"
                                        required
                                    >

                                </div>


                                {{-- GIỜ KẾT THÚC --}}

                                <div class="form-group">

                                    <label>
                                        Kết thúc
                                    </label>

                                    <input
                                        type="time"
                                        name="end_time"
                                        class="form-control"
                                        value="{{
                                            \Carbon\Carbon::parse(
                                                $item->end_time
                                            )->format('H:i')
                                        }}"
                                        required
                                    >

                                </div>


                                {{-- CẬP NHẬT --}}

                                <div class="form-group">

                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Cập nhật
                                    </button>

                                </div>

                            </div>

                        </form>


                        {{-- XÓA --}}

                        <div class="item-actions">

                            <a
                                href="{{ route(
                                    'places.show',
                                    $item->place->slug
                                ) }}"
                                class="btn btn-secondary"
                            >
                                Xem địa điểm
                            </a>


                            <form
                                method="POST"
                                action="{{ route(
                                    'itinerary-items.destroy',
                                    $item
                                ) }}"
                                class="delete-form"
                                onsubmit="
                                    return confirm(
                                        'Bạn có chắc muốn xóa địa điểm này khỏi lịch trình không?'
                                    );
                                "
                            >

                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    Xóa khỏi lịch trình
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>

    @endfor

</div>

@include('components.footer')

</body>

</html>