<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('resource/css/layouts.css') }}">
</head>

<body class="bg-gray-100">
    <header
        class="w-full relative flex flex-col sm:flex-row items-center justify-between gap-3 px-4 py-4 bg-white border-b header-mobile-stack">
        @include('partials.navbar')
    </header>
    <div class="flex flex-row min-h-screen">
        @include('partials.sidebar')
        <div class="flex-1 flex flex-col">
            <main class="p-2 sm:p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <footer class="text-center mt-8 mb-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} Indie GameDev
    </footer>

    <script src="{{ asset('resource/js/profile.js') }}"></script>
    <script src="{{ asset('resource/js/bookmark.js') }}"></script>
    <script src="{{ asset('resource/js/liveSearch.js') }}"></script>
</body>

</html>