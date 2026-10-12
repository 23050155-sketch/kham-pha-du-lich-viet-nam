<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $place->name }}</title>

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f8fafc;
            color: #1f2937;
        }

        .place-hero {
            min-height: 430px;

            display: flex;
            align-items: flex-end;

            background-size: cover;
            background-position: center;

            position: relative;
            overflow: hidden;
        }

        .place-hero::before {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    180deg,
                    rgba(15, 23, 42, .12),
                    rgba(15, 23, 42, .78)
                );
        }

        .hero-content {
            position: relative;
            z-index: 2;

            width:
                min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                0 0
                55px;

            color: white;
        }

        .province-link {
            display: inline-flex;

            align-items: center;

            margin-bottom: 14px;

            padding:
                7px 13px;

            border:
                1px solid
                rgba(255,255,255,.22);

            border-radius: 999px;

            background:
                rgba(13,148,136,.90);

            color: white;

            text-decoration: none;

            font-size: 12px;
            font-weight: 700;

            backdrop-filter:
                blur(8px);
        }

        .hero-content h1 {
            max-width: 850px;

            margin:
                0 0
                12px;

            font-size:
                clamp(38px, 6vw, 58px);

            line-height: 1.08;

            letter-spacing: -1px;
        }

        .hero-content p {
            max-width: 720px;

            margin: 0;

            color:
                rgba(255,255,255,.88);

            font-size:
                clamp(14px, 2vw, 17px);

            line-height: 1.7;
        }

        .main-container {
            width:
                min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                58px 0
                70px;

            display: grid;

            grid-template-columns:
                minmax(0, 1.7fr)
                minmax(300px, .9fr);

            gap: 28px;

            align-items: start;
        }

        .content-card,
        .info-card {
            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            padding: 30px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        .content-card h2,
        .info-card h3 {
            color: #0f172a;

            margin-bottom: 18px;
        }

        .content-card h2 {
            font-size: 25px;
        }

        .info-card h3 {
            font-size: 20px;
        }

        .description {
            color: #475569;

            font-size: 14px;

            line-height: 1.85;
        }

        .info-row {
            display: flex;

            justify-content: space-between;

            gap: 18px;

            padding:
                14px 0;

            border-bottom:
                1px solid
                #eef2f7;

            font-size: 13px;
        }

        .info-label {
            color: #64748b;

            flex-shrink: 0;
        }

        .info-value {
            color: #0f172a;

            font-weight: 700;

            text-align: right;

            word-break: break-word;
        }

        .free {
            color: #059669;
        }


        .detail-section {
            margin-top: 28px;

            padding-top: 25px;

            border-top:
                1px solid
                #eef2f7;
        }

        .detail-section h2 {
            margin-bottom: 12px;

            color: #0f172a;

            font-size: 21px;
        }

        .category-list {
            display: flex;

            justify-content: flex-end;

            flex-wrap: wrap;

            gap: 6px;
        }

        .category-badge {
            display: inline-flex;

            align-items: center;

            padding:
                5px 10px;

            border:
                1px solid
                #ccfbf1;

            border-radius: 999px;

            background: #f0fdfa;

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;
        }



        /* ================= GALLERY ================= */

        .gallery-section {
            width:
                min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                0 0
                70px;
        }

        .gallery-section h2 {
            margin-bottom: 20px;

            color: #0f172a;

            font-size: 28px;
        }

        .gallery-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;
        }

        .gallery-item {
            aspect-ratio:
                16 / 10;

            overflow: hidden;

            border-radius: 18px;

            background: #e2e8f0;

            box-shadow:
                0 8px 24px
                rgba(15,23,42,.06);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .35s ease;
        }

        .gallery-item:hover img {
            transform:
                scale(1.05);
        }

        .gallery-caption {
            margin-top: 9px;

            color: #475569;

            text-align: center;

            font-size: 13px;
            font-weight: 600;
        }


        /* ================= RATING ================= */

        .rating-section {
            width:
                min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                0 0
                75px;
        }



        .rating-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 18px;

            margin-bottom: 20px;
        }

        .favorite-section {
            margin: 0;
        }


        .rating-section h2 {
            margin: 0;

            color: #0f172a;

            font-size: 28px;
        }

        .rating-container {
            display: grid;

            grid-template-columns:
                .9fr 1.8fr;

            gap: 32px;

            padding: 28px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }


        /* Tổng quan */

        .rating-summary {
            display: flex;

            flex-direction: column;

            justify-content: center;

            text-align: center;

            padding-right: 30px;

            border-right:
                1px solid
                #eef2f7;
        }

        .rating-score {
            margin-bottom: 8px;
        }

        .rating-number {
            font-size: 48px;
            font-weight: 700;

            color: #0f172a;
        }

        .rating-max {
            font-size: 20px;

            color: #64748b;
        }

        .average-stars {
            margin-bottom: 8px;
        }

        .display-star {
            font-size: 26px;

            color: #d1d5db;
        }

        .display-star.active {
            color: #f59e0b;
        }

        .rating-count {
            color: #64748b;

            font-size: 14px;
        }


        /* User rating */

        .user-rating h3 {
            font-size: 20px;

            margin-bottom: 7px;
        }

        .rating-help {
            color: #64748b;

            margin-bottom: 15px;
        }

        .star-input {
            display: flex;

            gap: 5px;
        }

        .star-button {
            border: none;

            background: transparent;

            color: #d1d5db;

            font-size: 40px;

            padding: 0;

            cursor: pointer;

            transition: .15s;
        }

        .star-button:hover {
            color: #f59e0b;

            transform: scale(1.1);
        }

        .star-button.selected {
            color: #f59e0b;
        }

        .current-rating {
            margin-top: 10px;

            color: #64748b;

            font-size: 14px;
        }

        .rating-success {
            margin-top: 15px;

            padding: 12px 15px;

            background: #dcfce7;

            color: #166534;

            border-radius: 10px;
        }

        .login-rating-text {
            color: #64748b;
        }

        .login-rating-text a {
            color: #0d9488;

            font-weight: 600;

            text-decoration: none;
        }


        /* ================= COMMENT ================= */
        .comment-form {
            margin-top: 18px;

            padding: 22px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 18px;

            box-shadow:
                0 8px 24px
                rgba(15,23,42,.05);
        }

        .comment-form textarea {
            width: 100%;

            min-height: 110px;

            padding: 14px;

            border:
                1px solid
                #dbe3ec;

            border-radius: 11px;

            background: #f8fafc;

            color: #0f172a;

            font-size: 14px;

            resize: vertical;

            outline: none;
        }

        .comment-form textarea:focus {
            background: white;

            border-color: #14b8a6;

            box-shadow:
                0 0 0 3px
                rgba(20,184,166,.10);
        }

        .comment-submit {
            margin-top: 10px;

            min-height: 42px;

            padding:
                0 18px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }

        .comment-submit:hover {
            background: #0f766e;
        }

        .comment-success {
            margin-top: 15px;

            padding: 12px 15px;

            background: #dcfce7;

            color: #166534;

            border-radius: 10px;
        }

        .comment-error {
            margin-top: 8px;

            color: #dc2626;

            font-size: 14px;
        }

        .login-to-comment {
            background: white;

            padding: 20px;

            border-radius: 14px;

            color: #64748b;

            box-shadow: 0 5px 20px rgba(0,0,0,.07);
        }

        .login-to-comment a {
            color: #0d9488;

            font-weight: 600;

            text-decoration: none;
        }




        /* ================= COMMENT LIST ================= */

        .comment-list {
            margin-top: 25px;
        }

        .comment-item {
            display: flex;

            gap: 14px;

            margin-bottom: 14px;

            padding: 18px;

            background: white;

            border:
                1px solid
                #e2e8f0;

            border-radius: 16px;

            box-shadow:
                0 6px 20px
                rgba(15,23,42,.04);
        }

        .comment-avatar,
        .reply-avatar {
            flex-shrink: 0;

            width: 44px;
            height: 44px;

            overflow: hidden;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #0d9488
                );

            color: white;

            font-weight: 700;
        }

        .comment-avatar img,
        .reply-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comment-body {
            flex: 1;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;

            margin-bottom: 7px;
        }

        .comment-user {
            color: #1f2937;
        }

        .comment-date {
            color: #94a3b8;
            font-size: 13px;
        }

        .comment-content {
            color: #475569;
            line-height: 1.6;
            white-space: pre-line;
        }

        .no-comments {
            background: white;
            padding: 25px;

            border-radius: 14px;

            color: #64748b;
            text-align: center;
        }


        /* ================= ACTION BUTTONS ================= */

        .comment-actions {
            display: flex;
            align-items: center;
            gap: 14px;

            margin-top: 8px;
        }

        .reply-button,
        .edit-comment-button,
        .delete-comment-button {
            border: none;
            background: transparent;

            font-weight: 600;
            cursor: pointer;

            padding: 0;
            margin: 0;
        }

        .reply-button,
        .edit-comment-button {
            color: #0d9488;
        }

        .delete-comment-button {
            color: #dc2626;
        }

        .reply-button:hover,
        .edit-comment-button:hover,
        .delete-comment-button:hover {
            text-decoration: underline;
        }

        .delete-comment-form {
            display: inline-flex;
            margin: 0;
        }


        /* ================= REPLY LIST ================= */

        .reply-list {
            margin-top: 18px;

            padding-left: 20px;

            border-left: 2px solid #e5e7eb;
        }

        .reply-item {
            display: flex;
            gap: 12px;

            margin-top: 15px;
        }

        .reply-avatar {
            width: 36px;
            height: 36px;

            font-size: 14px;
        }

        .reply-body {
            flex: 1;

            padding: 12px 14px;

            background: #f8fafc;

            border:
                1px solid
                #eef2f7;

            border-radius: 12px;
        }


        /* ================= REPLY FORM ================= */

        .reply-form {
            display: none;

            width: 100%;
            margin-top: 12px;
        }

        .reply-form.show {
            display: block;
        }

        .reply-form textarea {
            width: 100%;

            border: 1px solid #d1d5db;
            border-radius: 10px;

            padding: 10px 12px;

            resize: vertical;
            outline: none;

            font-size: 14px;
        }

        .reply-form textarea:focus {
            border-color: #0d9488;
        }

        .reply-actions {
            display: flex;
            gap: 8px;

            margin-top: 8px;
        }

        .reply-submit {
            border: none;

            background: #0d9488;
            color: white;

            padding: 8px 14px;

            border-radius: 8px;

            cursor: pointer;
            font-weight: 600;
        }

        .reply-submit:hover {
            background: #0f766e;
        }

        .reply-cancel {
            border: 1px solid #d1d5db;

            background: white;
            color: #475569;

            padding: 8px 14px;

            border-radius: 8px;

            cursor: pointer;
        }


        /* ================= EDIT FORM ================= */

        .edit-comment-form {
            display: none;

            width: 100%;
            margin-top: 12px;
        }

        .edit-comment-form.show {
            display: block;
        }

        .edit-comment-form textarea {
            width: 100%;

            border: 1px solid #d1d5db;
            border-radius: 10px;

            padding: 10px 12px;

            resize: vertical;
            outline: none;
        }

        .edit-comment-form textarea:focus {
            border-color: #0d9488;
        }

        .edit-comment-actions {
            display: flex;
            gap: 8px;

            margin-top: 8px;
        }

        .save-comment-button {
            border: none;

            background: #0d9488;
            color: white;

            padding: 8px 14px;

            border-radius: 8px;

            cursor: pointer;
        }

        .save-comment-button:hover {
            background: #0f766e;
        }

        .cancel-edit-button {
            border: 1px solid #d1d5db;

            background: white;
            color: #475569;

            padding: 8px 14px;

            border-radius: 8px;

            cursor: pointer;
        }



        /* Yêu thích  */
        .favorite-button {
            min-height: 42px;

            padding:
                0 16px;

            border:
                1px solid
                #fecaca;

            border-radius: 10px;

            background: white;

            color: #dc2626;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }

        .favorite-button:hover {
            background: #fef2f2;
        }

        .favorite-button.active {
            background: #fef2f2;

            border-color: #fca5a5;

            color: #b91c1c;
        }

        .favorite-login {
            display: inline-block;

            text-decoration: none;

            color: #0d9488;
            font-weight: 600;
        }

        .favorite-login:hover {
            text-decoration: underline;
        }




        .map-section {
            width: min(100% - 40px, 1200px);

            margin: 0 auto;

            padding:
                0 0
                70px;
        }

        .map-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 18px;
        }

        .map-header h2 {
            color: #0f172a;

            font-size: 28px;
        }

        .map-direction-btn {
            min-height: 42px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 0 16px;

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

            transition: .2s ease;
        }

        .map-direction-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 24px
                rgba(13,148,136,.22);
        }

        .place-map {
            width: 100%;
            height: 420px;

            overflow: hidden;

            border:
                1px solid
                #e2e8f0;

            border-radius: 18px;

            box-shadow:
                0 8px 28px
                rgba(15,23,42,.05);
        }

        
        @media (max-width: 900px) {

            .main-container {
                grid-template-columns: 1fr;
            }

            .info-card {
                order: 2;
            }

            .rating-container {
                grid-template-columns: 1fr;
            }

            .rating-summary {
                padding-right: 0;

                padding-bottom: 24px;

                border-right: none;

                border-bottom:
                    1px solid
                    #eef2f7;
            }

        }


        @media (max-width: 650px) {

            .place-hero {
                min-height: 330px;
            }

            .hero-content {
                width:
                    calc(100% - 28px);

                padding-bottom: 38px;
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .main-container,
            .gallery-section,
            .rating-section {
                width:
                    calc(100% - 28px);
            }

            .main-container {
                padding:
                    42px 0
                    55px;
            }

            .content-card,
            .info-card {
                padding: 20px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .rating-header {
                align-items: stretch;

                flex-direction: column;
            }

            .favorite-button {
                width: 100%;
            }

            .rating-container {
                padding: 20px;
            }

            .comment-item {
                padding: 15px;
            }

            .reply-list {
                padding-left: 12px;
            }


            .related-section {
                width: calc(100% - 28px);
                margin: 45px auto;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }

            .map-section {
                width: calc(100% - 28px);
            }

            .map-header {
                align-items: stretch;
                flex-direction: column;
            }

            .map-direction-btn {
                width: 100%;
            }

            .place-map {
                height: 320px;
            }

        }



        .related-section {
            width: min(100% - 40px, 1200px);
            margin: 60px auto;
        }

        .related-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .related-header span {
            color: #0d9488;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .related-header h2 {
            margin-top: 7px;
            color: #0f172a;
            font-size: 30px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .related-card {
            overflow: hidden;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(15,23,42,.06);
        }

        .related-image {
            position: relative;
            aspect-ratio: 16 / 10;
            overflow: hidden;
        }

        .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-no-image {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ccfbf1;
            font-size: 35px;
        }

        .related-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 5px 10px;
            background: #0d9488;
            color: white;
            border-radius: 999px;
            font-size: 11px;
        }

        .related-content {
            padding: 18px;
        }

        .related-content h3 {
            margin-bottom: 9px;
            color: #0f172a;
            font-size: 18px;
        }

        .related-content p {
            margin-bottom: 12px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .related-meta {
            margin-bottom: 15px;
            color: #64748b;
            font-size: 12px;
        }

        .related-content a {
            display: flex;
            align-items: center;
            justify-content: center;

            min-height: 42px;

            background: linear-gradient(
                135deg,
                #0f766e,
                #0d9488
            );

            color: white;

            border-radius: 10px;

            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        @media (max-width: 992px) {

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }




        .map-popup {
            min-width: 180px;
        }

        .map-popup-name {
            display: block;

            margin-bottom: 6px;

            color: #0f172a;

            font-size: 15px;
        }

        .map-popup-address {
            margin-bottom: 6px;

            color: #64748b;

            font-size: 12px;

            line-height: 1.5;
        }

        .map-popup-price {
            color: #475569;

            font-size: 12px;
        }

        .map-popup-price strong {
            color: #0f766e;
        }



        .map-popup-link {
            display: inline-flex;

            margin-top: 8px;

            padding: 6px 10px;

            border-radius: 7px;

            background: #0f766e;

            color: white !important;

            text-decoration: none;

            font-size: 11px;
            font-weight: 700;
        }

        .map-popup-link:hover {
            background: #0d9488;
        }


        .map-legend {
            position: absolute;

            bottom: 18px;
            left: 18px;

            z-index: 500;

            padding: 10px 12px;

            background: rgba(255,255,255,.95);

            border:
                1px solid
                #e2e8f0;

            border-radius: 10px;

            box-shadow:
                0 4px 14px
                rgba(15,23,42,.12);

            font-size: 12px;
        }

        .map-legend-item {
            display: flex;

            align-items: center;

            gap: 8px;
        }

        .map-legend-item + .map-legend-item {
            margin-top: 7px;
        }

        .map-legend-dot {
            width: 12px;
            height: 12px;

            border-radius: 50%;

            flex-shrink: 0;
        }

        .map-legend-dot.current {
            background: #dc2626;
        }

        .map-legend-dot.nearby {
            background: #16a34a;
        }

        .place-map-wrapper {
            position: relative;
        }




        .custom-map-marker {
            background: transparent;
            border: none;
        }

        .map-pin {
            width: 30px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            filter: drop-shadow(0 4px 10px rgba(15, 23, 42, 0.25));
        }

        .map-pin svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .current-pin svg path {
            fill: #dc2626; /* đỏ */
        }

        .nearby-pin svg path {
            fill: #16a34a; /* xanh lá */
        }



        .related-categories {
            display: flex;
            flex-wrap: wrap;

            gap: 6px;

            margin-bottom: 10px;
        }

        .related-categories span {
            display: inline-flex;

            align-items: center;

            padding: 4px 8px;

            border-radius: 999px;

            background: #f0fdfa;

            border:
                1px solid
                #ccfbf1;

            color: #0f766e;

            font-size: 11px;
            font-weight: 700;
        }


        .related-match {
            margin-bottom: 10px;

            color: #0f766e;

            font-size: 12px;
            font-weight: 700;
        }



        .map-popup-direction {
            display: inline-flex;

            margin-top: 8px;
            margin-left: 6px;

            padding: 6px 10px;

            border-radius: 7px;

            background: #EE0000;

            color: white !important;

            text-decoration: none;

            font-size: 11px;
            font-weight: 700;
        }

        .map-popup-direction:hover {
            background: #15803d;
        }




        
        .place-compare-action {
            margin-top: 22px;
        }

        .place-compare-action .compare-add-btn {
            min-width: 160px;
            background: rgba(255, 255, 255, .96);
        }

        .place-compare-action .compare-add-btn.is-selected {
            background: #0f766e;
            color: white;
        }

    </style>

</head>

<body>

<x-navbar />

<section
    class="place-hero"
    style="
        background-image:
            url('{{ asset($place->cover_image) }}');
    "
>

    <div class="hero-content">

        <a href="{{ url('/provinces/' . $place->province->slug) }}"
           class="province-link">

            {{ $place->province->name }}

        </a>

        <h1>
            {{ $place->name }}
        </h1>

        <p>
            {{ $place->short_description }}
        </p>

        <div class="place-compare-action">
            <x-compare-button :place="$place" />
        </div>

    </div>

</section>


<main class="main-container">

    <section class="content-card">

        <h2>Giới thiệu</h2>

        <p class="description">
            {{ $place->description ?? $place->short_description }}
        </p>


        @if($place->activities)

            <div class="detail-section">

                <h2>Hoạt động</h2>

                <p class="description">
                    {{ $place->activities }}
                </p>

            </div>

        @endif


        @if($place->notes)

            <div class="detail-section">

                <h2>Lưu ý khi tham quan</h2>

                <p class="description">
                    {{ $place->notes }}
                </p>

            </div>

        @endif

    </section>


    <aside class="info-card">

        <h3>Thông tin tham quan</h3>


        <div class="info-row">

            <span class="info-label">
                Loại hình
            </span>

            <span class="info-value">

                @if($place->categories->count() > 0)

                    <span class="category-list">

                        @foreach($place->categories as $category)

                            <span class="category-badge">
                                {{ $category->name }}
                            </span>

                        @endforeach

                    </span>

                @else

                    Đang cập nhật

                @endif

            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Giá vé
            </span>

            @if($place->ticket_price == 0)

                <span class="info-value free">
                    Miễn phí
                </span>

            @else

                <span class="info-value">
                    {{ number_format($place->ticket_price) }} VNĐ
                </span>

            @endif

        </div>


        <div class="info-row">

            <span class="info-label">
                Giờ mở cửa
            </span>

            <span class="info-value">

                @if($place->open_time && $place->close_time)

                    {{ substr($place->open_time, 0, 5) }}
                    -
                    {{ substr($place->close_time, 0, 5) }}

                @else

                    Không cố định

                @endif

            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Thời gian tham quan
            </span>

            <span class="info-value">

                {{ $place->visit_duration_min }} phút

            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Thời điểm nên đi
            </span>

            <span class="info-value">

                @if($place->best_months)

                    {{ $place->best_months }}

                    <br>

                @endif


                @switch($place->best_time)

                    @case('morning')
                        Buổi sáng
                        @break

                    @case('afternoon')
                        Buổi chiều
                        @break

                    @case('evening')
                        Buổi tối
                        @break

                    @default
                        Cả ngày

                @endswitch

            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Địa chỉ
            </span>

            <span class="info-value">

                {{ $place->address ?? 'Đang cập nhật' }}

            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Lượt xem
            </span>

            <span class="info-value">
                👁 {{ number_format($place->view_count) }} lượt
            </span>

        </div>

    </aside>

</main>



@if(
    !is_null($place->latitude) &&
    !is_null($place->longitude)
)

    <section class="map-section">

        <div class="map-header">

            <h2>
                📍 Vị trí trên bản đồ
            </h2>

            <a
                href="https://www.google.com/maps/dir/?api=1&destination={{ $place->latitude }},{{ $place->longitude }}"
                target="_blank"
                rel="noopener noreferrer"
                class="map-direction-btn"
            >
                Mở chỉ đường
            </a>

        </div>

        <div class="place-map-wrapper">

            <div
                id="placeMap"
                class="place-map"
            ></div>

            <div class="map-legend">

                <div class="map-legend-item">
                    <span class="map-legend-dot current"></span>
                    <span>Địa điểm hiện tại</span>
                </div>

                <div class="map-legend-item">
                    <span class="map-legend-dot nearby"></span>
                    <span>Địa điểm gần đây</span>
                </div>

            </div>

        </div>

    </section>

@endif




@if($place->images->count() > 0)

    <section class="gallery-section">

        <h2>Thư viện ảnh</h2>

        <div class="gallery-grid">

            @foreach($place->images as $image)

                <div>

                    <div class="gallery-item">

                        <img
                            src="{{ asset($image->image_path) }}"
                            alt="{{ $image->caption ?? $place->name }}"
                        >

                    </div>

                    @if($image->caption)

                        <p class="gallery-caption">
                            {{ $image->caption }}
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    </section>

@endif


<section class="rating-section">

    @php
        $averageRating = $place->ratings()->avg('rating');
        $ratingCount = $place->ratings()->count();

        $userRating = auth()->check()
            ? $place->ratings()
                ->where('user_id', auth()->id())
                ->value('rating')
            : null;
    @endphp


    @php
        $isFavorite = auth()->check()
            ? $place->favorites()
                ->where('user_id', auth()->id())
                ->exists()
            : false;
    @endphp


    <div class="rating-header">

        <h2>Đánh giá địa điểm</h2>

        <div class="favorite-section">

            @auth

                <form
                    method="POST"
                    action="{{ route('favorites.toggle', $place->id) }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="favorite-button {{ $isFavorite ? 'active' : '' }}"
                    >
                        {{ $isFavorite ? '♥ Đã yêu thích' : '♡ Yêu thích' }}
                    </button>

                </form>

            @else

                <a
                    href="{{ route('login') }}"
                    class="favorite-login"
                >
                    ♡ Đăng nhập để yêu thích
                </a>

            @endauth

        </div>

    </div>


    <div class="rating-container">

        {{-- Tổng quan đánh giá --}}
        <div class="rating-summary">

            <div class="rating-score">

                <span class="rating-number">
                    {{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                </span>

                <span class="rating-max">
                    / 5
                </span>

            </div>


            <div class="average-stars">

                @for($i = 1; $i <= 5; $i++)

                    <span class="display-star
                        {{ $averageRating && $i <= round($averageRating) ? 'active' : '' }}">
                        ★
                    </span>

                @endfor

            </div>


            <p class="rating-count">
                {{ $ratingCount }} lượt đánh giá
            </p>

        </div>


        {{-- User đánh giá --}}
        <div class="user-rating">

            @auth

                <h3>Đánh giá của bạn</h3>

                <p class="rating-help">
                    Bạn cảm thấy địa điểm này thế nào?
                </p>


                <form
                    method="POST"
                    action="{{ route('ratings.store', $place->id) }}"
                >

                    @csrf


                    <div class="star-input">

                        @for($i = 1; $i <= 5; $i++)

                            <button
                                type="submit"
                                name="rating"
                                value="{{ $i }}"
                                class="star-button
                                    {{ $userRating && $i <= $userRating ? 'selected' : '' }}"
                                title="{{ $i }} sao"
                            >
                                ★
                            </button>

                        @endfor

                    </div>

                </form>


                @if($userRating)

                    <p class="current-rating">
                        Bạn đã đánh giá
                        <strong>
                            {{ $userRating }}/5 sao
                        </strong>
                    </p>

                @else

                    <p class="current-rating">
                        Chọn số sao để đánh giá.
                    </p>

                @endif


                @if(session('rating_success'))

                    <div class="rating-success">
                        {{ session('rating_success') }}
                    </div>

                @endif


            @else

                <h3>Đánh giá địa điểm</h3>

                <p class="login-rating-text">

                    Bạn cần

                    <a href="{{ route('login') }}">
                        đăng nhập
                    </a>

                    để đánh giá địa điểm này.

                </p>

            @endauth

        </div>

    </div>

    <h2>Bình luận</h2>

    @auth

        <form
            method="POST"
            action="{{ route('comments.store', $place->id) }}"
            class="comment-form"
        >
            @csrf

            <textarea
                name="content"
                rows="4"
                placeholder="Viết bình luận của bạn..."
                required
            >{{ old('content') }}</textarea>

            @error('content')
                <p class="comment-error">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit" class="comment-submit">
                Gửi bình luận
            </button>

        </form>

        @if(session('comment_success'))
            <div class="comment-success">
                {{ session('comment_success') }}
            </div>
        @endif

    @else

        <div class="login-to-comment">
            <a href="{{ route('login') }}">
                Đăng nhập
            </a>
            để bình luận về địa điểm này.
        </div>

    @endauth



    <div class="comment-list">

        @if($place->comments->count() > 0)

            @foreach($place->comments as $comment)

                <div class="comment-item">

                    {{-- AVATAR COMMENT CHA --}}
                    <div class="comment-avatar">

                        @if($comment->user->avatar)

                            <img
                                src="{{ asset($comment->user->avatar) }}"
                                alt="{{ $comment->user->name }}"
                            >

                        @else

                            {{ mb_strtoupper(
                                mb_substr($comment->user->name, 0, 1)
                            ) }}

                        @endif

                    </div>


                    <div class="comment-body">

                        {{-- TÊN + NGÀY --}}
                        <div class="comment-header">

                            <strong class="comment-user">
                                {{ $comment->user->name }}
                            </strong>

                            <span class="comment-date">
                                {{ $comment->created_at->format('d/m/Y H:i') }}
                            </span>

                        </div>


                        {{-- NỘI DUNG --}}
                        <p class="comment-content">
                            {{ $comment->content }}
                        </p>


                        {{-- CÁC NÚT --}}
                        <div class="comment-actions">

                            @auth

                                <button
                                    type="button"
                                    class="reply-button"
                                    onclick="toggleReplyForm({{ $comment->id }})"
                                >
                                    Trả lời
                                </button>

                            @endauth


                            @if(auth()->check() && auth()->id() === $comment->user_id)

                                <button
                                    type="button"
                                    class="edit-comment-button"
                                    onclick="toggleEditComment({{ $comment->id }})"
                                >
                                    Sửa
                                </button>


                                <form
                                    method="POST"
                                    action="{{ route('comments.destroy', $comment->id) }}"
                                    class="delete-comment-form"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này không?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-comment-button"
                                    >
                                        Xóa
                                    </button>

                                </form>

                            @endif

                        </div>


                        {{-- FORM TRẢ LỜI --}}
                        @auth

                            <form
                                method="POST"
                                action="{{ route('comments.store', $place->id) }}"
                                class="reply-form"
                                id="reply-form-{{ $comment->id }}"
                            >
                                @csrf

                                <input
                                    type="hidden"
                                    name="parent_id"
                                    value="{{ $comment->id }}"
                                >

                                <textarea
                                    name="content"
                                    rows="2"
                                    placeholder="Viết câu trả lời..."
                                    required
                                ></textarea>

                                <div class="reply-actions">

                                    <button
                                        type="submit"
                                        class="reply-submit"
                                    >
                                        Gửi trả lời
                                    </button>

                                    <button
                                        type="button"
                                        class="reply-cancel"
                                        onclick="toggleReplyForm({{ $comment->id }})"
                                    >
                                        Hủy
                                    </button>

                                </div>

                            </form>

                        @endauth


                        {{-- FORM SỬA COMMENT CHA --}}
                        @if(auth()->check() && auth()->id() === $comment->user_id)

                            <form
                                method="POST"
                                action="{{ route('comments.update', $comment->id) }}"
                                class="edit-comment-form"
                                id="edit-comment-form-{{ $comment->id }}"
                            >
                                @csrf
                                @method('PUT')

                                <textarea
                                    name="content"
                                    rows="3"
                                    required
                                >{{ $comment->content }}</textarea>

                                <div class="edit-comment-actions">

                                    <button
                                        type="submit"
                                        class="save-comment-button"
                                    >
                                        Lưu
                                    </button>

                                    <button
                                        type="button"
                                        class="cancel-edit-button"
                                        onclick="toggleEditComment({{ $comment->id }})"
                                    >
                                        Hủy
                                    </button>

                                </div>

                            </form>

                        @endif


                        {{-- DANH SÁCH REPLY --}}
                        @if($comment->replies->count() > 0)

                            <div class="reply-list">

                                @foreach($comment->replies as $reply)

                                    <div class="reply-item">

                                        {{-- AVATAR REPLY --}}
                                        <div class="reply-avatar">

                                            @if($reply->user->avatar)

                                                <img
                                                    src="{{ asset($reply->user->avatar) }}"
                                                    alt="{{ $reply->user->name }}"
                                                >

                                            @else

                                                {{ mb_strtoupper(
                                                    mb_substr($reply->user->name, 0, 1)
                                                ) }}

                                            @endif

                                        </div>


                                        <div class="reply-body">

                                            <div class="comment-header">

                                                <strong class="comment-user">
                                                    {{ $reply->user->name }}
                                                </strong>

                                                <span class="comment-date">
                                                    {{ $reply->created_at->format('d/m/Y H:i') }}
                                                </span>

                                            </div>


                                            <p class="comment-content">
                                                {{ $reply->content }}
                                            </p>


                                            {{-- SỬA / XÓA REPLY --}}
                                            @if(auth()->check() && auth()->id() === $reply->user_id)

                                                <div class="comment-actions">

                                                    <button
                                                        type="button"
                                                        class="edit-comment-button"
                                                        onclick="toggleEditComment({{ $reply->id }})"
                                                    >
                                                        Sửa
                                                    </button>


                                                    <form
                                                        method="POST"
                                                        action="{{ route('comments.destroy', $reply->id) }}"
                                                        class="delete-comment-form"
                                                        onsubmit="return confirm('Bạn có chắc muốn xóa câu trả lời này không?')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="delete-comment-button"
                                                        >
                                                            Xóa
                                                        </button>

                                                    </form>

                                                </div>


                                                {{-- FORM SỬA REPLY --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('comments.update', $reply->id) }}"
                                                    class="edit-comment-form"
                                                    id="edit-comment-form-{{ $reply->id }}"
                                                >
                                                    @csrf
                                                    @method('PUT')

                                                    <textarea
                                                        name="content"
                                                        rows="2"
                                                        required
                                                    >{{ $reply->content }}</textarea>

                                                    <div class="edit-comment-actions">

                                                        <button
                                                            type="submit"
                                                            class="save-comment-button"
                                                        >
                                                            Lưu
                                                        </button>

                                                        <button
                                                            type="button"
                                                            class="cancel-edit-button"
                                                            onclick="toggleEditComment({{ $reply->id }})"
                                                        >
                                                            Hủy
                                                        </button>

                                                    </div>

                                                </form>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        @else

            <div class="no-comments">
                Chưa có bình luận nào. Hãy là người đầu tiên bình luận.
            </div>

        @endif

    </div>

</section>


@if($relatedPlaces->isNotEmpty())

<section class="related-section">

    <div class="related-header">

        <span>
            Có thể bạn quan tâm
        </span>

        <h2>
            Địa điểm liên quan
        </h2>

    </div>


    <div class="related-grid">

        @foreach($relatedPlaces as $relatedPlace)

            <article class="related-card">

                <div class="related-image">

                    @if($relatedPlace->cover_image)

                        <img
                            src="{{ asset($relatedPlace->cover_image) }}"
                            alt="{{ $relatedPlace->name }}"
                        >

                    @else

                        <div class="related-no-image">
                            📍
                        </div>

                    @endif


                    @if($relatedPlace->province)

                        <span class="related-badge">
                            {{ $relatedPlace->province->name }}
                        </span>

                    @endif

                </div>


                <div class="related-content">

                    <h3>
                        {{ $relatedPlace->name }}
                    </h3>


                    @if($relatedPlace->categories->isNotEmpty())

                        <div class="related-categories">

                            @foreach($relatedPlace->categories->take(3) as $category)

                                <span>
                                    {{ $category->name }}
                                </span>

                            @endforeach

                        </div>

                    @endif


                    <div class="related-match">

                        🔗 {{ $relatedPlace->matching_categories_count }}
                        loại hình liên quan

                    </div>


                    <p>
                        {{
                            $relatedPlace->short_description
                            ?: 'Khám phá địa điểm du lịch nổi bật.'
                        }}
                    </p>

                    <div class="related-meta">
                        👁
                        {{ number_format($relatedPlace->view_count ?? 0) }}
                        lượt xem
                    </div>

                    <a
                        href="{{ route(
                            'places.show',
                            $relatedPlace->slug
                        ) }}"
                    >
                        Xem chi tiết
                    </a>

                </div>

            </article>

        @endforeach

    </div>

</section>

@endif


@if($nearbyPlaces->isNotEmpty())

<section class="related-section">

    <div class="related-header">

        <span>
            Gần vị trí này
        </span>

        <h2>
            Địa điểm gần đây
        </h2>

    </div>

    <div class="related-grid">

        @foreach($nearbyPlaces as $nearbyPlace)

            <article class="related-card">

                <div class="related-image">

                    @if($nearbyPlace->cover_image)

                        <img
                            src="{{ asset($nearbyPlace->cover_image) }}"
                            alt="{{ $nearbyPlace->name }}"
                        >

                    @else

                        <div class="related-no-image">
                            📍
                        </div>

                    @endif

                    @if($nearbyPlace->province)

                        <span class="related-badge">
                            {{ $nearbyPlace->province->name }}
                        </span>

                    @endif

                </div>

                <div class="related-content">

                    <h3>
                        {{ $nearbyPlace->name }}
                    </h3>

                    <p>
                        {{
                            $nearbyPlace->short_description
                            ?: 'Khám phá địa điểm du lịch gần đây.'
                        }}
                    </p>

                    <div class="related-meta">

                        📍
                        {{ number_format($nearbyPlace->distance_km, 1) }}
                        km

                    </div>

                    <a
                        href="{{ route(
                            'places.show',
                            $nearbyPlace->slug
                        ) }}"
                    >
                        Xem chi tiết
                    </a>

                </div>

            </article>

        @endforeach

    </div>

