<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Lịch sử hoạt động - TPDĐ Travel
    </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        body {
            background:
                linear-gradient(
                    180deg,
                    #f8fafc,
                    #f1f5f9
                );

            color: #1f2937;
        }


        .history-page {
            width:
                min(100% - 40px, 1100px);

            margin: 0 auto;

            padding:
                130px 0
                80px;
        }


        /* ================= HEADER ================= */

        .history-header {
            margin-bottom: 35px;

            text-align: center;
        }


        .history-header span {
            display: inline-block;

            margin-bottom: 8px;

            color: #0d9488;

            font-size: 13px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 2px;
        }


        .history-header h1 {
            margin-bottom: 10px;

            color: #0f172a;

            font-size:
                clamp(30px, 4vw, 42px);
        }


        .history-header p {
            color: #64748b;

            font-size: 15px;
        }


        /* ================= TABS ================= */

        .history-tabs {
            display: flex;

            justify-content: center;

            gap: 10px;

            margin-bottom: 28px;

            padding: 7px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 14px;

            box-shadow:
                0 6px 24px
                rgba(15,23,42,.05);
        }


        .history-tab {
            flex: 1;

            max-width: 230px;

            padding:
                12px 15px;

            border: none;
            border-radius: 10px;

            background: transparent;

            color: #475569;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }


        .history-tab:hover {
            background: #f0fdfa;

            color: #0f766e;
        }


        .history-tab.active {
            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;
        }


        /* ================= TAB CONTENT ================= */

        .tab-content {
            display: none;
        }


        .tab-content.active {
            display: block;
        }


        /* ================= CARD ================= */

        .history-list {
            display: grid;

            gap: 18px;
        }


        .history-card {
            display: grid;

            grid-template-columns:
                180px
                1fr;

            overflow: hidden;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 18px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }


        .history-card:hover {
            transform:
                translateY(-3px);

            box-shadow:
                0 14px 32px
                rgba(15,23,42,.09);
        }


        .history-image {
            min-height: 150px;

            background: #e2e8f0;
        }


        .history-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;
        }


        .history-no-image {
            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #0f766e;

            font-weight: 700;
        }


        .history-content {
            display: flex;

            flex-direction: column;

            padding: 20px;
        }


        .history-province {
            margin-bottom: 6px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;
        }


        .history-content h3 {
            margin-bottom: 8px;

            color: #0f172a;

            font-size: 20px;
        }


        .history-meta {
            margin-bottom: 12px;

            color: #64748b;

            font-size: 13px;
        }


        .history-text {
            margin-bottom: 15px;

            color: #475569;

            font-size: 14px;

            line-height: 1.65;
        }


        .history-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 42px;

            padding:
                0 16px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;
        }


        /* ================= RATING ================= */

        .rating-stars {
            margin-bottom: 10px;

            color: #f59e0b;

            font-size: 18px;
        }


        /* ================= EMPTY ================= */

        .history-empty {
            padding:
                50px 25px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 18px;

            text-align: center;

            box-shadow:
                0 6px 22px
                rgba(15,23,42,.05);
        }


        .history-empty-icon {
            margin-bottom: 12px;

            font-size: 42px;
        }


        .history-empty h3 {
            margin-bottom: 8px;

            color: #0f172a;

            font-size: 20px;
        }


        .history-empty p {
            color: #64748b;

            font-size: 14px;
        }


        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {

            .history-page {
                width:
                    calc(100% - 28px);

                padding:
                    150px 0
                    55px;
            }

            .history-tabs {
                flex-direction: column;
            }

            .history-tab {
                max-width: none;
            }

            .history-card {
                grid-template-columns: 1fr;
            }

            .history-image {
                min-height: 210px;
            }

        }


        .history-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 18px;

            color: #64748b;

            font-size: 14px;
        }


        .clear-history-btn {
            padding: 9px 14px;

            border: 1px solid #fecaca;
            border-radius: 9px;

            background: #fff1f2;
            color: #dc2626;

            font-weight: 700;

            cursor: pointer;
        }


        .history-actions {
            display: flex;
            align-items: center;

            gap: 10px;

            margin-top: auto;
        }


        .history-delete-btn {
            min-height: 42px;

            padding: 0 16px;

            border: 1px solid #fecaca;
            border-radius: 10px;

            background: #fff1f2;
            color: #dc2626;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }




        .success-message {
            margin-bottom: 20px;
            padding: 13px 16px;

            background: #ecfdf5;

            border: 1px solid #a7f3d0;
            border-radius: 10px;

            color: #047857;

            font-size: 14px;
            font-weight: 600;
        }



        #searches .history-card {
            grid-template-columns: 1fr;
        }

        #searches .history-content {
            min-height: 145px;
        }




        @media (max-width: 650px) {

            .history-toolbar {
                align-items: flex-start;
            }

            .history-actions {
                flex-wrap: wrap;
            }

        }
    </style>
