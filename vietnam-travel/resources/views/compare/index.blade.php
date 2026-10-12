
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>So sánh địa điểm | TPĐĐ Travel</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #183b38;
            background: #f4f9f8;
        }

        .compare-container {
            max-width: 1200px;
            margin: auto;
            padding: 55px 20px 90px;
        }

        .compare-back {
            display: inline-block;
            margin-bottom: 25px;
            color: #0f766e;
            text-decoration: none;
            font-weight: 600;
        }

        .compare-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .compare-heading h1 {
            font-size: clamp(27px, 4vw, 40px);
            margin: 0 0 12px;
        }

        .compare-heading p {
            color: #64748b;
            line-height: 1.7;
        }

        .compare-scroll {
            overflow-x: auto;
            border-radius: 20px;
            box-shadow: 0 12px 35px rgba(15, 118, 110, .08);
            background: white;
        }

        .compare-table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .compare-table th,
        .compare-table td {
            padding: 20px 16px;
            border-bottom: 1px solid #e6efed;
            text-align: center;
            vertical-align: middle;
            overflow-wrap: anywhere;
        }

        .compare-table th:first-child,
        .compare-table td:first-child {
            width: 160px;
            text-align: left;
            font-weight: 700;
            background: #f0faf8;
        }

        .compare-table thead th {
            vertical-align: top;
        }

        .compare-image {
            width: 100%;
            height: 155px;
            object-fit: cover;
            border-radius: 14px;
            background: #e5efed;
        }

        .compare-placeholder {
            height: 155px;
            display: grid;
            place-items: center;
            background: #e5efed;
            border-radius: 14px;
            font-size: 32px;
        }

        .compare-name {
            margin: 14px 0 8px;
            font-size: 18px;
        }

        .compare-name a {
            color: #134e4a;
            text-decoration: none;
        }

        .compare-tag {
            display: inline-block;
            margin: 3px;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e6f7f3;
            color: #0f766e;
            font-size: 12px;
        }

        .compare-price {
            color: #0f766e;
            font-weight: 700;
        }

        .compare-btn {
            display: inline-block;
            padding: 10px 15px;
            background: #0f766e;
            color: white;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .compare-remove {
            display: block;
            margin: 12px auto 0;
            background: transparent;
            border: none;
            color: #dc2626;
            cursor: pointer;
        }

        .compare-empty {
            padding: 65px 20px;
            background: white;
            border-radius: 20px;
            text-align: center;
        }

        @media (max-width: 640px) {
            .compare-container {
                padding: 30px 14px 65px;
            }

            .compare-table {
                min-width: 620px;
            }

            .compare-table th,
            .compare-table td {
                padding: 14px 10px;
                font-size: 13px;
            }

            .compare-table th:first-child,
            .compare-table td:first-child {
                width: 120px;
            }

            .compare-image,
            .compare-placeholder {
                height: 115px;
            }
        }
    </style>
</head>

<body>

<main class="compare-container">

    <a href="{{ route('explore.index') }}" class="compare-back">
        ← Quay lại khám phá
    </a>

    <div class="compare-heading">
        <h1>⚖️ So sánh địa điểm du lịch</h1>
        <p>
            Đối chiếu thông tin để lựa chọn điểm đến
            phù hợp với chuyến đi của bạn.
        </p>
    </div>

    @if($places->count() < 2)

        <div class="compare-empty">
            <h2>Chưa đủ địa điểm để so sánh</h2>
            <p>Hãy chọn ít nhất 2 địa điểm và tối đa 3 địa điểm.</p>
            <a href="{{ route('explore.index') }}" class="compare-btn">
                Khám phá địa điểm
            </a>
        </div>

    @else

        <div class="compare-scroll">
            <table class="compare-table">

                <thead>
                    <tr>
                        <th>Tiêu chí</th>

                        @foreach($places as $place)
                            <th>
                                @if($place->cover_image)
                                    <img
                                        class="compare-image"
                                        src="{{ asset($place->cover_image) }}"
                                        alt="{{ $place->name }}"
                                    >
                                @else
                                    <div class="compare-placeholder">📍</div>
                                @endif

                                <h3 class="compare-name">
                                    <a href="{{ route('places.show', $place->slug) }}">
                                        {{ $place->name }}
                                    </a>
                                </h3>

                                <button
                                    type="button"
                                    class="compare-remove"
                                    onclick="removeComparedPlace({{ $place->id }})"
                                >
                                    ✕ Bỏ so sánh
                                </button>
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Tỉnh / Thành phố</td>
                        @foreach($places as $place)
                            <td>{{ $place->province?->name ?? 'Chưa cập nhật' }}</td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Danh mục</td>
                        @foreach($places as $place)
                            <td>
                                @forelse($place->categories as $category)
                                    <span class="compare-tag">
                                        {{ $category->name }}
                                    </span>
                                @empty
                                    Chưa cập nhật
                                @endforelse
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Giá vé</td>
                        @foreach($places as $place)
                            <td class="compare-price">
                                @if((float) $place->ticket_price == 0)
                                    Miễn phí / chưa ghi nhận phí
                                @else
                                    {{ number_format($place->ticket_price, 0, ',', '.') }}đ
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Giờ mở cửa</td>
                        @foreach($places as $place)
                            <td>
                                @if($place->open_time && $place->close_time)
                                    {{ substr($place->open_time, 0, 5) }}
                                    –
                                    {{ substr($place->close_time, 0, 5) }}
                                @else
                                    Chưa cập nhật đầy đủ
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Thời gian tham quan</td>
                        @foreach($places as $place)
                            <td>
                                {{ $place->visit_duration_min }}
                                phút
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Lượt xem</td>
                        @foreach($places as $place)
                            <td>
                                👁 {{ number_format($place->view_count ?? 0) }}
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Địa chỉ</td>
                        @foreach($places as $place)
                            <td>{{ $place->address ?: 'Chưa cập nhật' }}</td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Mô tả</td>
                        @foreach($places as $place)
                            <td>
                                {{ $place->short_description ?: 'Chưa cập nhật' }}
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Chi tiết</td>
                        @foreach($places as $place)
                            <td>
                                <a
                                    class="compare-btn"
                                    href="{{ route('places.show', $place->slug) }}"
                                >
                                    Xem địa điểm →
                                </a>
                            </td>
                        @endforeach
                    </tr>
                </tbody>

            </table>
        </div>

    @endif

</main>

<script>
    function removeComparedPlace(id) {
        const key = 'tpdd_compare_places';

        let ids;

        try {
            ids = JSON.parse(localStorage.getItem(key) || '[]');
            if (!Array.isArray(ids)) ids = [];
        } catch {
            ids = [];
        }

        const currentIds = @json($places->pluck('id')->values());
        const remaining = currentIds.filter(
            placeId => Number(placeId) !== Number(id)
        );

        localStorage.setItem(key, JSON.stringify(remaining));


        const namesKey = 'tpdd_compare_names';

        let names = {};

        try {
            names = JSON.parse(localStorage.getItem(namesKey) || '{}');
            if (!names || typeof names !== 'object' || Array.isArray(names)) {
                names = {};
            }
        } catch {
            names = {};
        }

        delete names[id];

        localStorage.setItem(namesKey, JSON.stringify(names));


        if (remaining.length < 2) {
            window.location.href = "{{ route('explore.index') }}";
            return;
        }

        const params = new URLSearchParams();

        remaining.forEach(placeId => {
            params.append('places[]', placeId);
        });

        window.location.href =
            "{{ route('compare.index') }}?" + params.toString();
    }
</script>

</body>
</html>
