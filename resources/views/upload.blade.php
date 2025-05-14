@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto bg-white shadow p-7 rounded-md">
    <h2 class="text-2xl font-semibold mb-6">Upload Game</h2>

    <form action="{{ route('uploadGame') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      {{-- FORM KIRI --}}
      <div>
      {{-- Judul Game --}}
      <label class="block mb-2 font-medium">Judul</label>
      <input type="text" name="title" class="w-full p-2 border rounded mb-4" required>

      {{-- Tagline --}}
      <label class="block mb-2 font-medium">Deskripsi Singkat / Tagline</label>
      <input type="text" name="tagline" class="w-full p-2 border rounded mb-4">

      {{-- Video Trailer --}}
      <label class="block mb-2 font-medium">Video Trailer (Opsional)</label>
      <input type="url" name="trailer" class="w-full p-2 border rounded mb-4"
        placeholder="https://www.youtube.com/watch?v=...">

      {{-- Jenis Game --}}
      <label class="block mb-2 font-medium">Jenis Game</label>
      <select name="category" class="w-full p-2 border rounded mb-4">
        <option value="game">Windows</option>
        <option value="tool">Linux</option>
        <option value="assets">Play In Browser</option>
      </select>

      {{-- Tipe Game --}}
      <label class="block mb-2 font-medium">Tipe Game</label>
      <select name="type" class="w-full p-2 border rounded mb-4">
        <option value="downloadable">Downloadable</option>
        <option value="html">HTML (Web)</option>
      </select>

      {{-- Status --}}
      <label class="block mb-2 font-medium">Status</label>
      <select name="status" class="w-full p-2 border rounded mb-4">
        <option value="released">Sudah Rilis</option>
        <option value="in_development">Masih Dikembangkan</option>
      </select>

      {{-- Harga --}}
      <label class="block mb-2 font-medium">Harga</label>
      <div class="flex gap-4 mb-2">
        <label>
        <input type="radio" name="price_type" value="free" checked onchange="togglePriceInput()"> Gratis / Donasi
        </label>
        <label>
        <input type="radio" name="price_type" value="paid" onchange="togglePriceInput()"> Berbayar
        </label>
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

      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
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

      <div id="screenshotPreviewContainer" class="grid grid-cols-2 gap-4 mb-4">
        {{-- Preview screenshot akan muncul di sini --}}
      </div>

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
    function togglePriceInput() {
    const isPaid = document.querySelector('input[name="price_type"]:checked').value === 'paid';
    document.getElementById('priceInputWrapper').style.display = isPaid ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', togglePriceInput);

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

    let screenshotCount = 0;

    function handleScreenshotUpload(event) {
    const files = Array.from(event.target.files);
    const container = document.getElementById('screenshotPreviewContainer');

    if (screenshotCount + files.length > 5) {
      alert("Maksimal 5 screenshot.");
      return;
    }

    files.forEach(file => {
      if (screenshotCount >= 5) return;

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

    event.target.value = '';
    }
  </script>
@endsection