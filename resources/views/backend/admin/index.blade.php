@extends('backend.layouts.app')

@section('content')
    <div class="p-6 bg-gray-100 rounded shadow">
        <h1 class="text-2xl font-bold mb-8 text-center">Dashboard Admin</h1>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div class="bg-white p-6 rounded shadow border">
                <h2 class="text-lg font-semibold text-gray-700">Total User</h2>
                <p class="text-3xl font-bold text-blue-500">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow border">
                <h2 class="text-lg font-semibold text-gray-700">User Aktif Sekarang</h2>
                <p class="text-3xl font-bold text-green-500">{{ $activeUsers }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow border">
                <h2 class="text-lg font-semibold text-gray-700">Jumlah Game</h2>
                <p class="text-3xl font-bold text-purple-500">{{ $totalGames }}</p>
            </div>
        </div>
        <div class="mt-8 mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">Game Terbaru Hari ini</h1>

            @if($todayGames->isEmpty())
                <h2 class="text-gray-600 text-center">Belum ada game yang diupload hari ini.</h2>
            @else
                <div class="max-w-7xl w-full mx-auto">
                    <div class="mb-6 w-full max-w-7xl">
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-300 text-green-800 text-sm px-4 py-3 rounded-lg shadow">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="w-full max-w-7xl">
                        <div class="bg-white border border-gray-300 rounded-xl shadow-md overflow-x-auto p-4">
                            <table class="min-w-full text-sm text-left text-gray-700 divide-y divide-gray-200">
                                <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                                    <tr>
                                        <th class="px-4 py-3">Cover</th>
                                        <th class="px-4 py-3">Judul</th>
                                        <th class="px-4 py-3">PV Video</th>
                                        <th class="px-4 py-3">Kategori</th>
                                        <th class="px-4 py-3">Rilis</th>
                                        <th class="px-4 py-3">Genre</th>
                                        <th class="px-4 py-3">Tipe Harga</th>
                                        <th class="px-4 py-3">Harga</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Uploader</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($todayGames as $game)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2">
                                                <div
                                                    class="border border-gray-300 rounded-lg overflow-hidden w-14 h-14 flex items-center justify-center bg-gray-50">
                                                    <img src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : asset('images/default-cover.jpg') }}"
                                                        class="object-cover w-full h-full" alt="cover">
                                                </div>
                                            </td>
                                            <td class="px-4 py-2 font-medium text-gray-800">{{ $game->title }}</td>
                                            <td class="px-4 py-2">
                                                @if($game->pv_video_link)
                                                    <a href="{{ $game->pv_video_link }}" target="_blank"
                                                        class="text-blue-600 hover:underline">Lihat Video</a>
                                                @else
                                                    <span class="text-gray-400 italic">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">{{ $game->category_game }}</td>
                                            <td class="px-4 py-2">
                                                @php
                                                    $status = match ($game->release_status) {
                                                        1 => ['label' => 'Dikembangkan', 'class' => 'bg-yellow-100 text-yellow-700'],
                                                        2 => ['label' => 'Rilis', 'class' => 'bg-green-100 text-green-700'],
                                                        default => ['label' => 'Tidak Diketahui', 'class' => 'bg-gray-100 text-gray-600'],
                                                    };
                                                @endphp
                                                <span
                                                    class="px-2 py-1 rounded text-xs font-medium {{ $status['class'] }}">{{ $status['label'] }}</span>
                                            </td>
                                            <td class="px-4 py-2">{{ $game->genre }}</td>
                                            <td class="px-4 py-2">
                                                @if($game->price_type == 2)
                                                    <span
                                                        class="text-xs font-semibold bg-blue-100 text-blue-700 px-2 py-1 rounded">Berbayar</span>
                                                @else
                                                    <span
                                                        class="text-xs font-semibold bg-gray-100 text-gray-600 px-2 py-1 rounded">Gratis</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 text-green-600 font-semibold">
                                                @if($game->price_type == 2)
                                                    Rp {{ number_format($game->price, 0, ',', '.') }}
                                                @else
                                                    <span class="text-gray-400 italic">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                <span class="text-xs font-medium bg-gray-200 text-gray-700 px-2 py-1 rounded">
                                                    {{ $game->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $game->user?->username ?? '-' }}
                                            </td>
                                            <td class="px-4 py-2 flex gap-2 items-center">
                                                <form action="{{ route('backend.admin.updateGame', $game->id) }}" method="POST"
                                                    class="flex items-center gap-2 m-0">
                                                    @csrf
                                                    <select name="status"
                                                        class="text-sm border border-gray-300 rounded px-2 py-1 focus:ring-blue-200">
                                                        <option value="ditinjau" {{ $game->status == 'ditinjau' ? 'selected' : '' }}>
                                                            Ditinjau
                                                        </option>
                                                        <option value="tidak_aktif" {{ $game->status == 'tidak_aktif' ? 'selected' : '' }}>
                                                            Tidak Aktif</option>
                                                        <option value="aktif" {{ $game->status == 'aktif' ? 'selected' : '' }}>Aktif
                                                        </option>
                                                        <option value="ditolak" {{ $game->status == 'ditolak' ? 'selected' : '' }}>
                                                            Ditolak
                                                        </option>
                                                        <option value="banned" {{ $game->status == 'banned' ? 'selected' : '' }}>
                                                            Banned
                                                        </option>
                                                    </select>
                                                    <a href="{{ route('game.detail', Str::slug($game->title)) }}" target="_blank"
                                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs font-semibold px-3 py-1 rounded border border-gray-300 transition">
                                                        Tinjau Game
                                                    </a>
                                                    <button type="submit"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection