@extends('admin.layouts.app')

@section('title', 'Quản lý Người dùng')
@section('page-title', 'Quản lý Người dùng')

@section('content')

<div class="users-page">

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="success-alert">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-alert">
            ⚠️ {{ session('error') }}
        </div>
    @endif


    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h2>👥 Quản lý Người dùng</h2>

            <p>
                Quản lý tài khoản người dùng và quyền truy cập hệ thống.
            </p>
        </div>

    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('admin.users.index') }}"
            class="filter-form"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="🔎 Tìm tên, email hoặc số điện thoại..."
            >


            <select name="role">

                <option value="">
                    Tất cả quyền
                </option>

                <option
                    value="user"
                    {{ request('role') === 'user' ? 'selected' : '' }}
                >
                    Người dùng
                </option>

                <option
                    value="admin"
                    {{ request('role') === 'admin' ? 'selected' : '' }}
                >
                    Quản trị viên
                </option>

            </select>


            <button
                type="submit"
                class="btn-filter"
            >
                Lọc
            </button>


            <a
                href="{{ route('admin.users.index') }}"
                class="btn-reset"
            >
                Đặt lại
            </a>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div>
                <h3>Danh sách tài khoản</h3>

                <p>
                    Hiện có {{ $users->total() }} tài khoản.
                </p>
            </div>

        </div>


        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>Người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Quyền</th>
                        <th>Ngày đăng ký</th>
                        <th>Thao tác</th>
                    </tr>

                </thead>


                <tbody>

                @forelse($users as $user)

                    <tr>

                        {{-- USER --}}
                        <td>

                            <div class="user-info">

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

                                    <div class="user-name">
                                        {{ $user->name }}

                                        @if(auth()->id() === $user->id)
                                            <span class="you">
                                                Bạn
                                            </span>
                                        @endif
                                    </div>

                                    <div class="user-id">
                                        ID: {{ $user->id }}
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- EMAIL --}}
                        <td>
                            {{ $user->email }}
                        </td>


                        {{-- PHONE --}}
                        <td>

                            @if($user->phone)

                                {{ $user->phone }}

                            @else

                                <span class="empty-value">
                                    Chưa cập nhật
                                </span>

                            @endif

                        </td>


                        {{-- ROLE --}}
                        <td>

                            @if($user->role === 'admin')

                                <span class="role admin">
                                    🛡️ Admin
                                </span>

                            @else

                                <span class="role user">
                                    👤 User
                                </span>

                            @endif

                        </td>


                        {{-- CREATED --}}
                        <td>

                            {{ $user->created_at
                                ? $user->created_at->format('d/m/Y')
                                : '—'
                            }}

                        </td>


                        {{-- ACTION --}}
                        <td>

                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'admin.users.show',
                                        $user
                                    ) }}"
                                    class="btn-action view"
                                    title="Xem chi tiết"
                                >
                                    👁️
                                </a>


                                <a
                                    href="{{ route(
                                        'admin.users.edit',
                                        $user
                                    ) }}"
                                    class="btn-action edit"
                                    title="Chỉnh sửa"
                                >
                                    ✏️
                                </a>


                                @if(auth()->id() !== $user->id)

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.users.destroy',
                                            $user
                                        ) }}"
                                        onsubmit="return confirm(
                                            @js(
                                                'Bạn có chắc muốn xóa tài khoản ' .
                                                $user->name .
                                                '?'
                                            )
                                        )"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action delete"
                                            title="Xóa"
                                        >
                                            🗑️
                                        </button>

                                    </form>

                                @else

                                    <button
                                        type="button"
                                        class="btn-action disabled"
                                        title="Không thể xóa tài khoản đang đăng nhập"
                                        disabled
                                    >
                                        🗑️
                                    </button>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="empty-data"
                        >
                            Không tìm thấy tài khoản nào.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($users->hasPages())

            <div class="pagination-wrapper">

                <nav class="custom-pagination">

                    @if($users->onFirstPage())

                        <span class="pagination-btn disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $users->previousPageUrl() }}"
                            class="pagination-btn"
                        >
                            ‹
                        </a>

                    @endif


                    @foreach(
                        range(1, $users->lastPage())
                        as $page
                    )

                        @if($page == $users->currentPage())

                            <span class="pagination-btn active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $users->url($page) }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    @if($users->hasMorePages())

                        <a
                            href="{{ $users->nextPageUrl() }}"
                            class="pagination-btn"
                        >
                            ›
                        </a>

                    @else

                        <span class="pagination-btn disabled">
                            ›
                        </span>

                    @endif

                </nav>

            </div>

        @endif

    </div>

</div>

@endsection



@push('styles')

<style>

.users-page {
    width: 100%;
}


/* HEADER */

