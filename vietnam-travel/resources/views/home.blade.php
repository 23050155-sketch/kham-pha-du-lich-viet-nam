<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Khám phá du lịch Việt Nam</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #f8fafc;
            color: #0f172a;

            font-family:
                Inter,
                Arial,
                Helvetica,
                sans-serif;

            line-height: 1.5;
        }

        img {
            max-width: 100%;
            display: block;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }
        

        /* ============================= */
        /* HERO */
        /* ============================= */

        .hero {
            position: relative;

            min-height: clamp(620px, 88vh, 820px);

            display: flex;
            align-items: center;
            justify-content: center;

            padding:
                clamp(120px, 14vw, 160px)
                24px
                80px;

            background:
                linear-gradient(
                    115deg,
                    rgba(2, 44, 43, 0.82),
                    rgba(15, 118, 110, 0.50),
                    rgba(15, 23, 42, 0.35)
                ),
                url('../images/home-banner.jpg');

            background-size: cover;
            background-position: center;

            overflow: hidden;
        }


        /* Hiệu ứng sáng nhẹ */

        .hero::before {
            content: "";

            position: absolute;

            width: 480px;
            height: 480px;

            top: -180px;
            right: -140px;

            border-radius: 50%;

            background:
                rgba(45, 212, 191, 0.16);

            filter: blur(10px);

            pointer-events: none;
        }


        .hero-content {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 900px;

            margin: 0 auto;

            text-align: center;
            color: white;
        }


        .hero-content h1 {
            margin-bottom: 18px;

            font-size: clamp(42px, 6vw, 72px);
            font-weight: 800;

            line-height: 1.08;
            letter-spacing: -1.5px;

            text-shadow:
                0 6px 25px
                rgba(0, 0, 0, 0.25);
        }


        .hero-content p {
            max-width: 720px;

            margin:
                0 auto
                clamp(28px, 4vw, 40px);

            color: rgba(255, 255, 255, 0.90);

            font-size: clamp(16px, 2vw, 20px);
            line-height: 1.75;
        }


        /* ============================= */
        /* HERO SEARCH */
        /* ============================= */

        .search-box {
            position: relative;

            width: 100%;
            max-width: 760px;

            margin: 0 auto;

            display: flex;
            align-items: center;

            gap: 8px;

            padding: 8px;

            background:
                rgba(255, 255, 255, 0.94);

            border:
                1px solid
                rgba(255, 255, 255, 0.55);

            border-radius: 18px;

            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            box-shadow:
                0 20px 55px
                rgba(0, 0, 0, 0.22);
        }


        .search-box input {
            flex: 1;

            min-width: 0;

            height: 54px;

            padding: 0 18px;

            border: none;
            outline: none;

            background: transparent;

            color: #0f172a;

            font-size: 16px;
        }


        .search-box input::placeholder {
            color: #94a3b8;
        }


        .search-box button {
            flex-shrink: 0;

            height: 54px;

            padding: 0 24px;

            border: none;
            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .search-box button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 18px
                rgba(13, 148, 136, 0.30);
        }


        .search-box button:active {
            transform: translateY(0);
        }

        .error-message {
            max-width: 720px;
            margin: 15px auto 0;

            background: rgba(255, 255, 255, 0.95);
            color: #dc2626;

            padding: 12px 18px;

            border-radius: 10px;
        }


        /* ====================================== */
        /* KHÁM PHÁ THEO SỞ THÍCH */
        /* ====================================== */

        .category-section {
            position: relative;

            padding:
                clamp(35px, 4vw, 55px)
                24px 65px;

            background: #ffffff;
        }


        .category-container {
            width: 100%;
            max-width: 1200px;

            margin: 0 auto;
        }


        /* ===== HEADING ===== */

        .category-heading {
            max-width: 700px;

            margin:
                0 auto
                clamp(32px, 5vw, 48px);

            text-align: center;
        }


        .category-heading > span {
            display: inline-flex;

            align-items: center;

            padding: 7px 13px;

            margin-bottom: 14px;

            border-radius: 999px;

            background: #f0fdfa;

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1.4px;
            text-transform: uppercase;
        }


        .category-heading h2 {
            margin-bottom: 14px;

            color: #0f172a;

            font-size:
                clamp(28px, 4vw, 40px);

            line-height: 1.2;

            letter-spacing: -0.7px;
        }


        .category-heading p {
            max-width: 620px;

            margin: 0 auto;

            color: #64748b;

            font-size:
                clamp(14px, 1.6vw, 16px);

            line-height: 1.75;
        }


        /* ===== GRID ===== */

        .category-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 18px;
        }


        /* ===== CARD ===== */

        .category-card {
            position: relative;

            min-height: 190px;

            padding: 26px 20px;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            text-align: center;

            text-decoration: none;

            background:
                linear-gradient(
                    145deg,
                    #ffffff,
                    #f8fafc
                );

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 6px 24px
                rgba(15, 23, 42, 0.05);

            transition:
                transform 0.25s ease,
                border-color 0.25s ease,
                box-shadow 0.25s ease;
        }


        .category-card::before {
            content: "";

            position: absolute;

            width: 120px;
            height: 120px;

            top: -60px;
            right: -60px;

            border-radius: 50%;

            background:
                rgba(20, 184, 166, 0.08);

            transition:
                transform 0.3s ease;
        }


        .category-card:hover {
            transform:
                translateY(-6px);

            border-color:
                rgba(13, 148, 136, 0.45);

            box-shadow:
                0 16px 38px
                rgba(15, 23, 42, 0.10);
        }


        .category-card:hover::before {
            transform:
                scale(1.4);
        }


        /* ===== ICON ===== */

        .category-icon {
            position: relative;

            width: 68px;
            height: 68px;

            margin-bottom: 18px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 18px;

            background:
                linear-gradient(
                    135deg,
                    #ccfbf1,
                    #f0fdfa
                );

            font-size: 32px;

            transition:
                transform 0.25s ease;
        }


        .category-card:hover
        .category-icon {
            transform:
                scale(1.08)
                rotate(-3deg);
        }


        /* ===== TEXT ===== */

        .category-card h3 {
            position: relative;

            margin-bottom: 7px;

            color: #0f172a;

            font-size: 18px;
            font-weight: 700;

            transition:
                color 0.2s ease;
        }


        .category-card:hover h3 {
            color: #0f766e;
        }


        .category-card p {
            position: relative;

            margin: 0;

            color: #64748b;

            font-size: 13px;
            line-height: 1.5;
        }


        /* ====================================== */
        /* CATEGORY RESPONSIVE */
        /* ====================================== */

        @media (max-width: 992px) {

            .category-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 576px) {

            .category-section {
            padding: 30px 14px 50px;
        }


            .category-heading {
                margin-bottom: 30px;
            }


            .category-grid {
                gap: 10px;
            }


            .category-card {
                min-height: 155px;

                padding:
                    20px 10px;

                border-radius: 16px;
            }


            .category-icon {
                width: 52px;
                height: 52px;

                margin-bottom: 12px;

                border-radius: 14px;

                font-size: 25px;
            }


            .category-card h3 {
                font-size: 15px;
            }


            .category-card p {
                font-size: 11px;
            }

        }



        /* ====================================== */
        /* TRIP PLAN */
        /* ====================================== */

        .trip-plan-section {
            position: relative;

            padding:
                clamp(65px, 8vw, 100px)
                24px;

            overflow: hidden;

            background: #ffffff;

            color: #0f172a;
        }


        /* ánh sáng trang trí */

        .trip-plan-section::before {
            content: "";

            position: absolute;

            width: 420px;
            height: 420px;

            top: -200px;
            left: -150px;

            border-radius: 50%;

            background:
                rgba(45, 212, 191, 0.15);

            filter: blur(5px);
        }


        .trip-plan-section::after {
            content: "";

            position: absolute;

            width: 360px;
            height: 360px;

            right: -130px;
            bottom: -190px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.08);
        }


        .trip-plan-container {
            position: relative;

            z-index: 2;

            width: 100%;
            max-width: 1150px;

            margin: 0 auto;

            text-align: center;
        }


        /* ===== LABEL ===== */

        .trip-plan-label {
            display: inline-flex;

            align-items: center;

            padding: 7px 14px;

            margin-bottom: 16px;

            border:1px solid #ccfbf1;

            border-radius: 999px;

            background:#f0fdfa;
                
            backdrop-filter: blur(8px);

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1.5px;
        }


        /* ===== TITLE ===== */

        .trip-plan-container h2 {
            max-width: 720px;

            margin:
                0 auto
                16px;

            font-size:
                clamp(30px, 5vw, 46px);

            line-height: 1.15;

            letter-spacing: -0.8px;
        }


        .trip-plan-description {
            max-width: 680px;

            margin:
                0 auto
                46px;

            color: #64748b;

            font-size:
                clamp(14px, 1.6vw, 16px);

            line-height: 1.75;
        }


        /* ===== FEATURES ===== */

        .trip-plan-features {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;

            margin-bottom: 40px;
        }


        .trip-feature {
            position: relative;

            min-height: 180px;

            padding: 24px 18px;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            border: 1px solid #e2e8f0;

            border-radius: 20px;

            background: #f8fafc;

            box-shadow:
                0 8px 25px
                rgba(15, 23, 42, 0.06);

            transition:
                transform 0.25s ease,
                background 0.25s ease,
                border-color 0.25s ease,
                box-shadow 0.25s ease;
        }


        .trip-feature:hover {
            transform: translateY(-6px);

            background: #ffffff;

            border-color: #99f6e4;

            box-shadow:
                0 16px 35px
                rgba(15, 118, 110, 0.10);
        }


        /* ===== ICON ===== */

        .trip-feature > span {
            width: 58px;
            height: 58px;

            margin-bottom: 15px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 17px;

            background: #ccfbf1;

            font-size: 28px;
        }


        /* ===== TEXT ===== */
        .trip-feature strong {
            display: block;

            margin-bottom: 7px;

            color: #0f172a;

            font-size: 15px;
            font-weight: 700;
        }

        .trip-feature p {
            margin: 0;

            color: #64748b;

            font-size: 12px;
            line-height: 1.55;
        }


        /* ===== BUTTON ===== */

        .trip-plan-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 52px;

            padding: 0 24px;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            font-size: 14px;
            font-weight: 700;

            text-decoration: none;

            box-shadow:
                0 10px 25px
                rgba(13, 148, 136, 0.22);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .trip-plan-button:hover {
            transform: translateY(-3px);

            box-shadow:
                0 15px 32px
                rgba(13, 148, 136, 0.30);
        }


        /* ====================================== */
        /* TRIP PLAN RESPONSIVE */
        /* ====================================== */

        @media (max-width: 992px) {

            .trip-plan-features {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 576px) {

            .trip-plan-section {
                padding:
                    60px 14px;
            }


            .trip-plan-description {
                margin-bottom: 32px;
            }


            .trip-plan-features {
                grid-template-columns: 1fr;

                gap: 12px;
            }


            .trip-feature {
                min-height: 0;

                flex-direction: row;

                justify-content: flex-start;

                gap: 14px;

                padding: 18px;

                text-align: left;
            }


            .trip-feature > span {
                width: 50px;
                height: 50px;

                flex-shrink: 0;

                margin: 0;

                font-size: 24px;
            }


            .trip-feature strong {
                font-size: 14px;
            }


            .trip-feature p {
                font-size: 12px;
            }


            .trip-plan-button {
                width: 100%;

                max-width: 360px;
            }

        }



        /* ====================================== */
        /* AUTOCOMPLETE SEARCH */
        /* ====================================== */

        .search-suggestions {
            position: absolute;

            top: calc(100% + 8px);
            left: 0;

            width: 100%;

            max-height: 380px;

            overflow-y: auto;

            background: white;

            border-radius: 12px;

            box-shadow:
                0 10px 30px
                rgba(0, 0, 0, 0.15);

            display: none;

            z-index: 100;
        }

        .search-suggestions.show {
            display: block;
        }


        .search-suggestion-item {
            display: flex;

            align-items: center;

            gap: 13px;

            padding: 13px 16px;

            border-bottom: 1px solid #f1f5f9;

            cursor: pointer;

            text-align: left;

            transition: 0.2s;
        }

        .search-suggestion-item:last-child {
            border-bottom: none;
        }

        .search-suggestion-item:hover {
            background: #f0fdfa;
        }


        .suggestion-icon {
            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: #ccfbf1;

            border-radius: 50%;

            font-size: 18px;
        }


        .suggestion-info {
            display: flex;

            flex-direction: column;

            gap: 3px;
        }

        .suggestion-info strong {
            color: #1f2937;

            font-size: 14px;
        }

        .suggestion-info span {
            color: #64748b;

            font-size: 12px;
        }


        .search-empty {
            padding: 18px;

            color: #64748b;

            font-size: 14px;

            text-align: center;
        }


        /* ===================================== */
        /* FEATURED PLACES */
        /* ===================================== */

        .featured-section {
            padding:
                clamp(60px, 7vw, 90px)
                24px;

            background: #f8fafc;
        }


        .section-container {
            width: 100%;
            max-width: 1200px;

            margin: 0 auto;
        }


        /* ===== HEADING ===== */

        .section-heading {
            max-width: 700px;

            margin:
                0 auto
                clamp(32px, 5vw, 48px);

            text-align: center;
        }


        .section-heading span {
            display: inline-flex;

            align-items: center;

            padding: 7px 13px;

            margin-bottom: 14px;

            border-radius: 999px;

            background: #ecfdf5;

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1.4px;
            text-transform: uppercase;
        }


        .section-heading h2 {
            margin-bottom: 14px;

            color: #0f172a;

            font-size:
                clamp(28px, 4vw, 40px);

            line-height: 1.2;

            letter-spacing: -0.7px;
        }


        .section-heading p {
            max-width: 620px;

            margin: 0 auto;

            color: #64748b;

            font-size:
                clamp(14px, 1.6vw, 16px);

            line-height: 1.75;
        }


        /* ===== GRID ===== */

        .featured-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 24px;
        }


        /* ===== CARD ===== */

        .featured-card {
            display: flex;

            flex-direction: column;

            overflow: hidden;

            background: #ffffff;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            text-decoration: none;

            box-shadow:
                0 8px 28px
                rgba(15, 23, 42, 0.06);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;
        }


        .featured-card:hover {
            transform:
                translateY(-7px);

            border-color:
                rgba(13, 148, 136, 0.32);

            box-shadow:
                0 20px 45px
                rgba(15, 23, 42, 0.13);
        }


        /* ===== IMAGE ===== */

        .featured-image {
            position: relative;

            width: 100%;

            aspect-ratio: 16 / 10;

            overflow: hidden;

            background: #ccfbf1;
        }


        .featured-image::after {
            content: "";

            position: absolute;

            left: 0;
            right: 0;
            bottom: 0;

            height: 45%;

            background:
                linear-gradient(
                    to top,
                    rgba(15, 23, 42, 0.25),
                    transparent
                );

            pointer-events: none;
        }


        .featured-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform 0.45s ease;
        }


        .featured-card:hover
        .featured-image img {
            transform:
                scale(1.06);
        }


        .featured-no-image {
            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #ccfbf1,
                    #f0fdfa
                );

            font-size: 46px;
        }


        /* ===== BADGE ===== */

        .featured-badge {
            position: absolute;

            top: 14px;
            left: 14px;

            z-index: 2;

            padding: 7px 11px;

            border:
                1px solid
                rgba(255, 255, 255, 0.55);

            border-radius: 999px;

            background:
                rgba(255, 255, 255, 0.90);

            backdrop-filter: blur(8px);

            color: #0f766e;

            font-size: 11px;
            font-weight: 700;

            box-shadow:
                0 5px 15px
                rgba(0, 0, 0, 0.08);
        }


        /* ===== CONTENT ===== */

        .featured-content {
            flex: 1;

            display: flex;

            flex-direction: column;

            padding: 20px;
        }


        .featured-province {
            display: flex;

            align-items: center;

            gap: 5px;

            margin-bottom: 8px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;
        }


        .featured-province::before {
            content: "📍";

            font-size: 12px;
        }


        .featured-content h3 {
            margin-bottom: 10px;

            color: #0f172a;

            font-size: 20px;
            font-weight: 750;

            line-height: 1.35;
        }


        .featured-content p {
            min-height: 66px;

            margin-bottom: 16px;

            color: #64748b;

            font-size: 14px;
            line-height: 1.6;

            display: -webkit-box;

            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* ===== CATEGORY TAG ===== */

        .featured-categories {
            display: flex;

            flex-wrap: wrap;

            gap: 7px;

            margin-bottom: 18px;
        }


        .featured-categories span {
            padding: 5px 9px;

            background: #f0fdfa;

            border:
                1px solid
                #ccfbf1;

            border-radius: 999px;

            color: #0f766e;

            font-size: 11px;
            font-weight: 600;
        }


        /* ===== BOTTOM ===== */

        .featured-bottom {
            margin-top: auto;

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 12px;

            padding-top: 15px;

            border-top:
                1px solid
                #e2e8f0;
        }


        .featured-price {
            color: #334155;

            font-size: 12px;
            font-weight: 700;
        }


        .featured-detail {
            display: inline-flex;

            align-items: center;

            gap: 4px;

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;

            transition:
                transform 0.2s ease;
        }


        .featured-card:hover
        .featured-detail {
            transform:
                translateX(3px);
        }


        /* ===== EMPTY ===== */

        .featured-empty {
            grid-column: 1 / -1;

            padding: 50px 20px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            text-align: center;

            color: #64748b;
        }


        .featured-empty span {
            display: block;

            margin-bottom: 10px;

            font-size: 38px;
        }


        /* ===================================== */
        /* FEATURED RESPONSIVE */
        /* ===================================== */

        @media (max-width: 992px) {

            .featured-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 640px) {

            .featured-section {
                padding:
                    55px 14px;
            }


            .featured-grid {
                grid-template-columns:
                    1fr;

                gap: 18px;
            }


            .featured-card {
                border-radius: 17px;
            }


            .featured-content {
                padding: 17px;
            }


            .featured-content h3 {
                font-size: 18px;
            }


            .featured-content p {
                min-height: auto;

                -webkit-line-clamp: 2;
            }


            .featured-bottom {
                align-items: flex-start;
            }

        }



        /* ========================================= */
        /* HERO RESPONSIVE + MOBILE SEARCH */
        /* ========================================= */

        /* Desktop */
        .home-search-icon {
            display: none;
        }

        .home-search-text {
            display: inline;
        }

        /* Tablet và điện thoại */
        @media (max-width: 768px) {

            .hero {
                min-height: 720px;
                padding: 120px 18px 65px;
                background-position: center;
            }

            .hero-content {
                max-width: 650px;
            }

            .hero-content h1 {
                letter-spacing: -0.8px;
            }

            .hero-content p {
                max-width: 560px;
                line-height: 1.65;
            }

            .hero .search-box {
                flex-direction: row;
                width: 100%;
                max-width: 560px;
                gap: 4px;
                padding: 5px;
                border-radius: 999px;
                background: #ffffff;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
            }

            .hero .search-box input {
                width: auto;
                height: 46px;
                padding: 0 12px;
                font-size: 14px;
                text-align: left;
            }

            .hero .search-box .home-search-submit {
                display: flex;
                align-items: center;
                justify-content: center;

                flex: 0 0 46px;
                width: 46px;
                height: 46px;
                padding: 0;

                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(13, 148, 136, 0.25);
            }

            .hero .search-box .home-search-submit:hover {
                transform: none;
                box-shadow: 0 4px 12px rgba(13, 148, 136, 0.25);
            }

            .home-search-text {
                display: none;
            }

            .home-search-icon {
                display: block;
                width: 21px;
                height: 21px;
            }
        }

        /* Điện thoại nhỏ */
        @media (max-width: 480px) {

            .hero {
                min-height: 680px;
                padding: 105px 14px 50px;
            }

            .hero-content h1 {
                font-size: 38px;
            }

            .hero-content p {
                font-size: 15px;
                margin-bottom: 26px;
            }

            .hero .search-box input {
                height: 44px;
                font-size: 13px;
            }

            .hero .search-box .home-search-submit {
                flex-basis: 44px;
                width: 44px;
                height: 44px;
            }
        }




        .home-popular-searches {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;

            gap: 8px;

            margin-top: 14px;
        }

        .home-popular-label {
            color: white;

            font-size: 13px;
            font-weight: 700;
        }

        .home-popular-keyword {
            padding: 6px 11px;

            background: rgba(255, 255, 255, 0.16);

            border: 1px solid
                rgba(255, 255, 255, 0.28);

            border-radius: 20px;

            color: white;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            transition: 0.2s;
        }

        .home-popular-keyword:hover {
            background: white;

            color: #0f766e;
        }



        .recommend-section {
            padding: 75px 24px;

            background: #f0fdfa;
        }

        .recommend-container {
            width: 100%;
            max-width: 1200px;

            margin: 0 auto;
        }

        .recommend-heading {
            max-width: 700px;

            margin: 0 auto 40px;

            text-align: center;
        }

        .recommend-heading > span {
            display: inline-block;

            margin-bottom: 12px;

            color: #0f766e;

            font-size: 13px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1.3px;
        }

        .recommend-heading h2 {
            margin-bottom: 12px;

            color: #0f172a;

            font-size: 36px;
        }

        .recommend-heading p {
            color: #64748b;

            font-size: 15px;
            line-height: 1.7;
        }

        .recommend-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 20px;
        }

        .recommend-card {
            overflow: hidden;

            background: white;

            border: 1px solid #ccfbf1;
            border-radius: 18px;

            text-decoration: none;

            box-shadow:
                0 7px 25px
                rgba(15, 23, 42, .06);

            transition: .25s;
        }

        .recommend-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 15px 35px
                rgba(15, 23, 42, .10);
        }

        .recommend-image {
            aspect-ratio: 16 / 10;

            overflow: hidden;

            background: #ccfbf1;
        }

        .recommend-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition: .3s;
        }

        .recommend-card:hover
        .recommend-image img {
            transform: scale(1.05);
        }

        .recommend-no-image {
            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 40px;
        }

        .recommend-content {
            padding: 18px;
        }

        .recommend-province {
            display: block;

            margin-bottom: 7px;

            color: #0d9488;

            font-size: 12px;
            font-weight: 700;
        }

        .recommend-content h3 {
            margin-bottom: 9px;

            color: #0f172a;

            font-size: 18px;
        }

        .recommend-content p {
            margin-bottom: 15px;

            color: #64748b;

            font-size: 13px;
            line-height: 1.6;

            display: -webkit-box;

            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        .recommend-bottom {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 10px;

            padding-top: 13px;

            border-top: 1px solid #e2e8f0;

            font-size: 12px;
        }

        .recommend-bottom span {
            color: #64748b;
        }

        .recommend-bottom strong {
            color: #0f766e;
        }


        @media (max-width: 992px) {

            .recommend-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 650px) {

            .recommend-section {
                padding: 55px 14px;
            }

            .recommend-grid {
                grid-template-columns: 1fr;
            }

            .recommend-heading h2 {
                font-size: 28px;
            }

        }




        /* ============================= */
        /* POPULAR PLACES */
        /* ============================= */

        .popular-section {
            padding: clamp(60px, 7vw, 90px) 24px;
            background: #ffffff;
        }

        .popular-section .featured-badge {
            color: #c2410c;
            background: #fff7ed;
        }

        /* RESPONSIVE */

        @media (max-width: 640px) {
            .popular-section {
                padding: 55px 14px;
            }
        }



        
        /* ===== SO SÁNH ĐỊA ĐIỂM TRANG CHỦ ===== */

        .home-compare-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .home-compare-card > .featured-card,
        .home-compare-card > .recommend-card {
            flex: 1;
            width: 100%;
        }

        .home-compare-action {
            position: relative;
            z-index: 2;
            margin-top: 10px;
        }

        .home-compare-action .compare-add-btn {
            width: 100%;
        }

        .home-compare-card > .featured-card:hover,
        .home-compare-card > .recommend-card:hover {
            text-decoration: none;
        }

    </style>
</head>

<body>


<x-navbar />



<section class="hero">

    <div class="hero-content">

        <h1>Khám phá Việt Nam</h1>

        <p>
            Tìm kiếm tỉnh thành hoặc địa điểm du lịch nổi tiếng
            trên khắp Việt Nam và bắt đầu hành trình khám phá của bạn.
        </p>


        <form
            action="{{ route('search.results') }}"
            method="GET"
            class="search-box"
            id="homeSearchForm" 
        >

            <input
                type="text"
                name="q"
                id="home-search-input"
                placeholder="Nhập tỉnh, thành phố hoặc địa điểm..."
                autocomplete="off"
                required
            >


            <div
                id="search-suggestions"
                class="search-suggestions"
            ></div>


            <button
                type="submit"
                class="home-search-submit"
                aria-label="Tìm kiếm"
                title="Tìm kiếm"
            >
                <span class="home-search-text">Tìm kiếm</span>

                <svg
                    class="home-search-icon"
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="M20 20l-4-4"></path>
                </svg>
            </button>

        </form>


        @php
            $homePopularSearches = \App\Models\SearchHistory::query()
                ->selectRaw('keyword, COUNT(*) as total')
                ->groupBy('keyword')
                ->orderByDesc('total')
                ->limit(5)
                ->get();
        @endphp


        @if($homePopularSearches->isNotEmpty())

            <div class="home-popular-searches">

                <span class="home-popular-label">
                    🔥 Tìm kiếm phổ biến:
                </span>

                @foreach($homePopularSearches as $search)

                    <a
                        href="{{ route(
                            'search.results',
                            ['q' => $search->keyword]
                        ) }}"
                        class="home-popular-keyword"
                    >
                        {{ $search->keyword }}
                    </a>

                @endforeach

            </div>

        @endif


        @if(session('error'))

            <div class="error-message">
                {{ session('error') }}
            </div>

        @endif

    </div>

