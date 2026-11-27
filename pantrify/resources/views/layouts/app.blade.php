
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pantrify')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #fcfaf8;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            padding: 0;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        .main-content-area {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 240px;
            max-width: calc(100% - 240px);
            overflow-x: hidden;
        }

        .pantrify-sidebar {
            width: 220px;
            min-width: 220px;
            height: calc(100vh - 2rem);
            padding: 1.25rem 1rem;
            margin: 1rem 0 1rem 1rem;
            border-radius: 1.25rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
        }

        .pantrify-brand-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.25rem;
            margin-bottom: 1.5rem;
            text-decoration: none;
        }

        .pantrify-brand-mark {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: #0f172a;
            color: #ffffff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .pantrify-brand-text {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.1rem;
        }

        .pantrify-menu-label {
            color: #94a3b8;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.5rem 0.85rem;
            margin-top: 0.3rem;
        }

        .pantrify-side-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 0.85rem;
            color: #64748b;
            border-radius: 0.75rem;
            text-decoration: none;
            font-size: 0.925rem;
            font-weight: 500;
            margin: 0.2rem 0;
            transition: all 0.2s ease;
        }

        .pantrify-side-link i {
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .pantrify-side-link:hover {
            color: #0f172a;
            background: #f1f5f9;
        }

        .pantrify-side-link.active {
            color: #ffffff;
            background: #0f172a;
        }

        .pantrify-sidebar-bottom {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
            width: 100%;
        }

        @media(max-width: 991.98px) {
            .app-layout {
                flex-direction: column;
            }

            .pantrify-sidebar {
                width: 100%;
                height: 70px;
                min-width: 0;
                margin: 0;
                padding: 0.5rem 1rem;
                border-radius: 0;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                position: sticky;
                top: 0;
                overflow: visible;
            }

            .pantrify-brand-container,
            .pantrify-sidebar-bottom,
            .pantrify-menu-label,
            .pantrify-side-link span {
                display: none;
            }

            .pantrify-side-link {
                padding: 0.5rem;
                margin: 0;
            }

            .main-content-area {
                margin-left: 0;
                max-width: 100%;
                padding: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="app-layout">

    @php
        $pantrifyMenus = [
            [
                'route' => 'dashboard',
                'label' => 'Dashboard',
                'icon' => 'bi-grid-fill'
            ],
            [
                'route' => 'meal-planner',
                'label' => 'Meal Planner',
                'icon' => 'bi-journal-richtext'
            ],
            [
                'route' => 'stok-dapur',
                'label' => 'Stok Dapur',
                'icon' => 'bi-basket2'
            ],
            [
                'route' => 'anggaran',
                'label' => 'Anggaran',
                'icon' => 'bi-wallet2'
            ],
            [
                'route' => 'scan-struk',
                'label' => 'Scan Struk',
                'icon' => 'bi-receipt'
            ],
        ];

        $pantrifyAdditionalMenus = [
    [
        'route' => 'price-tracker',
        'label' => 'Price Tracker',
        'icon' => 'bi-tags'
    ],
];
    @endphp

    <!-- SIDEBAR -->
    <aside class="pantrify-sidebar">

        <a href="{{ route('dashboard') }}"
           class="pantrify-brand-container">

            <div class="pantrify-brand-mark">
                <i class="bi bi-egg-fried"></i>
            </div>

            <span class="pantrify-brand-text">Pantrify</span>
        </a>

        <div class="pantrify-menu-label">Menu Utama</div>

        @foreach ($pantrifyMenus as $menu)

            @if (\Illuminate\Support\Facades\Route::has($menu['route']))

                <a href="{{ route($menu['route']) }}"
                   class="pantrify-side-link {{ request()->routeIs($menu['route']) ? 'active' : '' }}">

                    <i class="bi {{ $menu['icon'] }}"></i>
                    <span>{{ $menu['label'] }}</span>

                </a>

            @endif

        @endforeach

        <div class="pantrify-menu-label">Fitur Lainnya</div>

        @foreach ($pantrifyAdditionalMenus as $menu)

            @if (\Illuminate\Support\Facades\Route::has($menu['route']))

                <a href="{{ route($menu['route']) }}"
                   class="pantrify-side-link {{ request()->routeIs($menu['route']) ? 'active' : '' }}">

                    <i class="bi {{ $menu['icon'] }}"></i>
                    <span>{{ $menu['label'] }}</span>

                </a>

            @endif

        @endforeach

        

    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main-content-area">

        @yield('content')

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
