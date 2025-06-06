<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center">

  <div class="bg-gray-200 p-8 rounded-lg shadow-md max-w-md w-full">
    <h2 class="text-center text-2xl font-semibold mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium">Email</label>
        <input type="email" name="email" id="email" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>

      <div class="mb-4">
        <label for="username" class="block text-sm font-medium">Username</label>
        <input type="text" name="username" id="username" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>

      <div class="mb-4 relative">
        <label for="password" class="block text-sm font-medium">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 pr-10">
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
      </div>

      <div class="mb-6 relative">
        <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 pr-10">
        <span id="togglePasswordConfirm" class="absolute right-3 top-9 cursor-pointer select-none">
          <!-- Mata terbuka (hijau saat aktif, default hidden) -->
          <svg id="eyeOpenConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden text-green-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-9 9s-9-4-9-9 7-9 9-9 9 4 9 9z" />
          </svg>
          <!-- Mata tertutup (default tampil, abu-abu) -->
          <svg id="eyeClosedConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block text-gray-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-9 0-1.657.672-3.157 1.825-4.325m3.153-2.153A9.956 9.956 0 0112 5c5 0 9 4 9 9 0 1.657-.672 3.157-1.825 4.325M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.364 6.364l12.728-12.728" />
          </svg>
        </span>
      </div>

      <button type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-md transition">
        Register
      </button>
    </form>

    <p class="text-center text-sm mt-4">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login di sini</a>
    </p>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Password utama
      const passwordInput = document.getElementById('password');
      const toggle = document.getElementById('togglePassword');
      const eyeOpen = document.getElementById('eyeOpen');
      const eyeClosed = document.getElementById('eyeClosed');

      toggle.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeOpen.classList.toggle('hidden', !isPassword);
        eyeClosed.classList.toggle('hidden', isPassword);
      });

      // Password konfirmasi
      const passwordInputConfirm = document.getElementById('password_confirmation');
      const toggleConfirm = document.getElementById('togglePasswordConfirm');
      const eyeOpenConfirm = document.getElementById('eyeOpenConfirm');
      const eyeClosedConfirm = document.getElementById('eyeClosedConfirm');

      toggleConfirm.addEventListener('click', function () {
        const isPassword = passwordInputConfirm.type === 'password';
        passwordInputConfirm.type = isPassword ? 'text' : 'password';
        eyeOpenConfirm.classList.toggle('hidden', !isPassword);
        eyeClosedConfirm.classList.toggle('hidden', isPassword);
      });
    });
  </script>
</body>

</html>