</section>



{{-- KHÁM PHÁ THEO SỞ THÍCH --}}

<section class="category-section">

    <div class="category-container">

        <div class="category-heading">

            <span>
                Khám phá theo sở thích
            </span>

            <h2>
                Bạn thích chuyến đi như thế nào?
            </h2>

            <p>
                Lựa chọn loại hình du lịch yêu thích
                và khám phá những địa điểm phù hợp với bạn.
            </p>

        </div>


        <div class="category-grid">

            @foreach($categories as $category)

                <a
                    href="{{ route('explore.index', [
                        'category' => $category->id
                    ]) }}"
                    class="category-card"
                >

                    <div class="category-icon">

                        @switch($category->name)

                            @case('Biển')
                                🏖️
                                @break

                            @case('Núi')
                                ⛰️
                                @break

                            @case('Văn hóa')
                                🏛️
                                @break

                            @case('Tâm linh')
                                🛕
                                @break

                            @case('Vui chơi')
                                🎡
                                @break

                            @case('Thiên nhiên')
                                🌿
                                @break

                            @case('Lịch sử')
                                📜
                                @break

                            @case('Ẩm thực')
                                🍜
                                @break

                            @default
                                📍

                        @endswitch

                    </div>


                    <h3>
                        {{ $category->name }}
                    </h3>


                    <p>
                        Khám phá địa điểm
                    </p>

                </a>

            @endforeach

        </div>

    </div>

