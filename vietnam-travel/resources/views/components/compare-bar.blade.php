
<div
    id="compare-floating-bar"
    class="compare-floating-bar"
    hidden
    aria-label="Danh sách địa điểm đang so sánh"
>
    <div class="compare-bar-inner">

        <div class="compare-bar-info">
            <strong>⚖️ So sánh địa điểm</strong>
            <span id="compare-count">0/3 địa điểm</span>
        </div>

        <div
            id="compare-selected-list"
            class="compare-selected-list"
        ></div>

        <div class="compare-bar-actions">
            <button
                type="button"
                id="compare-clear-btn"
                class="compare-clear-btn"
            >
                Xóa tất cả
            </button>

            <button
                type="button"
                id="compare-now-btn"
                class="compare-now-btn"
                disabled
            >
                So sánh ngay →
            </button>
        </div>

    </div>
</div>

@once
    <link
        rel="stylesheet"
        href="{{ asset('css/place-compare.css') }}"
    >

    <script>
        window.TPDD_COMPARE_URL = @json(route('compare.index'));
    </script>

    <script
        src="{{ asset('js/place-compare.js') }}"
        defer
    ></script>
@endonce
