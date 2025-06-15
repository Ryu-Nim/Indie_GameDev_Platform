@extends('backend.layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Kelola Admin</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">Username</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Role</th>
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $admin->username }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $admin->email }}</td>
            <td class="border border-gray-300 px-4 py-2">
                {{ $admin->role == 1 ? 'Super Admin' : 'Admin Biasa' }}
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <form action="{{ route('backend.admin.updateRole', $admin->id) }}" method="POST">
                    @csrf
                    <select name="role" class="px-2 py-1 border rounded">
                        <option value="1" {{ $admin->role == 1 ? 'selected' : '' }}>Super Admin</option>
                        <option value="2" {{ $admin->role == 2 ? 'selected' : '' }}>Admin Biasa</option>
                    </select>
                    <button type="submit" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Ubah Role
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection