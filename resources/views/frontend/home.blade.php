<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Game Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* 
            CSS RESPONSIVE UNTUK HEADER DAN POPUP MOBILE
            --------------------------------------------
            - Mengatur header, action bar, dan popup agar responsif di mobile.
            - Mengatur posisi profile/login agar tidak bentrok dengan search bar.
            - Mengatur ukuran popup agar proporsional di layar kecil.
        */

        @media (max-width: 400px) {

            /* Header stack vertikal di mobile */
            .header-mobile-stack {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 6px !important;
                padding-left: 8px !important;
                padding-right: 8px !important;
                padding-top: 8px !important;
                padding-bottom: 8px !important;
            }

            /* Link header jadi kolom di mobile */
            .header-mobile-stack .header-links {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 2px !important;
                width: 100%;
            }

            /* Ukuran font link header di mobile */
            .header-mobile-stack .header-links a,
            .header-mobile-stack .header-links span {
                font-size: 13px !important;
                padding: 0 !important;
            }

            /* Search bar tetap penuh di mobile */
            .header-mobile-stack .header-search {
                width: 100% !important;
                margin-top: 4px !important;
            }

            /* Action bar (profile/login) di kanan atas, lebih naik */
            #headerActionMobile {
                position: absolute !important;
                right: 8px !important;
                top: 0 !important;
                gap: 8px !important;
                z-index: 50;
            }

            /* Jarak profile mobile dari atas */
            #profileContainerMobile {
                margin-top: 4px !important;
            }

            /* Hilangkan margin default pada item action bar */
            #headerActionMobile>* {
                margin-left: 0 !important;
                margin-top: 0 !important;
            }

            /* Popup profil/login mobile: ukuran proporsional */
            #profilePopupMobile,
            #loginPopupMobile {
                min-width: 150px !important;
                max-width: 80vw !important;
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }

        @media (max-width: 430px) {

            /* Action bar tetap row dan rapi di mobile */
            #headerActionMobile {
                position: absolute !important;
                right: 8px !important;
                top: 8px !important;
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 8px !important;
                width: auto !important;
                z-index: 50;
            }

            #headerActionMobile>* {
                margin-left: 0 !important;
                margin-top: 0 !important;
            }

            /* Popup profil/login mobile: ukuran proporsional */
            #profilePopup,
            #profilePopupMobile,
            #loginPopupMobile {
                min-width: 150px !important;
                max-width: 80vw !important;
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }

        .header-search {
            position: relative;
            /* Agar hasil pencarian tetap dalam konteks search bar */
        }

        #searchResults {
            position: absolute;
            top: 100%;
            /* Letakkan hasil pencarian tepat di bawah input */
            left: 0;
            width: 100%;
            /* Ukuran sama dengan input */
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 50;
            /* Pastikan hasil muncul di atas elemen lain */
            display: none;
            /* Sembunyikan jika tidak ada hasil */
        }

        button {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar Full Width -->
    <header
        class="w-full relative flex flex-col sm:flex-row items-center justify-between gap-3 px-4 py-4 bg-white border-b header-mobile-stack">
        <div class="flex items-center flex-wrap gap-x-2 gap-y-2 max-w-full justify-center header-links">
            <a href="{{ url('/') }}" class="text-lg font-bold">
                LOGO
            </a>
            <!-- Hanya tampil di desktop -->
            <a href="#" class="hidden sm:inline text-sm sm:text-base font-medium hover:text-blue-600">Cari
                Game</a>
            @if(!Auth::check() || Auth::user()->role == 2)
                <a href="{{ route('uploadGame') }}"
                    class="hidden sm:inline text-sm sm:text-base font-medium hover:text-blue-600">Upload Game</a>
            @endif
        </div>
        <div class="relative w-full sm:w-1/3 header-search">
            <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </span>
            <input type="text" id="searchInput" placeholder="Cari game atau creator"
                class="w-full border border-gray-300 rounded pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <!-- Container hasil pencarian live -->
            <div id="searchResults" class="absolute w-full sm:w-1/3 bg-white shadow-lg rounded mt-2 hidden"></div>
        </div>

        <!-- Mobile & Desktop Action -->
        <div class="flex items-center gap-2 sm:static absolute right-2 top-2 sm:top-auto sm:right-auto z-50 sm:ml-0 ml-auto sm:mt-0 mt-2"
            id="headerActionMobile">
            @if(Auth::check())
                <!-- Desktop Profile -->
                <div class="relative hidden sm:flex items-center group" id="profileContainer">
                    <img id="profileBtn"
                        src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.jpg') }}"
                        alt="Profil" class="w-8 h-8 rounded-full object-cover cursor-pointer">

                    <!-- Pop-up Profil Desktop -->
                    <div id="profilePopup"
                        class="absolute top-6 right-0 bg-white shadow-lg rounded-lg py-5 px-7 border border-gray-200
                                                                                                                                                                                        min-w-[180px] sm:min-w-[220px] w-[90vw] max-w-xs sm:w-auto
                                                                                                                                                                                        invisible opacity-0 group-hover:visible group-hover:opacity-100
                                                                                                                                                                                        pointer-events-none group-hover:pointer-events-auto
                                                                                                                                                                                        transition z-50">
                        <p class="text-base sm:text-lg font-semibold text-gray-700">{{ Auth::user()->username }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-red-500 text-sm sm:text-base font-medium hover:underline mt-3 sm:mt-4 block">Logout</button>
                        </form>
                    </div>
                </div>
                <!-- Mobile Profile -->
                <div class="flex sm:hidden items-center" id="profileContainerMobile">
                    <img id="profileBtnMobile"
                        src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.jpg') }}"
                        alt="Profil" class="w-6 h-6 rounded-full object-cover cursor-pointer">

                    <!-- Pop-up Profil Mobile -->
                    <div id="profilePopupMobile"
                        class="absolute top-10 right-0 bg-white shadow-lg rounded-md py-4 px-4 border border-gray-200 hidden z-50 min-w-[120px] w-[30vw] max-w-[200px] min-h-[10px] max-h-[120px]">
                        <p class="text-base font-semibold text-gray-700 mb-2">{{ Auth::user()->username }}</p>
                        <!-- Tombol Cari Game & Upload Game di Popup Mobile -->
                        <a href="#"
                            class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 rounded py-2 mb-2 text-sm font-medium">Cari
                            Game</a>
                        @if(!Auth::check() || Auth::user()->role == 2)
                            <a href="{{ route('uploadGame') }}"
                                class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white rounded py-2 mb-2 text-sm font-medium">Upload
                                Game</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-red-500 text-sm font-medium hover:underline mt-2 block w-full text-left">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Mobile Login -->
                <div class="flex items-center gap-2 sm:hidden" id="authMobile">
                    <button id="loginPopupBtn"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded text-xs">Login</button>
                    <!-- Popup Login Mobile -->
                    <div id="loginPopupMobile"
                        class="absolute top-10 right-0 bg-white shadow-lg rounded-md py-4 px-4 border border-gray-200 hidden z-50 min-w-[180px] w-[90vw] max-w-xs">
                        <!-- Tombol Cari Game & Upload Game di Popup Mobile -->
                        <a href="#"
                            class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 rounded py-2 mb-2 text-sm font-medium">Cari
                            Game</a>
                        <a href="{{ route('uploadGame') }}"
                            class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white rounded py-2 mb-2 text-sm font-medium">Upload
                            Game</a>
                        <a href="{{ route('login') }}"
                            class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white rounded py-2 text-sm font-medium mt-2">Login</a>
                    </div>
                </div>
                <!-- Desktop Login/Register -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">Register</a>
                </div>
            @endif
        </div>
    </header>

    <!-- Sidebar di bawah Navbar -->
    <div class="flex flex-row min-h-screen">
        <!-- Sidebar -->
        <aside class="w-20 sm:w-24 bg-white border-r border-gray-300 flex flex-col items-center py-4 space-y-8">

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
                <a href="{{ route('community') }}"
                    class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 active:text-blue-800 transition-colors duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 11a3 3 0 11-6 0 3 3 0 016 0zm-6 8h6"
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
                        <path d="M12 14l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" />
                        <path d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    <span class="text-xs text-gray-700">Game</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <main class="p-2 sm:p-4">
                <div
                    class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
                    @foreach($games as $game)
                        @php
                            $isBookmarked = auth()->user()->bookmarks->contains('game_id', $game->id);
                        @endphp
                        <div class="relative bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                            <!-- Tombol Bookmark -->
                            <form onsubmit="event.preventDefault(); toggleBookmark({{ $game->id }}, this);"
                                class="absolute bottom-2 right-2 z-10">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <button type="submit"
                                    class="bookmark-button text-{{ $isBookmarked ? 'blue' : 'gray' }}-500 hover:text-blue-500 transition"
                                    data-game-id="{{ $game->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path d="M2 2v12l6-3 6 3V2z" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Cover Game -->
                            <a href="{{ route('game.detail', $game->title) }}">
                                <img src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : asset('images/default-cover.jpg') }}"
                                    alt="{{ $game->title }}" class="w-full h-40 sm:h-40 md:h-44 object-cover rounded-t-lg">
                            </a>

                            <div class="p-3">
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


        <!-- JS tetap di bawah -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Desktop hover
                const profileContainer = document.getElementById('profileContainer');
                const profilePopup = document.getElementById('profilePopup');
                if (profileContainer && profilePopup) {
                    profileContainer.addEventListener('mouseenter', () => {
                        profilePopup.classList.remove('invisible', 'opacity-0', 'pointer-events-none');
                        profilePopup.classList.add('visible', 'opacity-100', 'pointer-events-auto');
                    });
                    profileContainer.addEventListener('mouseleave', () => {
                        profilePopup.classList.add('invisible', 'opacity-0', 'pointer-events-none');
                        profilePopup.classList.remove('visible', 'opacity-100', 'pointer-events-auto');
                    });
                }

                // Mobile profile popup
                const profileBtnMobile = document.getElementById('profileBtnMobile');
                const profilePopupMobile = document.getElementById('profilePopupMobile');
                if (profileBtnMobile && profilePopupMobile) {
                    profileBtnMobile.addEventListener('click', function (e) {
                        e.stopPropagation();
                        profilePopupMobile.classList.toggle('hidden');
                    });
                    document.addEventListener('click', function () {
                        if (!profilePopupMobile.classList.contains('hidden')) {
                            profilePopupMobile.classList.add('hidden');
                        }
                    });
                    profilePopupMobile.addEventListener('click', function (e) {
                        e.stopPropagation();
                    });
                }

                // Mobile login popup
                const loginPopupBtn = document.getElementById('loginPopupBtn');
                const loginPopupMobile = document.getElementById('loginPopupMobile');
                if (loginPopupBtn && loginPopupMobile) {
                    loginPopupBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        loginPopupMobile.classList.toggle('hidden');
                    });
                    document.addEventListener('click', function () {
                        if (!loginPopupMobile.classList.contains('hidden')) {
                            loginPopupMobile.classList.add('hidden');
                        }
                    });
                    loginPopupMobile.addEventListener('click', function (e) {
                        e.stopPropagation();
                    });
                }
            });
            document.getElementById("searchInput").addEventListener("keyup", function () {
                let query = this.value;
                let resultsContainer = document.getElementById("searchResults");

                if (query.length > 0) {
                    fetch(`/live-search?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            resultsContainer.innerHTML = "";
                            if (data.length > 0) {
                                data.forEach(game => {
                                    let item = document.createElement("div");
                                    item.innerHTML = `<a href="/game/${game.title}" class="block px-4 py-2 hover:bg-gray-100">${game.title}</a>`;
                                    resultsContainer.appendChild(item);
                                });
                                resultsContainer.style.display = "block"; // Pastikan hasil muncul
                            } else {
                                resultsContainer.innerHTML = `<div class="px-4 py-2 text-gray-500">Tidak ada hasil</div>`;
                                resultsContainer.style.display = "block";
                            }
                        });
                } else {
                    resultsContainer.style.display = "none"; // Sembunyikan kalau tidak ada input
                }
            });

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
</body>

</html>