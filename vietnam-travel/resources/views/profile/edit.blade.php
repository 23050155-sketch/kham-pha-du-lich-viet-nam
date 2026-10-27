<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Chỉnh sửa hồ sơ</title>

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

        .edit-page {
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

        .edit-container {
            width: 100%;

            max-width: 900px;

            margin: 0 auto;
        }

        .edit-card {
            margin-bottom: 26px;

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

        .edit-card h1,
        .edit-card h2 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 30px;
        }

        .avatar-section {
            display: flex;

            align-items: center;

            gap: 22px;

            margin-bottom: 28px;

            padding: 20px;

            background: #f8fafc;

            border:
                1px solid
                #eef2f7;

            border-radius: 16px;
        }

        .avatar-preview {
            width: 105px;
            height: 105px;

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

            font-size: 36px;
            font-weight: 700;

            border:
                4px solid
                white;

            box-shadow:
                0 8px 20px
                rgba(13,148,136,.18);
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;

            min-height: 48px;

            padding: 0 14px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 11px;

            outline: none;

            background: #f8fafc;

            color: #0f172a;

            font-size: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-group input[type="file"] {
            min-height: auto;

            padding: 10px;

            background: white;
        }

        .form-group input:focus {
            background: white;

            border-color: #14b8a6;

            box-shadow:
                0 0 0 3px
                rgba(20,184,166,.10);
        }

        .save-btn {
            min-height: 46px;

            padding: 0 20px;

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

            box-shadow:
                0 8px 20px
                rgba(13,148,136,.18);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .save-btn:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 12px 28px
                rgba(13,148,136,.25);
        }

        .back-link {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 46px;

            margin-left: 8px;

            padding: 0 18px;

            border:
                1px solid
                #e2e8f0;

            border-radius: 11px;

            background: #f8fafc;

            color: #475569;

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            transition: .2s;
        }

        .back-link:hover {
            background: #e2e8f0;

            color: #0f172a;
        }

        .message-success {
            margin-bottom: 20px;

            padding: 13px 15px;

            background: #ecfdf5;

            border:
                1px solid
                #a7f3d0;

            border-radius: 11px;

            color: #047857;

            font-size: 13px;
            font-weight: 600;
        }

        .error-box {
            margin-bottom: 20px;

            padding: 14px 16px;

            background: #fef2f2;

            border:
                1px solid
                #fecaca;

            border-radius: 11px;

            color: #b91c1c;

            font-size: 13px;

            line-height: 1.6;
        }

        .error-box ul {
            margin: 0;

            padding-left: 18px;
        }

        @media (max-width: 650px) {

            .edit-page {
                padding:
                    125px 14px
                    55px;
            }

            .edit-page-heading {
                margin-bottom: 22px;
            }

            .edit-page-heading h1 {
                font-size: 30px;
            }

            .edit-card {
                padding: 22px 18px;

                border-radius: 18px;
            }

            .avatar-section {
                flex-direction: column;

                align-items: center;

                text-align: center;

                padding: 18px;
            }

            .avatar-preview {
                width: 90px;
                height: 90px;

                font-size: 30px;
            }

            .avatar-section .form-group {
                width: 100%;

                margin-bottom: 0;
            }

            .save-btn,
            .back-link {
                width: 100%;

                margin-left: 0;
            }

            .back-link {
                margin-top: 10px;
            }

        }



        .password-hint {
            display: block;

            margin-top: 7px;

            color: #64748b;

            font-size: 12px;

            line-height: 1.55;
        }





        .edit-page-heading {
            margin-bottom: 30px;

            text-align: center;
        }

        .edit-page-heading > span {
            display: inline-block;

            margin-bottom: 8px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1.4px;
        }

        .edit-page-heading h1 {
            margin: 0 0 9px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);

            line-height: 1.15;

            letter-spacing: -0.7px;
        }

        .edit-page-heading p {
            max-width: 620px;

            margin: 0 auto;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }




        .card-heading {
            margin-bottom: 26px;

            padding-bottom: 18px;

            border-bottom:
                1px solid
                #eef2f7;
        }

        .card-heading h2 {
            margin:
                0 0
                6px;

            color: #0f172a;

            font-size: 21px;
        }

        .card-heading p {
            margin: 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }




        .password-field {
            position: relative;
        }

        .password-field input {
            padding-right: 52px;
        }

        .password-toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);

            display: flex;
            align-items: center;
            justify-content: center;

            width: 36px;
            height: 36px;
            padding: 0;
            margin: 0;

            border: none;
            border-radius: 8px;
            background: transparent;
            color: #64748b;
            cursor: pointer;
        }

        .password-toggle:hover {
            background: #f1f5f9;
            color: #0d9488;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
            pointer-events: none;
        }
    </style>

</head>

<body>

<x-navbar />


