<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Category;
use Illuminate\Http\Request;


class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Province::query();



        $categories = Category::orderBy('name')->get();

        $selectedCategoryIds = $request->input('categories', []);

        if (!is_array($selectedCategoryIds)) {
            $selectedCategoryIds = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Nếu đi từ Home bằng ?category=ID
        | thì đưa category đó vào danh sách nhiều lựa chọn
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('category') &&
            !in_array(
                (int) $request->category,
                array_map('intval', $selectedCategoryIds)
            )
        ) {
            $selectedCategoryIds[] =
                (int) $request->category;
        }
        


        // Tìm kiếm tên tỉnh / thành phố
        if ($request->filled('search')) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }


        // Lọc theo Tỉnh / Thành phố
        if ($request->filled('type')) {

            $query->where(
                'administrative_type',
                $request->type
            );
        }


        // Nếu chọn sở thích / category
        if (!empty($selectedCategoryIds)) {

            $query->whereHas(
                'places',
                function ($placeQuery)
                use ($selectedCategoryIds) {

                    $placeQuery
                        ->where('status', 'active')
                        ->whereHas(
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
            );
        }


        // Đếm số địa điểm phù hợp của từng tỉnh
        $query->withCount([
            'places' => function ($placeQuery)
            use ($selectedCategoryIds) {

                $placeQuery->where(
                    'status',
                    'active'
                );


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

            }
        ]);


        $provinces = $query
            ->orderBy('name')
            ->get();


        // Category đang chọn
        $selectedCategory = null;

        if ($request->filled('category')) {

            $selectedCategory = Category::find(
                $request->category
            );

        }


        return view(
            'explore.index',
            compact(
                'provinces',
                'selectedCategory',
                'categories',
                'selectedCategoryIds'
            )
        );
    }
}