@extends('admin.layouts.app')

@section('title', 'Quản lý Tỉnh / Thành phố')
@section('page-title', 'Quản lý Tỉnh / Thành phố')

@section('content')

<div class="province-page">

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
            <h2>🗺️ Quản lý Tỉnh / Thành phố</h2>

            <p>
                Quản lý các tỉnh và thành phố trong hệ thống.
            </p>
        </div>

        <a
            href="{{ route('admin.provinces.create') }}"
            class="btn-add"
        >
            + Thêm tỉnh / thành phố
        </a>

    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('admin.provinces.index') }}"
            class="filter-form"
        >

            <div class="search-box">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="🔎 Tìm tỉnh / thành phố..."
                >

            </div>


            <select name="type">

                <option value="">
                    Tất cả loại
                </option>

                <option
                    value="Tỉnh"
                    {{ request('type') === 'Tỉnh'
                        ? 'selected'
                        : '' }}
                >
                    Tỉnh
                </option>

                <option
                    value="Thành phố"
                    {{ request('type') === 'Thành phố'
                        ? 'selected'
                        : '' }}
                >
                    Thành phố
                </option>

            </select>


            <button
                type="submit"
                class="btn-filter"
            >
                Lọc
            </button>


            <a
                href="{{ route('admin.provinces.index') }}"
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

                <h3>
                    Danh sách Tỉnh / Thành phố
                </h3>

                <p>
                    Hiện có {{ $provinces->total() }}
                    tỉnh/thành phố.
                </p>

            </div>

        </div>


        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>Ảnh</th>
                        <th>Tỉnh / Thành phố</th>
                        <th>Loại</th>
                        <th>Số địa điểm</th>
                        <th>Thao tác</th>
                    </tr>

                </thead>


                <tbody>

                @forelse($provinces as $province)

                    <tr>

                        {{-- ẢNH --}}
                        <td>

                            @if($province->cover_image)

                                <img
                                    src="{{ asset($province->cover_image) }}"
                                    alt="{{ $province->name }}"
                                    class="province-image"
                                >

                            @else

                                <div class="no-image">
                                    🖼️
                                </div>

                            @endif

                        </td>


                        {{-- TÊN --}}
                        <td>

                            <div class="province-name">
                                {{ $province->name }}
                            </div>

                            <div class="province-slug">
                                {{ $province->slug }}
                            </div>

                        </td>


                        {{-- LOẠI --}}
                        <td>

                            @if(
                                $province->administrative_type
                                === 'Thành phố'
                            )

                                <span class="type city">
                                    Thành phố
                                </span>

                            @else

                                <span class="type province">
                                    Tỉnh
                                </span>

                            @endif

                        </td>


                        {{-- SỐ ĐỊA ĐIỂM --}}
                        <td>

                            <span class="place-count">
                                📍 {{ $province->places_count }}
                            </span>

                        </td>


                        {{-- ACTION --}}
                        <td>

                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'admin.provinces.edit',
                                        $province
                                    ) }}"
                                    class="btn-action edit"
                                    title="Chỉnh sửa"
                                >
                                    ✏️
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.provinces.destroy',
                                        $province
                                    ) }}"
                                    onsubmit="return confirm(
                                        @js(
                                            'Bạn có chắc muốn xóa ' .
                                            $province->name .
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
                            Không tìm thấy tỉnh/thành phố nào.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- ====================================== --}}
        {{-- PAGINATION TÙY CHỈNH --}}
        {{-- ====================================== --}}

        @if($provinces->hasPages())

            <div class="pagination-wrapper">

                <nav class="custom-pagination">

                    {{-- TRANG TRƯỚC --}}
                    @if($provinces->onFirstPage())

                        <span class="pagination-btn disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $provinces->previousPageUrl() }}"
                            class="pagination-btn"
                        >
                            ‹
                        </a>

                    @endif


                    {{-- SỐ TRANG --}}
                    @foreach(
                        range(1, $provinces->lastPage())
                        as $page
                    )

                        @if($page == $provinces->currentPage())

                            <span class="pagination-btn active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $provinces->url($page) }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    {{-- TRANG SAU --}}
                    @if($provinces->hasMorePages())

                        <a
                            href="{{ $provinces->nextPageUrl() }}"
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

.province-page {
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
    transform: translateY(-2px);

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
    padding: 10px 18px;

    background: #0f766e;
    color: white;

    border: none;
    border-radius: 8px;

    cursor: pointer;

    font-weight: 600;
}

.btn-reset {
    display: flex;
    align-items: center;

    padding: 10px 15px;

    background: #f1f5f9;
    color: #475569;

    border-radius: 8px;

    text-decoration: none;

    font-size: 13px;
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

    min-width: 700px;

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


/* IMAGE */

.province-image,
.no-image {
    width: 70px;
    height: 50px;

    border-radius: 8px;
}

.province-image {
    object-fit: cover;
}

.no-image {
    display: flex;

    align-items: center;
    justify-content: center;

    background: #f1f5f9;

    font-size: 20px;
}


/* PROVINCE */

.province-name {
    margin-bottom: 5px;

    color: #111827;

    font-weight: 600;
}

.province-slug {
    color: #94a3b8;

    font-size: 11px;
}


/* TYPE */

.type {
    display: inline-block;

    padding: 6px 10px;

    border-radius: 20px;

    font-size: 11px;
    font-weight: 600;
}

.type.province {
    background: #ecfdf5;

    color: #047857;
}

.type.city {
    background: #eff6ff;

    color: #1d4ed8;
}


/* PLACE COUNT */

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
        min-height: 44px;

        justify-content: center;
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