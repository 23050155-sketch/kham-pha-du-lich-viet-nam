@extends('admin.layouts.app')

@section('title', 'Quản lý bình luận')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
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

        min-width: 1050px;

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
        vertical-align: top;
        font-size: 14px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 150px;
    }

    .avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        overflow: hidden;
        background: #0d9488;
        color: #fff;
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
        color: #64748b;
        font-size: 12px;
        margin-top: 3px;
    }

    .place-name {
        font-weight: 600;
        color: #0f766e;
        min-width: 150px;
    }

    .comment-content {
        max-width: 360px;
        min-width: 220px;
        line-height: 1.5;
        word-break: break-word;
    }

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-root {
        background: #ccfbf1;
        color: #0f766e;
    }

    .badge-reply {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .reply-count {
        display: block;
        margin-top: 6px;
        color: #64748b;
        font-size: 12px;
    }

    .date {
        color: #64748b;
        white-space: nowrap;
        font-size: 13px;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
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
    <div>
        <h1>💬 Quản lý bình luận</h1>

        <p>
            Theo dõi bình luận và phản hồi của người dùng.
        </p>
    </div>
</div>


<div class="filter-card">

    <form
        method="GET"
        action="{{ route('admin.comments.index') }}"
        class="filter-form"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Tìm nội dung, người dùng hoặc địa điểm..."
        >

        <select name="type">

            <option value="">
                Tất cả loại
            </option>

            <option
                value="root"
                {{ request('type') === 'root' ? 'selected' : '' }}
            >
                Bình luận chính
            </option>

            <option
                value="reply"
                {{ request('type') === 'reply' ? 'selected' : '' }}
            >
                Phản hồi
            </option>

        </select>

        <div class="filter-actions">

            <button
                type="submit"
                class="btn btn-search"
            >
                🔍 Tìm kiếm
            </button>

            <a
                href="{{ route('admin.comments.index') }}"
                class="btn btn-reset"
            >
                Đặt lại
            </a>

        </div>

    </form>

</div>


<div class="table-card">

    @if($comments->count() > 0)

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Địa điểm</th>
                        <th>Nội dung</th>
                        <th>Loại</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($comments as $comment)

                        <tr>

                            <td>
                                #{{ $comment->id }}
                            </td>


                            <td>

                                @if($comment->user)

                                    <div class="user-info">

                                        <div class="avatar">

                                            @if($comment->user->avatar)

                                                <img
                                                    src="{{ asset($comment->user->avatar) }}"
                                                    alt="{{ $comment->user->name }}"
                                                >

                                            @else

                                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}

                                            @endif

                                        </div>

                                        <div>

                                            <div class="user-name">
                                                {{ $comment->user->name }}
                                            </div>

                                            <div class="user-email">
                                                {{ $comment->user->email }}
                                            </div>

                                        </div>

                                    </div>

                                @else

                                    <span>Người dùng đã xóa</span>

                                @endif

                            </td>


                            <td>

                                @if($comment->place)

                                    <div class="place-name">
                                        {{ $comment->place->name }}
                                    </div>

                                @else

                                    <span>Địa điểm đã xóa</span>

                                @endif

                            </td>


                            <td>

                                <div class="comment-content">
                                    {{ $comment->content }}
                                </div>

                            </td>


                            <td>

                                @if(is_null($comment->parent_id))

                                    <span class="badge badge-root">
                                        Bình luận
                                    </span>

                                    @if($comment->replies_count > 0)

                                        <span class="reply-count">
                                            {{ $comment->replies_count }}
                                            phản hồi
                                        </span>

                                    @endif

                                @else

                                    <span class="badge badge-reply">
                                        Phản hồi
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="date">
                                    {{ $comment->created_at->format('d/m/Y') }}
                                    <br>
                                    {{ $comment->created_at->format('H:i') }}
                                </div>

                            </td>



                            <td>
    
                                <form
                                    method="POST"
                                    action="{{ route('admin.comments.destroy', $comment) }}"
                                    onsubmit="return confirmDeleteComment(
                                        {{ is_null($comment->parent_id) ? 'true' : 'false' }},
                                        {{ $comment->replies_count ?? 0 }}
                                    )"
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


        @if($comments->hasPages())

            <div class="pagination-wrapper">

                <nav class="custom-pagination">

                    @if($comments->onFirstPage())

                        <span class="pagination-btn disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $comments->previousPageUrl() }}"
                            class="pagination-btn"
                        >
                            ‹
                        </a>

                    @endif


                    @foreach(
                        range(1, $comments->lastPage())
                        as $page
                    )

                        @if($page == $comments->currentPage())

                            <span class="pagination-btn active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $comments->url($page) }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    @if($comments->hasMorePages())

                        <a
                            href="{{ $comments->nextPageUrl() }}"
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
                💬
            </div>

            <strong>
                Không tìm thấy bình luận
            </strong>

            <p style="margin-top: 6px;">
                Chưa có dữ liệu phù hợp với điều kiện tìm kiếm.
            </p>

        </div>

    @endif

</div>



<script>
    function confirmDeleteComment(isRoot, replyCount) {

        if (isRoot && replyCount > 0) {

            return confirm(
                'Bình luận này có ' +
                replyCount +
                ' phản hồi.\n\n' +
                'Nếu xóa bình luận chính, các phản hồi cũng sẽ bị xóa.\n\n' +
                'Bạn có chắc chắn muốn tiếp tục?'
            );

        }

        return confirm(
            'Bạn có chắc chắn muốn xóa bình luận này?'
        );
    }
</script>

@endsection