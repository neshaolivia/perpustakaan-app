<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-6">
            Ajukan Peminjaman Buku
        </h1>

        <!-- INFO BUKU -->
        <div class="bg-white rounded-xl shadow p-6 flex gap-6 mb-6">
            <img
                src="{{ $book->cover ? asset('storage/'.$book->cover) : 'https://via.placeholder.com/150x220' }}"
                class="w-32 h-48 object-contain bg-gray-100 rounded"
            >

            <div>
                <h2 class="text-xl font-bold">{{ $book->judul }}</h2>
                <p class="text-gray-600">{{ $book->author }}</p>
                <p class="mt-2 text-sm">
                    Status:
                    @if(strtolower($book->status) === 'tersedia')
                        <span class="text-green-600 font-semibold">Tersedia</span>
                    @else
                        <span class="text-red-500 font-semibold">Dipinjam</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- ALERT -->
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM PEMINJAMAN -->
        <form action="{{ route('peminjaman.store') }}" method="POST"
              class="bg-white rounded-xl shadow p-6 space-y-4">
            @csrf

            <input type="hidden" name="id_buku" value="{{ $book->id }}">

            <div>
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" required {{ strtolower($book->status) !== 'tersedia' ? 'disabled' : '' }}
                       class="w-full rounded-lg border-gray-300 focus:border-[#9BBC85] focus:ring-[#9BBC85] {{ strtolower($book->status) !== 'tersedia' ? 'bg-gray-100 text-gray-500' : '' }}">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">NIM</label>
                <input type="text" name="nim" value="{{ old('nim', Auth::user()->nim) }}" required {{ strtolower($book->status) !== 'tersedia' ? 'disabled' : '' }}
                       class="w-full rounded-lg border-gray-300 focus:border-[#9BBC85] focus:ring-[#9BBC85] {{ strtolower($book->status) !== 'tersedia' ? 'bg-gray-100 text-gray-500' : '' }}">
                @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required {{ strtolower($book->status) !== 'tersedia' ? 'disabled' : '' }}
                       class="w-full rounded-lg border-gray-300 focus:border-[#9BBC85] focus:ring-[#9BBC85] {{ strtolower($book->status) !== 'tersedia' ? 'bg-gray-100 text-gray-500' : '' }}">
                @error('tanggal_pinjam') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required {{ strtolower($book->status) !== 'tersedia' ? 'disabled' : '' }}
                       class="w-full rounded-lg border-gray-300 focus:border-[#9BBC85] focus:ring-[#9BBC85] {{ strtolower($book->status) !== 'tersedia' ? 'bg-gray-100 text-gray-500' : '' }}">
                <p class="text-sm text-gray-500 mt-1">Maksimal 30 hari dari tanggal peminjaman</p>
                @error('tanggal_kembali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    {{ strtolower($book->status) !== 'tersedia' ? 'disabled' : '' }}
                    class="{{ strtolower($book->status) !== 'tersedia' ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#7FA36A] hover:bg-[#6c8c5a]' }} text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                Ajukan Peminjaman
            </button>
        </form>

    </div>
</x-app-layout>