<main class="edit-page">

    <div class="edit-container">

        <div class="edit-page-heading">

            <span>Tài khoản</span>

            <h1>Chỉnh sửa hồ sơ</h1>

            <p>
                Cập nhật thông tin cá nhân và bảo mật tài khoản của bạn.
            </p>

        </div>


        <section class="edit-card">

            <div class="card-heading">

                <h2>Thông tin cá nhân</h2>

                <p>
                    Cập nhật ảnh đại diện và thông tin liên hệ của bạn.
                </p>

            </div>


            @if(session('success'))

                <div class="message-success">
                    {{ session('success') }}
                </div>

            @endif


            @if($errors->profile->any())

                <div class="error-box">

                    <ul>

                        @foreach($errors->profile->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('profile.update') }}"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="avatar-section">

                    <div class="avatar-preview">

                        @if(auth()->user()->avatar)

                            <img
                                src="{{ asset(auth()->user()->avatar) }}"
                                alt="{{ auth()->user()->name }}"
                                id="avatarPreview"
                            >

                        @else

                            <span id="avatarLetter">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                        @endif

                    </div>


                    <div class="form-group">

                        <label>
                            Ảnh đại diện
                        </label>

                        <input
                            type="file"
                            name="avatar"
                            accept="image/jpeg,image/png,image/webp"
                            onchange="previewAvatar(event)"
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label>
                        Họ và tên
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Số điện thoại
                    </label>

                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone', auth()->user()->phone) }}"
                        placeholder="Ví dụ: 0901234567"
                        maxlength="10"
                        inputmode="numeric"
                        pattern="0[0-9]{9}"
                    >

                </div>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Lưu thay đổi
                </button>


                <a
                    href="{{ route('profile') }}"
                    class="back-link"
                >
                    ← Quay lại hồ sơ
                </a>

            </form>

        </section>


        <section class="edit-card">

            <div class="card-heading">

                <h2>Đổi mật khẩu</h2>

                <p>
                    Nhập mật khẩu hiện tại trước khi thay đổi mật khẩu mới.
                </p>

            </div>


            @if(session('password_success'))

                <div class="message-success">
                    {{ session('password_success') }}
                </div>

            @endif


            @if($errors->password->any())

                <div class="error-box">

                    <ul>

                        @foreach($errors->password->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('profile.password') }}"
            >

                @csrf
                @method('PUT')


                <div class="form-group">

                    <label>
                        Mật khẩu hiện tại
                    </label>

                    <div class="password-field">
                        <input
                            type="password"
                            name="current_password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            aria-label="Hiện mật khẩu"
                            aria-pressed="false"
                            onclick="togglePassword(this)"
                        >
                            <svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                </div>


                <div class="form-group">

                    <label>
                        Mật khẩu mới
                    </label>

                    <div class="password-field">

                        <input
                            type="password"
                            name="password"
                            minlength="8"
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            aria-label="Hiện mật khẩu"
                            aria-pressed="false"
                            onclick="togglePassword(this)"
                        >
                            <svg viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">

                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>

                            </svg>
                        </button>

                    </div>

                    <small class="password-hint">
                        Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa,
                        chữ thường, số và ký tự đặc biệt.
                    </small>

                </div>


                <div class="form-group">

                    <label>
                        Xác nhận mật khẩu mới
                    </label>

                    <div class="password-field">

                        <input
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            aria-label="Hiện mật khẩu"
                            aria-pressed="false"
                            onclick="togglePassword(this)"
                        >
                            <svg viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">

                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>

                            </svg>
                        </button>

                    </div>

                </div>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Đổi mật khẩu
                </button>

            </form>

        </section>

    </div>

</main>


<script>

    function previewAvatar(event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {

            const avatarContainer =
                document.querySelector('.avatar-preview');

            avatarContainer.innerHTML =
                `<img src="${e.target.result}"
                      style="
                          width:100%;
                          height:100%;
                          object-fit:cover;
                      "
                >`;

        };

        reader.readAsDataURL(file);

    }

</script>


@include('components.footer')



<script>
function togglePassword(button) {
    const input = button.closest('.password-field').querySelector('input');
    const isVisible = input.type === 'text';

    input.type = isVisible ? 'password' : 'text';

    button.setAttribute(
        'aria-label',
        isVisible ? 'Hiện mật khẩu' : 'Ẩn mật khẩu'
    );

    button.setAttribute('aria-pressed', String(!isVisible));

    button.innerHTML = isVisible
        ? `<svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                <circle cx="12" cy="12" r="3"/>
           </svg>`
        : `<svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 3l18 18"/>
                <path d="M10.6 5.1A11 11 0 0 1 12 5c6.5 0 10 7 10 7a15 15 0 0 1-4 4.7"/>
                <path d="M6.2 6.2C3.5 8.1 2 12 2 12s3.5 7 10 7a10 10 0 0 0 4.2-.9"/>
                <path d="M10 10a3 3 0 0 0 4 4"/>
           </svg>`;
}
</script>




</body>

</html>