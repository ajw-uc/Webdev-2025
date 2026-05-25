<x-template title="Buat Artikel">
    <div class="container">
        <form method="post" class="was-validated">
            @csrf
            @isset($article)
                <x-form.group for="slug" label="Slug">
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') ?? $article->slug ?? '' }}" required>
                </x-form.group>
            @endisset
            <x-form.group for="title" label="Judul">
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $article->title ?? '' }}" required>
            </x-form.group>
            <x-form.group for="content" label="Isi">
                <textarea name="content" id="content" class="form-control" required>{{ old('content') ?? $article->content ?? '' }}</textarea>
            </x-form.group>
            <x-form.group for="article_category_id" label="Kategori">
                <select class="form-select" name="article_category_id" id="article_category_id" required>
                    @foreach($article_categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == (old('article_category_id') ?? $article->article_category_id ?? ''))>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </x-form.group>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-template>
