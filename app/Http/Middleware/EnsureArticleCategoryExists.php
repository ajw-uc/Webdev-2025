<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ArticleCategory;

class EnsureArticleCategoryExists
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $categories = ArticleCategory::orderBy('name')->get();

        if ($categories->isEmpty()) {
            return redirect()->route('article_category.list')
                ->withErrors(['alert' => 'Silahkan buat kategori artikel terlebih dahulu']);
        }

        $request->merge(['articleCategories' => $categories]);

        return $next($request);
    }
}
