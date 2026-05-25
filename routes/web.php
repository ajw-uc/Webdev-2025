<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCategoryController;
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
    Route::match(['get', 'post'], '/articles/{id}/edit', 'edit')->name('article.edit');
    Route::post('/articles/{id}/delete', 'delete')->name('article.delete');
    Route::post('/articles/{id}/comment', 'comment')->name('article.comment');
});

Route::controller(ArticleCategoryController::class)->group(function()
{
    Route::get('/article-categories', 'list')->name('article_category.list');
    Route::match(['get', 'post'], '/article-categories/create', 'create')->name('article_category.create');
    Route::get('/article-categories/{id}', 'single')->name('article_category.single');
    Route::match(['get', 'post'], '/article-categories/{id}/edit', 'edit')->name('article_category.edit');
    Route::post('/article-categories/{id}/delete', 'delete')->name('article_category.delete');
});
