@extends('admin.layouts.app')

@section('title', 'Thêm Tỉnh / Thành phố')
@section('page-title', 'Thêm Tỉnh / Thành phố')

@section('content')

<div class="form-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>

            <h2>
                ➕ Thêm Tỉnh / Thành phố
            </h2>

            <p>
                Thêm tỉnh hoặc thành phố mới vào hệ thống.
            </p>

        </div>


        <a
            href="{{ route('admin.provinces.index') }}"
            class="btn-back"
        >
            ← Quay lại
        </a>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="error-box">

            <strong>
                ⚠️ Vui lòng kiểm tra lại thông tin:
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


    {{-- FORM --}}
    <form
        action="{{ route('admin.provinces.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="form-card">

            <div class="form-card-header">

                <h3>
                    Thông tin Tỉnh / Thành phố
                </h3>

                <p>
                    Nhập thông tin cơ bản.
                </p>

            </div>


            <div class="form-grid">


                {{-- NAME --}}
                <div class="form-group full">

                    <label>
                        Tên tỉnh / thành phố
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Ví dụ: Tây Ninh"
                        required
                    >

                    <small>
                        Slug sẽ được hệ thống tự động tạo.
                    </small>

                </div>


                {{-- TYPE --}}
                <div class="form-group">

                    <label>
                        Loại hành chính
                        <span>*</span>
                    </label>

                    <select
                        name="administrative_type"
                        required
                    >

                        <option value="">
                            -- Chọn loại --
                        </option>

                        <option
                            value="Tỉnh"
                            {{ old('administrative_type') === 'Tỉnh'
                                ? 'selected'
                                : '' }}
                        >
                            Tỉnh
                        </option>

                        <option
                            value="Thành phố"
                            {{ old('administrative_type') === 'Thành phố'
                                ? 'selected'
                                : '' }}
                        >
                            Thành phố
                        </option>

                    </select>

                </div>


                {{-- IMAGE --}}
                <div class="form-group">

                    <label>
                        Ảnh bìa
                    </label>

                    <input
                        type="file"
                        name="cover_image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        JPG, JPEG, PNG hoặc WEBP. Tối đa 5MB.
                    </small>

                </div>


                {{-- DESCRIPTION --}}
                <div class="form-group full">

                    <label>
                        Mô tả
                    </label>

                    <textarea
                        name="description"
                        rows="7"
                        placeholder="Nhập mô tả về tỉnh/thành phố..."
                    >{{ old('description') }}</textarea>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="form-actions">

            <a
                href="{{ route('admin.provinces.index') }}"
                class="btn-cancel"
            >
                Hủy
            </a>

            <button
                type="submit"
                class="btn-save"
            >
                💾 Thêm tỉnh / thành phố
            </button>

        </div>

    </form>

</div>

@endsection



@push('styles')

<style>

.form-page {
    width: 100%;
    max-width: 1000px;

    margin: 0 auto;
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
}

.btn-back:hover {
    background: #e2e8f0;
}


/* CARD */

.form-card {
    margin-bottom: 22px;

    background: white;

    border:
        1px solid #e2e8f0;

    border-radius: 20px;

    overflow: hidden;

    box-shadow:
        0 7px 24px
        rgba(15,23,42,.04);
}

.form-card-header {
    padding: 20px 24px;

    border-bottom:
        1px solid #e2e8f0;
}

.form-card-header h3 {
    margin-bottom: 4px;

    color: #111827;

    font-size: 17px;
}

.form-card-header p {
    color: #64748b;

    font-size: 12px;
}


/* FORM */

.form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 20px;

    padding:
        clamp(20px, 3vw, 28px);
}

.form-group {
    display: flex;
    flex-direction: column;

    gap: 7px;
}

.form-group.full {
    grid-column: 1 / -1;
}

.form-group label {
    color: #374151;

    font-size: 13px;
    font-weight: 600;
}

.form-group label span {
    color: #dc2626;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;

    padding: 12px 13px;

    background: white;

    border:
        1px solid #dbe3ec;

    border-radius: 11px;

    outline: none;

    color: #0f172a;

    font-family: inherit;

    font-size: 13px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #14b8a6;

    box-shadow:
        0 0 0 3px
        rgba(20,184,166,.12);
}

.form-group small {
    color: #94a3b8;

    font-size: 11px;
}


/* ERROR */

.error-box {
    margin-bottom: 20px;
    padding: 15px 18px;

    background: #fef2f2;

    border: 1px solid #fecaca;
    border-radius: 10px;

    color: #b91c1c;

    font-size: 13px;
}

.error-box ul {
    margin-top: 8px;
    padding-left: 20px;
}


/* ACTION */

.form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 10px;
}

.btn-cancel,
.btn-save {
    min-height: 46px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0 20px;

    border-radius: 11px;

    font-size: 13px;
    font-weight: 700;
}

.btn-cancel {
    background: #f1f5f9;

    color: #475569;

    text-decoration: none;
}

.btn-save {
    background:
        linear-gradient(
            135deg,
            #0f766e,
            #0d9488
        );

    color: white;

    border: none;

    cursor: pointer;

    box-shadow:
        0 8px 20px
        rgba(13,148,136,.18);
}

.btn-save:hover {
    transform: translateY(-2px);

    box-shadow:
        0 12px 26px
        rgba(13,148,136,.26);
}


/* RESPONSIVE */

@media (max-width: 650px) {

    .page-header {
        flex-direction: column;
        align-items: stretch;

        gap: 15px;
    }

    .btn-back {
        width: 100%;
    }

    .form-grid {
        grid-template-columns: 1fr;

        padding: 17px;
    }

    .form-group.full {
        grid-column: auto;
    }

    .form-card {
        border-radius: 17px;
    }

    .form-actions {
        flex-direction:
            column-reverse;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;
    }

}

</style>

@endpush