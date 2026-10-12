<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $itinerary->title }}</title>

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
                min(100% - 40px, 1100px);

            margin:
                36px auto
                80px;
        }

        /* ============================= */
        /* HEADER */
        /* ============================= */

        .itinerary-header {
            margin-bottom: 30px;

            padding: 30px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 22px;

            box-shadow:
                0 10px 32px
                rgba(15,23,42,.06);
        }

        .itinerary-header h1 {
            margin:
                0 0
                22px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -.7px;
        }

        .itinerary-header::before {
            content: "LỊCH TRÌNH";

            display: inline-block;

            margin-bottom: 8px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1.4px;
        }

        .info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 14px;
        }

        .info-item {
            padding: 16px;

            background: #f8fafc;

            border:
                1px solid
                #e2e8f0;

            border-radius: 12px;

            color: #475569;

            font-size: 14px;

            line-height: 1.6;
        }

        .info-item strong {
            color: #0f172a;

            font-size: 13px;
        }

        .actions {
            margin-top: 24px;

            display: flex;

            align-items: center;

            gap: 10px;

            flex-wrap: wrap;
        }

        .btn {
            min-height: 44px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding:
                0 17px;

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
                24px;

            color: #0f172a;

            font-size: 23px;
        }

        /* ============================= */
        /* TIMELINE */
        /* ============================= */

        .timeline {
            position: relative;

            margin-left: 6px;
        }

        .timeline-item {
            position: relative;

            padding-left: 42px;

            padding-bottom: 28px;
        }

        .timeline-item:last-child {
            padding-bottom: 4px;
        }

        .timeline-item:not(:last-child)::before {
            content: "";

            position: absolute;

            left: 8px;
            top: 17px;
            bottom: -4px;

            width: 2px;

            background: #ccfbf1;
        }

        .timeline-dot {
            position: absolute;

            left: 0;
            top: 4px;

            width: 18px;
            height: 18px;

            border:
                4px solid
                #ccfbf1;

            border-radius: 50%;

            background: #0d9488;

            box-shadow:
                0 0 0 3px
                white;
        }

        .time {
            margin-bottom: 8px;

            color: #0f766e;

            font-size: 13px;

            font-weight: 700;
        }

        .place-card {
            padding: 20px;

            background: #f8fafc;

            border:
                1px solid
                #e2e8f0;

            border-radius: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .place-card:hover {
            border-color:
                rgba(13,148,136,.28);

            box-shadow:
                0 8px 24px
                rgba(15,23,42,.05);
        }

        .place-card h3 {
            margin:
                0 0
                8px;

            color: #0f172a;

            font-size: 19px;
        }

        .place-description {
            color: #64748b;

            font-size: 13px;

            line-height: 1.65;
        }

        .place-info {
            margin-top: 14px;

            display: flex;

            gap: 20px;

            flex-wrap: wrap;

            color: #64748b;

            font-size: 13px;
        }

        .place-info strong {
            color: #0f172a;
        }

        .empty-day {
            padding: 22px;

            background: #f8fafc;

            border:
                1px dashed
                #cbd5e1;

            border-radius: 12px;

            color: #64748b;

            text-align: center;

            font-size: 13px;
        }


        .empty-day a {
            display: inline-block;
            margin-top: 12px;

            color: #0d9488;
            font-weight: 700;
            text-decoration: none;
        }

        .empty-day a:hover {
            text-decoration: underline;
        }

        .success-message {
            margin-bottom: 22px;

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



        .place-link {
            display: inline-flex;

            margin-top: 14px;

            color: #0d9488;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none;
        }

        .place-link:hover {
            color: #0f766e;

            text-decoration: underline;
        }



        @media (max-width: 700px) {

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

            .itinerary-header,
            .day-section {
                padding: 20px;

                border-radius: 18px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;

                align-items: stretch;
            }

            .actions .btn {
                width: 100%;
            }

            .timeline {
                margin-left: 0;
            }

            .timeline-item {
                padding-left: 34px;
            }

            .place-info {
                flex-direction: column;

                gap: 6px;
            }

        }
    </style>
</head>


<body>

@include('components.navbar')

<div class="container">


    {{-- ============================== --}}
    {{-- THÔNG BÁO --}}
    {{-- ============================== --}}

    @if(session('itinerary_success'))

        <div class="success-message">
            {{ session('itinerary_success') }}
        </div>

    @endif


    {{-- ============================== --}}
    {{-- THÔNG TIN LỊCH TRÌNH --}}
    {{-- ============================== --}}

    <div class="itinerary-header">

        <h1>
            {{ $itinerary->title }}
        </h1>


        <div class="info-grid">

            <div class="info-item">
                <strong>Địa điểm</strong>
                <br>
                {{ $itinerary->province->name }}
            </div>


            <div class="info-item">
                <strong>Thời gian</strong>
                <br>

                {{ $itinerary->total_days }} ngày
                {{ $itinerary->total_nights }} đêm
            </div>


            <div class="info-item">

                <strong>Ngân sách</strong>

                <br>

                @if($itinerary->budget !== null)

                    {{ number_format(
                        $itinerary->budget,
                        0,
                        ',',
                        '.'
                    ) }} VNĐ

                @else

                    Không giới hạn

                @endif

            </div>


            <div class="info-item">

                <strong>Tổng tiền vé dự kiến</strong>

                <br>

                {{ number_format(
                    $totalTicketCost,
                    0,
                    ',',
                    '.'
                ) }} VNĐ

            </div>


            @if($itinerary->budget !== null)

                <div class="info-item">

                    <strong>Ngân sách còn lại</strong>

                    <br>

                    {{ number_format(
                        max(
                            0,
                            $itinerary->budget - $totalTicketCost
                        ),
                        0,
                        ',',
                        '.'
                    ) }} VNĐ

                </div>

            @endif

        </div>


        {{-- NÚT CHỨC NĂNG --}}

        <div class="actions">

            <a
                href="{{ route(
                    'itineraries.edit',
                    $itinerary
                ) }}"
                class="btn btn-primary"
            >
                Chỉnh sửa lịch trình
            </a>


            <a
                href="{{ route('itineraries.index') }}"
                class="btn btn-secondary"
            >
                Lịch trình của tôi
            </a>

        </div>

    </div>


    {{-- ============================== --}}
    {{-- CÁC NGÀY --}}
    {{-- ============================== --}}

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


            {{-- KHÔNG CÓ ĐỊA ĐIỂM --}}

            @if($dayItems->isEmpty())

                <div class="empty-day">

                    Chưa có địa điểm trong ngày này.


                    <a
                        href="{{ route(
                            'itineraries.edit',
                            $itinerary
                        ) }}"
                    >
                        + Thêm địa điểm
                    </a>

                </div>


            {{-- CÓ ĐỊA ĐIỂM --}}

            @else

                <div class="timeline">

                    @foreach($dayItems as $item)

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>


                            {{-- THỜI GIAN --}}

                            @if(
                                $item->start_time &&
                                $item->end_time
                            )

                                <div class="time">

                                    {{
                                        \Carbon\Carbon::parse(
                                            $item->start_time
                                        )->format('H:i')
                                    }}

                                    -

                                    {{
                                        \Carbon\Carbon::parse(
                                            $item->end_time
                                        )->format('H:i')
                                    }}

                                </div>

                            @endif


                            {{-- ĐỊA ĐIỂM --}}

                            <div class="place-card">

                                <h3>
                                    {{ $item->place->name }}
                                </h3>


                                @if($item->place->short_description)

                                    <div class="place-description">

                                        {{
                                            $item->place
                                                ->short_description
                                        }}

                                    </div>

                                @endif


                                <div class="place-info">

                                    <span>

                                        Thời lượng:

                                        <strong>
                                            {{
                                                $item->place
                                                    ->visit_duration_min
                                                ?? 120
                                            }}
                                            phút
                                        </strong>

                                    </span>


                                    <span>

                                        Giá vé:

                                        <strong>

                                            @if(
                                                $item->place
                                                    ->ticket_price > 0
                                            )

                                                {{
                                                    number_format(
                                                        $item->place
                                                            ->ticket_price,
                                                        0,
                                                        ',',
                                                        '.'
                                                    )
                                                }}
                                                VNĐ

                                            @else

                                                Miễn phí

                                            @endif

                                        </strong>

                                    </span>

                                </div>


                                <a
                                    href="{{ route(
                                        'places.show',
                                        $item->place->slug
                                    ) }}"
                                    class="place-link"
                                >
                                    Xem địa điểm →
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    @endfor


</div>

@include('components.footer')

</body>

</html>