</section>



@auth

    @if($recommendedPlaces->isNotEmpty())

        <section class="recommend-section">

            <div class="recommend-container">

                <div class="recommend-heading">

                    @if($recommendationMode === 'popular')

                        <span>
                            🔥 Đang được quan tâm
                        </span>

                        <h2>
                            Gợi ý địa điểm dành cho bạn
                        </h2>

                        <p>
                            Những địa điểm được gợi ý dựa trên
                            xu hướng tìm kiếm phổ biến của người dùng.
                        </p>

                    @else

                        <span>
                            ✨ Dành cho bạn
                        </span>

                        <h2>
                            Gợi ý địa điểm dành cho bạn
                        </h2>

                        <p>
                            Những địa điểm được đề xuất dựa trên
                            hoạt động và sở thích của bạn.
                        </p>

                    @endif

                </div>


                <div class="recommend-grid">

                    @foreach($recommendedPlaces as $place)
                    <div class="home-compare-card"> 
                        <a
                            href="{{ route(
                                'places.show',
                                $place->slug
                            ) }}"
                            class="recommend-card"
                        >

                            <div class="recommend-image">

                                @if($place->cover_image)

                                    <img
                                        src="{{ asset(
                                            $place->cover_image
                                        ) }}"
                                        alt="{{ $place->name }}"
                                    >

                                @else

                                    <div class="recommend-no-image">
                                        📍
                                    </div>

                                @endif

                            </div>


                            <div class="recommend-content">

                                @if($place->province)

                                    <span class="recommend-province">
                                        📍 {{ $place->province->name }}
                                    </span>

                                @endif


                                <h3>
                                    {{ $place->name }}
                                </h3>


                                <p>
                                    {{
                                        $place->short_description
                                        ?: 'Khám phá địa điểm du lịch nổi bật.'
                                    }}
                                </p>


                                <div class="recommend-bottom">

                                    <span>
                                        👁️ {{ number_format(
                                            $place->view_count ?? 0
                                        ) }}
                                    </span>

                                    <strong>
                                        Xem chi tiết →
                                    </strong>

                                </div>

                            </div>

                        </a>

                        
                        <div class="home-compare-action">
                            <x-compare-button :place="$place" />
                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

