<x-template title="Buat Artikel">
    <div class="container">
        <form method="post" class="was-validated" enctype="multipart/form-data">
            @csrf
            @isset($article)
                <x-form.group for="slug" label="{{ __('article.slug') }}">
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') ?? $article->slug ?? '' }}" required @readonly(!$allow_edit_slug)>
                </x-form.group>
            @endisset
            <x-form.group for="title" label="{{ __('article.title') }}">
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $article->title ?? '' }}" required>
            </x-form.group>
            <x-form.group for="content" label="{{ __('article.content') }}">
                <textarea name="content" id="content" class="form-control" required>{{ old('content') ?? $article->content ?? '' }}</textarea>
            </x-form.group>
            <x-form.group for="article_category_id" label="{{ __('article.category') }}">
                <select class="form-select" name="article_category_id" id="article_category_id" required>
                    @foreach($article_categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == (old('article_category_id') ?? $article->article_category_id ?? ''))>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </x-form.group>
            <x-form.group for="image" label="Gambar">
                <input type="file" name="image" accept="image/*" id="image" class="form-control">
            </x-form.group>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-template>
