<?php

namespace App\Http\Controllers;

use App\Models\ViewHistory;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\SearchHistory;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = ViewHistory::with([
                'place.province'
            ])
            ->where('user_id', auth()->id())
            ->orderByDesc('viewed_at')
            ->get();


        $ratings = Rating::with([
                'place.province'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();


        $comments = Comment::with([
                'place.province'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        
        $searchHistories = SearchHistory::where(
                'user_id',
                auth()->id()
            )
            ->orderByDesc('searched_at')
            ->get();


        return view(
            'history.index',
            compact(
                'histories',
                'searchHistories',
                'ratings',
                'comments'
            )
        );
    }



    public function destroy(ViewHistory $history)
    {
        if ($history->user_id !== auth()->id()) {
            abort(403);
        }

        $history->delete();

        return back()->with(
            'success',
            'Đã xóa lịch sử xem.'
        );
    }

    
    public function clear()
    {
        ViewHistory::where(
            'user_id',
            auth()->id()
        )->delete();

        return back()->with(
            'success',
            'Đã xóa toàn bộ lịch sử xem.'
        );
    }



    public function destroySearch(SearchHistory $searchHistory)
    {
        if ($searchHistory->user_id !== auth()->id()) {
            abort(403);
        }

        $searchHistory->delete();

        return back()->with(
            'success',
            'Đã xóa lịch sử tìm kiếm.'
        );
    }


    public function clearSearches()
    {
        SearchHistory::where(
            'user_id',
            auth()->id()
        )->delete();

        return back()->with(
            'success',
            'Đã xóa toàn bộ lịch sử tìm kiếm.'
        );
    }
}