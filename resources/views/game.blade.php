@foreach($games as $game)
  <h2>{{ $game->title }}</h2>
  <p>{{ $game->description }}</p>
  <a href="{{ route('downloadGame', $game->id) }}">Download ZIP</a>
  <a href="{{ url($game->folder_path . '/index.html') }}" target="_blank">Mainkan Sekarang</a>
@endforeach