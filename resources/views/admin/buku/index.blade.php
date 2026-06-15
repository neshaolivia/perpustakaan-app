<x-app-layout>

<div class="max-w-6xl mx-auto px-10 py-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelola Data Buku</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Buku</h3>
            <a href="{{ route('admin.buku.create') }}" class="px-4 py-2 bg-[#99BC85] text-white rounded-lg hover:bg-[#88ad74] transition">
                + Tambah Buku
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#99BC85] text-white">
                        <th class="p-3 rounded-tl-lg font-semibold">Judul</th>
                        <th class="p-3 font-semibold">Penulis</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 text-center rounded-tr-lg font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($books as $buku)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-3">{{ $buku->judul }}</td>
                        <td class="p-3">{{ $buku->author }}</td>
                        <td class="p-3">
                            <span class="px-3 py-1 text-sm rounded-full {{ $buku->status == 'Tersedia' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $buku->status }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.buku.edit', $buku->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            Data buku belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>
