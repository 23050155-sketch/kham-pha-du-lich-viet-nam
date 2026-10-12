@extends('admin.layouts.app')


@section('title', 'Dashboard')

@section('page-title', 'Dashboard')


@section('content')

{{-- ========================= --}}
{{-- WELCOME --}}
{{-- ========================= --}}

<div class="welcome-box">

    <div>

        <span class="welcome-label">
            TRANG QUẢN TRỊ
        </span>

        <h2>
            Xin chào, {{ auth()->user()->name }} 👋
        </h2>

        <p>
            Theo dõi và quản lý dữ liệu
            của hệ thống du lịch TPDĐ Travel.
        </p>

    </div>

</div>


{{-- ========================= --}}
{{-- STATISTICS --}}
{{-- ========================= --}}

<div class="stats-grid">


    {{-- ĐỊA ĐIỂM --}}

    <div class="stat-card">

        <div class="stat-icon">
            📍
        </div>

        <div class="stat-info">

            <span>
                Địa điểm
            </span>

            <h3>
                {{ number_format($totalPlaces) }}
            </h3>

            <p>
                Địa điểm du lịch
            </p>

        </div>

    </div>


    {{-- TỈNH THÀNH --}}

    <div class="stat-card">

        <div class="stat-icon">
            🏙️
        </div>

        <div class="stat-info">

            <span>
                Tỉnh / Thành phố
            </span>

            <h3>
                {{ number_format($totalProvinces) }}
            </h3>

            <p>
                Tổng số tỉnh thành
            </p>

        </div>

    </div>

    {{-- DANH MỤC --}}

    <div class="stat-card">

        <div class="stat-icon">
            🗂️
        </div>

        <div class="stat-info">

            <span>
                Danh mục
            </span>

            <h3>
                {{ number_format($categoryCount) }}
            </h3>

            <p>
                Danh mục địa điểm
            </p>

        </div>

    </div>


    {{-- USERS --}}

    <div class="stat-card">

        <div class="stat-icon">
            👥
        </div>

        <div class="stat-info">

            <span>
                Người dùng
            </span>

            <h3>
                {{ number_format($totalUsers) }}
            </h3>

            <p>
                Tài khoản hệ thống
            </p>

        </div>

        

    </div>



    {{-- BÌNH LUẬN --}}

    <div class="stat-card">

        <div class="stat-icon">
            💬
        </div>

        <div class="stat-info">

            <span>
                Bình luận
            </span>

            <h3>
                {{ number_format($commentCount) }}
            </h3>

            <p>
                Bình luận người dùng
            </p>

        </div>

    </div>


    {{-- TỔNG LƯỢT TÌM KIẾM --}}
    <div class="stat-card">

        <div class="stat-icon">
            🔍
        </div>

        <div class="stat-info">

            <span>
                Tìm kiếm
            </span>

            <h3>
                {{ number_format($totalSearches) }}
            </h3>

            <p>
                Tổng lượt tìm kiếm
            </p>

        </div>

    </div>


    {{-- TỪ KHÓA KHÁC NHAU --}}
    <div class="stat-card">

        <div class="stat-icon">
            🔥
        </div>

        <div class="stat-info">

            <span>
                Từ khóa
            </span>

            <h3>
                {{ number_format($uniqueSearchKeywords) }}
            </h3>

            <p>
                Từ khóa tìm kiếm khác nhau
            </p>

        </div>

    </div>


    {{-- ĐÁNH GIÁ --}}

    <div class="stat-card">

        <div class="stat-icon">
            ⭐
        </div>

        <div class="stat-info">

            <span>
                Đánh giá
            </span>

            <h3>
                {{ number_format($ratingCount) }}
            </h3>

            <p>
                Lượt đánh giá
            </p>

        </div>

    </div>

</div>



<div class="dashboard-section search-section">

    <div class="section-header">

        <h3>
            🔥 Top 5 tìm kiếm phổ biến
        </h3>

        <p>
            Những từ khóa được người dùng tìm kiếm nhiều nhất.
        </p>

    </div>


    @if($topSearches->isNotEmpty())

        <div class="top-search-list">

            @foreach($topSearches as $index => $search)

                <div class="top-search-item">

                    <span class="search-rank">
                        {{ $index + 1 }}
                    </span>

                    <span class="search-keyword">
                        {{ $search->keyword }}
                    </span>

                    <span class="search-total">
                        {{ $search->total }} lượt
                    </span>

                </div>

            @endforeach

        </div>

    @else

        <div class="search-empty">
            Chưa có dữ liệu tìm kiếm.
        </div>

    @endif

</div>



{{-- ========================= --}}
{{-- CHARTS --}}
{{-- ========================= --}}

