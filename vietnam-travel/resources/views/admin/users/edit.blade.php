@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Người dùng')
@section('page-title', 'Chỉnh sửa Người dùng')

@section('content')

<div class="edit-user-page">

    <div class="page-header">

        <div>
            <h2>✏️ Chỉnh sửa Người dùng</h2>

            <p>
                Cập nhật thông tin và quyền của tài khoản.
            </p>
        </div>

        <a
            href="{{ route('admin.users.show', $user) }}"
            class="btn-back"
        >
            ← Quay lại
        </a>

    </div>


    {{-- ERROR --}}
    @if(session('error'))

        <div class="error-alert">
            ⚠️ {{ session('error') }}
        </div>

    @endif


    {{-- VALIDATION --}}
    @if($errors->any())

        <div class="validation-alert">

            <strong>
                Vui lòng kiểm tra lại:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="form-card">

        {{-- USER HEADER --}}
        <div class="user-header">

            @if($user->avatar)

                <img
                    src="{{ asset($user->avatar) }}"
                    alt="{{ $user->name }}"
                    class="avatar"
                >

            @else

                <div class="avatar-default">
                    {{ strtoupper(
                        mb_substr($user->name, 0, 1)
                    ) }}
                </div>

            @endif


            <div>

                <h3>
                    {{ $user->name }}
                </h3>

                <p>
                    ID tài khoản: #{{ $user->id }}
                </p>

            </div>

        </div>


        <form
            method="POST"
            action="{{ route('admin.users.update', $user) }}"
        >

            @csrf
            @method('PUT')


            <div class="form-grid">


                {{-- NAME --}}
                <div class="form-group">

                    <label for="name">
                        Họ và tên
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                </div>


                {{-- EMAIL --}}
                <div class="form-group">

                    <label for="email">
                        Email
                        <span>*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                </div>


                {{-- PHONE --}}
                <div class="form-group">

                    <label for="phone">
                        Số điện thoại
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        maxlength="10"
                        inputmode="numeric"
                        pattern="0[0-9]{9}"
                        placeholder="Ví dụ: 0123456789"
                    >

                </div>


                {{-- ROLE --}}
                <div class="form-group">

                    <label for="role">
                        Quyền tài khoản
                        <span>*</span>
                    </label>

                    <select
                        id="role"
                        name="role"
                        required
                        {{ auth()->id() === $user->id
                            ? 'disabled'
                            : ''
                        }}
                    >

                        <option
                            value="user"
                            {{
                                old('role', $user->role) === 'user'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            👤 Người dùng
                        </option>

                        <option
                            value="admin"
                            {{
                                old('role', $user->role) === 'admin'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            🛡️ Quản trị viên
                        </option>

                    </select>


                    {{-- disabled không gửi dữ liệu --}}
                    @if(auth()->id() === $user->id)

                        <input
                            type="hidden"
                            name="role"
                            value="admin"
                        >

                        <small>
                            Bạn không thể thay đổi quyền của tài khoản
                            Admin đang đăng nhập.
                        </small>

                    @else

                        <small>
                            Admin có quyền truy cập khu vực quản trị hệ thống.
                        </small>

                    @endif

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('admin.users.show', $user) }}"
                    class="btn-cancel"
                >
                    Hủy
                </a>

                <button
                    type="submit"
                    class="btn-save"
                >
                    💾 Lưu thay đổi
                </button>

            </div>

        </form>

    </div>

</div>

@endsection



@push('styles')

<style>

.edit-user-page {
    width: 100%;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 22px;
}

.page-header h2 {
    margin-bottom: 6px;

    color: #0f172a;

    font-size:
        clamp(22px, 2.5vw, 28px);

    line-height: 1.25;
}

.page-header p {
    color: #64748b;
    font-size: 13px;
}

.btn-back {
    min-height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 16px;

    background: #f1f5f9;

    color: #475569;

    border:
        1px solid #e2e8f0;

    border-radius: 11px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    transition:
        background .2s ease,
        transform .2s ease;
}

.btn-back:hover {
    background: #e2e8f0;

    transform:
        translateY(-1px);
}


/* CARD */

.form-card {
    padding:
        clamp(20px, 3vw, 28px);

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 20px;

    box-shadow:
        0 7px 24px
        rgba(15,23,42,.04);
}


/* USER */

.user-header {
    display: flex;

    align-items: center;

    gap: 16px;

    padding-bottom: 22px;

    margin-bottom: 24px;

    border-bottom:
        1px solid #e2e8f0;
}

.avatar,
.avatar-default {
    width: 68px;
    height: 68px;

    flex-shrink: 0;

    border-radius: 50%;

    border:
        3px solid white;

    box-shadow:
        0 7px 20px
        rgba(15,23,42,.10);
}

.avatar {
    object-fit: cover;
}

.avatar-default {
    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #ccfbf1,
            #99f6e4
        );

    color: #0f766e;

    font-size: 24px;
    font-weight: 800;
}

.user-header h3 {
    margin-bottom: 4px;

    color: #111827;
}

.user-header p {
    color: #94a3b8;

    font-size: 12px;
}


/* FORM */

.form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 20px 22px;
}

