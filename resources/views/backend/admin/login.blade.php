<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('/images/admin.png') }}" alt="logo" class="h-40 w-40 mb-1">
        </div>

        <!-- Success message -->
        @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('backend.admin.login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-white mb-1">Username atau Email</label>
                <div class="flex items-center bg-gray-700 rounded">
                    <span class="px-3 text-green-400"><i class="mdi mdi-account"></i></span>
                    <input type="text" name="login" value="{{ old('login') }}"
                           class="w-full p-2 bg-gray-700 text-white rounded-r focus:outline-none @error('login') border border-red-500 @enderror"
                           placeholder="Masukkan Username atau Email">
                </div>
                @error('login')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-white mb-1">Password</label>
                <div class="flex items-center bg-gray-700 rounded">
                    <span class="px-3 text-yellow-400"><i class="mdi mdi-lock"></i></span>
                    <input type="password" name="password"
                           class="w-full p-2 bg-gray-700 text-white rounded-r focus:outline-none @error('password') border border-red-500 @enderror"
                           placeholder="Masukkan Password">
                </div>
                @error('password')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded w-full">Login</button>
            </div>
        </form>

        <!-- Optional Recover Form -->
        <div id="recoverForm" class="hidden mt-6">
            <p class="text-white mb-4 text-sm">Masukkan email Anda untuk mereset password.</p>
            <form>
                <div class="mb-4">
                    <div class="flex items-center bg-gray-700 rounded">
                        <span class="px-3 text-red-400"><i class="mdi mdi-email"></i></span>
                        <input type="text" class="w-full p-2 bg-gray-700 text-white rounded-r focus:outline-none"
                               placeholder="Email Address">
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="toggleRecover()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Kembali</button>
                    <button type="button"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleRecover() {
            const form = document.getElementById('recoverForm');
            form.classList.toggle('hidden');
        }
    </script>
</body>
</html>