.page-header {
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


/* FILTER */

.filter-card {
    padding: 20px;

    margin-bottom: 22px;

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 18px;

    box-shadow:
        0 6px 22px
        rgba(15,23,42,.04);
}

.filter-form {
    display: grid;

    grid-template-columns:
        minmax(280px, 1fr)
        200px
        auto
        auto;

    gap: 12px;
}

.filter-form input,
.filter-form select {
    width: 100%;

    min-height: 44px;

    padding: 0 13px;

    background: white;

    border:
        1px solid #dbe3ec;

    border-radius: 11px;

    outline: none;

    color: #0f172a;

    font-size: 13px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.filter-form input:focus,
.filter-form select:focus {
    border-color: #14b8a6;

    box-shadow:
        0 0 0 3px
        rgba(20,184,166,.12);
}

.btn-filter {
    min-height: 44px;

    padding: 0 18px;

    background:
        linear-gradient(
            135deg,
            #0f766e,
            #0d9488
        );

    color: white;

    border: none;

    border-radius: 11px;

    cursor: pointer;

    font-size: 13px;
    font-weight: 700;
}

.btn-reset {
    min-height: 44px;

    display: flex;

    align-items: center;
    justify-content: center;

    padding: 0 15px;

    background: #f1f5f9;

    color: #475569;

    border:
        1px solid #e2e8f0;

    border-radius: 11px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;
}


/* TABLE */

.table-card {
    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 20px;

    overflow: hidden;

    box-shadow:
        0 7px 24px
        rgba(15,23,42,.04);
}

.table-header {
    padding: 20px;

    border-bottom: 1px solid #e5e7eb;
}

.table-header h3 {
    margin-bottom: 4px;

    color: #111827;
    font-size: 17px;
}

.table-header p {
    color: #64748b;
    font-size: 12px;
}

.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;

    min-width: 900px;

    border-collapse: collapse;
}

th {
    padding: 13px 15px;

    background: #f8fafc;
    color: #475569;

    text-align: left;

    font-size: 12px;
    font-weight: 600;
}

td {
    padding: 14px 15px;

    border-top: 1px solid #f1f5f9;

    color: #334155;

    font-size: 13px;

    vertical-align: middle;
}

tbody tr:hover {
    background: #f8fafc;
}


/* USER */

.user-info {
    display: flex;
    align-items: center;

    gap: 11px;
}

.avatar,
.avatar-default {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    border-radius: 50%;
}

.avatar {
    object-fit: cover;
}

.avatar-default {
    display: flex;

    align-items: center;
    justify-content: center;

    background: #ccfbf1;
    color: #0f766e;

    font-size: 16px;
    font-weight: 700;
}

.user-name {
    color: #111827;

    font-weight: 600;
}

.user-id {
    margin-top: 3px;

    color: #94a3b8;

    font-size: 11px;
}

.you {
    margin-left: 5px;
    padding: 3px 6px;

    background: #ecfdf5;
    color: #047857;

    border-radius: 10px;

    font-size: 9px;
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

.empty-value {
    color: #94a3b8;

    font-style: italic;
}


/* ACTION */

.actions {
    display: flex;

    align-items: center;

    gap: 7px;
}

.actions form {
    margin: 0;
}

.btn-action {
    width: 36px;
    height: 36px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border:
        1px solid transparent;

    border-radius: 9px;

    text-decoration: none;

    cursor: pointer;

    transition:
        transform .2s ease,
        background .2s ease;
}

.btn-action:hover {
    transform:
        translateY(-1px);
}

.btn-action.view {
    background: #f0fdf4;
}

.btn-action.view:hover {
    background: #dcfce7;
}

.btn-action.edit {
    background: #ecfeff;
}

.btn-action.edit:hover {
    background: #cffafe;
}

.btn-action.delete {
    background: #fef2f2;
}

.btn-action.delete:hover {
    background: #fee2e2;
}

.btn-action.disabled {
    background: #f1f5f9;

    opacity: 0.45;

    cursor: not-allowed;
}


/* ALERT */

.success-alert {
    margin-bottom: 18px;
    padding: 13px 16px;

    background: #dcfce7;

    border: 1px solid #bbf7d0;
    border-radius: 9px;

    color: #166534;

    font-size: 13px;
}

.error-alert {
    margin-bottom: 18px;
    padding: 13px 16px;

    background: #fef2f2;

    border: 1px solid #fecaca;
    border-radius: 9px;

    color: #b91c1c;

    font-size: 13px;
}


/* EMPTY */

.empty-data {
    padding: 40px;

    color: #94a3b8;

    text-align: center;
}


/* PAGINATION */

.pagination-wrapper {
    display: flex;

    justify-content: center;

    padding: 20px;

    border-top:
        1px solid #e2e8f0;
}


.custom-pagination {
    display: flex;

    align-items: center;
    justify-content: center;

    flex-wrap: wrap;

    gap: 6px;
}


.pagination-btn {
    width: 38px;
    height: 38px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 10px;

    color: #475569;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;
}


.pagination-btn:hover {
    background: #f0fdfa;

    border-color: #99f6e4;

    color: #0f766e;
}


.pagination-btn.active {
    background:
        linear-gradient(
            135deg,
            #0f766e,
            #0d9488
        );

    border-color: transparent;

    color: white;
}


.pagination-btn.disabled {
    background: #f8fafc;

    color: #cbd5e1;

    cursor: not-allowed;

    pointer-events: none;
}



/* ========================= */
/* RESPONSIVE */
/* ========================= */

@media (max-width: 992px) {

    .filter-form {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 650px) {

    .filter-card {
        padding: 16px;

        border-radius: 16px;
    }

    .filter-form {
        grid-template-columns: 1fr;
    }

    .btn-filter,
    .btn-reset {
        width: 100%;

        min-height: 44px;
    }

    .table-header {
        padding: 17px;
    }

    .pagination-wrapper {
        padding: 16px 10px;
    }

    .pagination-btn {
        width: 36px;
        height: 36px;
    }

}
</style>

@endpush