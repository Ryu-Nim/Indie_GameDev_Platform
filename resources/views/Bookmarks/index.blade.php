@extends('layouts.app')

@section('content')
  <h2 class="text-xl font-bold mb-4">Game yang Telah Ditandai</h2>
  <div class="flex-1 flex flex-col">
    <!-- Grid Game -->
    <main class="p-2 sm:p-4">
    <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
      @foreach($bookmarks as $bookmark)
      @php 
      $game = $bookmark->game; 
      $isBookmarked = auth()->user()->bookmarks->contains('game_id', $game->id);
      @endphp
      <div class="relative bg-white rounded-lg shadow hover:shadow-md transition-shadow">
      <!-- Tombol Bookmark di kanan bawah -->
      <form onsubmit="event.preventDefault(); toggleBookmark({{ $game->id }});"
      class="absolute bottom-2 right-2 z-10">
      @csrf
      <input type="hidden" name="game_id" value="{{ $game->id }}">
      <button type="submit" class="bookmark-button text-{{ $isBookmarked ? 'blue' : 'gray' }}-500 hover:text-blue-500 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
        <path d="M2 2v12l6-3 6 3V2z" />
      </svg>
      </button>
      </form>

      <!-- Cover game jadi link ke detail -->
      <a href="{{ route('game.detail', $game->title) }}">
      <img
      src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : asset('images/default-cover.jpg') }}"
      alt="{{ $game->title }}" class="w-full h-40 sm:h-40 md:h-44 object-cover rounded-t-lg">
      </a>

      <div class="p-3">
      <!-- Judul game jadi link ke detail -->
      <a href="{{ route('game.detail', $game->title) }}">
      <h3 class="text-sm font-semibold text-gray-800 truncate hover:underline">
        {{ $game->title }}
      </h3>
      </a>
      <p class="text-xs text-gray-500">{{ ucfirst($game->category) }}</p>
      </div>
      </div>
    @endforeach
    </div>
    </main>
  </div>

  <script>
    function toggleBookmark(gameId, formElement) {
    fetch('/bookmark', {
      method: 'POST',
      headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ game_id: gameId })
    })
      .then(response => response.json())
      .then(data => {
      alert(data.message);

      // Ubah warna ikon sesuai status terbaru
      const button = formElement.querySelector('.bookmark-button');
      if (data.bookmarked) {
        button.classList.remove('text-gray-500');
        button.classList.add('text-blue-500');
      } else {
        button.classList.remove('text-blue-500');
        button.classList.add('text-gray-500');
      }
      })
      .catch(error => console.error('Error:', error));
    }
  </script>
@endsection