@extends('admin.layouts.app')

@section('title', 'Quản lý đánh giá')

@push('styles')
<style>
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 6px;

        color: #0f172a;

        font-size:
            clamp(22px, 2.5vw, 28px);

        line-height: 1.25;
    }

    .page-header p {
        margin: 0;
        color: #64748b;
    }

    .filter-card {
        padding: 20px;

        margin-bottom: 22px;

        background: #fff;

        border:
            1px solid #e2e8f0;

        border-radius: 18px;

        box-shadow:
            0 6px 22px
            rgba(15,23,42,.04);
    }

    .filter-form {
        display: grid;
        grid-template-columns: minmax(250px, 1fr) 200px auto;
        gap: 12px;
        align-items: center;
    }

    .filter-form input,
    .filter-form select {
        width: 100%;

        min-height: 44px;

        padding: 0 13px;

        background: #fff;

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

    .filter-actions {
        display: flex;
        gap: 8px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 10px 14px;

        border: none;
        border-radius: 11px;

        text-decoration: none;
        font-size: 14px;
        font-weight: 600;

        cursor: pointer;
        white-space: nowrap;
    }

    .btn-search {
        background:
            linear-gradient(
                135deg,
                #0f766e,
                #0d9488
            );

        color: #fff;

        box-shadow:
            0 8px 20px
            rgba(13,148,136,.15);
    }

    .btn-search:hover {
        transform:
            translateY(-1px);
    }

    .btn-reset {
        background: #e2e8f0;
        color: #334155;
    }

    .table-card {
        background: #fff;

        border:
            1px solid #e2e8f0;

        border-radius: 20px;

        overflow: hidden;

        box-shadow:
            0 7px 24px
            rgba(15,23,42,.04);
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
        padding: 14px 16px;
        text-align: left;

        background: #f8fafc;
        color: #475569;

        font-size: 13px;
        white-space: nowrap;
    }

    td {
        padding: 15px 16px;
        border-top: 1px solid #e2e8f0;
        vertical-align: middle;
        font-size: 14px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 170px;
    }

    .avatar {
        width: 38px;
        height: 38px;

        border-radius: 50%;
        overflow: hidden;

        background: #0d9488;
        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 700;
        flex-shrink: 0;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-name {
        font-weight: 600;
    }

    .user-email {
        margin-top: 3px;
        color: #64748b;
        font-size: 12px;
    }

    .place-name {
        min-width: 160px;
        font-weight: 600;
        color: #0f766e;
    }

    .stars {
        min-width: 115px;
        color: #f59e0b;
        font-size: 18px;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .rating-number {
        margin-top: 4px;
        color: #64748b;
        font-size: 12px;
    }

    .date {
        color: #64748b;
        white-space: nowrap;
        font-size: 13px;
    }

    .empty-state {
        padding: 55px 20px;
        text-align: center;
        color: #64748b;
    }



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

        pointer-events: none;
    }


    .alert {
        padding: 13px 16px;
        border-radius: 10px;
        margin-bottom: 20px;

        font-size: 14px;
        font-weight: 500;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .alert-error {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-delete {
        min-height: 36px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        padding: 0 12px;

        background: #fef2f2;

        color: #b91c1c;

        border:
            1px solid #fecaca;

        border-radius: 9px;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;

        white-space: nowrap;

        transition:
            background .2s ease,
            transform .2s ease;
    }

    .btn-delete:hover {
        background: #fee2e2;

        transform:
            translateY(-1px);
    }




    /* ========================= */
    /* RESPONSIVE */
    /* ========================= */

    @media (max-width: 992px) {

        .filter-form {
            grid-template-columns:
                1fr 180px;
        }

        .filter-actions {
            grid-column:
                1 / -1;

            width: 100%;
        }

        .filter-actions .btn {
            flex: 1;
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

        .filter-actions {
            grid-column: auto;

            flex-direction: column;
        }

        .filter-actions .btn {
            width: 100%;

            min-height: 44px;
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


@section('content')


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


@if(session('error'))

    <div class="alert alert-error">
        {{ session('error') }}
    </div>

@endif


<div class="page-header">

    <h1>⭐ Quản lý đánh giá</h1>

    <p>
        Theo dõi đánh giá của người dùng dành cho các địa điểm.
    </p>

</div>


<div class="filter-card">

    <form
        method="GET"
        action="{{ route('admin.ratings.index') }}"
        class="filter-form"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Tìm người dùng, email hoặc địa điểm..."
        >


        <select name="rating">

            <option value="">
                Tất cả số sao
            </option>

            @for($star = 5; $star >= 1; $star--)

                <option
                    value="{{ $star }}"
                    {{ (string) request('rating') === (string) $star ? 'selected' : '' }}
                >
                    {{ $star }} sao
                </option>

            @endfor

        </select>


        <div class="filter-actions">

            <button
                type="submit"
                class="btn btn-search"
            >
                🔍 Tìm kiếm
            </button>

            <a
                href="{{ route('admin.ratings.index') }}"
                class="btn btn-reset"
            >
                Đặt lại
            </a>

        </div>

    </form>

</div>


<div class="table-card">

    @if($ratings->count() > 0)

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Địa điểm</th>
                        <th>Đánh giá</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($ratings as $rating)

                        <tr>

                            <td>
                                #{{ $rating->id }}
                            </td>


                            <td>

                                @if($rating->user)

                                    <div class="user-info">

                                        <div class="avatar">

                                            @if($rating->user->avatar)

                                                <img
                                                    src="{{ asset($rating->user->avatar) }}"
                                                    alt="{{ $rating->user->name }}"
                                                >

                                            @else

                                                {{ strtoupper(substr($rating->user->name, 0, 1)) }}

                                            @endif

                                        </div>

                                        <div>

                                            <div class="user-name">
                                                {{ $rating->user->name }}
                                            </div>

                                            <div class="user-email">
                                                {{ $rating->user->email }}
                                            </div>

                                        </div>

                                    </div>

                                @else

                                    <span>Người dùng đã xóa</span>

                                @endif

                            </td>


                            <td>

                                @if($rating->place)

                                    <div class="place-name">
                                        {{ $rating->place->name }}
                                    </div>

                                @else

                                    <span>Địa điểm đã xóa</span>

                                @endif

                            </td>


                            <td>

                                <div class="stars">

                                    @for($star = 1; $star <= 5; $star++)

                                        {{ $star <= $rating->rating ? '★' : '☆' }}

                                    @endfor

                                </div>

                                <div class="rating-number">
                                    {{ $rating->rating }}/5 sao
                                </div>

                            </td>


                            <td>

                                <div class="date">
                                    {{ $rating->created_at->format('d/m/Y') }}
                                    <br>
                                    {{ $rating->created_at->format('H:i') }}
                                </div>

                            </td>


                            <td>

                                <form
                                    method="POST"
                                    action="{{ route('admin.ratings.destroy', $rating) }}"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-delete"
                                    >
                                        🗑 Xóa
                                    </button>

                                </form>

                            </td>


                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        @if($ratings->hasPages())

            <div class="pagination-wrapper">

                <nav class="custom-pagination">

                    @if($ratings->onFirstPage())

                        <span class="pagination-btn disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $ratings->previousPageUrl() }}"
                            class="pagination-btn"
                        >
                            ‹
                        </a>

                    @endif


                    @foreach(
                        range(1, $ratings->lastPage())
                        as $page
                    )

                        @if($page == $ratings->currentPage())

                            <span class="pagination-btn active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $ratings->url($page) }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    @if($ratings->hasMorePages())

                        <a
                            href="{{ $ratings->nextPageUrl() }}"
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

    @else

        <div class="empty-state">

            <div style="font-size: 42px; margin-bottom: 10px;">
                ⭐
            </div>

            <strong>
                Không tìm thấy đánh giá
            </strong>

            <p style="margin-top: 6px;">
                Chưa có dữ liệu phù hợp với điều kiện tìm kiếm.
            </p>

        </div>

    @endif

</div>

@endsection