</section>

@endif


<script>
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById(
            'reply-form-' + commentId
        );

        const editForm = document.getElementById(
            'edit-comment-form-' + commentId
        );

        if (!replyForm) {
            return;
        }

        // Nếu form sửa đang mở thì đóng lại
        if (editForm) {
            editForm.classList.remove('show');
        }

        // Mở / đóng form trả lời
        replyForm.classList.toggle('show');
    }


    function toggleEditComment(commentId) {
        const editForm = document.getElementById(
            'edit-comment-form-' + commentId
        );

        const replyForm = document.getElementById(
            'reply-form-' + commentId
        );

        if (!editForm) {
            return;
        }

        // Nếu form trả lời đang mở thì đóng lại
        if (replyForm) {
            replyForm.classList.remove('show');
        }

        // Mở / đóng form sửa
        editForm.classList.toggle('show');
    }
</script>


@include('components.footer')


<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
></script>

@if(
    !is_null($place->latitude) &&
    !is_null($place->longitude)
)

<script>

    const latitude =
        {{ $place->latitude }};

    const longitude =
        {{ $place->longitude }};


    const placeMap =
        L.map('placeMap', {
            minZoom: 5,
            maxZoom: 19
        })
        .setView(
            [
                latitude,
                longitude
            ],
            15
        );

    const mapPoints = [];



    const currentPlaceIcon = L.divIcon({
        className: 'custom-map-marker',
        html: `
            <div class="map-pin current-pin">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path>
                    <circle cx="12" cy="9" r="3.2" fill="white"></circle>
                </svg>
            </div>
        `,
        iconSize: [30, 40],
        iconAnchor: [15, 40],
        popupAnchor: [0, -36]
    });


    const nearbyPlaceIcon = L.divIcon({
        className: 'custom-map-marker',
        html: `
            <div class="map-pin nearby-pin">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path>
                    <circle cx="12" cy="9" r="3.2" fill="white"></circle>
                </svg>
            </div>
        `,
        iconSize: [30, 40],
        iconAnchor: [15, 40],
        popupAnchor: [0, -36]
    });



    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            maxNativeZoom: 19,
            attribution:
                '&copy; OpenStreetMap contributors'
        }
    ).addTo(placeMap);


    const popupContent = `
        <div class="map-popup">

            <strong class="map-popup-name">
                {{ $place->name }}
            </strong>

            <div class="map-popup-address">
                {{ $place->address ?? 'Địa chỉ đang cập nhật' }}
            </div>

            <div class="map-popup-price">

                @if($place->ticket_price == 0)

                    Giá vé:
                    <strong>Miễn phí</strong>

                @else

                    Giá vé:
                    <strong>
                        {{ number_format($place->ticket_price) }} VNĐ
                    </strong>

                @endif

            </div>

        </div>
    `;


    const mainMarker = L.marker(
        [
            latitude,
            longitude
        ],
        {
            icon: currentPlaceIcon
        }
    )
    .addTo(placeMap)
    .bindPopup(
        popupContent
    )
    .openPopup();

    mapPoints.push([
        latitude,
        longitude
    ]);



    @foreach($nearbyPlaces as $nearbyPlace)

        @if(
            !is_null($nearbyPlace->latitude) &&
            !is_null($nearbyPlace->longitude)
        )

            L.marker(
                [
                    {{ $nearbyPlace->latitude }},
                    {{ $nearbyPlace->longitude }}
                ],
                {
                    icon: nearbyPlaceIcon
                }
            )
            .addTo(placeMap)
            .bindPopup(`
                <div class="map-popup">

                    <strong class="map-popup-name">
                        {{ $nearbyPlace->name }}
                    </strong>

                    <div class="map-popup-address">
                        Cách địa điểm hiện tại:
                        {{ number_format($nearbyPlace->distance_km, 1) }}
                        km
                    </div>

                    <a
                        href="{{ route('places.show', $nearbyPlace->slug) }}"
                        class="map-popup-link"
                    >
                        Xem chi tiết
                    </a>


                    <a
                        href="https://www.google.com/maps/dir/?api=1&destination={{ $nearbyPlace->latitude }},{{ $nearbyPlace->longitude }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="map-popup-direction"
                    >
                        Chỉ đường
                    </a>

                </div>
            `);


            mapPoints.push([
                {{ $nearbyPlace->latitude }},
                {{ $nearbyPlace->longitude }}
            ]);


        @endif

    @endforeach

    if (mapPoints.length > 1) {

        placeMap.fitBounds(
            mapPoints,
            {
                padding: [40, 40],
                maxZoom: 14
            }
        );
    }

</script>

@endif

<x-compare-bar />

</body>

</html>


