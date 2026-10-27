<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quên mật khẩu - TPĐĐ Travel</title>

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
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        h1 {
            text-align: center;
            margin: 0 0 12px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .auth-card label {
            display: block;
            margin-bottom: 8px;
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

        .auth-card button {
            width: 100%;
            margin-top: 20px;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: #0d9488;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .auth-card button:hover {
            background: #0f766e;
        }

        .message {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 10px;
            background: #ccfbf1;
            color: #115e59;
        }

        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 8px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #0d9488;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<x-navbar />

<div class="auth-container">
    <div class="auth-card">

        <h1>Quên mật khẩu?</h1>

        <p class="subtitle">
            Nhập email đã đăng ký.
            Chúng tôi sẽ gửi liên kết để bạn đặt lại mật khẩu.
        </p>

        @if(session('status'))
            <div class="message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email">Email</label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Nhập email của bạn"
                autocomplete="email"
                required
            >

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">
                Gửi liên kết đặt lại mật khẩu
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            ← Quay lại đăng nhập
        </a>

    </div>
</div>

</body>
</html>