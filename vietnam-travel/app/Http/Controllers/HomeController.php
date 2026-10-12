<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Category;
use App\Models\SearchHistory;
use App\Models\ViewHistory;
use App\Models\Favorite;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Danh sách tỉnh / thành phố
        // Dùng cho ô tìm kiếm
        $provinces = Province::orderBy('name')
            ->get();


        $searchPlaces = Place::with('province')
            ->where('status', 'active')
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'slug',
                'province_id'
            ]);


        // Điểm đến nổi bật
        $featuredPlaces = Place::with([
                'province',
                'categories'
            ])
            ->where('status', 'active')
            ->where('is_featured', true)
            ->limit(6)
            ->get();


        // Địa điểm được quan tâm nhiều
        $popularPlaces = Place::with('province')
            ->where('status', 'active')
            ->orderByDesc('view_count')
            ->limit(6)
            ->get();


        // Danh mục / sở thích du lịch
        $categories = Category::orderBy('name')
            ->get();


        $recommendedPlaces = collect();

        $recommendationMode = null;


        if (auth()->check()) {

            $userId = auth()->id();

            /*
            |--------------------------------------------------------------------------
            | LẤY HÀNH VI CỦA USER
            |--------------------------------------------------------------------------
            */

            $userSearches = SearchHistory::where(
                    'user_id',
                    $userId
                )
                ->latest('searched_at')
                ->get();


            $viewHistories = ViewHistory::with('place')
                ->where('user_id', $userId)
                ->get();


            $favorites = Favorite::with('place')
                ->where('user_id', $userId)
                ->get();


            $ratings = Rating::with('place')
                ->where('user_id', $userId)
                ->get();


            /*
            |--------------------------------------------------------------------------
            | KIỂM TRA USER ĐÃ CÓ HÀNH VI CHƯA
            |--------------------------------------------------------------------------
            */

            $hasUserBehavior =
                $userSearches->isNotEmpty()
                || $viewHistories->isNotEmpty()
                || $favorites->isNotEmpty()
                || $ratings->isNotEmpty();


            $allProvinces = Province::all();

            $allPlaces = Place::where(
                    'status',
                    'active'
                )
                ->get();


            /*
            |--------------------------------------------------------------------------
            | TRƯỜNG HỢP 1:
            | USER ĐÃ CÓ HÀNH VI → GỢI Ý CÁ NHÂN HÓA
            |--------------------------------------------------------------------------
            */

            if ($hasUserBehavior) {

                $recommendationMode = 'personalized';

                $provinceScores = [];

                $provinceLastActivity = [];


                /*
                | TÌM KIẾM = +2
                */

                foreach ($userSearches as $search) {

                    $keyword = $this->normalizeVietnamese(
                        $search->keyword
                    );


                    $matchedProvince = $allProvinces
                        ->first(function ($province) use ($keyword) {

                            return
                                $this->normalizeVietnamese(
                                    $province->name
                                ) === $keyword;

                        });


                    if ($matchedProvince) {

                        $provinceId =
                            $matchedProvince->id;

                        $provinceScores[$provinceId] =
                            ($provinceScores[$provinceId] ?? 0)
                            + 2;

                        $provinceLastActivity[$provinceId] =
                            max(
                                $provinceLastActivity[$provinceId] ?? 0,
                                optional(
                                    $search->searched_at
                                )->timestamp ?? 0
                            );

                        continue;
                    }


                    $matchedPlace = $allPlaces
                        ->first(function ($place) use ($keyword) {

                            return
                                $this->normalizeVietnamese(
                                    $place->name
                                ) === $keyword;

                        });


                    if ($matchedPlace) {

                        $provinceId =
                            $matchedPlace->province_id;

                        $provinceScores[$provinceId] =
                            ($provinceScores[$provinceId] ?? 0)
                            + 2;

                        $provinceLastActivity[$provinceId] =
                            max(
                                $provinceLastActivity[$provinceId] ?? 0,
                                optional(
                                    $search->searched_at
                                )->timestamp ?? 0
                            );
                    }
                }


                /*
                | XEM = +1
                */

                foreach ($viewHistories as $history) {

                    if (!$history->place) {
                        continue;
                    }


                    $provinceId =
                        $history->place->province_id;


                    $provinceScores[$provinceId] =
                        ($provinceScores[$provinceId] ?? 0)
                        + 1;


                    $provinceLastActivity[$provinceId] =
                        max(
                            $provinceLastActivity[$provinceId] ?? 0,
                            optional(
                                $history->viewed_at
                            )->timestamp ?? 0
                        );
                }


                /*
                | YÊU THÍCH = +3
                */

                foreach ($favorites as $favorite) {

                    if (!$favorite->place) {
                        continue;
                    }


                    $provinceId =
                        $favorite->place->province_id;


                    $provinceScores[$provinceId] =
                        ($provinceScores[$provinceId] ?? 0)
                        + 3;


                    $provinceLastActivity[$provinceId] =
                        max(
                            $provinceLastActivity[$provinceId] ?? 0,
                            optional(
                                $favorite->created_at
                            )->timestamp ?? 0
                        );
                }


                /*
                | ĐÁNH GIÁ = +2
                */

                foreach ($ratings as $rating) {

                    if (!$rating->place) {
                        continue;
                    }


                    $provinceId =
                        $rating->place->province_id;


                    $provinceScores[$provinceId] =
                        ($provinceScores[$provinceId] ?? 0)
                        + 2;


                    $provinceLastActivity[$provinceId] =
                        max(
                            $provinceLastActivity[$provinceId] ?? 0,
                            optional(
                                $rating->created_at
                            )->timestamp ?? 0
                        );
                }


                /*
                | SẮP XẾP:
                | điểm cao trước
                | nếu bằng điểm → hoạt động gần nhất trước
                */

                $provinceIds =
                    array_keys($provinceScores);


                usort(
                    $provinceIds,
                    function ($a, $b)
                    use (
                        $provinceScores,
                        $provinceLastActivity
                    ) {

                        $scoreA =
                            $provinceScores[$a] ?? 0;

                        $scoreB =
                            $provinceScores[$b] ?? 0;


                        if ($scoreA !== $scoreB) {

                            return $scoreB <=> $scoreA;
                        }


                        return
                            ($provinceLastActivity[$b] ?? 0)
                            <=>
                            ($provinceLastActivity[$a] ?? 0);
                    }
                );


                $topProvinceIds =
                    array_slice(
                        $provinceIds,
                        0,
                        3
                    );


                /*
                | 3 - 2 - 1
                */

                $limits = [3, 2, 1];


                $viewedPlaceIds =
                    $viewHistories
                        ->pluck('place_id')
                        ->filter()
                        ->unique();


                foreach (
                    $topProvinceIds
                    as $index => $provinceId
                ) {

                    $limit =
                        $limits[$index] ?? 1;


                    // Ưu tiên nơi chưa xem
                    $places = Place::with('province')
                        ->where('status', 'active')
                        ->where(
                            'province_id',
                            $provinceId
                        )
                        ->whereNotIn(
                            'id',
                            $viewedPlaceIds
                        )
                        ->orderByDesc('view_count')
                        ->limit($limit)
                        ->get();


                    // Nếu tỉnh đó chưa đủ số lượng
                    if ($places->count() < $limit) {

                        $missing =
                            $limit - $places->count();


                        $extraPlaces = Place::with('province')
                            ->where('status', 'active')
                            ->where(
                                'province_id',
                                $provinceId
                            )
                            ->whereNotIn(
                                'id',
                                $places->pluck('id')
                            )
                            ->orderByDesc('view_count')
                            ->limit($missing)
                            ->get();


                        $places =
                            $places->concat(
                                $extraPlaces
                            );
                    }


                    $recommendedPlaces =
                        $recommendedPlaces
                            ->concat($places);
                }

            }


            /*
            |--------------------------------------------------------------------------
            | TRƯỜNG HỢP 2:
            | USER MỚI → DỰA VÀO TÌM KIẾM PHỔ BIẾN TOÀN HỆ THỐNG
            |--------------------------------------------------------------------------
            */

            else {

                $recommendationMode = 'popular';


                /*
                | Top 10 keyword toàn hệ thống
                */

                $popularKeywords = SearchHistory::query()
                    ->select(
                        'keyword',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('keyword')
                    ->orderByDesc('total')
                    ->limit(10)
                    ->get();


                $popularProvinceScores = [];

                $directPlaceIds = [];


                foreach ($popularKeywords as $search) {

                    $keyword =
                        $this->normalizeVietnamese(
                            $search->keyword
                        );


                    /*
                    | Keyword là tỉnh
                    */

                    $matchedProvince =
                        $allProvinces
                            ->first(
                                function ($province)
                                use ($keyword) {

                                    return
                                        $this->normalizeVietnamese(
                                            $province->name
                                        ) === $keyword;

                                }
                            );


                    if ($matchedProvince) {

                        $provinceId =
                            $matchedProvince->id;


                        $popularProvinceScores[$provinceId] =
                            ($popularProvinceScores[$provinceId] ?? 0)
                            + $search->total;


                        continue;
                    }


                    /*
                    | Keyword là địa điểm
                    */

                    $matchedPlace =
                        $allPlaces
                            ->first(
                                function ($place)
                                use ($keyword) {

                                    return
                                        $this->normalizeVietnamese(
                                            $place->name
                                        ) === $keyword;

                                }
                            );


                    if ($matchedPlace) {

                        /*
                        | Ưu tiên chính địa điểm
                        | đang được tìm nhiều
                        */

                        $directPlaceIds[] =
                            $matchedPlace->id;


                        /*
                        | Đồng thời cộng điểm
                        | cho tỉnh chứa địa điểm
                        */

                        $provinceId =
                            $matchedPlace->province_id;


                        $popularProvinceScores[$provinceId] =
                            ($popularProvinceScores[$provinceId] ?? 0)
                            + $search->total;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | ƯU TIÊN CÁC ĐỊA ĐIỂM ĐƯỢC TÌM TRỰC TIẾP
                |--------------------------------------------------------------------------
                */

                if (!empty($directPlaceIds)) {

                    $directPlaces =
                        Place::with('province')
                            ->where('status', 'active')
                            ->whereIn(
                                'id',
                                array_unique(
                                    $directPlaceIds
                                )
                            )
                            ->get();


                    /*
                    | Giữ đúng thứ tự phổ biến
                    */

                    $directPlaces =
                        $directPlaces
                            ->sortBy(
                                function ($place)
                                use ($directPlaceIds) {

                                    return array_search(
                                        $place->id,
                                        $directPlaceIds
                                    );
                                }
                            );


                    $recommendedPlaces =
                        $recommendedPlaces
                            ->concat(
                                $directPlaces
                            );
                }


                /*
                |--------------------------------------------------------------------------
                | LẤY CÁC TỈNH ĐƯỢC TÌM NHIỀU
                |--------------------------------------------------------------------------
                */

                arsort(
                    $popularProvinceScores
                );


                $topProvinceIds =
                    array_slice(
                        array_keys(
                            $popularProvinceScores
                        ),
                        0,
                        3
                    );


                foreach ($topProvinceIds as $provinceId) {

                    /*
                    | Chỉ lấy phần còn thiếu
                    | để tổng tối đa là 6
                    */

                    $missing =
                        6
                        - $recommendedPlaces->count();


                    if ($missing <= 0) {
                        break;
                    }


                    $places =
                        Place::with('province')
                            ->where('status', 'active')
                            ->where(
                                'province_id',
                                $provinceId
                            )
                            ->whereNotIn(
                                'id',
                                $recommendedPlaces
                                    ->pluck('id')
                            )
                            ->orderByDesc(
                                'view_count'
                            )
                            ->limit($missing)
                            ->get();


                    $recommendedPlaces =
                        $recommendedPlaces
                            ->concat($places);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | LOẠI TRÙNG
            |--------------------------------------------------------------------------
            */

            $recommendedPlaces =
                $recommendedPlaces
                    ->unique('id')
                    ->take(6)
                    ->values();


            /*
            |--------------------------------------------------------------------------
            | NẾU VẪN CHƯA ĐỦ 6
            | → BÙ BẰNG ĐỊA ĐIỂM CÓ VIEW CAO
            |--------------------------------------------------------------------------
            */

            if ($recommendedPlaces->count() < 6) {

                $missing =
                    6
                    - $recommendedPlaces->count();


                $extraPlaces =
                    Place::with('province')
                        ->where('status', 'active')
                        ->whereNotIn(
                            'id',
                            $recommendedPlaces
                                ->pluck('id')
                        )
                        ->orderByDesc(
                            'view_count'
                        )
                        ->limit($missing)
                        ->get();


                $recommendedPlaces =
                    $recommendedPlaces
                        ->concat($extraPlaces)
                        ->unique('id')
                        ->take(6)
                        ->values();
            }
        }


        return view(
            'home',
            compact(
                'provinces',
                'searchPlaces',
                'featuredPlaces',
                'popularPlaces',
                'categories',
                'recommendedPlaces',
                'recommendationMode'
            )
        );
    }

    public function search(Request $request)
    {
        $request->validate([
            'province' => 'required|string|max:255',
        ]);

        $keyword = $this->normalizeVietnamese(
            $request->province
        );

        if (mb_strlen($keyword) < 3) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Vui lòng nhập ít nhất 3 ký tự để tìm kiếm.'
                );
        }


        if (auth()->check()) {

            SearchHistory::create([
                'user_id' => auth()->id(),
                'keyword' => trim($request->province),
                'searched_at' => now(),
            ]);

        }


        // =====================================
        // TÌM KẾT QUẢ CHÍNH XÁC
        // =====================================

        $province = Province::all()->first(
            function ($province) use ($keyword) {

                return $this->normalizeVietnamese(
                    $province->name
                ) === $keyword;
            }
        );


        if ($province) {

            return redirect(
                '/provinces/' . $province->slug
            );
        }


        $place = Place::where('status', 'active')
            ->get()
            ->first(
                function ($place) use ($keyword) {

                    return $this->normalizeVietnamese(
                        $place->name
                    ) === $keyword;
                }
            );


        if ($place) {

            return redirect()->route(
                'places.show',
                $place->slug
            );
        }


        // =====================================
        // KHÔNG CHÍNH XÁC
        // → CHUYỂN SANG TRANG KẾT QUẢ
        // =====================================

        return redirect()->route(
            'search.results',
            [
                'q' => $request->province
            ]
        );
    }


    public function results(Request $request)
    {
        $request->validate([
            'q' => 'required|string|max:255',
        ]);

        $originalKeyword = trim($request->q);

        $keyword = $this->normalizeVietnamese(
            $originalKeyword
        );


        if (mb_strlen($keyword) < 3) {

            return redirect('/')
                ->with(
                    'error',
                    'Vui lòng nhập ít nhất 3 ký tự để tìm kiếm.'
                );
        }


        if (auth()->check()) {

            SearchHistory::create([
                'user_id' => auth()->id(),
                'keyword' => $originalKeyword,
                'searched_at' => now(),
            ]);

        }


        // =====================================
        // TÌM TỈNH / THÀNH
        // =====================================

        $provinces = Province::all()
            ->filter(
                function ($province) use ($keyword) {

                    return str_contains(
                        $this->normalizeVietnamese(
                            $province->name
                        ),
                        $keyword
                    );
                }
            )
            ->values();


        // =====================================
        // TÌM ĐỊA ĐIỂM
        // =====================================

        $selectedCategoryIds =
            $request->input('categories', []);

        if (!is_array($selectedCategoryIds)) {
            $selectedCategoryIds = [];
        }


        $placesQuery = Place::with([
                'province',
                'categories'
            ])
            ->where('status', 'active')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings');


        /*
        |--------------------------------------------------------------------------
        | LỌC LOẠI HÌNH
        |--------------------------------------------------------------------------
        */

        if (!empty($selectedCategoryIds)) {

            $placesQuery->whereHas(
                'categories',
                function ($query)
                use ($selectedCategoryIds) {

                    $query->whereIn(
                        'categories.id',
                        $selectedCategoryIds
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LỌC GIÁ VÉ
        |--------------------------------------------------------------------------
        */

        if ($request->filled('price')) {

            switch ($request->price) {

                case 'free':

                    $placesQuery->where(
                        'ticket_price',
                        0
                    );

                    break;


                case 'under_100':

                    $placesQuery
                        ->where(
                            'ticket_price',
                            '>',
                            0
                        )
                        ->where(
                            'ticket_price',
                            '<',
                            100000
                        );

                    break;


                case '100_300':

                    $placesQuery->whereBetween(
                        'ticket_price',
                        [
                            100000,
                            300000
                        ]
                    );

                    break;


                case 'over_300':

                    $placesQuery->where(
                        'ticket_price',
                        '>',
                        300000
                    );

                    break;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | LỌC ĐÁNH GIÁ
        |--------------------------------------------------------------------------
        */

        if ($request->filled('rating')) {

            $rating = (int) $request->rating;

            if ($rating >= 1 && $rating <= 5) {

                $placesQuery
                    ->having(
                        'ratings_avg_rating',
                        '>=',
                        $rating
                    )
                    ->having(
                        'ratings_avg_rating',
                        '<',
                        $rating + 1
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | LẤY DỮ LIỆU
        |--------------------------------------------------------------------------
        */

        $places = $placesQuery
            ->get()
            ->filter(
                function ($place)
                use ($keyword) {

                    return str_contains(
                        $this->normalizeVietnamese(
                            $place->name
                        ),
                        $keyword
                    );
                }
            )
            ->values();


        $categories = Category::orderBy('name')->get();


        return view(
            'search.results',
            compact(
                'originalKeyword',
                'provinces',
                'places',
                'categories',
                'selectedCategoryIds'
            )
        );
    }


    private function normalizeVietnamese(string $text): string
    {
        $text = mb_strtolower(
            trim($text),
            'UTF-8'
        );

        $characters = [
            'à' => 'a',
            'á' => 'a',
            'ạ' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ầ' => 'a',
            'ấ' => 'a',
            'ậ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ă' => 'a',
            'ằ' => 'a',
            'ắ' => 'a',
            'ặ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',

            'è' => 'e',
            'é' => 'e',
            'ẹ' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ê' => 'e',
            'ề' => 'e',
            'ế' => 'e',
            'ệ' => 'e',
            'ể' => 'e',
            'ễ' => 'e',

            'ì' => 'i',
            'í' => 'i',
            'ị' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',

            'ò' => 'o',
            'ó' => 'o',
            'ọ' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ồ' => 'o',
            'ố' => 'o',
            'ộ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ơ' => 'o',
            'ờ' => 'o',
            'ớ' => 'o',
            'ợ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',

            'ù' => 'u',
            'ú' => 'u',
            'ụ' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ư' => 'u',
            'ừ' => 'u',
            'ứ' => 'u',
            'ự' => 'u',
            'ử' => 'u',
            'ữ' => 'u',

            'ỳ' => 'y',
            'ý' => 'y',
            'ỵ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',

            'đ' => 'd',
        ];

        return strtr(
            $text,
            $characters
        );
    }
}