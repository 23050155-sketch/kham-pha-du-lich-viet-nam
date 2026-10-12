@extends('admin.layouts.app')

@section('title', 'Thêm Danh mục')
@section('page-title', 'Thêm Danh mục')

@section('content')

<div class="form-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h2>➕ Thêm Danh mục</h2>

            <p>
                Thêm danh mục địa điểm mới vào hệ thống.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.index') }}"
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
        method="POST"
        action="{{ route('admin.categories.store') }}"
    >

        @csrf


        <div class="form-card">

            <div class="form-card-header">

                <h3>
                    Thông tin danh mục
                </h3>

                <p>
                    Nhập tên danh mục cần thêm.
                </p>

            </div>


            <div class="form-content">

                <div class="form-group">

                    <label>
                        Tên danh mục
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Ví dụ: Sinh thái"
                        required
                        autofocus
                    >

                    <small>
                        Slug sẽ được hệ thống tự động tạo từ tên danh mục.
                    </small>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="form-actions">

            <a
                href="{{ route('admin.categories.index') }}"
                class="btn-cancel"
            >
                Hủy
            </a>

            <button
                type="submit"
                class="btn-save"
            >
                💾 Thêm danh mục
            </button>

        </div>

    </form>

</div>

@endsection



@push('styles')

<style>

.form-page {
    width: 100%;
    max-width: 850px;

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

.form-content {
    padding:
        clamp(20px, 3vw, 28px);
}


/* FORM */

.form-group {
    display: flex;
    flex-direction: column;

    gap: 7px;
}

.form-group label {
    color: #374151;

    font-size: 13px;
    font-weight: 600;
}

.form-group label span {
    color: #dc2626;
}

.form-group input {
    width: 100%;

    padding: 12px 13px;

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

.form-group input:focus {
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

    transition:
        transform .2s ease,
        box-shadow .2s ease;
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
    transform:
        translateY(-2px);

    box-shadow:
        0 12px 26px
        rgba(13,148,136,.26);
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
        border-radius: 17px;
    }

    .form-card-header {
        padding: 17px;
    }

    .form-content {
        padding: 17px;
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