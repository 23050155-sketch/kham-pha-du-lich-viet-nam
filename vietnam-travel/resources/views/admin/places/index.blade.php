@extends('admin.layouts.app')

@section('title', 'Quản lý địa điểm')
@section('page-title', 'Quản lý địa điểm')

@section('content')

<div class="places-page">

    {{-- THÔNG BÁO THÀNH CÔNG --}}
    @if(session('success'))
        <div class="success-alert">
            ✅ {{ session('success') }}
        </div>
    @endif


    {{-- THÔNG BÁO LỖI --}}
    @if(session('error'))
        <div class="error-alert">
            ⚠️ {{ session('error') }}
        </div>
    @endif


    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h2>📍 Quản lý địa điểm</h2>
            <p>
                Quản lý các địa điểm du lịch trong hệ thống.
            </p>
        </div>

        <a href="{{ route('admin.places.create') }}"
           class="btn-add">
            + Thêm địa điểm
        </a>

    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <form method="GET"
              action="{{ route('admin.places.index') }}"
              class="filter-form">

            <div class="search-box">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="🔎 Tìm tên địa điểm..."
                >
            </div>


            <select name="province">

                <option value="">
                    Tất cả tỉnh/thành
                </option>

                @foreach($provinces as $province)

                    <option
                        value="{{ $province->id }}"
                        {{ request('province') == $province->id ? 'selected' : '' }}
                    >
                        {{ $province->name }}
                    </option>

                @endforeach

            </select>


            <select name="status">

                <option value="">
                    Tất cả trạng thái
                </option>

                <option
                    value="active"
                    {{ request('status') === 'active' ? 'selected' : '' }}
                >
                    Đang hiển thị
                </option>

                <option
                    value="hidden"
                    {{ request('status') === 'hidden' ? 'selected' : '' }}
                >
                    Đang ẩn
                </option>

            </select>


            <button type="submit" class="btn-filter">
                Lọc
            </button>


            <a href="{{ route('admin.places.index') }}"
               class="btn-reset">
                Đặt lại
            </a>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div>
                <h3>Danh sách địa điểm</h3>

                <p>
                    Hiện có {{ $places->total() }} địa điểm.
                </p>
            </div>

        </div>


        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>Ảnh</th>
                        <th>Địa điểm</th>
                        <th>Tỉnh / Thành phố</th>
                        <th>Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>

                </thead>


                <tbody>

                @forelse($places as $place)

                    <tr>

                        {{-- ẢNH --}}
                        <td>

                            @if($place->cover_image)

                                <img
                                    src="{{ asset($place->cover_image) }}"
                                    alt="{{ $place->name }}"
                                    class="place-image"
                                >

                            @else

                                <div class="no-image">
                                    🖼️
                                </div>

                            @endif

                        </td>


                        {{-- TÊN --}}
                        <td>

                            <div class="place-name">
                                {{ $place->name }}
                            </div>

                            <div class="place-address">
                                {{ $place->address ?? 'Chưa có địa chỉ' }}
                            </div>

                        </td>


                        {{-- TỈNH --}}
                        <td>

                            {{ $place->province->name ?? '---' }}

                        </td>


                        {{-- VIEW --}}
                        <td>

                            <span class="view-count">
                                👁️ {{ number_format($place->view_count) }}
                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($place->status === 'active')

                                <span class="status active">
                                    ● Hiển thị
                                </span>

                            @else

                                <span class="status hidden">
                                    ● Đang ẩn
                                </span>

                            @endif

                        </td>


                        {{-- ACTION --}}
                        <td>

                            <div class="actions">

                                {{-- SỬA --}}
                                <a
                                    href="{{ route('admin.places.edit', $place) }}"
                                    class="btn-action edit"
                                    title="Chỉnh sửa"
                                >
                                    ✏️
                                </a>


                                {{-- ẨN / HIỆN --}}
                                <form
                                    method="POST"
                                    action="{{ route('admin.places.toggle-status', $place) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn-action toggle"
                                        title="{{ $place->status === 'active'
                                            ? 'Ẩn địa điểm'
                                            : 'Hiển thị địa điểm' }}"
                                    >

                                        @if($place->status === 'active')
                                            👁️
                                        @else
                                            🚫
                                        @endif

                                    </button>
                                </form>


                                {{-- XÓA --}}
                                <form
                                    method="POST"
                                    action="{{ route('admin.places.destroy', $place) }}"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa địa điểm {{ $place->name }}? Hành động này không thể hoàn tác.')"
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

                        <td colspan="6"
                            class="empty-data">

                            Không tìm thấy địa điểm nào.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- ====================================== --}}
        {{-- PAGINATION TÙY CHỈNH --}}
        {{-- ====================================== --}}

        @if($places->hasPages())

            <div class="pagination-wrapper">

                <nav class="custom-pagination">

                    {{-- NÚT TRƯỚC --}}
                    @if($places->onFirstPage())

                        <span class="pagination-btn disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $places->previousPageUrl() }}"
                            class="pagination-btn"
                            aria-label="Trang trước"
                        >
                            ‹
                        </a>

                    @endif


                    {{-- SỐ TRANG --}}
                    @foreach(
                        range(1, $places->lastPage())
                        as $page
                    )

                        @if($page == $places->currentPage())

                            <span
                                class="
                                    pagination-btn
                                    active
                                "
                            >
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{
                                    $places->url($page)
                                }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    {{-- NÚT SAU --}}
                    @if($places->hasMorePages())

                        <a
                            href="{{ $places->nextPageUrl() }}"
                            class="pagination-btn"
                            aria-label="Trang sau"
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

    .places-page {
        width: 100%;
    }


    /* ========================= */
    /* HEADER */
    /* ========================= */

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


    /* ========================= */
    /* FILTER */
    /* ========================= */

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
            minmax(220px, 1fr)
            200px
            170px
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


    /* ========================= */
    /* TABLE */
    /* ========================= */

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
        min-width: 820px;
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


    /* ========================= */
    /* PLACE */
    /* ========================= */

    .place-image,
    .no-image {
        width: 65px;
        height: 48px;

        border-radius: 8px;
    }

    .place-image {
        object-fit: cover;
    }

    .no-image {
        display: flex;

        align-items: center;
        justify-content: center;

        background: #f1f5f9;

        font-size: 20px;
    }

    .place-name {
        margin-bottom: 5px;

        color: #111827;

        font-weight: 600;
    }

    .place-address {
        max-width: 300px;

        color: #94a3b8;

        font-size: 11px;

        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .view-count {
        color: #64748b;
    }


    /* ========================= */
    /* STATUS */
    /* ========================= */

    .status {
        display: inline-block;

        padding: 6px 10px;

        border-radius: 20px;

        font-size: 11px;
        font-weight: 600;
    }

    .status.active {
        background: #dcfce7;

        color: #15803d;
    }

    .status.hidden {
        background: #fee2e2;

        color: #b91c1c;
    }


    /* ========================= */
    /* ACTIONS */
    /* ========================= */

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

    .btn-action.delete {
        background: #fef2f2;
    }


    /* ========================= */
    /* EMPTY */
    /* ========================= */

    .empty-data {
        padding: 40px;

        color: #94a3b8;

        text-align: center;
    }


    /* ========================= */
    /* PAGINATION */
    /* ========================= */

    .pagination-wrapper {
        display: flex;

        justify-content: center;

        padding: 20px;

        border-top:
            1px solid #e2e8f0;

        background: white;
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

        box-shadow:
            0 6px 15px
            rgba(13,148,136,.20);
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

        .custom-pagination {
            gap: 5px;
        }

        .pagination-btn {
            width: 36px;
            height: 36px;

            border-radius: 9px;

            font-size: 12px;
        }

    }



    .btn-action.toggle {
        background: #fefce8;
    }

    .btn-action.toggle:hover {
        background: #fef3c7;
    }

    .btn-action.edit:hover {
        background: #cffafe;
    }

    .btn-action.delete:hover {
        background: #fee2e2;
    }




    /* ========================= */
    /* ALERT */
    /* ========================= */

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

</style>

@endpush