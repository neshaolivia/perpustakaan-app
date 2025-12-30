<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peak Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#E4EFE7] text-gray-800">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-10 py-6">
    <div class="flex items-center gap-3">
        <img src="{{ asset('img/logo.jpeg') }}" class="w-10">
        <span class="text-xl font-bold text-[#99BC85]">Peak Library</span>
    </div>

    <div class="flex gap-4">
        <a href="{{ route('login') }}"
           class="px-4 py-2 rounded-lg text-[#99BC85] border border-[#99BC85] hover:bg-[#99BC85] hover:text-white transition">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="px-4 py-2 rounded-lg bg-[#99BC85] text-white hover:bg-[#88ad74] transition">
            Register
        </a>
    </div>
</nav>

<!-- HERO -->
<section class="max-w-6xl mx-auto px-10 py-20 grid md:grid-cols-2 gap-12 items-center">

    <div>
        <h1 class="text-4xl font-bold leading-tight mb-6">
            Sistem Perpustakaan<br>
            <span class="text-[#99BC85]">Modern & Terintegrasi</span>
        </h1>

        <p class="text-gray-600 mb-8">
            Peak Library membantu pengelolaan buku, anggota, dan peminjaman
            secara efisien, cepat, dan terstruktur.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-[#99BC85] text-white rounded-xl font-semibold hover:bg-[#88ad74]">
                Mulai Sekarang
            </a>

            <a href="{{ route('login') }}"
               class="px-6 py-3 border border-[#99BC85] text-[#99BC85] rounded-xl font-semibold hover:bg-[#99BC85] hover:text-white">
                Login
            </a>
        </div>
    </div>

    <div class="flex justify-center">
        <img src="{{ asset('img/logo.jpeg') }}" class="w-64 opacity-90">
    </div>

</section>

<!-- FEATURES -->
<section class="bg-white py-20">
    <div class="max-w-6xl mx-auto px-10">
        <h2 class="text-3xl font-bold text-center mb-12 text-[#99BC85]">
            Fitur Utama
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-6 rounded-xl bg-[#E4EFE7]">
                <h3 class="font-bold mb-2">Manajemen Buku</h3>
                <p class="text-sm text-gray-600">
                    Kelola data buku secara rapi dan terstruktur.
                </p>
            </div>

            <div class="p-6 rounded-xl bg-[#E4EFE7]">
                <h3 class="font-bold mb-2">Data Anggota</h3>
                <p class="text-sm text-gray-600">
                    Pendataan anggota cepat dan aman.
                </p>
            </div>

            <div class="p-6 rounded-xl bg-[#E4EFE7]">
                <h3 class="font-bold mb-2">Peminjaman</h3>
                <p class="text-sm text-gray-600">
                    Monitoring peminjaman dan pengembalian buku.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="text-center py-6 text-sm text-gray-500">
    © {{ date('Y') }} Peak Library. All rights reserved.
</footer>

</body>
</html>
