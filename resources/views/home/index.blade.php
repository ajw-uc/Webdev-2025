<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('article.list') }}">Articles</a>
    </div>
    <h1>Halo, {{ $nama }}</h1>
    <p>{!! $tanggal !!}</p>
</body>
</html>
