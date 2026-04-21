<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        .spinner {
            border: 2px solid rgba(255,255,255,0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 via-blue-500 to-cyan-400">

    <div class="absolute w-72 h-72 bg-white/20 rounded-full blur-3xl top-10 left-10"></div>
    <div class="absolute w-72 h-72 bg-white/20 rounded-full blur-3xl bottom-10 right-10"></div>

    <div class="fade-in relative w-full max-w-md p-8 rounded-2xl backdrop-blur-lg bg-white/80 shadow-2xl border border-white/30">

        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">
            🔐 Login
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 text-sm p-3 rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-5" id="loginForm">
            @csrf

            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                    placeholder="Masukkan email" required>
            </div>

            <div class="relative">
                <label class="text-sm text-gray-600">Password</label>

                <input id="password" type="password" name="password"
                    class="w-full mt-1 p-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                    placeholder="Masukkan password" required>

                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-9 text-gray-500 hover:text-gray-700 text-sm">
                    👁️
                </button>
            </div>

            <div class="flex justify-end">
                <a href="/forgot-password" class="text-sm text-blue-500 hover:underline">
                    Forgot password?
                </a>
            </div>

            <button id="loginBtn" type="submit"
                class="w-full py-3 rounded-lg text-white font-medium bg-gradient-to-r from-blue-500 to-indigo-500 hover:opacity-90 transition shadow-md flex items-center justify-center gap-2">
                <span id="btnText">Login</span>
            </button>

        </form>

        
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Yayasan Bina Anak IndONEsia Kompeten. All rights reserved.
        </p>

    </div>

<script>
    // show hide pw
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    //loading
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        const text = document.getElementById('btnText');

        btn.disabled = true;
        text.innerHTML = '<div class="spinner"></div> Loading...';
    });
</script>

</body>
</html>