<x-template title="Artikel">
    <div class="container">
        <form class="mb-3">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" value="{{ request()->query('search') }}" placeholder="Cari artikel">
                <button type="submit" class="btn btn-primary">Terapkan</button>
            </div>
        </form>
        @if (count($articles) < 10)
            <a class="btn btn-success" href="{{ route('article.create') }}">Tambah Artikel</a>
        @endif
        @foreach($articles as $article)
            <div class="card mt-3">
                <div class="card-body">
                    <a href="{{ route('article.single', ['slug' => $article->slug]) }}">
                        <h5 class="card-title">{{ $article->title }}</h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $article->updated_at }}</h6>
                    <p class="card-text">
                        {{ $article->content }}
                    </p>
                    <div class="badge text-bg-light">
                        {{ $article->category->name }}
                    </div>
                    <div class="mt-3">
                        {{-- @if($article->comments->count() > 0) --}}
                        @if($article->comments_count > 0)
                            <div class="mb-2 text-muted">Komentar terakhir</div>
                            <x-article-comment :comment="$article->comments->last()"></x-article-comment>
                        @endif
                        <a href="{{ route('article.single', ['slug' => $article->slug]) }}#comment">Lihat {{ $article->comments_count }} komentar</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-3">
            {{ $articles->links() }}
        </div>
    </div>
</x-template>
