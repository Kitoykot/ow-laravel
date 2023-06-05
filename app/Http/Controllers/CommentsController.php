<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only([
            "addComment",
            "deleteComment"
        ]);
    }

    public function addComment(Request $request)
    {
        $request->validate([
            "body" => ["string", "max:2000"],
            "article_id" => ["integer"]
        ]);

        Comment::create([
            "body" => $request->body,
            "user_id" => Auth::user()->id,
            "article_id" => $request->article_id
        ]);

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->id);

        if(!$comment)
        {
            return abort(404);
        }

        if($comment->user_id !== Auth::user()->id)
        {
            return redirect()->route("one-article", $comment->article_id);
        }

        $comment->delete();

        return redirect()->back();
    }
}
