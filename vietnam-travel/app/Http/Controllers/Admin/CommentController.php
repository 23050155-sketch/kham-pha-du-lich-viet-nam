<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::query()
            ->with([
                'user',
                'place',
                'parent',
            ])
            ->withCount('replies');

        // Tìm theo nội dung bình luận,
        // tên người dùng hoặc địa điểm
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where(
                    'content',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );
                })
                ->orWhereHas('place', function ($placeQuery) use ($search) {
                    $placeQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );
                });
            });
        }

        // Lọc loại bình luận
        if ($request->type === 'root') {
            $query->whereNull('parent_id');
        }

        if ($request->type === 'reply') {
            $query->whereNotNull('parent_id');
        }

        $comments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.comments.index',
            compact('comments')
        );
    }



    public function destroy(Comment $comment)
    {
        try {

            /*
            |--------------------------------------------------------------------------
            | Nếu là bình luận chính
            | Xóa các phản hồi trước
            |--------------------------------------------------------------------------
            */

            if (is_null($comment->parent_id)) {
                $comment->replies()->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Xóa bình luận
            |--------------------------------------------------------------------------
            */

            $comment->delete();

            return redirect()
                ->route('admin.comments.index')
                ->with(
                    'success',
                    'Xóa bình luận thành công!'
                );

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('admin.comments.index')
                ->with(
                    'error',
                    'Không thể xóa bình luận. Vui lòng thử lại.'
                );
        }
    }
}