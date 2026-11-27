<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · Pantrify</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/pantrify.css') }}">
</head>
<body>
<div class="app">
    @include('partials.sidebar')

    <div class="main">
        <header class="topbar">
            <button class="menu-toggle" type="button" aria-label="Buka menu"
                    onclick="document.body.classList.toggle('sidebar-open')">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="topbar__title">@yield('title', 'Dashboard')</h1>

            <div class="topbar__actions">
                <a href="{{ route('notifikasi') }}" class="icon-btn" aria-label="Notifikasi">
                    <i class="bi bi-bell"></i>
                    <span class="icon-btn__dot"></span>
                </a>
                <a href="{{ route('profil') }}" class="user-chip">
                    <span class="user-chip__avatar">J</span>
                    <span class="user-chip__name">Jroy</span>
                </a>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <div class="backdrop" onclick="document.body.classList.remove('sidebar-open')"></div>
</div>
</body>
</html>