@extends('backend.layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Kelola User</h2>

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
            <th class="border border-gray-300 px-4 py-2">Status</th>
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $user->username }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
            <td class="border border-gray-300 px-4 py-2">
                {{ $user->role == 1 ? 'User' : 'Developer' }}
            </td>
            @switch($user->status)
                @case(1)
                    <td class="border border-gray-300 px-4 py-2">Aktif</td>
                    @break
                @case(2)
                    <td class="border border-gray-300 px-4 py-2">Tidak Aktif</td>
                    @break
                @case(3)
                    <td class="border border-gray-300 px-4 py-2">Tinjau</td>
                    @break
                @case(4)
                    <td class="border border-gray-300 px-4 py-2">Banned</td>
                    @break
                @default
                    <td class="border border-gray-300 px-4 py-2">Tidak Diketahui</td>
            @endswitch
            <td class="border border-gray-300 px-4 py-2">
                <form action="{{ route('backend.admin.updateUser', $user->id) }}" method="POST">
                    @csrf
                    <select name="role" class="px-2 py-1 border rounded">
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>user</option>
                        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>developer</option>
                    </select>

                    <select name="status" class="px-2 py-1 border rounded">
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>Tinjau</option>
                        <option value="4" {{ $user->status == 4 ? 'selected' : '' }}>Banned</option>
                    </select>

                    <button type="submit" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Update
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection