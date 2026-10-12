<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Place;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // ==============================
        // THỐNG KÊ TỔNG QUAN
        // ==============================

        
        $totalPlaces = Place::count();
        $totalProvinces = Province::count();
        $categoryCount = Category::count();
        $totalUsers = User::count();
        $commentCount = Comment::count();
        $ratingCount = Rating::count();
        $totalSearches = SearchHistory::count();

        $uniqueSearchKeywords = SearchHistory::query()
            ->distinct()
            ->count('keyword');

        $topSearches = SearchHistory::query()
            ->select(
                'keyword',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('keyword')
            ->orderByDesc('total')
            ->limit(5)
            ->get();


        // ==============================
        // TOP 5 TỈNH CÓ LƯỢT XEM CAO NHẤT
        // ==============================

        $topViewedProvinces = Province::query()
            ->leftJoin('places', 'provinces.id', '=', 'places.province_id')
            ->select(
                'provinces.id',
                'provinces.name',
                DB::raw('COALESCE(SUM(places.view_count), 0) as total_views')
            )
            ->groupBy(
                'provinces.id',
                'provinces.name'
            )
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();


        // ==============================
        // TOP 5 TỈNH ĐƯỢC YÊU THÍCH
        // ==============================

        $topFavoriteProvinces = Province::query()
            ->leftJoin('places', 'provinces.id', '=', 'places.province_id')
            ->leftJoin('favorites', 'places.id', '=', 'favorites.place_id')
            ->select(
                'provinces.id',
                'provinces.name',
                DB::raw('COUNT(favorites.id) as total_favorites')
            )
            ->groupBy(
                'provinces.id',
                'provinces.name'
            )
            ->orderByDesc('total_favorites')
            ->limit(5)
            ->get();


        // ==============================
        // TOP 5 TỈNH CÓ NHIỀU ĐÁNH GIÁ
        // ==============================

        $topRatedProvinces = Province::query()
            ->leftJoin('places', 'provinces.id', '=', 'places.province_id')
            ->leftJoin('ratings', 'places.id', '=', 'ratings.place_id')
            ->select(
                'provinces.id',
                'provinces.name',
                DB::raw('COUNT(ratings.id) as total_ratings')
            )
            ->groupBy(
                'provinces.id',
                'provinces.name'
            )
            ->orderByDesc('total_ratings')
            ->limit(5)
            ->get();


        return view('admin.dashboard', compact(
            'totalPlaces',
            'totalProvinces',
            'categoryCount',
            'totalUsers',
            'commentCount',
            'ratingCount',
            'totalSearches',
            'uniqueSearchKeywords',
            'topSearches',
            'topViewedProvinces',
            'topFavoriteProvinces',
            'topRatedProvinces'
        ));
    }
}