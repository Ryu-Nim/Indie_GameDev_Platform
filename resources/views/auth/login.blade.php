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

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
          placeholder="Masukkan password">
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

</body>

</html>