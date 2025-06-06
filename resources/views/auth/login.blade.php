<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">

  <div class="bg-gray-200 p-8 rounded-lg shadow-lg max-w-sm w-full">
    <h4 class="text-center text-lg font-semibold mb-4">Login</h4>
    <form method="POST" action="{{ route('login.process') }}">
      @csrf

      <div class="mb-4">
        <label for="login" class="block text-sm font-medium">Username atau Email</label>
        <input type="text" name="login" id="login" required autofocus
          class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
          placeholder="Masukkan username atau email">
        @error('login') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
      </div>

      <div class="mb-4 relative">
        <label for="password" class="block text-sm font-medium">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 pr-10"
          placeholder="Masukkan password">
        <span id="togglePassword" class="absolute right-3 top-9 cursor-pointer select-none">
          <!-- Mata terbuka (hijau saat aktif, default hidden) -->
          <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden text-green-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-9 9s-9-4-9-9 7-9 9-9 9 4 9 9z" />
          </svg>
          <!-- Mata tertutup (default tampil, abu-abu) -->
          <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block text-gray-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-9 0-1.657.672-3.157 1.825-4.325m3.153-2.153A9.956 9.956 0 0112 5c5 0 9 4 9 9 0 1.657-.672 3.157-1.825 4.325M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.364 6.364l12.728-12.728" />
          </svg>
        </span>
        @error('password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
      </div>

      <div class="flex items-center mb-4">
        <input type="checkbox" class="mr-2" id="remember" name="remember">
        <label class="text-sm" for="remember">Remember Me</label>
      </div>

      <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-md font-semibold">
        Login
      </button>
    </form>

    <!-- Opsi Belum Punya Akun? -->
    <div class="text-center mt-4">
      <p class="text-sm">Belum punya akun? <a href="{{ route('register') }}"
          class="text-green-500 hover:underline">Register di sini</a></p>
    </div>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const passwordInput = document.getElementById('password');
      const toggle = document.getElementById('togglePassword');
      const eyeOpen = document.getElementById('eyeOpen');
      const eyeClosed = document.getElementById('eyeClosed');

      toggle.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeOpen.classList.toggle('hidden', !isPassword);
        eyeClosed.classList.toggle('hidden', isPassword);

        // Ubah warna icon
        if (!isPassword) {
          eyeOpen.classList.remove('text-green-500');
          eyeOpen.classList.add('text-gray-500');
        } else {
          eyeOpen.classList.remove('text-gray-500');
          eyeOpen.classList.add('text-green-500');
        }
      });

      // Set warna awal (abu-abu)
      eyeOpen.classList.remove('text-green-500');
      eyeOpen.classList.add('text-gray-500');
    });
  </script>

</body>

</html>