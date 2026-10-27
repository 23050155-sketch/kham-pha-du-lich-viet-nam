<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập</title>

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

            background: white;

            border-radius: 18px;

            padding: 35px;

            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        .auth-card h1 {
            text-align: center;
            margin-bottom: 8px;
        }

        .auth-subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #d1d5db;
            border-radius: 10px;

            font-size: 15px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0d9488;
        }

        .submit-btn {
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

        .submit-btn:hover {
            background: #0f766e;
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
        }

        .auth-link a {
            color: #0d9488;
            text-decoration: none;
            font-weight: 600;
        }

        .error-box {
            background: #fee2e2;
            color: #b91c1c;

            padding: 12px 15px;

            border-radius: 10px;

            margin-bottom: 20px;
        }



        .forgot-password-link {
            margin-top: 10px;
            text-align: right;
        }

        .forgot-password-link a {
            color: #0d9488;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .forgot-password-link a:hover {
            color: #0f766e;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<x-navbar />

<div class="auth-container">

    <div class="auth-card">

        <h1>Đăng nhập</h1>

        <p class="auth-subtitle">
            Đăng nhập để tiếp tục khám phá
        </p>

        @if($errors->any())

            <div class="error-box">

                {{ $errors->first() }}

            </div>

        @endif

        <form
            method="POST"
            action="{{ route('login.submit') }}"
        >

            @csrf

            <div class="form-group">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Mật khẩu
                </label>

                <input
                    type="password"
                    name="password"
                    required
                >

                <div class="forgot-password-link">
                    <a href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                </div>

            </div>

            <button
                type="submit"
                class="submit-btn"
            >
                Đăng nhập
            </button>

        </form>

        <div class="auth-link">

            Chưa có tài khoản?

            <a href="{{ route('register') }}">
                Đăng ký
            </a>

        </div>

    </div>

</div>

</body>
</html>