@extends('admin.layouts.app')

@section('title', 'Quản lý Danh mục')
@section('page-title', 'Quản lý Danh mục')

@section('content')

<div class="category-page">

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
            <h2>🏷️ Quản lý Danh mục</h2>

            <p>
                Quản lý các danh mục địa điểm du lịch trong hệ thống.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn-add"
        >
            + Thêm danh mục
        </a>

    </div>


    {{-- TÌM KIẾM --}}
    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('admin.categories.index') }}"
            class="filter-form"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="🔎 Tìm kiếm danh mục..."
            >

            <button
                type="submit"
                class="btn-filter"
            >
                Tìm kiếm
            </button>

            <a
                href="{{ route('admin.categories.index') }}"
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
                <h3>Danh sách danh mục</h3>

                <p>
                    Hiện có {{ $categories->total() }} danh mục.
                </p>
            </div>

        </div>


        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Số địa điểm</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>


                <tbody>

                @forelse($categories as $category)

                    <tr>

                        {{-- STT --}}
                        <td>
                            {{ $categories->firstItem() + $loop->index }}
                        </td>


                        {{-- NAME --}}
                        <td>

                            <div class="category-name">
                                🏷️ {{ $category->name }}
                            </div>

                        </td>


                        {{-- SLUG --}}
                        <td>

                            <span class="slug">
                                {{ $category->slug }}
                            </span>

                        </td>


                        {{-- PLACE COUNT --}}
                        <td>

                            <span class="place-count">
                                📍 {{ $category->places_count }}
                            </span>

                        </td>


                        {{-- ACTION --}}
                        <td>

                            <div class="actions">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route(
                                        'admin.categories.edit',
                                        $category
                                    ) }}"
                                    class="btn-action edit"
                                    title="Chỉnh sửa"
                                >
                                    ✏️
                                </a>


                                {{-- DELETE --}}
                                <form
                                    method="POST"
                                    action="{{ route('admin.categories.destroy', $category) }}"
                                    onsubmit="return confirm(
                                        @js(
                                            'Bạn có chắc muốn xóa danh mục ' .
                                            $category->name .
                                            '? Hành động này không thể hoàn tác.'
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

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="5"
                            class="empty-data"
                        >
                            Không tìm thấy danh mục nào.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- ====================================== --}}
        {{-- PAGINATION TÙY CHỈNH --}}
        {{-- ====================================== --}}

        @if($categories->hasPages())

            <div class="pagination-wrapper">

                <nav class="custom-pagination">

                    {{-- TRANG TRƯỚC --}}
                    @if($categories->onFirstPage())

                        <span class="pagination-btn disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $categories->previousPageUrl() }}"
                            class="pagination-btn"
                        >
                            ‹
                        </a>

                    @endif


                    {{-- SỐ TRANG --}}
                    @foreach(
                        range(1, $categories->lastPage())
                        as $page
                    )

                        @if($page == $categories->currentPage())

                            <span class="pagination-btn active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $categories->url($page) }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    {{-- TRANG SAU --}}
                    @if($categories->hasMorePages())

                        <a
                            href="{{ $categories->nextPageUrl() }}"
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

.category-page {
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


/* ADD */

.btn-add {
    min-height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 18px;

    background:
        linear-gradient(
            135deg,
            #0f766e,
            #0d9488
        );

    color: white;

    border-radius: 12px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    box-shadow:
        0 8px 20px
        rgba(13,148,136,.18);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.btn-add:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 12px 26px
        rgba(13,148,136,.26);
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
        minmax(250px, 1fr)
        auto
        auto;

    gap: 12px;
}

.filter-form input {
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

.filter-form input:focus {
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

    min-width: 680px;

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
    padding: 15px;

    border-top: 1px solid #f1f5f9;

    color: #334155;

    font-size: 13px;

    vertical-align: middle;
}

tbody tr:hover {
    background: #f8fafc;
}


/* CATEGORY */

.category-name {
    color: #111827;

    font-weight: 600;
}

.slug {
    display: inline-block;

    padding: 5px 9px;

    background: #f1f5f9;
    color: #64748b;

    border-radius: 6px;

    font-size: 11px;
}

.place-count {
    font-weight: 600;

    color: #475569;
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
    width: 34px;
    height: 34px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: none;
    border-radius: 7px;

    text-decoration: none;

    cursor: pointer;
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

    flex-shrink: 0;

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 10px;

    color: #475569;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease;
}


.pagination-btn:hover {
    background: #f0fdfa;

    border-color: #99f6e4;

    color: #0f766e;

    transform:
        translateY(-1px);
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

@media (max-width: 650px) {

    .page-header {
        flex-direction: column;

        align-items: stretch;

        gap: 15px;
    }

    .btn-add {
        width: 100%;
    }

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

        border-radius: 9px;
    }

}

</style>

@endpush