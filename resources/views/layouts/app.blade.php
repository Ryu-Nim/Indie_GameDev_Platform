<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
    @include('partials.navbar')

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    <footer class="text-center mt-8 mb-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} Indie GameDev
    </footer>
</body>

</html>