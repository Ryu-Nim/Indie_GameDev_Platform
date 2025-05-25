@extends('layouts.app')

@section('content')
  <div class="min-h-screen flex items-center justify-center bg-gray-200">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
    <h2 class="text-center text-2xl font-semibold mb-4">Register</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-4">
      <label for="email" class="block text-sm font-medium">Email</label>
      <input type="email" name="email" id="email" required class="w-full p-2 border rounded-md focus:ring-green-500">
      </div>

      <div class="mb-4">
      <label for="username" class="block text-sm font-medium">Username</label>
      <input type="text" name="username" id="username" required
        class="w-full p-2 border rounded-focus:ring-green-500">
      </div>

      <div class="mb-4">
      <label for="password" class="block text-sm font-medium">Password</label>
      <input type="password" name="password" id="password" required
        class="w-full p-2 border rounded-md focus:ring-green-500">
      </div>

      <div class="mb-4">
      <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required
        class="w-full p-2 border rounded-md focus:ring-green-500">
      </div>

      <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-md font-semibold">
      Register
      </button>
    </form>

    <p class="text-center text-sm mt-4">
      Sudah punya akun? <a href="{{ route('login') }}" class="text-green-500 hover:underline">Login di sini</a>
    </p>
    </div>
  </div>
@endsection