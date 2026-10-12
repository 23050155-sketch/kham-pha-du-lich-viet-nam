@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa địa điểm')
@section('page-title', 'Chỉnh sửa địa điểm')

@section('content')

<div class="form-page">

    <div class="page-header">

        <div>
            <h2>✏️ Chỉnh sửa địa điểm</h2>

            <p>
                Cập nhật thông tin {{ $place->name }}.
            </p>
        </div>

        <a href="{{ route('admin.places.index') }}"
           class="btn-back">
            ← Quay lại
        </a>

    </div>


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
        action="{{ route('admin.places.update', $place) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- ========================= --}}
        {{-- THÔNG TIN CƠ BẢN --}}
        {{-- ========================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Thông tin cơ bản</h3>

                <p>
                    Thông tin chính của địa điểm du lịch.
                </p>

            </div>


            <div class="form-grid">

                <div class="form-group full">

                    <label>
                        Tên địa điểm
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $place->name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Tỉnh / Thành phố
                        <span>*</span>
                    </label>

                    <select name="province_id" required>

                        @foreach($provinces as $province)

                            <option
                                value="{{ $province->id }}"

                                {{ old(
                                    'province_id',
                                    $place->province_id
                                ) == $province->id
                                    ? 'selected'
                                    : ''
                                }}
                            >

                                {{ $province->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label>
                        Trạng thái
                        <span>*</span>
                    </label>

                    <select name="status">

                        <option
                            value="active"
                            {{ old(
                                'status',
                                $place->status
                            ) === 'active'
                                ? 'selected'
                                : ''
                            }}
                        >
                            Hiển thị
                        </option>

                        <option
                            value="hidden"
                            {{ old(
                                'status',
                                $place->status
                            ) === 'hidden'
                                ? 'selected'
                                : ''
                            }}
                        >
                            Ẩn
                        </option>

                    </select>

                </div>


                <div class="form-group full">

                    <label>Địa chỉ</label>

                    <input
                        type="text"
                        name="address"
                        value="{{ old(
                            'address',
                            $place->address
                        ) }}"
                    >

                </div>


                <div class="form-group full">

                    <label>Mô tả ngắn</label>

                    <textarea
                        name="short_description"
                        rows="3"
                    >{{ old(
                        'short_description',
                        $place->short_description
                    ) }}</textarea>

                </div>


                <div class="form-group full">

                    <label>Mô tả chi tiết</label>

                    <textarea
                        name="description"
                        rows="7"
                    >{{ old(
                        'description',
                        $place->description
                    ) }}</textarea>

                </div>

            </div>

        </div>


        {{-- ========================= --}}
        {{-- THÔNG TIN THAM QUAN --}}
        {{-- ========================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Thông tin tham quan</h3>

                <p>
                    Giá vé và thời gian tham quan.
                </p>

            </div>


            <div class="form-grid">

                <div class="form-group">

                    <label>Giá vé (VNĐ)</label>

                    <input
                        type="number"
                        name="ticket_price"
                        min="0"
                        value="{{ old(
                            'ticket_price',
                            $place->ticket_price
                        ) }}"
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
                        min="1"
                        value="{{ old(
                            'visit_duration_min',
                            $place->visit_duration_min
                        ) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Giờ mở cửa</label>

                    <input
                        type="time"
                        name="open_time"
                        value="{{ old('open_time', $place->open_time) }}"
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
                        value="{{ old('close_time', $place->close_time) }}"
                    >

                    <small>
                        Có thể để trống nếu địa điểm không có giờ đóng cửa cố định.
                    </small>

                </div>


                <div class="form-group">

                    <label>Thời điểm phù hợp</label>

                    <select name="best_time">

                        @foreach([
                            'any' => 'Bất kỳ',
                            'morning' => 'Buổi sáng',
                            'afternoon' => 'Buổi chiều',
                            'evening' => 'Buổi tối'
                        ] as $value => $label)

                            <option
                                value="{{ $value }}"

                                {{ old(
                                    'best_time',
                                    $place->best_time
                                ) === $value
                                    ? 'selected'
                                    : ''
                                }}
                            >

                                {{ $label }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label>Tháng phù hợp</label>

                    <input
                        type="text"
                        name="best_months"
                        value="{{ old(
                            'best_months',
                            $place->best_months
                        ) }}"
                        placeholder="Ví dụ: 3,4,5,6..."
                    >

                </div>

            </div>

        </div>


        {{-- ========================= --}}
        {{-- DANH MỤC --}}
        {{-- ========================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <h3>Danh mục</h3>

                <p>
                    Chọn loại hình phù hợp với địa điểm.
                </p>

            </div>


            @php
                $selectedCategories = old(
                    'categories',
                    $place->categories->pluck('id')->toArray()
                );
            @endphp


            <div class="category-grid">

                @foreach($categories as $category)

                    <label class="category-item">

                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}"

                            {{ in_array(
                                $category->id,
                                $selectedCategories
                            ) ? 'checked' : '' }}
                        >

                        <span>
                            {{ $category->name }}
                        </span>

                    </label>

                @endforeach

            </div>

        </div>


        {{-- ========================= --}}
        {{-- THÔNG TIN BỔ SUNG --}}
        {{-- ========================= --}}

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
                    >{{ old(
                        'activities',
                        $place->activities
                    ) }}</textarea>

                </div>


                <div class="form-group full">

                    <label>Ghi chú</label>

                    <textarea
                        name="notes"
                        rows="3"
                    >{{ old(
                        'notes',
                        $place->notes
                    ) }}</textarea>

                </div>


                <div class="form-group">

                    <label>Vĩ độ</label>

                    <input
                        type="number"
                        step="any"
                        name="latitude"
                        value="{{ old(
                            'latitude',
                            $place->latitude
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label>Kinh độ</label>

                    <input
                        type="number"
                        step="any"
                        name="longitude"
                        value="{{ old(
                            'longitude',
                            $place->longitude
                        ) }}"
                    >

                </div>


                {{-- CURRENT IMAGE --}}
                @if($place->cover_image)

                    <div class="form-group full">

                        <label>Ảnh hiện tại</label>

                        <img
                            src="{{ asset($place->cover_image) }}"
                            class="current-image"
                            alt="{{ $place->name }}"
                        >

                    </div>

                @endif


                <div class="form-group full">

                    <label>Thay ảnh đại diện</label>

                    <input
                        type="file"
                        name="cover_image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Không chọn ảnh mới nếu muốn giữ nguyên ảnh hiện tại.
                    </small>

                </div>


                {{-- CURRENT GALLERY --}}
                <div class="form-group full">

                    <label>Thư viện ảnh hiện tại</label>

                    @if($place->images->count() > 0)

                        <div class="existing-gallery">

                            @foreach($place->images as $image)

                                <div class="existing-gallery-item">

                                    <img
                                        src="{{ asset($image->image_path) }}"
                                        alt="{{ $image->caption ?? $place->name }}"
                                    >

                                    <input
                                        type="text"
                                        name="existing_captions[{{ $image->id }}]"
                                        value="{{ old(
                                            'existing_captions.' . $image->id,
                                            $image->caption
                                        ) }}"
                                        placeholder="Chú thích ảnh..."
                                        maxlength="255"
                                    >


                                    <button
                                        type="button"
                                        class="btn-delete-image"
                                        onclick="deleteGalleryImage(
                                            '{{ route(
                                                'admin.places.images.destroy',
                                                [$place, $image]
                                            ) }}'
                                        )"
                                    >
                                        🗑 Xóa ảnh
                                    </button>

                                </div>

                            @endforeach

                        </div>

                        <small>
                            Có thể chỉnh sửa chú thích của từng ảnh.
                        </small>

                    @else

                        <div class="empty-gallery">
                            Địa điểm này chưa có ảnh thư viện.
                        </div>

                    @endif

                </div>


                {{-- ADD NEW GALLERY IMAGES --}}
                <div class="form-group full">

                    <label>Thêm ảnh vào thư viện</label>

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

                            {{ old(
                                'is_featured',
                                $place->is_featured
                            ) ? 'checked' : '' }}
                        >

                        <span>
                            ⭐ Địa điểm nổi bật
                        </span>

                    </label>

                </div>

            </div>

        </div>


        <div class="form-actions">

            <a
                href="{{ route('admin.places.index') }}"
                class="btn-cancel"
            >
                Hủy
            </a>

            <button
                type="submit"
                class="btn-save"
            >
                💾 Lưu thay đổi
            </button>

        </div>

    </form>


    <form
        id="delete-gallery-image-form"
        method="POST"
        style="display: none;"
    >
        @csrf
        @method('DELETE')
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

    color: #0f172a;

    font-family: inherit;

    font-size: 13px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.form-group textarea {
    resize: vertical;

    line-height: 1.6;
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
        background .2s ease,
        transform .2s ease;
}

