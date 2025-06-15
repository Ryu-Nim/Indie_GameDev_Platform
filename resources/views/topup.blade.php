@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

@section('content')
<div class="container mx-auto px-4 py-3">
    <div class="relative mb-10 text-center">
        <h2 class="text-5xl font-extrabold text-blue-600 drop-shadow-md">🎮 Boost Up Center</h2>
        <p class="text-gray-500 mt-2">Boost performa komunitas mu & mainkan </p>
        <p class="text-gray-500 mt-0">lebih banyak game dengan lebih bebas</p>
        <div
            class="absolute left-1/2 transform -translate-x-1/2 w-48 h-1 bg-gradient-to-r from-blue-400 via-indigo-500 to-blue-600 rounded-full mt-4">
        </div>
    </div>

    {{-- Main Card --}}
    <div
        class="bg-gradient-to-br from-white via-blue-50 to-white shadow-xl rounded-2xl p-8 max-w-5xl mx-auto border border-blue-100">
        <form action="{{ route('topup.store') }}" method="POST">
            @csrf
        </form>
        @csrf

        {{-- Username --}}
        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Username: </label>
            <input type="text" value="Alexchuuuyy" disabled class="w-full border border-white-300 rounded-md p-3 bg-white-100 text-gray-800 font-medium shadow-inner">
        </div>

        <div x-data="{ tab: 'coin' }" class="mb-10">
            <div class="flex justify-center mb-6">
                <button @click="tab = 'coin'"
                    :class="tab === 'coin' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-6 py-2 rounded-l-lg font-semibold transition">💰 Coin</button>
                <button @click="tab = 'premium'"
                    :class="tab === 'premium' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-6 py-2 rounded-r-lg font-semibold transition">⭐ Premium</button>
            </div>

            <div>
                <div x-show="tab === 'coin'" x-transition>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Coin</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-5" id="coinOptions">
                        @foreach([
                        ['coin' => 50, 'price' => 5000],
                        ['coin' => 100, 'price' => 10000],
                        ['coin' => 250, 'price' => 25000],
                        ['coin' => 500, 'price' => 45000],
                        ['coin' => 1000, 'price' => 85000],
                        ] as $option)
                        <label class="cursor-pointer transform hover:scale-105 transition">
                            <input type="radio" name="amount" value="{{ $option['coin'] }}"
                                data-price="{{ $option['price'] }}" class="hidden peer">
                            <div
                                class="flex flex-col items-center justify-center text-center p-4 rounded-xl bg-white border border-gray-300 shadow-md peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-400">
                                <img src="https://via.placeholder.com/50" class="mb-2" alt="Coin Icon">
                                <span class="text-xl font-bold text-blue-600">{{ $option['coin'] }}</span>
                                <span class="text-sm text-gray-600">Rp{{ number_format($option['price'], 0, ',',
                                    '.') }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div x-show="tab === 'premium'" x-transition>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Paket Premium</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach([
                        ['label' => 'Mingguan', 'duration' => 7, 'price' => 15000],
                        ['label' => 'Bulanan', 'duration' => 30, 'price' => 50000],
                        ['label' => 'Tahunan', 'duration' => 365, 'price' => 450000],
                        ] as $pkg)
                        <label class="cursor-pointer">
                            <input type="radio" name="amount" value="{{ strtolower($pkg['label']) }}_premium"
                                data-price="{{ $pkg['price'] }}" class="hidden peer">
                            <div
                                class="p-6 rounded-xl bg-gradient-to-br from-yellow-100 via-yellow-50 to-white border border-yellow-400 shadow-md peer-checked:ring-2 peer-checked:ring-yellow-500 text-center">
                                <h4 class="text-lg font-bold text-yellow-700 mb-1">{{ $pkg['label'] }}</h4>
                                <p class="text-sm text-gray-600">Akses premium selama {{ $pkg['duration'] }} hari
                                </p>
                                <p class="text-xl mt-2 font-semibold text-yellow-800">Rp{{
                                    number_format($pkg['price'], 0, ',', '.') }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Metode Pembayaran</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['gopay', 'ovo', 'dana', 'Bank'] as $method)
                <label class="cursor-pointer">
                    <input type="radio" name="payment" value="{{ $method }}" class="hidden peer">
                    <div
                        class="w-28 h-20 flex items-center justify-center rounded-lg bg-gray-100 border border-gray-300 text-gray-700 font-medium shadow-sm peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-300 capitalize hover:bg-blue-50 transition">
                        {{ $method }}
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <div class="mb-10">
            <p class="text-lg text-gray-800 font-semibold">Total Harga: <span id="totalPrice"
                    class="text-blue-600">-</span></p>
        </div>

        <div class="text-center">
            <button type="button" onclick="openModal()"
                class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition">
                Top Up Sekarang
            </button>
        </div>
        </form>
    </div>
</div>

<div id="confirmModal" class="fixed inset-0 z-50 bg-black bg-opacity-40 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 shadow-xl max-w-sm w-full text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Konfirmasi Top Up?</h3>
        <p class="text-gray-600 mb-6">Pastikan pilihan coin dan metode pembayaran kamu sudah benar.</p>
        <div class="flex justify-center gap-4">
            <button onclick="closeModal()"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-800">Batal</button>
            <button onclick="submitForm()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ya,
                Lanjut</button>
        </div>
    </div>
</div>

<script>
    const radios = document.querySelectorAll('input[name="amount"]');
    const totalPrice = document.getElementById('totalPrice');
    const modal = document.getElementById('confirmModal');

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            const price = this.getAttribute('data-price');
            totalPrice.textContent = 'Rp' + parseInt(price).toLocaleString('id-ID');
        });
    });

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    function submitForm() {
        document.getElementById('topupForm').submit();
    }
</script>
@endsection