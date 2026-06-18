<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Riwayat Peminjaman Buku</h1>

        <!-- ALERT -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-4 font-semibold text-gray-600">No</th>
                        <th class="p-4 font-semibold text-gray-600">Buku</th>
                        <th class="p-4 font-semibold text-gray-600">Tanggal Pinjam</th>
                        <th class="p-4 font-semibold text-gray-600">Tanggal Kembali</th>
                        <th class="p-4 font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $peminjaman)
                        <tr class="border-b last:border-0 hover:bg-gray-50">
                            <td class="p-4 text-gray-600">{{ $loop->iteration }}</td>
                            <td class="p-4">
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $peminjaman->book->judul }}</div>
                                    <div class="text-sm text-gray-500">{{ $peminjaman->book->author }}</div>
                                </div>
                            </td>
                            <td class="p-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                            </td>
                            <td class="p-4 text-gray-600">
                                {{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') : '-' }}
                            </td>
                            <td class="p-4">
                                @if(strtolower($peminjaman->status) === 'dipinjam')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-full">Dipinjam</span>
                                @elseif(strtolower($peminjaman->status) === 'dikembalikan')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">Dikembalikan</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-full">{{ ucfirst($peminjaman->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada riwayat peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
