<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tạo lịch trình du lịch</title>

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
                min(100% - 40px, 820px);

            margin:
                40px auto
                80px;
        }

        /* ============================= */
        /* HEADER */
        /* ============================= */

        .page-header {
            max-width: 680px;

            margin:
                0 auto
                32px;

            text-align: center;
        }

        .page-header::before {
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
                10px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -0.7px;
        }

        .page-header p {
            margin: 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;
        }

        /* ============================= */
        /* FORM CARD */
        /* ============================= */

        .form-card {
            padding: 32px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 22px;

            box-shadow:
                0 10px 32px
                rgba(15, 23, 42, .06);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;

            min-height: 48px;

            padding:
                0 14px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 11px;

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

        .help-text {
            margin-top: 7px;

            color: #64748b;

            font-size: 12px;

            line-height: 1.55;
        }

        /* ============================= */
        /* INFORMATION */
        /* ============================= */

        .information {
            margin-bottom: 28px;

            padding: 18px;

            background: #f0fdfa;

            border:
                1px solid
                #ccfbf1;

            border-radius: 14px;

            color: #475569;

            font-size: 13px;

            line-height: 1.65;
        }

        .information strong {
            display: block;

            margin-bottom: 6px;

            color: #0f766e;

            font-size: 14px;
        }

        /* ============================= */
        /* ERRORS */
        /* ============================= */

        .errors {
            margin-bottom: 22px;

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
        /* BUTTON */
        /* ============================= */

        .actions {
            display: grid;

            grid-template-columns:
                auto
                1fr;

            gap: 10px;

            margin-top: 6px;
        }

        .btn {
            min-height: 48px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding:
                0 20px;

            border: none;

            border-radius: 11px;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            text-decoration: none;

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
                0 8px 20px
                rgba(13,148,136,.18);
        }

        .btn-primary:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 12px 28px
                rgba(13,148,136,.24);
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
        /* RESPONSIVE */
        /* ============================= */

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
                margin-bottom: 24px;
            }

            .page-header h1 {
                font-size: 30px;
            }

            .form-card {
                padding: 22px 18px;

                border-radius: 18px;
            }

            .actions {
                grid-template-columns: 1fr;
            }

            .btn {
                width: 100%;
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

        <h1>
            Tạo lịch trình du lịch
        </h1>

        <p>
            Chọn tỉnh/thành phố, số ngày và ngân sách.
            Hệ thống sẽ tự động đề xuất lịch trình phù hợp cho bạn.
        </p>

    </div>


    {{-- ============================= --}}
    {{-- LỖI VALIDATION --}}
    {{-- ============================= --}}

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


    {{-- ============================= --}}
    {{-- FORM --}}
    {{-- ============================= --}}

    <div class="form-card">

        <div class="information">

            <strong>
                Hệ thống đề xuất lịch trình như thế nào?
            </strong>

            Hệ thống sẽ lựa chọn các địa điểm phù hợp
            dựa trên thời gian tham quan, thời điểm thích hợp,
            giờ mở cửa, giờ đóng cửa và ngân sách của bạn.

        </div>


        <form
            method="POST"
            action="{{ route('itineraries.store') }}"
        >

            @csrf


            {{-- ========================= --}}
            {{-- TỈNH / THÀNH PHỐ --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="province_id">
                    Tỉnh / Thành phố
                </label>

                <select
                    name="province_id"
                    id="province_id"
                    class="form-control"
                    required
                >

                    <option value="">
                        -- Chọn tỉnh / thành phố --
                    </option>


                    @foreach($provinces as $province)

                        <option
                            value="{{ $province->id }}"
                            @selected(
                                old('province_id') == $province->id
                            )
                        >
                            {{ $province->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ========================= --}}
            {{-- SỐ NGÀY --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="total_days">
                    Số ngày
                </label>

                <input
                    type="number"
                    name="total_days"
                    id="total_days"
                    class="form-control"
                    min="1"
                    max="30"
                    value="{{ old('total_days', 3) }}"
                    required
                >

                <div class="help-text">
                    Ví dụ: 3 ngày tương ứng với lịch trình
                    3 ngày 2 đêm.
                </div>

            </div>


            {{-- ========================= --}}
            {{-- NGÂN SÁCH --}}
            {{-- ========================= --}}

            <div class="form-group">

                <label for="budget">
                    Ngân sách dự kiến
                </label>

                <input
                    type="number"
                    name="budget"
                    id="budget"
                    class="form-control"
                    min="0"
                    step="1000"
                    value="{{ old('budget') }}"
                    placeholder="Ví dụ: 3000000"
                >

                <div class="help-text">
                    Đơn vị: VNĐ. Bạn có thể để trống nếu
                    không muốn giới hạn ngân sách tiền vé.
                </div>

            </div>


            {{-- ========================= --}}
            {{-- BUTTON --}}
            {{-- ========================= --}}

            <div class="actions">

                <a
                    href="{{ route('itineraries.index') }}"
                    class="btn btn-secondary"
                >
                    ← Quay lại
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Tạo lịch trình
                </button>

            </div>

        </form>

    </div>

</div>

@include('components.footer')

</body>

</html>