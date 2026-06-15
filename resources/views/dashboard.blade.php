<x-app-layout>
    <div class="min-h-screen bg-[#EEF5EC]">
        <!-- HERO BANNER -->
        <div class="px-8 mt-8">
            <div class="bg-gradient-to-r from-[#9BBC85] to-[#7FA36A] rounded-2xl p-10 text-white shadow-lg">
                <h2 class="text-3xl font-bold mb-2">
                    Mau membaca lebih banyak?
                </h2>
                <p class="mb-6">
                    Jelajahi koleksi buku terbaru dan terpopuler di Peak Library
                </p>
                <a href="{{ route('books.index') }}"
                   class="bg-white text-[#7FA36A] px-6 py-3 rounded-xl font-semibold">
                    Lihat Semua Buku
                </a>
            </div>
        </div>

        <!-- SEARCH -->
        <div class="px-8 mt-6">
            <form action="{{ route('dashboard') }}" method="GET">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari buku di Peak Library (tekan Enter)"
                       class="w-full px-4 py-3 rounded-xl border-gray-300
                              focus:border-[#9BBC85] focus:ring-[#9BBC85]">
            </form>
        </div>

        <!-- KATEGORI -->
        <div class="px-8 mt-10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-[#2F3E2E]">Kategori Buku</h3>
                @if(request('kategori'))
                    <a href="{{ route('dashboard') }}" class="text-sm text-red-500 hover:underline">Hapus Filter</a>
                @endif
            </div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                @foreach($categories as $cat)
                    <a href="{{ route('dashboard', ['kategori' => $cat->nama_kategoris]) }}"
                       class="p-6 rounded-xl shadow text-center font-medium transition block
                              {{ request('kategori') == $cat->nama_kategoris ? 'bg-[#9BBC85] text-white' : 'bg-white hover:bg-gray-50 text-gray-800' }}">
                        {{ $cat->nama_kategoris }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- BUKU TERBARU -->
        <div class="px-8 mt-12 pb-10">
            <h3 class="text-xl font-bold text-[#2F3E2E] mb-6">
                Buku Terbaru
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

                        <!-- KLIK GAMBAR → DETAIL BUKU -->
                        <a href="{{ route('books.show', $book->id) }}">
                            <img
                                src="{{ $book->cover ? asset('storage/'.$book->cover) : 'https://via.placeholder.com/300x400' }}"
                                alt="{{ $book->judul }}"
                                class="w-full h-64 object-contain rounded-lg bg-gray-100 hover:scale-105 transition"
                            >
                        </a>

                        <h4 class="font-semibold mt-3">
                            {{ $book->judul }}
                        </h4>

                        <p class="text-sm text-gray-600">
                            {{ $book->author ?? '-' }}
                        </p>

                        <!-- STATUS -->
                        <p class="mt-2 text-sm">
                            @if(strtolower($book->status) === 'tersedia')
                                <span class="text-green-600 font-semibold">Tersedia</span>
                            @else
                                <span class="text-red-500 font-semibold">Dipinjam</span>
                            @endif
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-4">
                        Belum ada buku tersedia.
                    </p>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
