<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Category;

class ProvinceController extends Controller
{
    public function show(Request $request, string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | LẤY DANH MỤC ĐƯỢC CHỌN
        |--------------------------------------------------------------------------
        */

        $selectedCategoryIds =
            $request->input('categories', []);

        if (!is_array($selectedCategoryIds)) {
            $selectedCategoryIds = [];
        }


        /*
        |--------------------------------------------------------------------------
        | HỖ TRỢ CATEGORY CŨ
        | Ví dụ: ?category=3
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $categoryId =
                (int) $request->category;

            if (
                !in_array(
                    $categoryId,
                    array_map(
                        'intval',
                        $selectedCategoryIds
                    )
                )
            ) {
                $selectedCategoryIds[] =
                    $categoryId;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | LẤY TỈNH
        |--------------------------------------------------------------------------
        */

        $province = Province::with([
                'places' => function ($query)
                use (
                    $request,
                    $selectedCategoryIds
                ) {

                    $query
                        ->where(
                            'status',
                            'active'
                        )
                        ->withAvg(
                            'ratings',
                            'rating'
                        )
                        ->withCount(
                            'ratings'
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | TRẠNG THÁI YÊU THÍCH
                    |--------------------------------------------------------------------------
                    */

                    if (auth()->check()) {

                        $query->withExists([
                            'favorites as is_favorite'
                            => function ($query) {

                                $query->where(
                                    'user_id',
                                    auth()->id()
                                );
                            }
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | LỌC NHIỀU LOẠI HÌNH
                    |--------------------------------------------------------------------------
                    */

                    if (!empty($selectedCategoryIds)) {

                        $query->whereHas(
                            'categories',
                            function ($categoryQuery)
                            use ($selectedCategoryIds) {

                                $categoryQuery->whereIn(
                                    'categories.id',
                                    $selectedCategoryIds
                                );
                            }
                        );
                    }



                    /*
                    |--------------------------------------------------------------------------
                    | LỌC THEO GIÁ VÉ
                    |--------------------------------------------------------------------------
                    */

                    if ($request->filled('price')) {

                        switch ($request->price) {

                            case 'free':

                                $query->where(
                                    'ticket_price',
                                    0
                                );

                                break;


                            case 'under_100':

                                $query
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

                                $query->whereBetween(
                                    'ticket_price',
                                    [
                                        100000,
                                        300000
                                    ]
                                );

                                break;


                            case 'over_300':

                                $query->where(
                                    'ticket_price',
                                    '>',
                                    300000
                                );

                                break;
                        }
                    }



                    /*
                |--------------------------------------------------------------------------
                | LỌC THEO ĐÁNH GIÁ
                |--------------------------------------------------------------------------
                */

                if ($request->filled('rating')) {

                    $rating = (int) $request->rating;

                    if ($rating >= 1 && $rating <= 5) {

                        $query
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
                    | MIỄN PHÍ
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $request->filter ===
                        'free'
                    ) {

                        $query->where(
                            'ticket_price',
                            0
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ĐÁNH GIÁ CAO
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $request->filter ===
                        'rating'
                    ) {

                        $query->orderByDesc(
                            'ratings_avg_rating'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PHỔ BIẾN
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $request->filter ===
                        'popular'
                    ) {

                        $query->orderByDesc(
                            'view_count'
                        );
                    }

                }
            ])
            ->where(
                'slug',
                $slug
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | DANH SÁCH CATEGORY
        |--------------------------------------------------------------------------
        */

        $categories =
            Category::orderBy('name')
                ->get();


        return view(
            'provinces.show',
            compact(
                'province',
                'categories',
                'selectedCategoryIds'
            )
        );
    }
}