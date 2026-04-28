<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Global CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    {{-- Page CSS --}}
    @stack('styles')

    {{-- Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 flex">

    {{-- SIDEBAR --}}
    <aside class="sidebar w-64 text-white min-h-screen p-5">
        <h2 class="text-xl font-bold mb-8">Admin Panel</h2>

        <ul class="space-y-2 text-sm">
        @if(in_array(auth()->user()->id, ['880', '13']))
        <li>
                <a href="/employees"
                    class="menu-item {{ request()->is('employees*') ? 'menu-active' : '' }}">
                    <i data-lucide="users"></i>
                    Employee
                </a>
            </li>

            <li>
                <a href="/inventaris"
                    class="menu-item {{ request()->is('inventaris*') ? 'menu-active' : '' }}">
                    <i data-lucide="box"></i>
                    Inventaris
                </a>
            </li>
@endif
            <li>
                <a href="/peminjaman"
                    class="menu-item {{ request()->is('peminjaman*') ? 'menu-active' : '' }}">
                    <i data-lucide="clipboard-list"></i>
                    Peminjaman
                </a>
            </li>
        </ul>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-h-screen">

        {{-- NAVBAR --}}
        <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="font-semibold text-lg">
                    @yield('title', 'Dashboard')
                </h1>
                <p class="text-sm text-gray-500">
                    {{ date('l, d F Y') }}
                </p>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-gray-100 px-3 py-1 rounded-full text-sm">
                    {{ auth()->user()->name }}
                </div>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="p-6 flex justify-center">
            <div class="w-full max-w-6xl">
                <div class="card p-6">
                    @yield('content')
                </div>
            </div>
        </main>

    </div>

    <script>
        lucide.createIcons();
    </script>

@stack('scripts')

</body>
</html>