<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku - Peak Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#E4EFE7] text-gray-800">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-10 py-6 bg-white shadow-sm">
    <div class="flex items-center gap-3">
        <img src="{{ asset('img/logo.jpeg') }}" class="w-10">
        <span class="text-xl font-bold text-[#99BC85]">Peak Library</span>
    </div>

    <div class="flex gap-4 items-center">
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-[#99BC85] transition">Dashboard</a>
        <!-- Form Logout -->
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-lg border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="max-w-4xl mx-auto px-10 py-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Buku</h2>

    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('admin.buku.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Judul Buku</label>
                <input type="text"
                       name="judul"
                       value="{{ old('judul', $book->judul) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99BC85] @error('judul') border-red-500 @enderror">
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penulis -->
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Penulis</label>
                <input type="text"
                       name="author"
                       value="{{ old('author', $book->author) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99BC85] @error('author') border-red-500 @enderror">
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                <select name="id_kategoris"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99BC85] bg-white @error('id_kategoris') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ old('id_kategoris', $book->id_kategoris) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategoris }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategoris')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99BC85] bg-white @error('status') border-red-500 @enderror">
                    <option value="Tersedia" {{ $book->status == 'Tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>
                    <option value="Dipinjam" {{ $book->status == 'Dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="description"
                          rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99BC85]">{{ old('description', $book->description) }}</textarea>
            </div>

            <!-- Cover -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Cover Buku</label>
                <input type="file" name="cover" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99BC85] bg-white">
                
                @if($book->cover)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 mb-1">Cover saat ini:</p>
                        <img src="{{ asset('storage/' . $book->cover) }}"
                             class="w-24 rounded shadow-sm border">
                    </div>
                @endif
            </div>

            <!-- Button -->
            <div class="flex gap-4">
                <button type="submit" class="px-6 py-2 bg-[#99BC85] text-white rounded-lg font-semibold hover:bg-[#88ad74] transition">
                    Update Buku
                </button>
                <a href="{{ route('admin.buku.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
