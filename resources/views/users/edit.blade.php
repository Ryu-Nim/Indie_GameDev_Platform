@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Profil</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan input:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No. Telepon:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Ganti Foto Profil:</label>
            <input type="file" name="photo" class="form-control">
            @if ($user->photo)
                <small class="text-muted">Foto saat ini: {{ $user->photo }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru (opsional):</label>
            <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengubah password">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('profile', $user->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