<div class="charts-section">

    <div class="charts-header">
        <h3>Thống kê theo tỉnh / thành phố</h3>
        <p>
            Top 5 tỉnh/thành phố có mức độ tương tác cao nhất.
        </p>
    </div>


    {{-- BIỂU ĐỒ LƯỢT XEM --}}
    <div class="chart-card chart-large">

        <div class="chart-title">
            <div>
                <h4>👁️ Top 5 lượt xem</h4>
                <p>
                    Tỉnh/thành phố có tổng lượt xem địa điểm cao nhất.
                </p>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="viewsChart"></canvas>
        </div>

    </div>


    <div class="charts-grid">

        {{-- BIỂU ĐỒ YÊU THÍCH --}}
        <div class="chart-card">

            <div class="chart-title">
                <div>
                    <h4>❤️ Top 5 yêu thích</h4>
                    <p>
                        Tỷ lệ lượt yêu thích theo tỉnh/thành phố.
                    </p>
                </div>
            </div>

            <div class="chart-container small-chart">
                <canvas id="favoritesChart"></canvas>
            </div>

        </div>


        {{-- BIỂU ĐỒ ĐÁNH GIÁ --}}
        <div class="chart-card">

            <div class="chart-title">
                <div>
                    <h4>⭐ Top 5 lượt đánh giá</h4>
                    <p>
                        Tỉnh/thành phố có nhiều lượt đánh giá nhất.
                    </p>
                </div>
            </div>

            <div class="chart-container small-chart">
                <canvas id="ratingsChart"></canvas>
            </div>

        </div>

    </div>

</div>


@endsection

@push('styles')

