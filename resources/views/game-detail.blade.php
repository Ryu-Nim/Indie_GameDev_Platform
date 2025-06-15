@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    <h2 class="text-2xl font-bold mb-4 text-center">{{ $game->title }}</h2>

    {{-- Carousel Skeleton Loader --}}
    <div id="carousel-skeleton" class="w-full h-96 rounded-xl bg-gray-300 animate-pulse mb-8"></div>

    {{-- Banner Section --}}
    @php
    $banners = [];

    $cover = $game->cover_image
    ? asset('storage/' . $game->cover_image)
    : asset('images/default-cover.jpg');
    $banners[] = ['type' => 'image', 'src' => $cover];

    $trailer = $game->pv_video_link;
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
    $banners[] = ['type' => 'video', 'src' => $embedUrl];
    }
    }

    foreach ($game->screenshots as $screenshot) {
    if ($screenshot->screenshot_path) {
    $banners[] = ['type' => 'image', 'src' => asset('storage/' . $screenshot->screenshot_path)];
    }
    }

    $category = strtolower($game->category_game);
  @endphp

    <div class="carousel-banner hidden mb-8">
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

    {{-- Deskripsi --}}
    <p class="text-gray-600 text-center">{{ $game->description }}</p>
    <p class="text-sm text-gray-500 text-center p-4">Kategori: {{ ucfirst($game->category_game) }}</p>

    {{-- Webgame --}}
    @if($category === 'webgame')
    <div id="gameContainer" class="text-center">
    <button id="playButton" class="px-6 py-3 bg-blue-600 text-white rounded-md text-lg hover:bg-blue-700 transition">
      Mainkan
    </button>
    <div id="iframeWrapper" class="mt-4 hidden">
      <div data-width="980" class="game_frame" style="width:100%;max-width:980px;height:660px;margin:0 auto;">
      <iframe src="{{ asset($game->web_game_file . '/index.html') }}"
      allow="autoplay; fullscreen *; geolocation; microphone; camera; midi; monetization; xr-spatial-tracking; gamepad; gyroscope; accelerometer; xr; web-share"
      class="w-full h-full border-0" allowfullscreen></iframe>
      </div>
    </div>
    </div>
    @endif

    {{-- Harga atau Tombol Unduh --}}
    @if (!in_array($game->category_game, ['WebGame', 'Uncategorized']))
    @if ($game->price_type == 2)
    <p class="text-lg font-bold text-green-500">Rp {{ number_format($game->price, 0, ',', '.') }}</p>
    <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md mt-4 inline-block">Beli Sekarang</a>
    @else
    <a href="{{ route('downloadGame', $game->id) }}"
    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md mt-4 inline-block">Unduh Gratis</a>
    @endif
    @endif

    {{-- Komentar Dummy --}}
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
    </div>
    </div>
  </div>

  {{-- Carousel & Loader Script --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script>
    $(document).ready(function () {
    // Tunggu semua gambar selesai dimuat
    $('.carousel-banner').imagesLoaded(function () {
      $('#carousel-skeleton').hide();
      $('.carousel-banner').removeClass('hidden').slick({
      dots: true,
      arrows: true,
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      adaptiveHeight: true
      });
    });

    $('#playButton').on('click', function () {
      $(this).hide();
      $('#iframeWrapper').removeClass('hidden');
    });
    });
  </script>
@endsection