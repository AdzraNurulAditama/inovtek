@php
    // route name => [label, icon Bootstrap Icons]
    $menu = [
        'dashboard'      => ['Dashboard',      'bi-grid-1x2'],
        'meal-planner'   => ['Meal Planner',   'bi-calendar-week'],
        'daftar-belanja' => ['Daftar Belanja', 'bi-basket'],
        'stok-dapur'     => ['Stok Dapur',     'bi-box-seam'],
        'scan-struk'     => ['Scan Struk',     'bi-receipt'],
        'anggaran'       => ['Anggaran',       'bi-wallet2'],
        'price-tracker'  => ['Price Tracker',  'bi-graph-up-arrow'],
        'notifikasi'     => ['Notifikasi',     'bi-bell'],
        'profil'         => ['Profil',         'bi-person'],
    ];
@endphp

<aside class="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <span class="brand__mark"><i class="bi bi-egg-fried"></i></span>
        <span>
            <span class="brand__name">Pantrify</span>
            <span class="brand__sub">Web Application</span>
        </span>
    </a>

    <nav class="nav" aria-label="Menu utama">
        <p class="nav__label">Main menu</p>
        @foreach ($menu as $routeName => [$label, $icon])
            <a href="{{ route($routeName) }}"
               class="nav__item {{ request()->routeIs($routeName) ? 'is-active' : '' }}"
               @if (request()->routeIs($routeName)) aria-current="page" @endif>
                <i class="bi {{ $icon }}"></i>
                <span>{{ $label }}</span>
            </a>
        @endforeach
    </nav>
</aside>