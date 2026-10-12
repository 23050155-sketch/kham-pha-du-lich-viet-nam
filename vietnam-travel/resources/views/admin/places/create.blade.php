@extends('admin.layouts.app')

@section('title', 'Thêm địa điểm')
@section('page-title', 'Thêm địa điểm')

@section('content')

@if(session('success'))

    <div class="success-alert">
        ✅ {{ session('success') }}
    </div>

@endif

<div class="form-page">

    <div class="page-header">

        <div>
            <h2>➕ Thêm địa điểm mới</h2>

            <p>
                Nhập thông tin địa điểm du lịch vào hệ thống.
            </p>
        </div>

        <a href="{{ route('admin.places.index') }}"
           class="btn-back">
            ← Quay lại
        </a>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="error-box">

            <strong>
                Vui lòng kiểm tra lại thông tin:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.places.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- ====================== --}}
        {{-- THÔNG TIN CƠ BẢN --}}
        {{-- ====================== --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Thông tin cơ bản</h3>

                <p>
                    Thông tin chính của địa điểm du lịch.
                </p>

            </div>


            <div class="form-grid">


                {{-- NAME --}}
                <div class="form-group full">

                    <label>
                        Tên địa điểm
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Ví dụ: Bà Nà Hills"
                        required
                    >

                </div>


                {{-- PROVINCE --}}
                <div class="form-group">

                    <label>
                        Tỉnh / Thành phố
                        <span>*</span>
                    </label>

                    <select name="province_id" required>

                        <option value="">
                            -- Chọn tỉnh/thành --
                        </option>

                        @foreach($provinces as $province)

                            <option
                                value="{{ $province->id }}"
                                {{ old('province_id') == $province->id ? 'selected' : '' }}
                            >
                                {{ $province->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- STATUS --}}
                <div class="form-group">

                    <label>
                        Trạng thái
                        <span>*</span>
                    </label>

                    <select name="status">

                        <option value="active"
                            {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                            Hiển thị
                        </option>

                        <option value="hidden"
                            {{ old('status') === 'hidden' ? 'selected' : '' }}>
                            Ẩn
                        </option>

                    </select>

                </div>


                {{-- ADDRESS --}}
                <div class="form-group full">

                    <label>Địa chỉ</label>

                    <input
                        type="text"
                        name="address"
                        value="{{ old('address') }}"
                        placeholder="Nhập địa chỉ địa điểm..."
                    >

                </div>


                {{-- SHORT DESCRIPTION --}}
                <div class="form-group full">

                    <label>Mô tả ngắn</label>

                    <textarea
                        name="short_description"
                        rows="3"
                        placeholder="Giới thiệu ngắn về địa điểm..."
                    >{{ old('short_description') }}</textarea>

                </div>


                {{-- DESCRIPTION --}}
                <div class="form-group full">

                    <label>Mô tả chi tiết</label>

                    <textarea
                        name="description"
                        rows="7"
                        placeholder="Nhập nội dung mô tả chi tiết..."
                    >{{ old('description') }}</textarea>

                </div>

            </div>

        </div>


        {{-- ====================== --}}
        {{-- THÔNG TIN THAM QUAN --}}
        {{-- ====================== --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Thông tin tham quan</h3>

                <p>
                    Giá vé, thời gian mở cửa và thời lượng tham quan.
                </p>

            </div>


            <div class="form-grid">

                <div class="form-group">

                    <label>Giá vé (VNĐ)</label>

                    <input
                        type="number"
                        name="ticket_price"
                        value="{{ old('ticket_price', 0) }}"
                        min="0"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Thời lượng tham quan (phút)
                        <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="visit_duration_min"
                        value="{{ old('visit_duration_min') }}"
                        min="1"
                        placeholder="Ví dụ: 120"
                        required
                    >

                    <small>
                        Thời gian trung bình để tham quan địa điểm.
                    </small>

                </div>


                <div class="form-group">

                    <label>Giờ mở cửa</label>

                    <input
                        type="time"
                        name="open_time"
                        value="{{ old('open_time') }}"
                    >

                    <small>
                        Có thể để trống nếu địa điểm không có giờ mở cửa cố định.
                    </small>

                </div>


                <div class="form-group">

                    <label>Giờ đóng cửa</label>

                    <input
                        type="time"
                        name="close_time"
                        value="{{ old('close_time') }}"
                    >

                    <small>
                        Có thể để trống nếu địa điểm không có giờ đóng cửa cố định.
                    </small>

                </div>


                <div class="form-group">

                    <label>Thời điểm phù hợp</label>

                    <select name="best_time">

                        <option value="any">
                            Bất kỳ
                        </option>

                        <option value="morning">
                            Buổi sáng
                        </option>

                        <option value="afternoon">
                            Buổi chiều
                        </option>

                        <option value="evening">
                            Buổi tối
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Tháng phù hợp</label>

                    <input
                        type="text"
                        name="best_months"
                        value="{{ old('best_months') }}"
                        placeholder="Ví dụ: 3,4,5,6..."
                    >

                </div>

            </div>

        </div>


        {{-- ====================== --}}
        {{-- PHÂN LOẠI --}}
        {{-- ====================== --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Danh mục</h3>

                <p>
                    Chọn một hoặc nhiều loại hình du lịch.
                </p>

            </div>


            <div class="category-grid">

                @foreach($categories as $category)

                    <label class="category-item">

                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}"
                            {{ in_array(
                                $category->id,
                                old('categories', [])
                            ) ? 'checked' : '' }}
                        >

                        <span>
                            {{ $category->name }}
                        </span>

                    </label>

                @endforeach

            </div>

        </div>


        {{-- ====================== --}}
        {{-- THÔNG TIN BỔ SUNG --}}
        {{-- ====================== --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Thông tin bổ sung</h3>

            </div>


            <div class="form-grid">

                <div class="form-group full">

                    <label>Hoạt động</label>

                    <textarea
                        name="activities"
                        rows="3"
                        placeholder="Ví dụ: Tắm biển, chụp ảnh, tham quan..."
                    >{{ old('activities') }}</textarea>

                </div>


                <div class="form-group full">

                    <label>Ghi chú</label>

                    <textarea
                        name="notes"
                        rows="3"
                        placeholder="Các lưu ý dành cho du khách..."
                    >{{ old('notes') }}</textarea>

                </div>


                <div class="form-group">

                    <label>Vĩ độ</label>

                    <input
                        type="number"
                        step="any"
                        name="latitude"
                        value="{{ old('latitude') }}"
                    >

                </div>


                <div class="form-group">

                    <label>Kinh độ</label>

                    <input
                        type="number"
                        step="any"
                        name="longitude"
                        value="{{ old('longitude') }}"
                    >

                </div>


                <div class="form-group full">

                    <label>Ảnh đại diện</label>

                    <input
                        type="file"
                        name="cover_image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        JPG, JPEG, PNG hoặc WEBP. Tối đa 5MB.
                    </small>

                </div>


                {{-- GALLERY IMAGES --}}
                <div class="form-group full">

                    <label>Thư viện ảnh</label>

                    <input
                        type="file"
                        name="gallery_images[]"
                        id="gallery_images"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                    >

                    <small>
                        Có thể chọn nhiều ảnh cùng lúc.
                        Tối đa 10 ảnh, mỗi ảnh tối đa 5MB.
                    </small>

                    <div
                        id="gallery-preview"
                        class="gallery-preview"
                    ></div>

                </div>


                <div class="form-group full">

                    <label class="featured-check">

                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                        >

                        <span>
                            ⭐ Đặt làm địa điểm nổi bật
                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="form-actions">

            <a href="{{ route('admin.places.index') }}"
               class="btn-cancel">
                Hủy
            </a>

            <button type="submit"
                    class="btn-save">
                💾 Thêm địa điểm
            </button>

        </div>

    </form>

</div>

@endsection



@push('styles')

<style>

.form-page {
    width: 100%;
    max-width: 1150px;

    margin: 0 auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 22px;
}

.page-header h2 {
    margin-bottom: 5px;

    color: #111827;

    font-size: 22px;
}

.page-header p {
    color: #64748b;

    font-size: 13px;
}

.btn-back {
    padding: 10px 15px;

    background: #f1f5f9;

    color: #475569;

    border-radius: 8px;

    text-decoration: none;

    font-size: 13px;
}


/* CARD */

.form-card {
    margin-bottom: 22px;

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

.form-card-header {
    margin-bottom: 20px;
}

.form-card-header h3 {
    margin-bottom: 5px;

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
        repeat(2, 1fr);

    gap: 18px;
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
    color: #ef4444;
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


/* CATEGORY */

.category-grid {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 10px;
}

.category-item {
    display: flex;

    align-items: center;

    gap: 9px;

    padding: 13px;

    background:
        linear-gradient(
            145deg,
            #ffffff,
            #f8fafc
        );

    border:
        1px solid #e2e8f0;

    border-radius: 12px;

    cursor: pointer;

    font-size: 13px;

    transition:
        border-color .2s ease,
        background .2s ease;
}

.category-item:hover {
    border-color: #99f6e4;

    background: #f0fdfa;
}

.category-item input {
    accent-color: #0f766e;
}


/* FEATURED */

.featured-check {
    display: flex !important;

    flex-direction: row !important;

    align-items: center;

    gap: 9px;

    cursor: pointer;
}

.featured-check input {
    width: auto;

    accent-color: #0f766e;
}

.featured-check span {
    color: #374151 !important;
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


/* BUTTON */

.form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 10px;

    margin-bottom: 30px;
}

.btn-cancel,
.btn-save {
    padding: 11px 20px;

    border-radius: 8px;

    font-size: 13px;

    font-weight: 600;
}

.btn-cancel {
    background: #f1f5f9;

    color: #475569;

    text-decoration: none;
}

.btn-save {
    background: #0f766e;

    color: white;

    border: none;

    cursor: pointer;
}

.btn-save:hover {
    background: #115e59;
}


.success-alert {
    margin-bottom: 18px;

    padding: 13px 16px;

    background: #dcfce7;

    border: 1px solid #bbf7d0;

    border-radius: 9px;

    color: #166534;

    font-size: 13px;
}



/* GALLERY PREVIEW */

.gallery-preview {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 12px;

    margin-top: 12px;
}

.gallery-preview-item {
    position: relative;

    padding: 8px;

    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}

.gallery-preview-item img {
    width: 100%;
    height: 130px;

    object-fit: cover;
    border-radius: 7px;
}

.gallery-preview-number {
    position: absolute;
    top: 14px;
    left: 14px;

    padding: 3px 7px;

    background: rgba(0, 0, 0, 0.65);
    color: white;

    border-radius: 6px;

    font-size: 11px;
}

.gallery-caption {
    width: 100%;

    margin-top: 8px;
    padding: 8px 9px !important;

    background: white;
    border: 1px solid #d1d5db;
    border-radius: 7px;

    font-size: 12px !important;
    outline: none;
}

.gallery-caption:focus {
    border-color: #14b8a6;
}

@media (max-width: 992px) {

    .category-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .gallery-preview {
        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }

}


@media (max-width: 650px) {

    .page-header {
        flex-direction: column;
        align-items: stretch;

        gap: 15px;
    }

    .btn-back {
        width: 100%;

        display: flex;
        justify-content: center;

        min-height: 44px;

        align-items: center;
    }

    .form-grid,
    .category-grid {
        grid-template-columns: 1fr;
    }

    .form-card {
        padding: 17px;

        border-radius: 17px;
    }

    .gallery-preview {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;

        min-height: 46px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

}
</style>

@endpush



@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input =
        document.getElementById('gallery_images');

    const preview =
        document.getElementById('gallery-preview');

    if (!input || !preview) {
        return;
    }

    input.addEventListener('change', function () {

        preview.innerHTML = '';

        const files = Array.from(this.files);

        if (files.length > 10) {

            alert('Bạn chỉ được chọn tối đa 10 ảnh.');

            this.value = '';

            return;
        }

        files.forEach(function (file, index) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const item =
                    document.createElement('div');

                item.className =
                    'gallery-preview-item';

                item.innerHTML = `
                    <img
                        src="${event.target.result}"
                        alt="Ảnh ${index + 1}"
                    >

                    <span class="gallery-preview-number">
                        ${index + 1}
                    </span>

                    <input
                        type="text"
                        name="gallery_captions[${index}]"
                        class="gallery-caption"
                        placeholder="Nhập chú thích cho ảnh..."
                        maxlength="255"
                    >
                `;

                preview.appendChild(item);
            };

            reader.readAsDataURL(file);
        });

    });

});
</script>

@endpush