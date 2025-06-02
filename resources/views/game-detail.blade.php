@extends('layouts.app')

@section('content')
  {{-- Game Detail --}}
  <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    <h2 class="text-2xl font-bold mb-4 text-center">{{ $game->title }}</h2>

    {{-- Banner Section --}}
    @php
    $banners = [];
    // Banner 1: Cover (pakai default jika null)
    $cover = $game->cover_image
    ? asset('storage/' . $game->cover_image)
    : asset('images/default-cover.jpg');
    $banners[] = [
    'type' => 'image',
    'src' => $cover,
    ];

    // Banner 2: Trailer (YouTube)
    $trailer = $game->trailer;
    $embedUrl = null;
    if ($trailer) {
    if (str_contains($trailer, 'youtu.be/')) {
    $videoId = explode('youtu.be/', $trailer)[1];
    $videoId = explode('?', $videoId)[0];
    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
    } elseif (str_contains($trailer, 'youtube.com/watch')) {
    parse_str(parse_url($trailer, PHP_URL_QUERY), $query);
    $videoId = $query['v'] ?? '';
    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
    } elseif (str_contains($trailer, 'youtube.com/embed/')) {
    $embedUrl = $trailer;
    }
    if ($embedUrl) {
    $banners[] = [
      'type' => 'video',
      'src' => $embedUrl,
    ];
    }
    }
    // Banner 3 dst: Screenshots
    foreach ($game->screenshots as $screenshot) {
    if ($screenshot->screenshot_path) {
    $banners[] = [
      'type' => 'image',
      'src' => asset('storage/' . $screenshot->screenshot_path),
    ];
    }
    }
    $category = strtolower($game->category);
  @endphp

    {{-- Carousel Banner --}}
    <div class="carousel-banner mb-8">
    @foreach ($banners as $banner)
      @if ($banner['type'] === 'image')
      <div>
      <img src="{{ $banner['src'] }}" alt="Banner"
      class="w-full h-96 object-cover rounded-xl border-4 border-gray-700" />
      </div>
      @elseif ($banner['type'] === 'video')
      <div>
      <iframe src="{{ $banner['src'] }}" class="w-full h-96 rounded-xl border-4 border-gray-700" frameborder="0"
      allowfullscreen></iframe>
      </div>
      @endif
    @endforeach
    </div>

    <p class="text-gray-600 text-center">{{ $game->description }}</p>
    <p class="text-sm text-gray-500 text-center">Kategori: {{ ucfirst($game->category) }}</p>

    @php
    $category = strtolower($game->category);
  @endphp

    @if($category === 'webgame')
    <div class="mt-8 p-4 border-4 border-blue-500 rounded-xl bg-gray-100 text-center">
    <h3 class="font-bold mb-2 text-lg text-blue-700">Mainkan Game</h3>
    <button id="playWebGameBtn"
      class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition mb-4"
      onclick="document.getElementById('webgame-iframe-box').style.display='block'; this.style.display='none';">
      ▶ Mainkan Game
    </button>
    <div id="webgame-iframe-box"
      class="w-full max-w-6xl mx-auto rounded-lg border-2 border-gray-400 bg-white overflow-hidden mt-4"
      style="display:none;">
      <iframe src="{{ asset($game->web_game . '/index.html') }}" class="w-full rounded-lg"
      style="height:80vh; overflow:hidden;" allowfullscreen scrolling="no">
      </iframe>
    </div>
    </div>
    @endif

    @if(
    $game->price_type == 2 &&
    $game->category !== 'WebGame' &&
    $game->category !== 'Uncategorized'
    )
    <p class="text-lg font-bold text-green-500">Rp {{ number_format($game->price, 0, ',', '.') }}</p>
    <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md mt-4 inline-block">Beli Sekarang</a>
    @elseif(
    $game->price_type != 2 &&
    $game->category !== 'WebGame' &&
    $game->category !== 'Uncategorized'
    )
    <a href="{{ route('downloadGame', $game->id) }}"
      class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md mt-4 inline-block">Unduh Gratis</a>
  @endif

    <!-- Kolom Komentar Dummy -->
    <div class="mt-10">
    <h3 class="text-lg font-bold mb-4 text-gray-700 text-center">Komentar</h3>
    <div class="space-y-4 max-w-2xl mx-auto">
      <div class="p-4 bg-gray-100 rounded-lg shadow">
      <div class="flex items-center mb-2">
        <span class="font-semibold text-blue-700 mr-2">User123</span>
        <span class="text-xs text-gray-400">2 hari lalu</span>
      </div>
      <p class="text-gray-700">Game-nya seru banget! Grafiknya keren.</p>
      </div>
      <div class="p-4 bg-gray-100 rounded-lg shadow">
      <div class="flex items-center mb-2">
        <span class="font-semibold text-green-700 mr-2">GamerPro</span>
        <span class="text-xs text-gray-400">1 hari lalu</span>
      </div>
      <p class="text-gray-700">Misi-misinya menantang, recommended!</p>
      </div>
      <div class="p-4 bg-gray-100 rounded-lg shadow">
      <div class="flex items-center mb-2">
        <span class="font-semibold text-purple-700 mr-2">Anonim</span>
        <span class="text-xs text-gray-400">5 jam lalu</span>
      </div>
      <p class="text-gray-700">Semoga ada update fitur baru ya.</p>
      </div>
    </div>
    </div>
    </div>



<!-- Slick CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
<!-- jQuery (wajib) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<!-- Slick JS -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>$(document).ready(function () 
{$('.carousel-banner').slick({dots: true,arrows: true,infinite: true,
speed: 500,
slidesToShow: 1,
adaptiveHeight: true
});
});
</script>
@endsection