@extends('admin.layouts.app')

@section('title', 'Chi tiết Người dùng')
@section('page-title', 'Chi tiết Người dùng')

@section('content')

<div class="user-detail-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h2>👤 Chi tiết Người dùng</h2>

            <p>
                Thông tin và hoạt động của tài khoản.
            </p>
        </div>

        <div class="header-actions">

            <a
                href="{{ route('admin.users.index') }}"
                class="btn-back"
            >
                ← Quay lại
            </a>

            <a
                href="{{ route('admin.users.edit', $user) }}"
                class="btn-edit"
            >
                ✏️ Chỉnh sửa
            </a>

        </div>

    </div>


    {{-- PROFILE --}}
    <div class="profile-card">

        <div class="profile-top">

            @if($user->avatar)

                <img
                    src="{{ asset($user->avatar) }}"
                    alt="{{ $user->name }}"
                    class="profile-avatar"
                >

            @else

                <div class="profile-avatar-default">
                    {{ strtoupper(
                        mb_substr($user->name, 0, 1)
                    ) }}
                </div>

            @endif


            <div class="profile-main">

                <div class="name-row">

                    <h3>
                        {{ $user->name }}
                    </h3>

                    @if(auth()->id() === $user->id)

                        <span class="you">
                            Bạn
                        </span>

                    @endif

                </div>


                <div>

                    @if($user->role === 'admin')

                        <span class="role admin">
                            🛡️ Quản trị viên
                        </span>

                    @else

                        <span class="role user">
                            👤 Người dùng
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- INFORMATION --}}
        <div class="info-grid">

            <div class="info-item">
                <span class="label">
                    ID tài khoản
                </span>

                <strong>
                    #{{ $user->id }}
                </strong>
            </div>


            <div class="info-item">
                <span class="label">
                    Họ và tên
                </span>

                <strong>
                    {{ $user->name }}
                </strong>
            </div>


            <div class="info-item">
                <span class="label">
                    Email
                </span>

                <strong>
                    {{ $user->email }}
                </strong>
            </div>


            <div class="info-item">
                <span class="label">
                    Số điện thoại
                </span>

                <strong>
                    {{ $user->phone ?: 'Chưa cập nhật' }}
                </strong>
            </div>


            <div class="info-item">
                <span class="label">
                    Ngày đăng ký
                </span>

                <strong>
                    {{
                        $user->created_at
                            ? $user->created_at->format('d/m/Y H:i')
                            : '—'
                    }}
                </strong>
            </div>


            <div class="info-item">
                <span class="label">
                    Cập nhật gần nhất
                </span>

                <strong>
                    {{
                        $user->updated_at
                            ? $user->updated_at->format('d/m/Y H:i')
                            : '—'
                    }}
                </strong>
            </div>

        </div>

    </div>


    {{-- ACTIVITY --}}
    <div class="section-title">

        <h3>
            📊 Hoạt động của người dùng
        </h3>

        <p>
            Thống kê hoạt động của tài khoản trên website.
        </p>

    </div>


    <div class="stats-grid">


        <div class="stat-card">

            <div class="stat-icon">
                ⭐
            </div>

            <div>
                <div class="stat-number">
                    {{ $user->ratings_count }}
                </div>

                <div class="stat-label">
                    Đánh giá
                </div>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                💬
            </div>

            <div>
                <div class="stat-number">
                    {{ $user->comments_count }}
                </div>

                <div class="stat-label">
                    Bình luận
                </div>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                ❤️
            </div>

            <div>
                <div class="stat-number">
                    {{ $user->favorites_count }}
                </div>

                <div class="stat-label">
                    Yêu thích
                </div>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                🗓️
            </div>

            <div>
                <div class="stat-number">
                    {{ $user->itineraries_count }}
                </div>

                <div class="stat-label">
                    Lịch trình
                </div>
            </div>

        </div>


    </div>

</div>

@endsection



@push('styles')

<style>

.user-detail-page {
    width: 100%;
}


/* HEADER */

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

.header-actions {
    display: flex;
    gap: 10px;
}

