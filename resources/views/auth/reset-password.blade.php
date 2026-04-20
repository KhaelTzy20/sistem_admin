<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="bg-white p-6 rounded shadow w-full max-w-md">
    <h2 class="text-xl font-bold mb-4">Reset Password</h2>

    <form method="POST" action="/reset-password">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" placeholder="Email"
            class="w-full p-2 border rounded mb-2">

        <input type="password" name="password" placeholder="Password baru"
            class="w-full p-2 border rounded mb-2">

        <input type="password" name="password_confirmation" placeholder="Konfirmasi password"
            class="w-full p-2 border rounded mb-4">

        <button class="w-full bg-green-500 text-white py-2 rounded">
            Reset Password
        </button>
    </form>
</div>

</body>
</html>