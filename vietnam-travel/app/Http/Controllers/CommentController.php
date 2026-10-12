<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function store(Request $request, Place $place)
    {
        $request->validate([
            'content' => 'required|string|max:1000',

            'parent_id' => [
                'nullable',

                Rule::exists('comments', 'id')
                    ->where(function ($query) use ($place) {
                        $query->where('place_id', $place->id);
                    }),
            ],
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'place_id' => $place->id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        return back()->with(
            'comment_success',
            'Bình luận của bạn đã được đăng.'
        );
    }


    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with(
            'comment_success',
            'Bình luận đã được xóa.'
        );
    }


    
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return back()->with(
            'comment_success',
            'Bình luận đã được cập nhật.'
        );
    }
}