<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đặt lại mật khẩu - TPĐĐ Travel</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            background: #f8fafc;
            color: #1f2937;
        }

        .auth-container {
            min-height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            padding: 35px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        h1 {
            margin: 0 0 10px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .auth-card label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .auth-card input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
        }

        .auth-card input:focus {
            outline: none;
            border-color: #0d9488;
        }

        .auth-card button[type="submit"] {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: #0d9488;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .auth-card button[type="submit"]:hover {
            background: #0f766e;
        }

        .error {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 10px;
            background: #fee2e2;
            color: #b91c1c;
        }

        .back-link {
            display: block;
            margin-top: 22px;
            text-align: center;
            color: #0d9488;
            text-decoration: none;
            font-weight: 600;
        }


        .password-hint {
            display: block;
            margin-top: 7px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
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




        .password-field {
            position: relative;
        }

        .auth-card .password-field input {
            width: 100%;
            padding-right: 52px;
        }

        .auth-card .password-toggle {
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

        .auth-card .password-toggle:hover {
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

<div class="auth-container">
    <div class="auth-card">

        <h1>Đặt lại mật khẩu</h1>

        <p class="subtitle">
            Tạo mật khẩu mới để tiếp tục sử dụng TPĐĐ Travel.
        </p>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $email) }}"
                    required
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu mới</label>

                <div class="password-field">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        minlength="8"
                        required
                        autocomplete="new-password"
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
                <label for="password_confirmation">
                    Xác nhận mật khẩu mới
                </label>

                <div class="password-field">

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
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

            <button type="submit">
                Cập nhật mật khẩu
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            ← Quay lại đăng nhập
        </a>

    </div>
</div>

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