@endauth



<section class="featured-section">

    <div class="section-container">

        <div class="section-heading">
            <span>Gợi ý cho bạn</span>

            <h2>Điểm đến nổi bật</h2>

            <p>
                Khám phá những địa điểm du lịch nổi bật
                và đáng trải nghiệm trên khắp Việt Nam.
            </p>
        </div>


        <div class="featured-grid">

            @forelse($featuredPlaces as $place)

                <div class="home-compare-card">

                    <a
                        href="{{ route('places.show', $place->slug) }}"
                        class="featured-card"
                    >

                    {{-- ẢNH --}}
                    <div class="featured-image">

                        @if($place->cover_image)

                            <img
                                src="{{ asset($place->cover_image) }}"
                                alt="{{ $place->name }}"
                            >

                        @else

                            <div class="featured-no-image">
                                📍
                            </div>

                        @endif


                        {{-- BADGE --}}
                        <span class="featured-badge">
                            ⭐ Nổi bật
                        </span>

                    </div>


                    {{-- NỘI DUNG --}}
                    <div class="featured-content">

                        @if($place->province)

                            <span class="featured-province">
                                📍 {{ $place->province->name }}
                            </span>

                        @endif


                        <h3>
                            {{ $place->name }}
                        </h3>


                        <p>
                            {{
                                $place->short_description
                                ?: 'Khám phá địa điểm du lịch nổi bật tại '
                                . ($place->province?->name ?? 'Việt Nam')
                            }}
                        </p>


                        {{-- DANH MỤC --}}
                        @if($place->categories->isNotEmpty())

                            <div class="featured-categories">

                                @foreach(
                                    $place->categories->take(2)
                                    as $category
                                )

                                    <span>
                                        {{ $category->name }}
                                    </span>

                                @endforeach

                            </div>

                        @endif


                        <div class="featured-bottom">

                            @if($place->ticket_price > 0)

                                <span class="featured-price">
                                    🎫
                                    {{ number_format(
                                        $place->ticket_price
                                    ) }}đ
                                </span>

                            @else

                                <span class="featured-price">
                                    🎫 Miễn phí
                                </span>

                            @endif


                            <span class="featured-detail">
                                Xem chi tiết →
                            </span>

                        </div>

                    </div>

                
                </a>

                <div class="home-compare-action">
                    <x-compare-button :place="$place" />
                </div>

            </div>

            @empty


                <div class="featured-empty">

                    <span>⭐</span>

                    <p>
                        Hiện chưa có địa điểm nổi bật.
                    </p>

                </div>

            @endforelse

        </div>


    </div>

