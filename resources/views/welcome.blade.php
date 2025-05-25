<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-20 sm:w-24 bg-white border-r border-gray-300 flex flex-col items-center py-4 space-y-8">
            <!-- Icon Menu -->
            <button class="text-gray-700 hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Beranda -->
            <div class="flex flex-col items-center space-y-1">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9.75L12 4l9 5.75V20a2 2 0 01-2 2H5a2 2 0 01-2-2V9.75z" />
                </svg>
                <span class="text-xs text-gray-700">Beranda</span>
            </div>

            <!-- Community -->
            <div class="flex flex-col items-center space-y-1">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 11a3 3 0 11-6 0 3 3 0 016 0zm-6 8h6"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
                <span class="text-xs text-gray-700">Community</span>
            </div>

            <!-- Game -->
            <div class="flex flex-col items-center space-y-1">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    <path d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
                <span class="text-xs text-gray-700">Game</span>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 py-4 bg-white border-b">
                <!-- Left: Logo & Navigation -->
                <div class="flex items-center space-x-4 flex-wrap">
                    <span class="text-lg font-bold">LOGO</span>
                    <a href="#" class="text-sm sm:text-base font-medium hover:text-blue-600">Cari Game</a>
                    <a href="#" class="text-sm sm:text-base font-medium hover:text-blue-600">Update Game</a>
                    <a href="#" class="text-sm sm:text-base font-medium hover:text-blue-600">Upload Game</a>
                </div>

                <!-- Center: Search Bar -->
                <div class="relative w-full sm:w-1/3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari game atau creator"
                        class="w-full border border-gray-300 rounded pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Right: Profile -->
                <div class="w-8 h-8 rounded-full overflow-hidden">
                    <img src="https://i.pravatar.cc/300" alt="Profil" class="w-full h-full object-cover rounded-full" />
                </div>

            </header>

            <!-- Grid Game -->
            <main class="p-4">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Card -->
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                        <div class="bg-gray-300 h-32 sm:h-40 w-full"></div> <!-- Thumbnail -->
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-gray-800 truncate">Nama Game</h3>
                            <p class="text-xs text-gray-500">Tipe Game</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                        <div class="bg-gray-400 h-32 sm:h-40 w-full"></div> <!-- Thumbnail -->
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-gray-800 truncate">Game Kedua</h3>
                            <p class="text-xs text-gray-500">Puzzle</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                        <div class="bg-gray-200 h-32 sm:h-40 w-full"></div> <!-- Thumbnail -->
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-gray-800 truncate">Game Ketiga</h3>
                            <p class="text-xs text-gray-500">Petualangan</p>
                        </div>
                    </div>
                    <!-- Tambah kartu lainnya jika diperlukan -->
                </div>
            </main>
        </div>
    </div>
</body>

</html>