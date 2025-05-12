@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Saya</h2>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Username:</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}">
        </div>

        <div>
            <label>Nama:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <div>
            <label>No Telepon:</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div>
            <label>Avatar:</label>
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" width="100">
            @endif
            <input type="file" name="avatar">
        </div>

        <button type="submit">Simpan</button>
    </form>

    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin hapus akun?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="color: red;">Hapus Akun</button>
    </form>
</div>
@endsection
