<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Place $place)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'place_id' => $place->id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return back()->with(
            'rating_success',
            'Đánh giá của bạn đã được lưu.'
        );
    }


    public function destroy(\App\Models\Rating $rating)
    {
        if ($rating->user_id !== auth()->id()) {
            abort(403);
        }

        $rating->delete();

        return back()->with(
            'success',
            'Đã xóa đánh giá.'
        );
    }
}