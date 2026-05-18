<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/articles', [ArticleController::class, 'list']);
// Route::get('/articles/create', [ArticleController::class, 'create']);
// Route::post('/articles/create', [ArticleController::class, 'create']);

Route::controller(ArticleController::class)->group(function()
{
    Route::get('/articles', 'list')->name('article.list');
    Route::match(['get', 'post'], '/articles/create', 'create')->name('article.create');
    Route::get('/articles/{slug}', 'single')->name('article.single');
});