.form-group {
    display: flex;
    flex-direction: column;

    gap: 7px;
}

.form-group label {
    color: #334155;

    font-size: 13px;
    font-weight: 600;
}

.form-group label span {
    color: #ef4444;
}

.form-group input,
.form-group select {
    width: 100%;

    padding: 11px 12px;

    background: white;

    border: 1px solid #d1d5db;
    border-radius: 8px;

    outline: none;

    font-size: 13px;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #14b8a6;

    box-shadow:
        0 0 0 3px
        rgba(20,184,166,.12);
}

.form-group select:disabled {
    background: #f8fafc;

    color: #64748b;

    border-color: #e2e8f0;

    cursor: not-allowed;

    opacity: 1;
}

.form-group small {
    color: #94a3b8;

    font-size: 11px;
}


/* ACTION */

.form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 10px;

    padding-top: 24px;

    margin-top: 28px;

    border-top:
        1px solid #e2e8f0;
}

.btn-cancel,
.btn-save {
    min-height: 46px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0 20px;

    border: none;

    border-radius: 11px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.btn-cancel {
    background: #f1f5f9;
    color: #475569;
}

.btn-save {
    background:
        linear-gradient(
            135deg,
            #0f766e,
            #0d9488
        );

    color: white;

    cursor: pointer;

    box-shadow:
        0 8px 20px
        rgba(13,148,136,.18);
}

.btn-save:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 12px 26px
        rgba(13,148,136,.26);
}


/* ALERT */

.error-alert,
.validation-alert {
    padding: 15px 18px;

    margin-bottom: 20px;

    background:
        linear-gradient(
            145deg,
            #fff7f7,
            #fef2f2
        );

    color: #b91c1c;

    border:
        1px solid #fecaca;

    border-radius: 12px;

    font-size: 13px;
}

.validation-alert ul {
    margin: 8px 0 0 18px;
}



/* ========================= */
/* RESPONSIVE */
/* ========================= */

@media (max-width: 650px) {

    .page-header {
        flex-direction: column;

        align-items: stretch;

        gap: 15px;
    }

    .btn-back {
        width: 100%;

        min-height: 44px;
    }

    .form-card {
        padding: 17px;

        border-radius: 17px;
    }

    .user-header {
        align-items: flex-start;

        gap: 13px;
    }

    .avatar,
    .avatar-default {
        width: 58px;
        height: 58px;
    }

    .form-grid {
        grid-template-columns: 1fr;

        gap: 16px;
    }

    .form-actions {
        flex-direction:
            column-reverse;

        gap: 10px;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;

        min-height: 46px;
    }

}
</style>

@endpush