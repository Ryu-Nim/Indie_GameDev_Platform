@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Profil Saya</h2>

    <div class="flex flex-col md:flex-row gap-6">
        <!-- Profile Card -->
        <div class="md:w-2/3 bg-white rounded-xl shadow-md overflow-hidden md:flex relative">
            <div class="md:flex-shrink-0">
                <img class="h-48 w-full object-cover md:w-48" src="https://via.placeholder.com/150" alt="Avatar">
            </div>
            <div class="p-6 w-full">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">User Profile</div>
                        <h5 class="mt-1 text-lg font-bold text-black">Alex Cihuyy</h5>
                    </div>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50 cursor-not-allowed"
                        disabled>
                        Follow
                    </button>
                </div>
                <p class="text-gray-700"><strong>Username:</strong> @lexselow</p>
                <p class="mt-1 text-gray-700"><strong>Deskripsi:</strong> Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Vivamus congue dolor a massa aliquam feugiat. Etiam imperdiet felis lacus,
                    viverra venenatis turpis lobortis ut.
                </p>
            </div>
        </div>

        <!-- Tentang User -->
        <div class="md:w-1/3 bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">About Me</h3>
            <ul class="text-gray-700 space-y-2">
                <li><strong>Instagram:</strong> @notyournzii</li>
                <li><strong>Twitter:</strong> @notyournzii</li>
                <li><strong>Email:</strong> notyournzii@bsi.ac.id</li>
            </ul>
        </div>
    </div>

    <!-- My Games -->
    <div class="mt-10 bg-white rounded-xl shadow-md p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">My Games</h3>
        <div class="max-h-64 overflow-y-auto space-y-4 pr-2">
            {{-- Ganti @for menjadi @foreach jika datanya dari database. --}}
            @for($i = 1; $i <= 8; $i++) <div class="p-4 border rounded-lg hover:bg-gray-100 transition duration-200">
                <h4 class="font-semibold text-blue-600">Game Title {{ $i }}</h4>
                <p class="text-sm text-gray-600 mb-2">Deskripsi singkat game ke-{{ $i }}. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.</p>
        </div>
        @endfor
    </div>
</div>
</div>
@endsection