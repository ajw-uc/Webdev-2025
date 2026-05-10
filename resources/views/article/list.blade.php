<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
</head>
<body>
    @if(count($articles) > 0)
    <a href="{{ route('article.create') }}">Tambah artikel</a>
    @endif

    @foreach ($articles as $article)
    <div>
        <h4>{{ $article['title'] }}</h4>
        {!! $article['content'] !!}
        <div>
            <small>{{ $article['date'] }}</small>
        </div>
    </div>
    <hr/>
    @endforeach
</body>
</html>
