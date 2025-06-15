@extends('backend.layouts.app')

@section('title', 'Permintaan Role Developer')

@section('content')
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Permintaan Role Developer</h1>

        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Jika tidak ada data --}}
        @if ($roleRequests->isEmpty())
            <div class="text-gray-500 text-sm italic">Belum ada permintaan role developer.</div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase tracking-wide border-b">
                        <tr>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Alasan</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($roleRequests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">{{ $request->user->name }}</div>
                                    <div class="text-gray-500 text-xs">{{ $request->user->username }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->reason }}</td>
                                <td class="px-6 py-4 capitalize text-gray-700">{{ $request->status }}</td>
                                <td class="px-6 py-4">
                                    @if ($request->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="{{ route('backend.admin.role-requests.approve', $request->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-1.5 rounded-md transition text-xs font-medium">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('backend.admin.role-requests.reject', $request->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-md transition text-xs font-medium">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-500 italic">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
