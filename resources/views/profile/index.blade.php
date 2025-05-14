@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Saya</h2>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div>
        @if ($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="120">
        @else
            <p>Tidak ada avatar.</p>
        @endif
    </div>

    <ul>
        <li><strong>Username:</strong> {{ $user->username }}</li>
        <li><strong>Nama:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>No. Telepon:</strong> {{ $user->phone ?? '-' }}</li>
    </ul>

    <div style="margin-top: 20px;">
        <a href="{{ route('profile.edit') }}">Edit Profil</a> |
        <form action="{{ route('profile.destroy') }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin hapus akun?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="color:red;">Hapus Akun</button>
        </form>
    </div>
</div>
@endsection
