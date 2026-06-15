<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleComment;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class ArticleController extends Controller
{
    function list(Request $request)
    {
        // $articles = Article::with('category')->paginate(20);
        // $articles = Article::with('category')->simplePaginate(20);

        $articles = Article::where(function($query) use ($request) {
            $query->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('content', 'like', '%'.$request->search.'%');
        })->with('category')->paginate(20)->withQueryString();


        return view('article.list', [
            'articles' => $articles
        ]);
    }

    function create(Request $request)
    {
        $articleCategories = $request->articleCategories;

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => ['required', 'string', 'max:255', Rule::unique('articles')],
                'content' => ['required', 'string', 'max:2000'],
                'article_category_id' => ['required', 'integer', Rule::in($articleCategories->pluck('id'))]
            ]);

            $slug = Str::slug($request->title);
            if (Article::where('slug', $slug)->exists()) $slug .= '-'.uniqid();

            $article = Article::create([
                'slug' => $slug,
                'title' => $request->title,
                'content' => $request->content,
                'article_category_id' => $request->article_category_id,
                'user_id' => $request->user()->id,
                'image' => [File::image()->max('10mb')]
            ]);

            if ($article) {
                if ($request->file('image')) {
                    $image = $request->file('image');
                    // store ke public disk, supaya bisa diakses melalui web browser
                    $path = $image->storeAs('articles', $article->id. '.' . $image->getClientOriginalExtension(), 'public');
                    $article->image = $path;
                    $article->save();
                }

                return redirect()->route('article.list')
                    ->withSuccess(__('article.success', ['name' => $article->title]));
            }

            return back()->withInput()
                ->withErrors([
                    'alert' => 'Gagal menyimpan artikel'
                ]);
        }

        return view('article.form', [
            'article_categories' => ArticleCategory::orderBy('name')->get()
        ]);
    }

    function single(string $slug, Request $request)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('article.single', [
            'article' => $article
        ]);
    }

    function edit(string $id, Request $request)
    {
        $article = Article::where('id', $id)->firstOrFail();

        Gate::authorize('update', $article);

        $articleCategories = $request->articleCategories;

        if ($request->isMethod('post')) {
            $request->validate([
                'slug' => ['required', 'string', Rule::unique('articles')->ignore($article->id)],
                'title' => ['required', 'string', 'max:255', Rule::unique('articles')->ignore($article->id)],
                'content' => ['required', 'string', 'max:2000'],
                'article_category_id' => ['required', 'integer', Rule::in($articleCategories->pluck('id'))],
                'image' => [File::image()->max('10mb')]
            ]);

            $article->slug = $request->slug;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->article_category_id = $request->article_category_id;
            $article->save();

            if ($article) {
                // hapus image lama
                if ($article->image) {
                    // hapus image dari public disk storage
                    Storage::disk('public')->delete($article->image);
                }

                // upload image baru
                if ($request->file('image')) {
                    $filename = $article->id . '.' . $request->file('image')->getClientOriginalExtension();
                    // store ke public disk, supaya bisa diakses melalui web browser
                    $path = $request->file('image')->storeAs('articles', $filename, 'public');
                    $article->image = $path;
                    $article->save();
                }

                return redirect()->route('article.single', ['slug' => $article->slug])
                    ->withSuccess(__('article.success', ['name' => $article->title]));
            }

            return back()->withInput()
                ->withErrors([ 'alert' => 'Gagal menyimpan artikel' ]);
        }

        return view('article.form', [
            'article' => $article,
            'article_categories' => ArticleCategory::orderBy('name')->get(),
            'allow_edit_slug' => Gate::allows('isAdmin')
        ]);
    }

    function delete(string $id, Request $request)
    {
        Gate::authorize('isAdmin');

        // cek akses user author lain
        // $user = User::where('role', UserRoleEnum::Author->value)->first();
        // if (Gate::forUser($user)->allows('isAdmin')) {
        //     return abort(403, 'Hanya admin yang bisa mengubah artikel');
        // }

        $article = Article::where('id', $id)->firstOrFail();

        $image = $article->image;

        if ($article->delete()) {
            if ($image) {
                // hapus image dari public disk storage
                Storage::disk('public')->delete($image);
            }
            return redirect()->route('article.list')
                ->withSuccess('Artikel telah dihapus');
        }

        return back()->withInput()
            ->withErrors([ 'alert' => 'Gagal menghapus artikel' ]);
    }

    function comment(string $id, Request $request)
    {
        $article = Article::where('id', $id)->firstOrFail();

        $request->validate([
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        $comment = ArticleComment::create([
            'article_id' => $article->id,
            'content' => $request->comment,
            'user_id' => $request->user()->id
        ]);

        if ($comment) {
            return redirect()->route('article.single', ['slug' => $article->slug])
                ->withSuccess('Komentar berhasil ditambahkan');
        }

        return back()->withInput()
            ->withErrors([ 'message' => 'Gagal menambahkan komentar' ]);
    }
}
