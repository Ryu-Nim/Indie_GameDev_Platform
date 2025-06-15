<aside class="w-20 sm:w-24 bg-white border-r border-gray-300 flex flex-col items-center py-4 space-y-8">

  <!-- Beranda -->
  <div class="flex flex-col items-center space-y-1">
    <a href="{{ route('home') }}"
      class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 active:text-blue-800 transition-colors duration-150">
    <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 9.75L12 4l9 5.75V20a2 2 0 01-2 2H5a2 2 0 01-2-2V9.75z" />
    </svg>
    <span class="text-xs text-gray-700">Beranda</span>
    </a>
  </div>

  <!-- Community -->
  <div class="flex flex-col items-center space-y-1">
    <a href="{{ route('community') }}"
      class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 active:text-blue-800 transition-colors duration-150">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 11a3 3 0 11-6 0 3 3 0 016 0zm-6 8h6"
          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
      </svg>
      <span class="text-xs">Community</span>
    </a>
  </div>
  <!-- Game -->
  <div class="flex flex-col items-center space-y-1">
    <a href="{{ route('bookmarks.index') }}"
      class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 active:text-blue-800 transition-colors duration-150">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M12 14l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
        <path d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" stroke-linecap="round"
          stroke-linejoin="round" stroke-width="2" />
      </svg>
      <span class="text-xs text-gray-700">Game</span>
    </a>
  </div>
</aside>