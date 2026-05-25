<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    function list(Request $request)
    {
        $categories = ArticleCategory::get();

        return view('article_category.list', [
            'categories' => $categories
        ]);
    }

    function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $article = ArticleCategory::create([
                'name' => $request->name,
            ]);

            if ($article) {
                return redirect()->route('article_category.list')
                    ->withSuccess('Kategori berhasil dibuat');
            }

            return back()->withInput()
                ->withErrors([
                    'alert' => 'Gagal menyimpan kategori'
                ]);
        }

        return view('article_category.form');
    }

    function edit(string $id, Request $request)
    {
        $category = ArticleCategory::where('id', $id)->firstOrFail();

        if ($request->isMethod('post')) {
            $category->name = $request->name;
            $category->save();

            if ($category) {
                return redirect()->route('article_category.list')
                    ->withSuccess('Kategori berhasil diubah');
            }

            return back()->withInput()
                ->withErrors([ 'alert' => 'Gagal menyimpan kategori' ]);
        }

        return view('article_category.form', [
            'category' => $category
        ]);
    }

    function delete(string $id, Request $request)
    {
        $category = ArticleCategory::where('id', $id)->firstOrFail();

        if ($category->delete()) {
            return redirect()->route('article_category.list')
                ->withSuccess('Kategori telah dihapus');
        }

        return back()->withInput()
            ->withErrors([ 'alert' => 'Gagal menghapus artikel' ]);
    }
}