<style>

    /* ============================= */
    /* WELCOME */
    /* ============================= */

    .welcome-box {
        position: relative;

        overflow: hidden;

        padding:
            clamp(24px, 4vw, 36px);

        margin-bottom: 24px;

        background:
            linear-gradient(
                135deg,
                #0f766e,
                #0d9488
            );

        border-radius: 22px;

        color: white;

        box-shadow:
            0 12px 32px
            rgba(15,118,110,.16);
    }

    .welcome-label {
        display: block;

        margin-bottom: 8px;

        color: #ccfbf1;

        font-size: 11px;
        font-weight: bold;

        letter-spacing: 1.5px;
    }

    .welcome-box h2 {
        margin-bottom: 8px;

        font-size:
            clamp(23px, 3vw, 30px);
    }

    .welcome-box p {
        color: #ccfbf1;

        font-size: 14px;
    }


    /* ============================= */
    /* STATISTICS */
    /* ============================= */

    .stats-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 18px;

        margin-bottom: 25px;
    }


    .stat-card {
        display: flex;

        align-items: center;

        gap: 16px;

        min-width: 0;

        padding: 20px;

        background: white;

        border:
            1px solid #e2e8f0;

        border-radius: 18px;

        box-shadow:
            0 6px 22px
            rgba(15,23,42,.04);

        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .stat-card:hover {
        transform:
            translateY(-4px);

        border-color:
            rgba(13,148,136,.25);

        box-shadow:
            0 14px 32px
            rgba(15,23,42,.08);
    }

    .stat-info {
        min-width: 0;
    }


    .stat-icon {
        width: 55px;
        height: 55px;

        display: flex;

        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        background: #f0fdfa;

        border-radius: 13px;

        font-size: 25px;
    }


    .stat-info span {
        color: #64748b;

        font-size: 13px;
    }


    .stat-info h3 {
        margin: 5px 0;

        color: #111827;

        font-size: 25px;
    }


    .stat-info p {
        color: #94a3b8;

        font-size: 11px;
    }


    /* ============================= */
    /* SECTION */
    /* ============================= */

    .dashboard-section {
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


    .section-header {
        margin-bottom: 20px;
    }


    .section-header h3 {
        margin-bottom: 5px;

        color: #111827;

        font-size: 18px;
    }


    .section-header p {
        color: #64748b;

        font-size: 13px;
    }



    .search-section {
        margin-bottom: 25px;
    }

    .top-search-list {
        display: flex;
        flex-direction: column;

        gap: 10px;
    }

    .top-search-item {
        display: flex;
        align-items: center;

        gap: 12px;

        padding: 13px 15px;

        background: #f8fafc;

        border: 1px solid #f1f5f9;
        border-radius: 10px;
    }

    .search-rank {
        width: 32px;
        height: 32px;

        display: flex;

        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        background: #ccfbf1;

        color: #0f766e;

        border-radius: 50%;

        font-size: 13px;
        font-weight: 700;
    }

    .search-keyword {
        flex: 1;

        color: #111827;

        font-size: 14px;
        font-weight: 600;
    }

    .search-total {
        color: #64748b;

        font-size: 13px;
    }

    .search-empty {
        padding: 20px;

        background: #f8fafc;

        border-radius: 10px;

        color: #64748b;

        text-align: center;
    }


    /* ============================= */
    /* CHARTS */
    /* ============================= */

    .charts-section {
        margin-top: 25px;
    }

    .charts-header {
        margin-bottom: 18px;
    }

    .charts-header h3 {
        margin-bottom: 5px;

        color: #111827;

        font-size: 20px;
    }

    .charts-header p {
        color: #64748b;

        font-size: 13px;
    }


    .chart-card {
        padding:
            clamp(18px, 3vw, 24px);

        min-width: 0;

        background: white;

        border:
            1px solid #e2e8f0;

        border-radius: 20px;

        box-shadow:
            0 7px 24px
            rgba(15,23,42,.04);
    }

    .chart-large {
        margin-bottom: 20px;
    }

    .chart-title {
        margin-bottom: 20px;
    }

    .chart-title h4 {
        margin-bottom: 5px;

        color: #111827;

        font-size: 16px;
    }

    .chart-title p {
        color: #64748b;

        font-size: 12px;
    }


    .charts-grid {
        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 20px;
    }


    .chart-container {
        position: relative;

        width: 100%;

        height: 300px;
    }

    .small-chart {
        height: 320px;
    }



    /* ================= RESPONSIVE ================= */

    @media (max-width: 1200px) {

        .stats-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

    }


    @media (max-width: 992px) {

        .charts-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 650px) {

        .welcome-box {
            padding: 22px 18px;
            border-radius: 18px;
        }

        .welcome-box h2 {
            font-size: 22px;
        }

        .stats-grid {
            grid-template-columns: 1fr;

            gap: 12px;
        }

        .stat-card {
            padding: 17px;
        }

        .dashboard-section,
        .chart-card {
            padding: 17px;

            border-radius: 17px;
        }

        .top-search-item {
            padding: 12px;
        }

        .chart-container,
        .small-chart {
            height: 280px;
        }

    }

</style>

@endpush



@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // =====================================
    // DỮ LIỆU TỪ LARAVEL
    // =====================================

    const viewedLabels = @json(
        $topViewedProvinces->pluck('name')->values()
    );

    const viewedData = @json(
        $topViewedProvinces->pluck('total_views')->values()
    );


    const favoriteLabels = @json(
        $topFavoriteProvinces->pluck('name')->values()
    );

    const favoriteData = @json(
        $topFavoriteProvinces->pluck('total_favorites')->values()
    );


    const ratingLabels = @json(
        $topRatedProvinces->pluck('name')->values()
    );

    const ratingData = @json(
        $topRatedProvinces->pluck('total_ratings')->values()
    );


    // =====================================
    // 1. BAR NGANG - LƯỢT XEM
    // =====================================

    new Chart(
        document.getElementById('viewsChart'),
        {
            type: 'bar',

            data: {
                labels: viewedLabels,

                datasets: [{
                    label: 'Lượt xem',

                    data: viewedData,

                    backgroundColor: '#14b8a6',

                    borderRadius: 6,

                    barThickness: 25
                }]
            },

            options: {
                indexAxis: 'y',

                responsive: true,

                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    x: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        },

                        grid: {
                            color: '#f1f5f9'
                        }
                    },

                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        }
    );


    // =====================================
    // 2. DOUGHNUT - YÊU THÍCH
    // =====================================

    new Chart(
        document.getElementById('favoritesChart'),
        {
            type: 'doughnut',

            data: {
                labels: favoriteLabels,

                datasets: [{
                    label: 'Lượt yêu thích',

                    data: favoriteData,

                    backgroundColor: [
                        '#14b8a6',
                        '#0ea5e9',
                        '#8b5cf6',
                        '#f59e0b',
                        '#f43f5e'
                    ],

                    borderWidth: 2,

                    borderColor: '#ffffff'
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false,

                cutout: '65%',

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            padding: 18,

                            usePointStyle: true
                        }
                    }
                }
            }
        }
    );


    // =====================================
    // 3. BAR ĐỨNG - ĐÁNH GIÁ
    // =====================================

    new Chart(
        document.getElementById('ratingsChart'),
        {
            type: 'bar',

            data: {
                labels: ratingLabels,

                datasets: [{
                    label: 'Lượt đánh giá',

                    data: ratingData,

                    backgroundColor: '#f59e0b',

                    borderRadius: 6,

                    barThickness: 35
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            stepSize: 1
                        },

                        grid: {
                            color: '#f1f5f9'
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        }
    );

});

</script>

@endpush