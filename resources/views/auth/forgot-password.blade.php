<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="bg-white p-6 rounded shadow w-full max-w-md">
    <h2 class="text-xl font-bold mb-4">Forgot Password</h2>

    @if (session('status'))
        <div class="text-green-600 mb-2">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="/forgot-password">
        @csrf

        <input type="email" name="email" placeholder="Email"
            class="w-full p-2 border rounded mb-4">

        <button class="w-full bg-blue-500 text-white py-2 rounded">
            Kirim Link Reset
        </button>
    </form>
</div>

</body>
</html>