.btn-back,
.btn-edit {
    min-height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 16px;

    border-radius: 11px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.btn-back {
    background: #f1f5f9;

    color: #475569;

    border:
        1px solid #e2e8f0;
}

.btn-back:hover {
    background: #e2e8f0;

    transform:
        translateY(-1px);
}

.btn-edit {
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

.btn-edit:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 12px 26px
        rgba(13,148,136,.26);
}


/* PROFILE */

.profile-card {
    padding:
        clamp(20px, 3vw, 28px);

    margin-bottom: 26px;

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 20px;

    box-shadow:
        0 7px 24px
        rgba(15,23,42,.04);
}

.profile-top {
    display: flex;
    align-items: center;

    gap: 18px;

    padding-bottom: 22px;
    margin-bottom: 22px;

    border-bottom: 1px solid #e5e7eb;
}

.profile-avatar,
.profile-avatar-default {
    width: 88px;
    height: 88px;

    flex-shrink: 0;

    border-radius: 50%;

    border:
        3px solid #ffffff;

    box-shadow:
        0 8px 22px
        rgba(15,23,42,.10);
}

.profile-avatar {
    object-fit: cover;
}

.profile-avatar-default {
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

    font-size: 30px;
    font-weight: 800;
}

.name-row {
    display: flex;
    align-items: center;

    gap: 8px;

    margin-bottom: 9px;
}

.name-row h3 {
    color: #0f172a;

    font-size:
        clamp(20px, 2vw, 24px);

    font-weight: 750;
}

.you {
    padding: 3px 7px;

    background: #ecfdf5;
    color: #047857;

    border-radius: 10px;

    font-size: 10px;
}


/* ROLE */

.role {
    display: inline-block;

    padding: 6px 10px;

    border-radius: 20px;

    font-size: 11px;
    font-weight: 600;
}

.role.admin {
    background: #fef3c7;
    color: #92400e;
}

.role.user {
    background: #eff6ff;
    color: #1d4ed8;
}


/* INFORMATION */

.info-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;
}

.info-item {
    display: flex;

    flex-direction: column;

    gap: 7px;

    padding: 16px;

    background:
        linear-gradient(
            145deg,
            #f8fafc,
            #ffffff
        );

    border:
        1px solid #e2e8f0;

    border-radius: 13px;

    transition:
        transform .2s ease,
        border-color .2s ease,
        box-shadow .2s ease;
}

.info-item:hover {
    transform:
        translateY(-2px);

    border-color: #ccfbf1;

    box-shadow:
        0 7px 18px
        rgba(15,23,42,.05);
}

.info-item .label {
    color: #94a3b8;

    font-size: 11px;
}

.info-item strong {
    color: #0f172a;

    font-size: 13px;
    font-weight: 650;

    overflow-wrap: anywhere;
}


/* SECTION */

.section-title {
    margin-bottom: 15px;
}

.section-title h3 {
    margin-bottom: 5px;

    color: #0f172a;

    font-size: 18px;
    font-weight: 700;
}

.section-title p {
    color: #64748b;

    font-size: 12px;
}


/* STATS */

.stats-grid {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 15px;
}

.stat-card {
    display: flex;

    align-items: center;

    gap: 14px;

    padding: 20px;

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 16px;

    box-shadow:
        0 6px 20px
        rgba(15,23,42,.04);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}

.stat-card:hover {
    transform:
        translateY(-3px);

    border-color:
        rgba(20,184,166,.25);

    box-shadow:
        0 10px 24px
        rgba(15,23,42,.07);
}

.stat-icon {
    width: 48px;
    height: 48px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    background:
        linear-gradient(
            135deg,
            #f0fdfa,
            #ccfbf1
        );

    border-radius: 13px;

    font-size: 21px;
}

.stat-number {
    color: #0f172a;

    font-size: 24px;
    font-weight: 800;

    line-height: 1;
}

.stat-label {
    margin-top: 3px;

    color: #64748b;

    font-size: 11px;
}



/* ========================= */
/* RESPONSIVE */
/* ========================= */

@media (max-width: 992px) {

    .stats-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 650px) {

    .page-header {
        flex-direction: column;

        align-items: stretch;

        gap: 15px;
    }

    .header-actions {
        width: 100%;

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .btn-back,
    .btn-edit {
        width: 100%;

        min-height: 44px;
    }

    .profile-card {
        padding: 17px;

        border-radius: 17px;
    }

    .profile-top {
        flex-direction: column;

        align-items: flex-start;

        gap: 15px;
    }

    .profile-avatar,
    .profile-avatar-default {
        width: 76px;
        height: 76px;
    }

    .name-row {
        flex-wrap: wrap;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: 1fr;

        gap: 12px;
    }

    .stat-card {
        padding: 17px;
    }

}

</style>

@endpush