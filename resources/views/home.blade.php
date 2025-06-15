@extends('layouts.app')

@section('content')
    {{-- Skeleton Placeholder --}}
    @php
        $skeletoncount = 20;
    @endphp
    <div id="skeleton-wrapper"
        class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
        @for($i = 0; $i < $skeletoncount; $i++)
            <div class="animate-pulse bg-white rounded-lg shadow p-3">
                <div class="bg-gray-300 h-40 rounded-t-lg mb-3"></div>
                <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                <div class="h-3 bg-gray-200 rounded w-1/2"></div>
            </div>
        @endfor
    </div>

    {{-- Konten Game Asli --}}
    <div id="game-list"
        class="hidden opacity-0 transition-opacity duration-500 grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
        @foreach($games as $game)
            @php
                $user = auth()->user();
                $isBookmarked = $user ? auth()->user()->bookmarks->contains('game_id', $game->id) : false;
                //$isBookmarked = auth()->user()->bookmarks->contains('game_id', $game->id);
            @endphp
            <div class="relative bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                @auth
                    <form onsubmit="event.preventDefault(); toggleBookmark({{ $game->id }}, this);"
                        class="absolute bottom-2 right-2 z-10">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <button type="submit"
                            class="bookmark-button text-{{ $isBookmarked ? 'blue' : 'gray' }}-500 hover:text-blue-500 transition"
                            data-game-id="{{ $game->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2 2v12l6-3 6 3V2z" />
                            </svg>
                        </button>
                    </form>
                @endauth

                <a href="{{ route('game.detail', Str::slug($game->title)) }}">
                    <img src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : asset('images/default-cover.jpg') }}"
                        alt="{{ $game->title }}" class="w-full h-40 sm:h-40 md:h-44 object-cover rounded-t-lg">
                </a>

                <div class="p-3">
                    <a href="{{ route('game.detail', Str::slug($game->title)) }}">
                        <h3 class="text-sm font-semibold text-gray-800 truncate hover:underline">
                            {{ $game->title }}
                        </h3>
                    </a>
                    <p class="text-xs text-gray-500 mb-2 mt-1">{{ ucfirst($game->genre) }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst($game->category_game) }}</p>
                    <!-- <p class="text-xs text-gray-500">{{ $game->created_at->diffForHumans() }}</p> -->
                </div>
            </div>
        @endforeach
    </div>

    {{-- Script Transition Skeleton -> Data --}}
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const skeleton = document.getElementById('skeleton-wrapper');
                const gameList = document.getElementById('game-list');

                // Sembunyikan skeleton dan tampilkan konten
                skeleton.style.display = 'none';
                gameList.classList.remove('hidden');

                // Tambahkan efek fade-in
                setTimeout(() => {
                    gameList.classList.add('opacity-100');
                }, 50);
            }, 800); // Delay 800ms, ubah sesuai selera
        });
    </script>
@endsection