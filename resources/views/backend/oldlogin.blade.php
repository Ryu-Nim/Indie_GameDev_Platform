
<h2 class="text-xl font-bold mb-4">Admin Login</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <p>{{ $errors->first('login') }}</p>
    </div>
@endif

<form action="{{ route('backend.admin.login') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
    @csrf
    <div class="mb-4">
        <label for="login" class="block text-gray-600">Username atau Email:</label>
        <input type="text" name="login" class="border px-3 py-2 w-full rounded" required>
    </div>
    <div class="mb-4">
        <label for="password" class="block text-gray-600">Password:</label>
        <input type="password" name="password" class="border px-3 py-2 w-full rounded" required>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Login
    </button>
</form>