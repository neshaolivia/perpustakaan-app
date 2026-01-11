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
            <input type="text"
                   placeholder="Cari buku di Peak Library"
                   class="w-full rounded-xl border-gray-300 focus:border-[#9BBC85] focus:ring-[#9BBC85]">
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
