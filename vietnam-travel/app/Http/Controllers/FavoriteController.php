<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Place;
use App\Models\Category;

class FavoriteController extends Controller
{
    public function toggle(Place $place)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('place_id', $place->id)
            ->first();

        if ($favorite) {
            $favorite->delete();

            session()->put(
                'favorite_success',
                'Đã bỏ địa điểm khỏi danh sách yêu thích.'
            );

            return back();
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'place_id' => $place->id,
        ]);

        session()->put(
            'favorite_success',
            'Đã thêm địa điểm vào danh sách yêu thích.'
        );

        return back();
    }


    public function index(Request $request)
    {
        $favoriteMessage =
            session()->pull('favorite_success');


        /*
        |--------------------------------------------------------------------------
        | CATEGORY ĐANG CHỌN
        |--------------------------------------------------------------------------
        */

        $selectedCategoryIds =
            $request->input('categories', []);

        if (!is_array($selectedCategoryIds)) {
            $selectedCategoryIds = [];
        }


        /*
        |--------------------------------------------------------------------------
        | QUERY FAVORITE
        |--------------------------------------------------------------------------
        */

        $favorites = Favorite::with([
                'place' => function ($query) {

                    $query
                        ->with([
                            'province',
                            'categories'
                        ])
                        ->withAvg(
                            'ratings',
                            'rating'
                        )
                        ->withCount(
                            'ratings'
                        );
                }
            ])
            ->where(
                'favorites.user_id',
                auth()->id()
            );


        /*
        |--------------------------------------------------------------------------
        | LỌC THEO ĐỊA ĐIỂM
        |--------------------------------------------------------------------------
        */

        $favorites->whereHas(
            'place',
            function ($placeQuery) use (
                $request,
                $selectedCategoryIds
            ) {

                /*
                |----------------------------
                | TÌM THEO TÊN
                |----------------------------
                */

                if ($request->filled('q')) {

                    $placeQuery->where(
                        'name',
                        'like',
                        '%' .
                        trim($request->q) .
                        '%'
                    );
                }


                /*
                |----------------------------
                | LOẠI HÌNH
                |----------------------------
                */

                if (!empty($selectedCategoryIds)) {

                    $placeQuery->whereHas(
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
                |----------------------------
                | GIÁ VÉ
                |----------------------------
                */

                if ($request->filled('price')) {

                    switch ($request->price) {

                        case 'free':

                            $placeQuery->where(
                                'ticket_price',
                                0
                            );

                            break;


                        case 'under_100':

                            $placeQuery
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

                            $placeQuery->whereBetween(
                                'ticket_price',
                                [
                                    100000,
                                    300000
                                ]
                            );

                            break;


                        case 'over_300':

                            $placeQuery->where(
                                'ticket_price',
                                '>',
                                300000
                            );

                            break;
                    }
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | MẶC ĐỊNH: MỚI LƯU TRƯỚC
        |--------------------------------------------------------------------------
        */

        $favorites
            ->latest('favorites.created_at');


        $favorites =
            $favorites->get();


        /*
        |--------------------------------------------------------------------------
        | LỌC RATING
        |--------------------------------------------------------------------------
        */

        if ($request->filled('rating')) {

            $rating =
                (int) $request->rating;

            if (
                $rating >= 1 &&
                $rating <= 5
            ) {

                $favorites =
                    $favorites
                        ->filter(
                            function ($favorite)
                            use ($rating) {

                                $average =
                                    $favorite
                                        ->place
                                        ->ratings_avg_rating;

                                return
                                    $average !== null &&
                                    $average >= $rating &&
                                    $average < $rating + 1;
                            }
                        )
                        ->values();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | PHỔ BIẾN
        |--------------------------------------------------------------------------
        */

        if ($request->filter === 'popular') {

            $favorites =
                $favorites
                    ->sortByDesc(
                        fn ($favorite) =>
                            $favorite
                                ->place
                                ->view_count
                    )
                    ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        $categories =
            Category::orderBy('name')
                ->get();


        return view(
            'favorites.index',
            compact(
                'favorites',
                'favoriteMessage',
                'categories',
                'selectedCategoryIds'
            )
        );
    }
}