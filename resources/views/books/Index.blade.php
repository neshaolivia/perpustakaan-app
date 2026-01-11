@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4 text-green-700">
        📚 Daftar Buku
    </h1>

    {{-- SEARCH --}}
    <form method="GET" class="mb-5">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul atau penulis..."
            class="w-full p-3 border rounded-lg focus:ring focus:ring-green-300"
        >
    </form>

    {{-- GRID BUKU --}}
    <div class="grid grid-cols-4 gap-6">

        @forelse($books as $book)
            <div class="bg-white shadow rounded-lg p-4">

                {{-- COVER --}}
                <img
                    src="{{ $book->cover ?? 'https://via.placeholder.com/150' }}"
                    class="h-48 w-full object-cover rounded"
                >

                {{-- JUDUL --}}
                <h2 class="font-bold mt-2">
                    {{ $book->judul }}
                </h2>

                {{-- PENULIS --}}
                <p class="text-sm text-gray-600">
                    {{ $book->penulis }}
                </p>

                {{-- STOK --}}
                <p class="mt-1 text-sm">
                    Stok:
                    <span class="{{ $book->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                        {{ $book->stok }}
                    </span>
                </p>

            </div>
        @empty
            <p class="text-gray-500 col-span-4">
                Tidak ada buku ditemukan.
            </p>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $books->links() }}
    </div>

</div>
@endsection
