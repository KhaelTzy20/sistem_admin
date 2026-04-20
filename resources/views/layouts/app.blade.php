<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- SIDEBAR -->
    <div class="w-64 bg-gray-900 text-white min-h-screen p-5">
        <h2 class="text-xl font-bold mb-6">Admin</h2>

        <ul class="space-y-3">
            <li>
                <a href="/employees" class="block p-2 rounded hover:bg-gray-700">
                    Employee
                </a>
            </li>

            <li>
                <a href="/inventaris" class="block p-2 rounded hover:bg-gray-700">
                    Inventaris
                </a>
            </li>

            <li>
                <a href="/peminjaman" class="block p-2 rounded hover:bg-gray-700">
                    Form Peminjaman
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="flex-1">

        <!-- NAVBAR -->
        <div class="bg-white shadow px-6 py-4 flex justify-between">
            <span class="font-semibold">Sistem Admin</span>

            <div class="flex items-center gap-4">
                <span>{{ auth()->user()->name }}</span>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-6">
            @yield('content')
        </div>

    </div>

</body>
</html>