</section>



<section class="popular-section">

    <div class="section-container">

        <div class="section-heading">

            <span>🔥 Đang được quan tâm</span>

            <h2>Địa điểm được quan tâm nhiều</h2>

            <p>
                Khám phá những địa điểm đang nhận được
                nhiều sự quan tâm từ người dùng.
            </p>

        </div>

        <div class="featured-grid">

            @forelse($popularPlaces as $place)

                <div class="home-compare-card">

                    <a
                        href="{{ route('places.show', $place->slug) }}"
                        class="featured-card"
                    >

                    <div class="featured-image">

                        @if($place->cover_image)

                            <img
                                src="{{ asset($place->cover_image) }}"
                                alt="{{ $place->name }}"
                                loading="lazy"
                            >

                        @else

                            <div class="featured-no-image">
                                📍
                            </div>

                        @endif

                        <span class="featured-badge">
                            🔥 Phổ biến
                        </span>

                    </div>

                    <div class="featured-content">

                        @if($place->province)

                            <span class="featured-province">
                                {{ $place->province->name }}
                            </span>

                        @endif

                        <h3>{{ $place->name }}</h3>

                        <p>
                            {{
                                $place->short_description
                                ?: 'Khám phá địa điểm du lịch nổi bật tại '
                                . ($place->province?->name ?? 'Việt Nam')
                                . '.'
                            }}
                        </p>

                        @if($place->categories->isNotEmpty())

                            <div class="featured-categories">

                                @foreach($place->categories->take(2) as $category)

                                    <span>
                                        {{ $category->name }}
                                    </span>

                                @endforeach

                            </div>

                        @endif

                        <div class="featured-bottom">

                            <span class="featured-price">
                                👁️ {{ number_format($place->view_count ?? 0) }}
                                lượt xem
                            </span>

                            <span class="featured-detail">
                                Xem chi tiết →
                            </span>

                        </div>

                    </div>

                
                </a>

                <div class="home-compare-action">
                    <x-compare-button :place="$place" />
                </div>

            </div>

            @empty


                <div class="featured-empty">

                    <span>🔥</span>

                    <p>
                        Chưa có dữ liệu địa điểm được quan tâm.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>




