<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\EnsureArticleCategoryExists;
use App\Http\Middleware\EnsureUserRole;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/articles', [ArticleController::class, 'list']);
// Route::get('/articles/create', [ArticleController::class, 'create']);
// Route::post('/articles/create', [ArticleController::class, 'create']);

Route::controller(ArticleController::class)->middleware(['auth', EnsureArticleCategoryExists::class])->group(function()
{
    Route::get('/articles', 'list')->name('article.list');
    Route::get('/articles/cache', 'cache');
    Route::match(['get', 'post'], '/articles/create', 'create')->name('article.create');
    Route::get('/articles/{slug}', 'single')->name('article.single');
    Route::match(['get', 'post'], '/articles/{id}/edit', 'edit')->name('article.edit');
    Route::post('/articles/{id}/delete', 'delete')->name('article.delete')->middleware('can:isAdmin');
    Route::post('/articles/{id}/comment', 'comment')->name('article.comment');
});

Route::controller(ArticleCategoryController::class)->middleware('auth')->group(function()
{
    Route::get('/article-categories', 'list')->name('article_category.list');
    Route::match(['get', 'post'], '/article-categories/create', 'create')->name('article_category.create')
        ->middleware(EnsureUserRole::class.':'.UserRoleEnum::Administrator->value);
        // ->middleware('role:'.UserRoleEnum::Administrator->value); // penggunaan middleware alias
    Route::get('/article-categories/{id}', 'single')->name('article_category.single');
    Route::match(['get', 'post'], '/article-categories/{id}/edit', 'edit')->name('article_category.edit')
        ->middleware(EnsureUserRole::class.':'.UserRoleEnum::Administrator->value);
        // ->middleware('role:'.UserRoleEnum::Administrator->value); // penggunaan middleware alias
    Route::post('/article-categories/{id}/delete', 'delete')->name('article_category.delete')
        ->middleware(EnsureUserRole::class.':'.UserRoleEnum::Administrator->value);
        // ->middleware('role:'.UserRoleEnum::Administrator->value); // penggunaan middleware alias
});

Route::controller(UserController::class)->middleware('auth')->group(function() {
    Route::get('/users', 'list')->name('user.list');
    Route::match(['get', 'post'], '/users/create', 'create')->name('user.create');
    Route::match(['get', 'post'], '/users/{id}/edit', 'edit')->name('user.edit');
    Route::post('/users/{id}/delete', 'delete')->name('user.delete');
});

Route::controller(LoginController::class)->group(function() {
    Route::match(['get', 'post'], '/login', 'form')->middleware('guest')->name('login');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(\App\Http\Controllers\NotificationController::class)->middleware('auth')->group(function() {
    Route::get('/notification', 'list')->name('notification.list');
    Route::get('/notification/{id}/read', 'read')->name('notification.read');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
