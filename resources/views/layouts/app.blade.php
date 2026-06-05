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

<script>
function toggleSubmenu(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
}
</script>

<body class="bg-gray-100 flex">

    {{-- SIDEBAR --}}
    <aside class="sidebar w-64 text-white min-h-screen p-5">
        <h2 class="text-xl font-bold mb-8">Admin Panel</h2>

        <ul class="space-y-2 text-sm">
        <li>
    <button onclick="toggleSubmenu('employeeMenu')"
        class="menu-item w-full flex justify-between items-center {{ request()->is('employees*') ? 'menu-active' : '' }}">

        <div class="flex items-center gap-2">
            <i data-lucide="users"></i>
            Employee
        </div>

        <i data-lucide="chevron-down" class="w-4 h-4"></i>
    </button>

    {{-- SUB MENU --}}
    <ul id="employeeMenu"
        class="ml-6 mt-2 space-y-1 {{ request()->is('employees*') ? '' : 'hidden' }}">

        <li>
            <a href="/employees"
                class="block text-sm px-3 py-2 rounded hover:bg-white/10
                {{ request()->is('employees') ? 'menu-active' : '' }}">
                Data Employee
            </a>
        </li>

        <li>
            <a href="/employees/tabungan"
                class="block text-sm px-3 py-2 rounded hover:bg-white/10
                {{ request()->is('employees/tabungan*') ? 'menu-active' : '' }}">
                Tabungan
            </a>
        </li>

         {{-- EQUITY --}}
    <li>
        <a href="/employees/equity"
            class="block text-sm px-3 py-2 rounded hover:bg-white/10
            {{ request()->is('employees/equity*') ? 'menu-active' : '' }}">
            Equity
        </a>
    </li>

    <li>
    <a href="/employees/summary"
        class="block text-sm px-3 py-2 rounded hover:bg-white/10
        {{ request()->is('employees/summary*') ? 'menu-active' : '' }}">

        Financial Summary
    </a>
</li>

    </ul>
</li>
            <li>
                <a href="/inventaris"
                    class="menu-item {{ request()->is('inventaris*') ? 'menu-active' : '' }}">
                    <i data-lucide="box"></i>
                    Inventaris
                </a>
            </li>
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