{{-- ====================================== --}}
{{-- LÊN KẾ HOẠCH CHUYẾN ĐI --}}
{{-- ====================================== --}}

<section class="trip-plan-section">

    <div class="trip-plan-container">

        <span class="trip-plan-label">
            Lên kế hoạch dễ dàng
        </span>

        <h2>
            Sẵn sàng cho chuyến đi tiếp theo?
        </h2>

        <p class="trip-plan-description">
            Tạo lịch trình du lịch phù hợp với chuyến đi
            dựa trên tỉnh thành, số ngày và ngân sách của bạn.
        </p>


        <div class="trip-plan-features">

            <div class="trip-feature">
                <span>📍</span>

                <div>
                    <strong>Chọn tỉnh thành</strong>
                    <p>Lựa chọn nơi bạn muốn khám phá</p>
                </div>
            </div>


            <div class="trip-feature">
                <span>📅</span>

                <div>
                    <strong>Chọn số ngày</strong>
                    <p>Xác định thời gian cho chuyến đi</p>
                </div>
            </div>


            <div class="trip-feature">
                <span>💰</span>

                <div>
                    <strong>Thiết lập ngân sách</strong>
                    <p>Giới hạn chi phí vé tham quan</p>
                </div>
            </div>


            <div class="trip-feature">
                <span>🗺️</span>

                <div>
                    <strong>Tạo lịch trình</strong>
                    <p>Hệ thống tự động sắp xếp địa điểm</p>
                </div>
            </div>

        </div>


        @auth

            <a
                href="{{ route('itineraries.create') }}"
                class="trip-plan-button"
            >
                Tạo lịch trình ngay →
            </a>

        @else

            <a
                href="{{ route('login') }}"
                class="trip-plan-button"
            >
                Đăng nhập để tạo lịch trình →
            </a>

        @endauth

    </div>

