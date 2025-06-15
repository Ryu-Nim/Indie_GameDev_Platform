<div class="flex items-center flex-wrap gap-x-2 gap-y-2 max-w-full justify-center header-links">
  <a href="{{ route('home') }}" class="text-lg font-bold">
    LOGO
  </a>
  <!-- Hanya tampil di desktop -->
  <a href="#" class="hidden sm:inline text-sm sm:text-base font-medium hover:text-blue-600">Cari Game</a>
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


<div
  class="flex items-center gap-2 sm:static absolute right-2 top-2 sm:top-auto sm:right-auto z-50 sm:ml-0 ml-auto sm:mt-0 mt-2"
  id="headerActionMobile">
  @if(Auth::check())
    <!-- Desktop Profile -->
    <div class="relative hidden sm:flex items-center group" id="profileContainer">
    <img id="profileBtn"
      src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.jpg') }}"
      alt="Profil" class="w-8 h-8 rounded-full object-cover cursor-pointer">
    <!-- Pop-up Profil Desktop -->
    <div id="profilePopup" class="absolute top-6 right-0 bg-white shadow-lg rounded-lg py-5 px-7 border border-gray-200
      min-w-[180px] sm:min-w-[220px] w-[90vw] max-w-xs sm:w-auto
      invisible opacity-0 group-hover:visible group-hover:opacity-100
      pointer-events-none group-hover:pointer-events-auto
      transition z-50">
      <p class="text-base sm:text-lg font-semibold text-gray-700 text-center mb-3">{{ Auth::user()->username }}</p>
      <div class="w-full border-t border-gray-300 my-4"></div>
      <div class="flex items-center gap-2 mb-2">
      <span class="text-yellow-500 font-semibold text-sm ml-auto mb-3">Coin: {{ Auth::user()->coin }}</span>
      @if(Auth::user()->role == 2)
      <span class="text-red-500 font-semibold text-sm ml-auto mb-3 mr-auto">Red Coin: {{ Auth::user()->redcoin }}</span>
    @endif
      </div>
      @if(Auth::user()->role == 1)
      <a href="{{ route('requestform.form') }}"
      class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 rounded py-2 mt-3 text-sm font-medium mb-2">
      Request Role Developer
      </a>
    @endif
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
      <p class="text-base font-semibold text-gray-700 text-center mb-3">{{ Auth::user()->username }}</p>
      <div class="flex items-center gap-2 mb-2">
      <span class="text-yellow-500 font-semibold text-sm">Coin: {{ Auth::user()->coin }}</span>
      @if(Auth::user()->role == 2)
      <span class="text-red-500 font-semibold text-sm">Red Coin: {{ Auth::user()->redcoin }}</span>
    @endif
      </div>
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
    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Login</a>
    <a href="{{ route('register') }}"
      class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">Register</a>
    </div>
  @endif
</div>