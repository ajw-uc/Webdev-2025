<x-template title="Artikel">
    <div class="container">
        @if (count($articles) < 10)
            <a class="btn btn-success" href="{{ route('article.create') }}">Tambah Artikel</a>
        @endif
        @foreach($articles as $article)
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $article['title'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $article['date'] }}</h6>
                    <p class="card-text">
                        {{ $article['content'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-template>
