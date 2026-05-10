<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
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
</body>
</html>
