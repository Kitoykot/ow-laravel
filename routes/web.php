<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;

Auth::routes();

Route::get("/", [PagesController::class, "mainPage"])->name("main");
Route::get("/profile/{id}", [PagesController::class, "profilePage"])->name("profile");
Route::get("/profile-settings", [PagesController::class, "profileSettings"])->name("profile-settings");

    //Обновление профиля
    Route::post("/update-profile", [UsersController::class, "updateProfile"])->name("update-profile");

    //Удаление фотографии профиля
    Route::post("/delete-avatar", [UsersController::class, "deleteAvatar"])->name("delete-avatar");

Route::get("/my-articles", [PagesController::class, "myArticles"])->name("my-articles");
Route::get("/add-article", [PagesController::class, "addArticle"])->name("add-article");

    //Добавление статьи
    Route::post("/create-article", [ArticlesController::class, "createArticle"])->name("create-article");

    //Удаление и обновление статьи
    Route::post("/delete-article", [ArticlesController::class, "deleteArticle"])->name("delete-article");
    Route::post("/update", [ArticlesController::class, "updateArticle"])->name("update");

    //Снять с публикации и опубликовать статью
    Route::post("/public-article", [ArticlesController::class, "publicArticle"])->name("public-article");

Route::get("/update-article/{id}", [PagesController::class, "updateArticle"])->name("update-article");

Route::get("/article/{id}", [PagesController::class, "oneArticle"])->name("one-article");
Route::get("/user-articles/{id}", [PagesController::class, "userArticles"])->name("user-articles");

    //Добавление и удаление комментариев
    Route::post("/add-comment", [CommentsController::class, "addComment"])->name("add-comment");
    Route::post("/delete-comment", [CommentsController::class, "deleteComment"])->name("delete-comment");

//Поиск
Route::get("/search", [PagesController::class, "search"])->name("search");

//Фильтр по темам
Route::get("/filter/{id}", [PagesController::class, "filter"])->name("filter");