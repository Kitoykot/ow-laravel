<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only([
            "profileSettings",
            "myArticles",
            "addArticle",
            "updateArticle",
        ]);
    }

    public function mainPage()
    {
        $articles = Article::where("public", 1)->inRandomOrder()->limit(12)->get();
        $new_articles = Article::where("public", 1)->latest()->paginate(3);

        return view("home", [
            "articles" => $articles,
            "new_articles" => $new_articles
        ]);
    }

    public function profilePage($id)
    {
        $user = User::find($id);

        $articles_count = Article::where("user_id", $user->id)->where("public", 1)->count();

        if(!$user)
        {
            return abort(404);
        }

        return view("profile", [
            "user" => $user,
            "articles_count" => $articles_count
        ]);
    }

    public function profileSettings()
    {
        $users = User::where('id', Auth::user()->id)->get();

        return view("profile-settings", [
            "users" => $users
        ]);
    }

    public function myArticles()
    {
        $articles = Article::where("user_id", Auth::user()->id)->latest()->get();

        return view("my-articles", [
            "articles" => $articles
        ]);
    }

    public function addArticle()
    {   
        $categories = Category::all();

        return view("add-article", [
            "categories" => $categories
        ]);
    }

    public function updateArticle($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        $category_find = Category::find($article->category_id);

        if(!$article)
        {
            return abort(404);
        }

        if($article->user_id !== Auth::user()->id)
        {
            return redirect()->route("my-articles");
        }

        return view("update-article", [
            "article" => $article,
            "categories" => $categories,
            "category_find" => $category_find
        ]);
    }

    public function oneArticle($id)
    {
        $article = Article::find($id);
        $user = User::find($article->user_id);
        $category = Category::find($article->category_id);
        $articles_category = Article::where("category_id", $category->id)->inRandomOrder()->limit(3)->get();
        $comments = Comment::where("article_id", $article->id)->latest()->paginate(10);

        if(!$article)
        {
            return abort(404);
        }

        if($article->public !== 1)
        {
            return redirect()->route("main"); 
        }

        return view("article", [
            "article" => $article,
            "user" => $user,
            "category" => $category,
            "articles_category" => $articles_category,
            "comments" => $comments
        ]);
    }

    public function userArticles($id)
    {
        $articles = Article::where("user_id", $id)->where("public", 1)->get();

        return view("user-articles", [
            "articles" => $articles
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $articles = Article::
                        where("title", "LIKE", "%$q%")
                        ->orwhere("short", "LIKE", "%$q%")
                        ->orwhere("body", "LIKE", "%$q%")
                        ->where("public", 1)
                        ->get();

        return view("search", [
            "articles" => $articles
        ]);
    }

    public function filter($id)
    {
        $articles = Article::where("category_id", $id)->where("public", 1)->get();

        return view("filter", [
            "articles" => $articles
        ]);
    }
}