</section>


<script>

    const searchData = [

        // Tỉnh / Thành phố
        @foreach($provinces as $province)

            {
                name: @json($province->name),
                type: 'province',
                typeLabel: @json($province->administrative_type),
                province: '',
                url: @json(url('/provinces/' . $province->slug))
            },

        @endforeach


        // Địa điểm du lịch
        @foreach($searchPlaces as $place)

            {
                name: @json($place->name),
                type: 'place',
                typeLabel: 'Địa điểm du lịch',
                province: @json($place->province?->name ?? ''),
                url: @json(route('places.show', $place->slug))
            },

        @endforeach

    ];



    function normalizeVietnamese(text) {

        return text
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd')
            .trim();
    }




    const searchInput =
        document.getElementById('home-search-input');

    const suggestionsBox =
        document.getElementById('search-suggestions');


    searchInput.addEventListener('input', function () {

        const keyword =
            normalizeVietnamese(this.value);


        suggestionsBox.innerHTML = '';


        // Chưa nhập gì
        if (keyword === '') {

            suggestionsBox.classList.remove('show');

            return;
        }


        // Tìm dữ liệu phù hợp
        const results = searchData
            .filter(item =>
                normalizeVietnamese(item.name)
                    .includes(keyword)
            )
            .slice(0, 8);


        // Không tìm thấy
        if (results.length === 0) {

            suggestionsBox.innerHTML = `
                <div class="search-empty">
                    Không tìm thấy kết quả phù hợp
                </div>
            `;

            suggestionsBox.classList.add('show');

            return;
        }


        // Hiển thị kết quả
        results.forEach(item => {

            const suggestion =
                document.createElement('div');

            suggestion.className =
                'search-suggestion-item';


            const icon =
                item.type === 'province'
                    ? '🏙️'
                    : '📍';


            let description = '';

            if (item.type === 'province') {

                description =
                    item.typeLabel;

            } else {

                description =
                    item.province
                        ? item.province + ' · Địa điểm du lịch'
                        : 'Địa điểm du lịch';

            }


            suggestion.innerHTML = `
                <div class="suggestion-icon">
                    ${icon}
                </div>

                <div class="suggestion-info">

                    <strong>
                        ${item.name}
                    </strong>

                    <span>
                        ${description}
                    </span>

                </div>
            `;


            suggestion.addEventListener(
                'click',
                function () {

                    searchInput.value = item.name;

                    document
                        .getElementById('homeSearchForm')
                        .submit();

                }
            );


            suggestionsBox.appendChild(
                suggestion
            );

        });


        suggestionsBox.classList.add('show');

    });



    document.addEventListener(
        'click',
        function (event) {

            if (
                !searchInput.contains(event.target) &&
                !suggestionsBox.contains(event.target)
            ) {

                suggestionsBox.classList.remove(
                    'show'
                );

            }

        }
    );

</script>


    <x-footer />

    <x-compare-bar />


</body>
</html>