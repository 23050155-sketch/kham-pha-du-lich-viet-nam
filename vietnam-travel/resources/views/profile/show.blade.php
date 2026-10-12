<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Hồ sơ cá nhân</title>

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

        .profile-page {
            min-height: 100vh;

            padding:
                125px 20px
                80px;

            background:
                linear-gradient(
                    180deg,
                    #f8fafc,
                    #f1f5f9
                );
        }

        .profile-container {
            width: 100%;

            max-width: 980px;

            margin: 0 auto;
        }

        .profile-card {
            overflow: hidden;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 22px;

            padding: 0;

            box-shadow:
                0 12px 35px
                rgba(15, 23, 42, .07);
        }

        .profile-header {
            display: flex;

            align-items: center;

            gap: 24px;

            padding: 32px 35px;

            background:
                linear-gradient(
                    135deg,
                    #f0fdfa,
                    #ffffff
                );

            border-bottom:
                1px solid
                #e2e8f0;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;

            flex-shrink: 0;

            overflow: hidden;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            font-size: 38px;
            font-weight: 700;

            border:
                5px solid
                white;

            box-shadow:
                0 8px 25px
                rgba(13, 148, 136, .20);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .profile-info h1 {
            margin:
                0 0
                7px;

            color: #0f172a;

            font-size: 28px;

            line-height: 1.25;
        }

        .profile-info p {
            margin: 0;

            color: #64748b;

            font-size: 14px;
        }

        .profile-details {
            padding:
                10px 35px
                5px;
        }

        .detail-row {
            display: grid;

            grid-template-columns:
                180px
                1fr;

            align-items: center;

            gap: 24px;

            padding: 18px 0;

            border-bottom:
                1px solid
                #eef2f7;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #64748b;

            font-size: 13px;
            font-weight: 600;
        }

        .detail-value {
            color: #0f172a;

            font-size: 14px;
            font-weight: 700;

            text-align: right;

            word-break: break-word;
        }

        .empty-value {
            color: #94a3b8;

            font-weight: 500;

            font-style: italic;
        }

        .profile-actions {
            padding: 25px 35px 32px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .edit-profile-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 46px;

            padding: 0 20px;

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

            box-shadow:
                0 8px 20px
                rgba(13, 148, 136, .18);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }


        .admin-profile-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 46px;
            padding: 0 20px;

            border-radius: 11px;
            background: #e0f2f1;
            color: #0f766e;

            border: 1px solid #99f6e4;
            text-decoration: none;

            font-size: 14px;
            font-weight: 700;

            transition: 0.2s ease;
        }

        .admin-profile-btn:hover {
            background: #ccfbf1;
            transform: translateY(-2px);
        }


        .edit-profile-btn:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 12px 28px
                rgba(13, 148, 136, .25);
        }


        @media (max-width: 650px) {

            .profile-page {
                padding:
                    125px 14px
                    55px;
            }

            .profile-page-heading {
                margin-bottom: 22px;
            }

            .profile-page-heading h1 {
                font-size: 30px;
            }

            .profile-header {
                flex-direction: column;

                text-align: center;

                padding:
                    28px 20px;

                gap: 16px;
            }

            .profile-avatar {
                width: 92px;
                height: 92px;

                font-size: 32px;
            }

            .profile-info h1 {
                font-size: 23px;
            }

            .profile-details {
                padding:
                    5px 20px;
            }

            .detail-row {
                grid-template-columns: 1fr;

                gap: 6px;

                padding: 15px 0;
            }

            .detail-value {
                text-align: left;
            }

            .profile-actions {
                padding:
                    22px 20px
                    26px;
            }

            .edit-profile-btn,
            .admin-profile-btn {
                width: 100%;
            }

        }




        .profile-page-heading {
            margin-bottom: 28px;
            text-align: center;
        }

        .profile-page-heading > span {
            display: inline-block;

            margin-bottom: 8px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1.4px;
        }

        .profile-page-heading h1 {
            margin: 0 0 8px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -0.7px;
        }

        .profile-page-heading p {
            max-width: 600px;

            margin:
                0 auto;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }
    </style>

</head>

<body>

<x-navbar />


<main class="profile-page">

    <div class="profile-container">

        <div class="profile-page-heading">
            <span>Tài khoản</span>

            <h1>Hồ sơ cá nhân</h1>

            <p>
                Quản lý thông tin cá nhân và tài khoản của bạn.
            </p>
        </div>

        <section class="profile-card">


            <div class="profile-header">

                <div class="profile-avatar">

                    @if(auth()->user()->avatar)

                        <img
                            src="{{ asset(auth()->user()->avatar) }}"
                            alt="{{ auth()->user()->name }}"
                        >

                    @else

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    @endif

                </div>


                <div class="profile-info">

                    <h1>
                        {{ auth()->user()->name }}
                    </h1>

                    <p>
                        Thành viên TPDĐ Travel
                    </p>

                </div>

            </div>


            <div class="profile-details">


                <div class="detail-row">

                    <span class="detail-label">
                        Họ và tên
                    </span>

                    <span class="detail-value">
                        {{ auth()->user()->name }}
                    </span>

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Email
                    </span>

                    <span class="detail-value">
                        {{ auth()->user()->email }}
                    </span>

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Số điện thoại
                    </span>

                    @if(auth()->user()->phone)

                        <span class="detail-value">
                            {{ auth()->user()->phone }}
                        </span>

                    @else

                        <span class="detail-value empty-value">
                            Chưa cập nhật
                        </span>

                    @endif

                </div>


                <div class="detail-row">

                    <span class="detail-label">
                        Ngày tham gia
                    </span>

                    <span class="detail-value">
                        {{ auth()->user()->created_at->format('d/m/Y') }}
                    </span>

                </div>


            </div>


            <div class="profile-actions">

                @if(auth()->user()->role === 'admin')
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="admin-profile-btn"
                    >
                        🛡️ Trang quản trị
                    </a>
                @endif

                <a
                    href="{{ route('profile.edit') }}"
                    class="edit-profile-btn"
                >
                    ✏️ Chỉnh sửa hồ sơ
                </a>

            </div>


        </section>

    </div>

</main>


@include('components.footer')

</body>

</html>