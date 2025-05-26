<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <!-- Bootstrap CSS (biasanya sudah ada) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="#">MyApp</a>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="text-center mt-5 mb-3 text-muted">
        &copy; {{ date('Y') }} Indie GameDev 
    </footer>
</body>
</html>
