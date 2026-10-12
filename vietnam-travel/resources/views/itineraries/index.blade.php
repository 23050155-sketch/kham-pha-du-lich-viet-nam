<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Lịch trình của tôi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            padding-top: 110px;

            font-family:
                Inter,
                Arial,
                Helvetica,
                sans-serif;

            background: #f8fafc;

            color: #0f172a;
        }

        .container {
            width: min(100% - 40px, 1180px);

            margin:
                42px auto
                80px;
        }

        /* ============================= */
        /* HEADER */
        /* ============================= */

        .page-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 24px;

            margin-bottom: 32px;

            padding: 28px;

            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #f0fdfa
                );

            border: 1px solid #dff7f3;

            border-radius: 22px;

            box-shadow:
                0 10px 30px
                rgba(15, 23, 42, .05);
        }

        .page-header h1 {
            margin:
                0 0
                8px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -0.8px;
        }

        .page-header p {
            margin: 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }

        /* ============================= */
        /* BUTTON */
        /* ============================= */

        .btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 42px;

            padding: 0 16px;

            border: none;

            border-radius: 10px;

            text-decoration: none;

            cursor: pointer;

            font-size: 13px;
            font-weight: 700;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }


        /* PRIMARY */

        .btn-primary {
            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            box-shadow:
                0 8px 20px
                rgba(13, 148, 136, .18);
        }

        .btn-primary:hover {
            box-shadow:
                0 12px 26px
                rgba(13, 148, 136, .26);
        }


        /* SECONDARY */

        .btn-secondary {
            background: #f1f5f9;

            color: #334155;

            border:
                1px solid
                #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }


        /* DELETE */

        .btn-danger {
            background: #fef2f2;

            color: #dc2626;

            border:
                1px solid
                #fecaca;
        }

        .btn-danger:hover {
            background: #dc2626;

            color: white;
        }

        /* ============================= */
        /* SUCCESS */
        /* ============================= */

        .success-message {
            margin-bottom: 26px;

            padding: 14px 18px;

            background: #ecfdf5;

            border:
                1px solid
                #a7f3d0;

            border-radius: 12px;

            color: #047857;

            font-size: 14px;
            font-weight: 600;
        }

        /* ============================= */
        /* GRID */
        /* ============================= */

        .itinerary-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 22px;
        }

        /* ============================= */
        /* CARD */
        /* ============================= */

        .itinerary-card {
            position: relative;

            display: flex;
            flex-direction: column;

            min-height: 100%;

            padding: 24px;

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

        .itinerary-card:hover {
            transform: translateY(-5px);

            border-color:
                rgba(13, 148, 136, .28);

            box-shadow:
                0 18px 38px
                rgba(15, 23, 42, .10);
        }

        .itinerary-card h2 {
            margin:
                0 0
                10px;

            color: #0f172a;

            font-size: 21px;

            line-height: 1.35;
        }

        .province {
            width: fit-content;

            margin-bottom: 18px;

            padding: 6px 10px;

            background: #f0fdfa;

            border:
                1px solid
                #ccfbf1;

            border-radius: 999px;

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;
        }

        .card-info {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 12px;

            margin-bottom: 18px;
        }

        .info-item {
            padding: 14px;

            background: #f8fafc;

            border:
                1px solid
                #eef2f7;

            border-radius: 12px;
        }

        .info-label {
            margin-bottom: 6px;

            color: #64748b;

            font-size: 11px;
            font-weight: 600;

            text-transform: uppercase;

            letter-spacing: .4px;
        }

        .info-value {
            color: #0f172a;

            font-size: 14px;
            font-weight: 700;

            line-height: 1.45;
        }

        .created-at {
            margin-bottom: 20px;

            color: #94a3b8;

            font-size: 12px;

            line-height: 1.5;
        }

        .card-actions {
            display: flex;

            flex-wrap: wrap;

            gap: 8px;

            margin-top: auto;

            padding-top: 18px;

            border-top:
                1px solid
                #f1f5f9;
        }

        .delete-form {
            margin: 0;
        }

        /* ============================= */
        /* EMPTY */
        /* ============================= */

        .empty-state {
            padding:
                70px 25px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            text-align: center;

            box-shadow:
                0 8px 28px
                rgba(15, 23, 42, .05);
        }

        .empty-state::before {
            content: "🗺️";

            display: block;

            margin-bottom: 16px;

            font-size: 48px;
        }

        .empty-state h2 {
            margin:
                0 0
                10px;

            color: #0f172a;

            font-size: 24px;
        }

        .empty-state p {
            max-width: 480px;

            margin:
                0 auto
                24px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;
        }

        /* ============================= */
        /* RESPONSIVE */
        /* ============================= */

        /* TABLET */

        @media (max-width: 900px) {

            body {
                padding-top: 115px;
            }

            .container {
                width:
                    calc(100% - 32px);

                margin:
                    34px auto
                    65px;
            }

            .itinerary-grid {
                grid-template-columns: 1fr;
            }

        }


        /* MOBILE */

        @media (max-width: 600px) {

            body {
                padding-top: 125px;
            }

            .container {
                width:
                    calc(100% - 28px);

                margin:
                    28px auto
                    50px;
            }


            /* HEADER */

            .page-header {
                flex-direction: column;

                align-items: stretch;

                gap: 18px;

                padding: 22px 18px;

                border-radius: 18px;
            }

            .page-header h1 {
                font-size: 30px;
            }

            .page-header .btn-primary {
                width: 100%;
            }


            /* CARD */

            .itinerary-card {
                padding: 19px;

                border-radius: 17px;
            }

            .itinerary-card h2 {
                font-size: 19px;
            }


            /* INFO */

            .card-info {
                grid-template-columns: 1fr;
            }


            /* BUTTONS */

            .card-actions {
                display: grid;

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .card-actions .btn {
                width: 100%;
            }

            .delete-form {
                width: 100%;
            }

            .delete-form .btn {
                width: 100%;
            }

            .card-actions > .btn-primary {
                grid-column: 1 / -1;
            }

        }
    </style>
</head>


<body>

@include('components.navbar')

<div class="container">

    {{-- ============================= --}}
    {{-- HEADER --}}
    {{-- ============================= --}}

    <div class="page-header">

        <div>

            <h1>
                Lịch trình của tôi
            </h1>

            <p>
                Quản lý các chuyến đi bạn đã tạo.
            </p>

        </div>


        <a
            href="{{ route('itineraries.create') }}"
            class="btn btn-primary"
        >
            + Tạo lịch trình mới
        </a>

    </div>


    {{-- ============================= --}}
    {{-- THÔNG BÁO --}}
    {{-- ============================= --}}

    @if(session('itinerary_success'))

        <div class="success-message">
            {{ session('itinerary_success') }}
        </div>

    @endif


    {{-- ============================= --}}
    {{-- CHƯA CÓ LỊCH TRÌNH --}}
    {{-- ============================= --}}

    @if($itineraries->isEmpty())

        <div class="empty-state">

            <h2>
                Bạn chưa có lịch trình nào
            </h2>

            <p>
                Hãy tạo lịch trình đầu tiên cho chuyến đi của bạn.
            </p>

            <a
                href="{{ route('itineraries.create') }}"
                class="btn btn-primary"
            >
                Tạo lịch trình
            </a>

        </div>


    {{-- ============================= --}}
    {{-- DANH SÁCH LỊCH TRÌNH --}}
    {{-- ============================= --}}

    @else

        <div class="itinerary-grid">

            @foreach($itineraries as $itinerary)

                <div class="itinerary-card">

                    {{-- TÊN --}}

                    <h2>
                        {{ $itinerary->title }}
                    </h2>


                    {{-- TỈNH / THÀNH --}}

                    <div class="province">
                        📍 {{ $itinerary->province->name }}
                    </div>


                    {{-- THÔNG TIN --}}

                    <div class="card-info">

                        <div class="info-item">

                            <div class="info-label">
                                Thời gian
                            </div>

                            <div class="info-value">

                                {{ $itinerary->total_days }}
                                ngày

                                {{ $itinerary->total_nights }}
                                đêm

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-label">
                                Ngân sách
                            </div>

                            <div class="info-value">

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

                            </div>

                        </div>

                    </div>


                    {{-- NGÀY TẠO --}}

                    <div class="created-at">
                        🕒 Ngày tạo:
                        {{ $itinerary->created_at->format('d/m/Y H:i') }}
                    </div>


                    {{-- CHỨC NĂNG --}}

                    <div class="card-actions">

                        <a
                            href="{{ route(
                                'itineraries.show',
                                $itinerary
                            ) }}"
                            class="btn btn-primary"
                        >
                            Xem chi tiết
                        </a>


                        <a
                            href="{{ route(
                                'itineraries.edit',
                                $itinerary
                            ) }}"
                            class="btn btn-secondary"
                        >
                            Chỉnh sửa
                        </a>


                        <form
                            method="POST"
                            action="{{ route(
                                'itineraries.destroy',
                                $itinerary
                            ) }}"
                            class="delete-form"
                            onsubmit="
                                return confirm(
                                    'Bạn có chắc muốn xóa lịch trình này không?'
                                );
                            "
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                Xóa
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

@include('components.footer')

</body>

</html>