<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- COVER -->
            <div>
                <img
                    src="{{ $book->cover ? asset('storage/'.$book->cover) : 'https://via.placeholder.com/400x600' }}"
                    class="w-full rounded-xl shadow"
                >
            </div>

            <!-- DETAIL -->
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $book->judul }}</h1>
                <p class="text-gray-600 mb-1">Penulis: {{ $book->author }}</p>
                <p class="text-gray-600 mb-4">
                    Kategori: {{ $book->kategoris->nama ?? '-' }}
                </p>

                <p class="mb-6 text-gray-700">
                    {{ $book->description }}
                </p>

                @if ($book->status === 'tersedia')
                    <a href="{{ route('peminjaman.create', $book->id) }}"
                       class="inline-block bg-[#7FA36A] text-white px-6 py-3 rounded-xl font-semibold">
                        Ajukan Peminjaman
                    </a>
                @else
                    <span class="text-red-500 font-semibold">
                        Buku sedang dipinjam
                    </span>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
