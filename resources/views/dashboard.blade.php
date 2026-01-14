<x-app-layout>
    <div class="min-h-screen bg-[#EEF5EC]">

        <!-- TAB MENU -->
        <div class="bg-white px-8 py-4 flex gap-8 shadow-sm">
            <a class="font-semibold text-[#9BBC85]">Buku</a>
            <a class="text-gray-500">Peminjaman</a>
            <a class="text-gray-500">Riwayat</a>
            <a class="text-gray-500">Bantuan</a>
        </div>

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

        <!-- SEARCH (UI ONLY) -->
        <div class="px-8 mt-6">
            <input type="text"
                   placeholder="Cari buku di Peak Library"
                   class="w-full pl-4 rounded-xl border-gray-300
                          focus:border-[#9BBC85] focus:ring-[#9BBC85]">
        </div>

        <!-- KATEGORI -->
        <div class="px-8 mt-10">
            <h3 class="text-xl font-bold text-[#2F3E2E] mb-4">
                Kategori Buku
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-xl shadow text-center">Novel</div>
                <div class="bg-white p-6 rounded-xl shadow text-center">Pendidikan</div>
                <div class="bg-white p-6 rounded-xl shadow text-center">Sejarah</div>
                <div class="bg-white p-6 rounded-xl shadow text-center">Teknologi</div>
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
                            @if($book->status === 'tersedia')
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
