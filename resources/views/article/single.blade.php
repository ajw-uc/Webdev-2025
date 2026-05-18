<x-template>
    <div class="container">
        <div class="mb-3 text-end">
            <a href="{{ route('article.list') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
        <h1>
            {{ $article->title }}
        </h1>
        <h5 class="mb-2 text-body-secondary">
            {{ $article->updated_at }}
        </h5>
        <p>
            {{ $article->content }}
        </p>
    </div>
</x-template>
