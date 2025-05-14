<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Game - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <nav class="bg-blue-600 text-white p-4 shadow">
    <div class="container mx-auto">
      <h1 class="text-lg font-semibold">Game Uploader</h1>
    </div>
  </nav>

  <main class="container mx-auto p-4">
    @yield('content')
  </main>

</body>

</html>