.category-item:hover {
    border-color: #99f6e4;

    background: #f0fdfa;

    transform:
        translateY(-1px);
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


.success-alert {
    margin-bottom: 18px;

    padding: 13px 16px;

    background: #dcfce7;

    border: 1px solid #bbf7d0;

    border-radius: 9px;

    color: #166534;

    font-size: 13px;
}



.current-image {
    width:
        min(100%, 320px);

    height: auto;

    aspect-ratio:
        16 / 10;

    object-fit: cover;

    border:
        1px solid #e2e8f0;

    border-radius: 14px;

    box-shadow:
        0 6px 18px
        rgba(15,23,42,.06);
}



/* EXISTING GALLERY */

.existing-gallery,
.gallery-preview {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;

    margin-top: 5px;
}

.existing-gallery-item,
.gallery-preview-item {
    position: relative;

    padding: 9px;

    background: #f8fafc;

    border:
        1px solid #e2e8f0;

    border-radius: 13px;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}

.existing-gallery-item:hover,
.gallery-preview-item:hover {
    transform:
        translateY(-3px);

    border-color:
        rgba(13,148,136,.25);

    box-shadow:
        0 8px 20px
        rgba(15,23,42,.07);
}

.existing-gallery-item img,
.gallery-preview-item img {
    width: 100%;
    height: 140px;

    object-fit: cover;

    border-radius: 7px;
}

.existing-gallery-item input,
.gallery-caption {
    width: 100%;

    margin-top: 8px;
    padding: 8px 9px !important;

    background: white;
    border: 1px solid #d1d5db;
    border-radius: 7px;

    font-size: 12px !important;
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

.empty-gallery {
    padding: 15px;

    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 8px;

    color: #64748b;
    font-size: 12px;
}


.btn-delete-image {
    width: 100%;

    margin-top: 8px;
    padding: 8px 10px;

    background: #fef2f2;
    color: #dc2626;

    border: 1px solid #fecaca;
    border-radius: 7px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;
}

.btn-delete-image:hover {
    background: #fee2e2;
}




/* ===================================== */
/* RESPONSIVE */
/* ===================================== */

@media (max-width: 992px) {

    .category-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .existing-gallery,
    .gallery-preview {
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

    .btn-back {
        width: 100%;

        min-height: 44px;
    }

    .form-grid,
    .category-grid,
    .existing-gallery,
    .gallery-preview {
        grid-template-columns: 1fr;
    }

    .form-card {
        padding: 17px;

        border-radius: 17px;
    }

    .form-card-header {
        margin-bottom: 16px;
    }

    .form-card-header h3 {
        font-size: 16px;
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

    .current-image {
        width: 100%;

        max-width: 360px;
    }

}
</style>

@endpush



@push('scripts')

<script>


function deleteGalleryImage(url) {

    const confirmed = confirm(
        'Bạn có chắc muốn xóa ảnh này khỏi thư viện không?'
    );

    if (!confirmed) {
        return;
    }

    const form = document.getElementById(
        'delete-gallery-image-form'
    );

    form.action = url;
    form.submit();
}


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