<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Platform Game</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }
    .scrollbar-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>
<body class="bg-gray-100 flex">

  <!-- Sidebar -->
  <aside class="w-28 bg-white shadow-md h-screen flex flex-col items-center py-6 space-y-8">
    <button class="text-2xl">☰</button>
    <div class="flex flex-col items-center space-y-4">
      <div class="flex flex-col items-center">
        <img src="https://via.placeholder.com/32" alt="Beranda" class="w-8 h-8" />
        <span class="text-xs mt-1 text-center">Beranda</span>
      </div>
      <div class="flex flex-col items-center">
        <img src="https://via.placeholder.com/32" alt="Community" class="w-8 h-8" />
        <span class="text-xs mt-1 text-center">Community</span>
      </div>
      <div class="flex flex-col items-center">
        <img src="https://via.placeholder.com/32" alt="Game" class="w-8 h-8" />
        <span class="text-xs mt-1 text-center">Game</span>
      </div>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    
    <!-- Navbar -->
    <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
      <div class="flex items-center space-x-6">
        <div class="text-xl font-bold">LOGO</div>
        <nav class="flex space-x-4">
          <a href="#" class="text-sm font-medium hover:underline">Cari Game</a>
          <a href="#" class="text-sm font-medium hover:underline">Update Game</a>
          <a href="#" class="text-sm font-medium hover:underline">Upload Game</a>
        </nav>
      </div>
      <div class="flex items-center space-x-3">
        <input 
          type="text" 
          placeholder="Tempat Pencarian Game atau Creator"
          class="px-4 py-1 border border-gray-300 rounded text-sm w-80"
        />
        <button class="text-lg">🔍</button>
        <div class="w-8 h-8 bg-gray-400 rounded-full"></div>
      </div>
    </header>

    <!-- Main Area -->
    <main class="p-6">
      <h1 class="text-xl font-semibold mb-2">Selamat datang di Platform Game</h1>
      <p class="text-sm text-gray-600 mb-6">
        Ini adalah tampilan home. Tambahan konten seperti daftar game, aktivitas komunitas, dll bisa ditaruh di sini.
      </p>

      <!-- Carousel -->
      <section>
        <h2 class="text-xl font-semibold mb-4">Game Populer</h2>
        <div class="relative">
          <div
            class="flex overflow-x-auto space-x-4 scrollbar-hide scroll-smooth snap-x"
            id="carousel"
          >
            <!-- Card 1 -->
<div class="flex-shrink-0 snap-start w-40 bg-white shadow rounded-lg p-2 text-center">
  <img src="resources/views/icon/broken-relic.jpg.jpg" alt="Game 1" class="mx-auto rounded" height="900" width="900" />
  <p class="mt-2 text-sm font-medium">Game 1</p>
</div>
<!-- Card 2 -->
<div class="flex-shrink-0 snap-start w-40 bg-white shadow rounded-lg p-2 text-center">
  <img src="https://images.unsplash.com/photo-1606813904310-96e5ddf80b74?auto=format&fit=crop&w=100&q=80" alt="Game 2" class="mx-auto rounded" />
  <p class="mt-2 text-sm font-medium">Game 2</p>
</div>
<!-- Card 3 -->
<div class="flex-shrink-0 snap-start w-40 bg-white shadow rounded-lg p-2 text-center">
  <img src="https://images.unsplash.com/photo-1606813904375-8d96079a5d67?auto=format&fit=crop&w=100&q=80" alt="Game 3" class="mx-auto rounded" />
  <p class="mt-2 text-sm font-medium">Game 3</p>
</div>
<!-- Card 4 -->
<div class="flex-shrink-0 snap-start w-40 bg-white shadow rounded-lg p-2 text-center">
  <img src="https://images.unsplash.com/photo-1606813904281-8d05c26e0f10?auto=format&fit=crop&w=100&q=80" alt="Game 4" class="mx-auto rounded" />
  <p class="mt-2 text-sm font-medium">Game 4</p>
</div>
<!-- Card 5 -->
<div class="flex-shrink-0 snap-start w-40 bg-white shadow rounded-lg p-2 text-center">
  <img src="https://images.unsplash.com/photo-1606813904476-3f9d14318887?auto=format&fit=crop&w=100&q=80" alt="Game 5" class="mx-auto rounded" />
  <p class="mt-2 text-sm font-medium">Game 5</p>
</div>

          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
