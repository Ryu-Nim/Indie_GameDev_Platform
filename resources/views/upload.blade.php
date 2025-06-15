@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto bg-white shadow p-7 rounded-md">
    <h2 class="text-2xl font-semibold mb-6">Upload Game</h2>

    <form id="gameUploadForm" action="{{ route('uploadGame') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

      {{-- FORM KIRI --}}
      <div>
      {{-- Judul Game --}}
      <label class="block mb-2 font-medium">Judul</label>
      <input type="text" name="title" class="w-full p-2 border rounded mb-4" required>

      {{-- Sinopsis --}}
      <label class="block mb-2 font-medium">Deskripsi Singkat / Sinopsis (Opsional)</label>
      <input type="text" name="sinopsis" class="w-full p-2 border rounded mb-4">

      {{-- Video Trailer --}}
      <label class="block mb-2 font-medium">Video Trailer (Opsional)</label>
      <input type="url" name="pv_video_link" class="w-full p-2 border rounded mb-4"
        placeholder="https://www.youtube.com/watch?v=...">

      {{-- Jenis Game --}}
      <label class="block mb-2 font-medium">Jenis Game</label>
      <select name="category_game" class="w-full p-2 border rounded mb-4">
        <option value="Uncategorized" selected>Uncategorized</option>
        <option value="WindowsGame">Windows</option>
        <option value="LinuxGame">Linux</option>
        <option value="WebGame">Play In Browser</option>
      </select>

      {{-- Genre Game --}}
      <label class="block mb-2 font-medium">Genre Game</label>
      <select name="genre" id="genre" class="w-full p-2 border rounded mb-4">
        <option value="Uncategorized" selected>Uncategorized</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="RPG">RPG</option>
        <option value="Simulation">Simulation</option>
        <option value="Strategy">Strategy</option>
        <option value="Puzzle">Puzzle</option>
        <option value="Sports">Sports</option>
        <option value="Horror">Horror</option>
        <option value="Platformer">Platformer</option>
        <option value="Side_Scrolling">Side Scrolling</option>
      </select>

      {{-- Tipe Game --}}
      <label class="block mb-2 font-medium">Tipe Game</label>
      <select name="type_game" class="w-full p-2 border rounded mb-4">
        <option value="html" selected>Web Game</option>
        <option value="downloadable">Downloadable</option>
      </select>

      {{-- Status Game --}}
      <label class="block mb-2 font-medium">Status</label>
      <select name="release_status" class="w-full p-2 border rounded mb-4">
        <option value="1" selected>Masih Dikembangkan</option>
        <option value="2" >Sudah Rilis</option>
      </select>

      {{-- Harga --}}
      <label class="block mb-2 font-medium">Harga</label>
      <div class="flex gap-4 mb-2">
        <label><input type="radio" name="price_type" value="1" checked onchange="togglePriceInput()"> Gratis /
        Donasi</label>
        <label><input type="radio" name="price_type" value="2" onchange="togglePriceInput()"> Berbayar</label>
      </div>
      <div id="priceInputWrapper" style="display: none;">
        <input type="number" name="price" placeholder="Harga (jika berbayar)" class="w-full p-2 border rounded mb-4">
      </div>

      {{-- Upload Game File --}}
      <label class="block mb-2 font-medium">File Game (.zip)</label>
      <input type="file" name="game_file" accept=".zip" class="mb-4 w-full" required>

      {{-- Deskripsi Panjang --}}
      <label class="block mb-2 font-medium">Deskripsi Lengkap</label>
      <textarea name="description" rows="6" class="w-full p-2 border rounded mb-4"></textarea>

      {{-- Submit button type button supaya kita bisa handle manual via JS --}}
      <button type="button" onclick="submitForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
        Upload Game
      </button>
      </div>

      {{-- MEDIA KANAN --}}
      <div>
      {{-- Cover Image --}}
      <label class="block mb-5 font-medium">Cover Image</label>
      <div
        class="relative border-2 border-dashed rounded-md flex items-center justify-center mb-6 cursor-pointer overflow-hidden"
        style="width: 315px; height: 250px;" onclick="document.getElementById('coverInput').click()">
        <span id="coverPlaceholder" class="text-gray-400">Klik untuk upload cover</span>
        <img id="coverPreview" src="" alt="Cover Preview" class="absolute inset-0 object-cover hidden"
        style="width: 630px; height: 500px;">
        <input type="file" id="coverInput" name="cover" accept="image/*" class="hidden"
        onchange="previewCover(event)">
      </div>

      {{-- Screenshot Game --}}
      <label class="block mb-2 font-medium">Screenshot Game (Max 5)</label>
      <div id="screenshotPreviewContainer" class="grid grid-cols-2 gap-4 mb-4"></div>

      <button type="button" onclick="document.getElementById('screenshotInput').click()"
        class="bg-gray-200 hover:bg-gray-300 text-sm px-4 py-2 rounded mb-4">
        + Upload Screenshot
      </button>

      <input type="file" name="screenshots[]" id="screenshotInput" accept="image/*" multiple class="hidden"
        onchange="handleScreenshotUpload(event)">
      </div>
    </div>
    </form>
  </div>

  <script>
    // Toggle harga input jika radio price_type berubah
    function togglePriceInput() {
    const priceType = document.querySelector('input[name="price_type"]:checked').value;
    document.getElementById('priceInputWrapper').style.display = priceType === '2' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', togglePriceInput);

    // Preview cover image
    function previewCover(event) {
    const input = event.target;
    const preview = document.getElementById('coverPreview');
    const placeholder = document.getElementById('coverPlaceholder');

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
      preview.src = e.target.result;
      preview.classList.remove('hidden');
      placeholder.classList.add('hidden');
      };
      reader.readAsDataURL(input.files[0]);
    }
    }

    // Array untuk simpan semua file screenshot yang sudah dipilih
    let screenshotFiles = [];
    let screenshotCount = 0;

    // Handle upload screenshot
    function handleScreenshotUpload(event) {
    const files = Array.from(event.target.files);
    const container = document.getElementById('screenshotPreviewContainer');
    const total = screenshotCount + files.length;

    if (total > 5) {
      alert("Maksimal 5 screenshot.");
      return;
    }

    files.forEach(file => {
      if (screenshotCount >= 5) return;

      screenshotFiles.push(file);

      const reader = new FileReader();
      reader.onload = function (e) {
      const wrapper = document.createElement('div');
      wrapper.className = "relative border rounded overflow-hidden";

      const img = document.createElement('img');
      img.src = e.target.result;
      img.className = "w-full h-auto object-cover";

      wrapper.appendChild(img);
      container.appendChild(wrapper);
      };
      reader.readAsDataURL(file);
      screenshotCount++;
    });

    // Reset input file supaya bisa upload file sama lagi kalau mau
    event.target.value = "";
    }

    // Submit form dengan fetch dan FormData, termasuk file screenshot yang disimpan di array
    function submitForm() {
    const form = document.getElementById('gameUploadForm');
    const formData = new FormData(form);

    // Tambahkan file screenshot yang sudah dipilih
    screenshotFiles.forEach((file, index) => {
      formData.append('screenshots[]', file);
    });

    fetch(form.action, {
      method: 'POST',
      body: formData,
      headers: {
      'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      }
    })
      .then(response => {
      if (!response.ok) throw new Error('Network response was not ok');
      return response.json();
      })
      .then(data => {
      alert('Game berhasil diupload!');
      // Jika mau redirect, ganti url ini
      window.location.href = "/";
      })
      .catch(error => {
      alert('Terjadi kesalahan saat upload.');
      console.error('Error:', error);
      });
    }
  </script>
@endsection