<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $query = Rating::query()
            ->with([
                'user',
                'place',
            ]);

        /*
        |--------------------------------------------------------------------------
        | TÌM KIẾM
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas(
                    'user',
                    function ($userQuery) use ($search) {
                        $userQuery->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $search . '%'
                        );
                    }
                );

                $q->orWhereHas(
                    'place',
                    function ($placeQuery) use ($search) {
                        $placeQuery->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    }
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | LỌC THEO SỐ SAO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('rating')) {

            $query->where(
                'rating',
                $request->rating
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PHÂN TRANG
        |--------------------------------------------------------------------------
        */

        $ratings = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.ratings.index',
            compact('ratings')
        );
    }



    public function destroy(Rating $rating)
    {
        try {

            $rating->delete();

            return redirect()
                ->route('admin.ratings.index')
                ->with(
                    'success',
                    'Xóa đánh giá thành công!'
                );

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('admin.ratings.index')
                ->with(
                    'error',
                    'Không thể xóa đánh giá. Vui lòng thử lại.'
                );
        }
    }
}