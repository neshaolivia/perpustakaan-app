<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-600">No</th>
                                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-600">Judul Buku</th>
                                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-600">Nama Peminjam</th>
                                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-600">Tanggal Peminjaman</th>
                                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-600">Tanggal Pengembalian</th>
                                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-600">Status</th>
                                    <th class="px-6 py-3 border-b text-center text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjaman as $index => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $item->book->judul ?? '-' }}</td>
                                        <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $item->user->name ?? '-' }}</td>
                                        <td class="px-6 py-4 border-b text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 border-b text-sm text-gray-700">{{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}</td>
                                        <td class="px-6 py-4 border-b text-sm">
                                            @if($item->status == 'Dipinjam')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Dipinjam</span>
                                            @else
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b text-center text-sm">
                                            <form action="{{ route('admin.peminjaman.update', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="Dipinjam" {{ $item->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                                    <option value="Dikembalikan" {{ $item->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 border-b text-center text-sm text-gray-500">Belum ada data peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
