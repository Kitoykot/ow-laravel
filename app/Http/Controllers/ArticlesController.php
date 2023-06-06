<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only([
            "createArticle",
            "deleteArticle",
            "publicArticle",
            "updateArticle"
        ]);
    }

    public function createArticle(Request $request)
    {
        $request->validate([
            "title" => ["required" ,"string", "max:255"],
            "short" => ["required", "max:500"],
            "category_id" => ["integer"],
            "body" => ["required", "string"],
            "image" => ["required", "mimes:png,jpg,jpeg", "max:5000"]
        ]);

        $path = "/storage/" . $request->image->store("images", "public");

        Article::create([
            "title" => $request->title,
            "short" => $request->short,
            "category_id" => $request->category_id,
            "body" => $request->body,
            "image" => $path,
            "user_id" => Auth::user()->id,
        ]);

        return redirect()->route("my-articles");
    }

    public function deleteArticle(Request $request)
    {
        $article = Article::find($request->id);

        if(!$article)
        {
            return abort(404);
        }

        if($article->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-articles");
        }

        $image = public_path() . $article->image;
        unlink($image);

        $article->delete();

        return redirect()->route("my-articles");
    }

    public function publicArticle(Request $request)
    {
        $article = Article::find($request->id);

        if(!$article)
        {
            return abort(404);
        }

        if($article->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-articles");
        }

        $article->public = (int)$article->public == 1 ? 0 : 1;

        $article->save();

        return redirect()->route("my-articles");
    }

    public function updateArticle(Request $request)
    {
        $article = Article::find($request->id);

        if(!$article)
        {
            return abort(404);
        }

        if($article->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-articles");
        }

        $request->validate([
            "title" => ["required" ,"string", "max:255"],
            "short" => ["required", "max:500"],
            "category_id" => ["integer"],
            "body" => ["required", "string"],
            "image" => ["mimes:png,jpg,jpeg", "max:5000"]
        ]);

        $article->title = $request->title;
        $article->short = $request->short;
        $article->category_id = $request->category_id;
        $article->body = $request->body;

        if($request->hasFile('image'))
        {
            $image = public_path() . $article->image;
            unlink($image);

            $path = "/storage/" . $request->image->store("images", "public");
            $article->image = $path;
        }

        $article->save();

        return redirect()->route("one-article", $article->id);
    }
}