</head>

<body>

    <x-navbar />


    <main class="history-page">

                
    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif            


        <div class="history-header">

            <span>
                Tài khoản
            </span>

            <h1>
                Lịch sử hoạt động
            </h1>

            <p>
                Xem lại các địa điểm bạn đã xem,
                đánh giá và bình luận.
            </p>

        </div>



        <div class="history-tabs">

            <button
                class="history-tab active"
                data-tab="views"
            >
                Lịch sử xem
            </button>

            <button
                class="history-tab"
                data-tab="searches"
            >
                Lịch sử tìm kiếm
            </button>

            <button
                class="history-tab"
                data-tab="ratings"
            >
                Đánh giá của tôi
            </button>

            <button
                class="history-tab"
                data-tab="comments"
            >
                Bình luận của tôi
            </button>

        </div>



        {{-- ================= LỊCH SỬ XEM ================= --}}

        <section
            class="tab-content active"
            id="views"
        >

            @if($histories->isNotEmpty())

            <div class="history-toolbar">

                <span>
                    {{ $histories->count() }} địa điểm đã xem
                </span>

                <form
                    action="{{ route('history.clear') }}"
                    method="POST"
                    onsubmit="return confirm('Bạn có chắc muốn xóa toàn bộ lịch sử xem?')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="clear-history-btn"
                    >
                        Xóa toàn bộ
                    </button>

                </form>

            </div>

                <div class="history-list">

                    @foreach($histories as $history)

                        @if($history->place)

                            <article class="history-card">

                                <div class="history-image">

                                    @if($history->place->cover_image)

                                        <img
                                            src="{{ asset($history->place->cover_image) }}"
                                            alt="{{ $history->place->name }}"
                                        >

                                    @else

                                        <div class="history-no-image">
                                            📍 {{ $history->place->name }}
                                        </div>

                                    @endif

                                </div>


                                <div class="history-content">

                                    @if($history->place->province)

                                        <div class="history-province">
                                            {{ $history->place->province->name }}
                                        </div>

                                    @endif


                                    <h3>
                                        {{ $history->place->name }}
                                    </h3>


                                    <div class="history-meta">

                                        Đã xem:

                                        {{ optional($history->viewed_at)->format('d/m/Y H:i') }}

                                    </div>


                                    <p class="history-text">

                                        {{
                                            $history->place->short_description
                                            ?: 'Khám phá địa điểm du lịch nổi bật tại Việt Nam.'
                                        }}

                                    </p>


                                    <div class="history-actions">

                                        <a
                                            href="{{ route(
                                                'places.show',
                                                $history->place->slug
                                            ) }}"
                                            class="history-btn"
                                        >
                                            Xem lại
                                        </a>


                                        <form
                                            action="{{ route(
                                                'history.destroy',
                                                $history->id
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Xóa địa điểm này khỏi lịch sử xem?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="history-delete-btn"
                                            >
                                                Xóa
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </article>

                        @endif

                    @endforeach

                </div>

            @else

                <div class="history-empty">

                    <div class="history-empty-icon">
                        👁️
                    </div>

                    <h3>
                        Chưa có lịch sử xem
                    </h3>

                    <p>
                        Những địa điểm bạn đã xem
                        sẽ xuất hiện tại đây.
                    </p>

                </div>

            @endif

        </section>



        {{-- ================= LỊCH SỬ TÌM KIẾM ================= --}}
        <section
            class="tab-content"
            id="searches"
        >

            @if($searchHistories->isNotEmpty())

                <div class="history-toolbar">

                    <span>
                        {{ $searchHistories->count() }}
                        lượt tìm kiếm
                    </span>

                    <form
                        action="{{ route('history.searches.clear') }}"
                        method="POST"
                        onsubmit="return confirm(
                            'Bạn có chắc muốn xóa toàn bộ lịch sử tìm kiếm?'
                        )"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="clear-history-btn"
                        >
                            Xóa toàn bộ
                        </button>

                    </form>

                </div>


                <div class="history-list">

                    @foreach($searchHistories as $search)

                        <article class="history-card">

                            <div class="history-content">

                                <div class="history-province">
                                    🔍 Từ khóa tìm kiếm
                                </div>

                                <h3>
                                    {{ $search->keyword }}
                                </h3>

                                <div class="history-meta">

                                    Đã tìm:

                                    {{
                                        $search->searched_at
                                            ->format('d/m/Y H:i')
                                    }}

                                </div>

                                <div class="history-actions">

                                    <a
                                        href="{{ route(
                                            'search.results',
                                            ['q' => $search->keyword]
                                        ) }}"
                                        class="history-btn"
                                    >
                                        Tìm lại
                                    </a>

                                    <form
                                        action="{{ route(
                                            'history.searches.destroy',
                                            $search->id
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Bạn có chắc muốn xóa từ khóa này?'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="history-delete-btn"
                                        >
                                            Xóa
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="history-empty">

                    <div class="history-empty-icon">
                        🔍
                    </div>

                    <h3>
                        Chưa có lịch sử tìm kiếm
                    </h3>

                    <p>
                        Những từ khóa bạn đã tìm kiếm
                        sẽ xuất hiện tại đây.
                    </p>

                </div>

            @endif

        </section>



        {{-- ================= ĐÁNH GIÁ ================= --}}

        <section
            class="tab-content"
            id="ratings"
        >

            @if($ratings->isNotEmpty())

                <div class="history-list">

                    @foreach($ratings as $rating)

                        @if($rating->place)

                            <article class="history-card">

                                <div class="history-image">

                                    @if($rating->place->cover_image)

                                        <img
                                            src="{{ asset($rating->place->cover_image) }}"
                                            alt="{{ $rating->place->name }}"
                                        >

                                    @else

                                        <div class="history-no-image">
                                            ⭐ {{ $rating->place->name }}
                                        </div>

                                    @endif

                                </div>


                                <div class="history-content">

                                    @if($rating->place->province)

                                        <div class="history-province">
                                            {{ $rating->place->province->name }}
                                        </div>

                                    @endif


                                    <h3>
                                        {{ $rating->place->name }}
                                    </h3>


                                    <div class="rating-stars">

                                        @for($i = 1; $i <= 5; $i++)

                                            @if($i <= $rating->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif

                                        @endfor

                                        <span
                                            style="
                                                color:#475569;
                                                font-size:13px;
                                            "
                                        >
                                            {{ $rating->rating }}/5
                                        </span>

                                    </div>


                                    <div class="history-meta">

                                        Đánh giá ngày:

                                        {{ $rating->created_at->format('d/m/Y H:i') }}

                                    </div>


                                    <div class="history-actions">

                                        <a
                                            href="{{ route(
                                                'places.show',
                                                $rating->place->slug
                                            ) }}"
                                            class="history-btn"
                                        >
                                            Xem địa điểm
                                        </a>


                                        <form
                                            action="{{ route(
                                                'ratings.destroy',
                                                $rating->id
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="history-delete-btn"
                                            >
                                                Xóa đánh giá
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </article>

                        @endif

                    @endforeach

                </div>

            @else

                <div class="history-empty">

                    <div class="history-empty-icon">
                        ⭐
                    </div>

                    <h3>
                        Chưa có đánh giá
                    </h3>

                    <p>
                        Những địa điểm bạn đánh giá
                        sẽ xuất hiện tại đây.
                    </p>

                </div>

            @endif

        </section>



        {{-- ================= BÌNH LUẬN ================= --}}

        <section
            class="tab-content"
            id="comments"
        >

            @if($comments->isNotEmpty())

                <div class="history-list">

                    @foreach($comments as $comment)

                        @if($comment->place)

                            <article class="history-card">

                                <div class="history-image">

                                    @if($comment->place->cover_image)

                                        <img
                                            src="{{ asset($comment->place->cover_image) }}"
                                            alt="{{ $comment->place->name }}"
                                        >

                                    @else

                                        <div class="history-no-image">
                                            💬 {{ $comment->place->name }}
                                        </div>

                                    @endif

                                </div>


                                <div class="history-content">

                                    @if($comment->place->province)

                                        <div class="history-province">
                                            {{ $comment->place->province->name }}
                                        </div>

                                    @endif


                                    <h3>
                                        {{ $comment->place->name }}
                                    </h3>


                                    <p class="history-text">
                                        “{{ $comment->content }}”
                                    </p>


                                    <div class="history-meta">

                                        Bình luận ngày:

                                        {{ $comment->created_at->format('d/m/Y H:i') }}

                                    </div>


                                    <div class="history-actions">

                                        <a
                                            href="{{ route(
                                                'places.show',
                                                $comment->place->slug
                                            ) }}"
                                            class="history-btn"
                                        >
                                            Xem địa điểm
                                        </a>


                                        <form
                                            action="{{ route(
                                                'comments.destroy',
                                                $comment->id
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="history-delete-btn"
                                            >
                                                Xóa bình luận
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </article>

                        @endif

                    @endforeach

                </div>

            @else

                <div class="history-empty">

                    <div class="history-empty-icon">
                        💬
                    </div>

                    <h3>
                        Chưa có bình luận
                    </h3>

                    <p>
                        Những bình luận của bạn
                        sẽ xuất hiện tại đây.
                    </p>

                </div>

            @endif

        </section>


    </main>


    <x-footer />


    <script>

        const historyTabs =
            document.querySelectorAll('.history-tab');

        const historyContents =
            document.querySelectorAll('.tab-content');


        function openHistoryTab(tabName) {

            historyTabs.forEach(function(tab) {

                tab.classList.remove('active');

                if (tab.dataset.tab === tabName) {
                    tab.classList.add('active');
                }

            });


            historyContents.forEach(function(content) {

                content.classList.remove('active');

                if (content.id === tabName) {
                    content.classList.add('active');
                }

            });

        }


        historyTabs.forEach(function(tab) {

            tab.addEventListener('click', function() {

                const target = this.dataset.tab;

                openHistoryTab(target);


                const url =
                    new URL(window.location.href);

                url.searchParams.set(
                    'tab',
                    target
                );

                window.history.replaceState(
                    {},
                    '',
                    url
                );

            });

        });


        const params =
            new URLSearchParams(
                window.location.search
            );

        const currentTab =
            params.get('tab') || 'views';


        if (
            ['views', 'searches', 'ratings', 'comments']
                .includes(currentTab)
        ) {

            openHistoryTab(currentTab);

        } else {

            openHistoryTab('views');

        }

    </script>

</body>

</html>