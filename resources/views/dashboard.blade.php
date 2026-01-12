<x-app-layout>
    <div class="min-h-screen bg-[#EEF5EC]">

        <!-- TOP BAR -->
        <div class="bg-gradient-to-r from-[#9BBC85] to-[#7FA36A] px-8 py-5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.jpeg') }}" class="w-10 rounded-full">
                <h1 class="text-white text-xl font-bold">Peak Library</h1>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-white">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-white text-[#7FA36A] px-4 py-2 rounded-lg font-semibold">
                        Keluar
                    </button>
                </form>
            </div>
        </div>

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
                <a href="#"
                   class="bg-white text-[#7FA36A] px-6 py-3 rounded-xl font-semibold">
                    Lihat Buku
                </a>
            </div>
        </div>

        <!-- SEARCH -->
<div class="px-8 mt-6">
    <div class="relative">

        <!-- ICON SEARCH -->
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35m1.85-5.65a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
            </svg>
        </div>

        <!-- INPUT -->
        <input type="text"
               placeholder="Cari buku di Peak Library"
               class="w-full pl-12 rounded-xl border-gray-300
                      focus:border-[#9BBC85] focus:ring-[#9BBC85]">
    </div>
</div>


        <!-- KATEGORI -->
        <div class="px-8 mt-10">
            <h3 class="text-xl font-bold text-[#2F3E2E] mb-4">
                Kategori Buku
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <p class="mt-2 font-semibold">Novel</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <p class="mt-2 font-semibold">Pendidikan</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <p class="mt-2 font-semibold">Sejarah</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <p class="mt-2 font-semibold">Teknologi</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

<!-- DAFTAR BUKU -->
<div class="px-8 mt-10">
    <h3 class="text-xl font-bold text-[#2F3E2E] mb-4">
        Buku Terbaru
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($books as $book)
            <div class="bg-white p-4 rounded-xl shadow">
                <img
                    src="{{ $book->cover ? asset('storage/'.$book->cover) : 'https://via.placeholder.com/150' }}"
                    class="h-40 w-full object-cover rounded-lg"
                >

                <h4 class="font-semibold mt-2">
                    {{ $book->judul }}
                </h4>

                <p class="text-sm text-gray-600">
                    {{ $book->author ?? '-' }}
                </p>
            </div>
        @empty
            <p class="text-gray-500 col-span-4">
                Belum ada buku.
            </p>
        @endforelse
    </div>
</div>
