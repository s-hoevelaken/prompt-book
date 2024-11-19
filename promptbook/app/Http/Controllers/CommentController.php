<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        
        Log::info('we made it to the controller');
        Log::info('Request is:', ['request' => $request->all()]);


        $validated = $request->validated();

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'prompt_id' => $validated['prompt_id'],
            'content' => $validated['content'],
            'parent_id' => $request->input('parent_id')
        ]);

        return response()->json(['message' => 'Comment added successfully', 'comment' => $comment]);
    }

    public function toggleLike($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $user = Auth::user();

        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Comment unliked successfully']);
        } else {
            $comment->likes()->create(['user_id' => $user->id]);
            return response()->json(['message' => 'Comment liked successfully']);
        }
    }

    public function getComments($promptId)
    {
        $comments = Comment::where('prompt_id', $promptId)
            ->whereNull('parent_id')
            ->with(['replies', 'user', 'likes'])
            ->get();

        return response()->json(['comments' => $comments]);
    }
}
