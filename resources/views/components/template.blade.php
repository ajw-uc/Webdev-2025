<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebDev 2025 @isset($title) - {{ $title }} @endisset</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite([])
    @endif
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WebDev 2023</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('article.list') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('article_category.list') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.list') }}">User</a>
                    </li>
                </ul>

                <div class="d-flex">
                    @auth
                        <div class="dropdown">
                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->unreadNotifications->isNotEmpty())
                                    <i class="bi bi-bell-fill"></i>
                                    <span class="badge text-bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @else
                                    <i class="bi bi-bell"></i>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                @if(auth()->user()->unreadNotifications->isNotEmpty())
                                    @foreach(auth()->user()->unreadNotifications->take(5) as $notification)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('notification.read', ['id' => $notification->id]) }}">{{ $notification->data['text'] }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><p class="dropdown-item disabled">{{ __('notification.no_unread') }}</p></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('notification.list') }}">{{ __('notification.view_all') }}</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
        @endif

        @error('alert')
        <x-alert type="danger">
            {{ session('errors')->first('alert') }}
        </x-alert>
        @enderror
    </div>

    {{ $slot }}
</body>
</html>
