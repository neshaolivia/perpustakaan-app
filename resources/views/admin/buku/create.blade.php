<h1>Tambah Buku</h1>

<form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="judul" placeholder="Judul" required>
    <input type="text" name="penulis" placeholder="Penulis" required>
    <input type="text" name="penerbit" placeholder="Penerbit" required>
    <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required>

    <select name="id_kategori">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->nama }}</option>
        @endforeach
    </select>

    <input type="file" name="cover">

    <button type="submit">Simpan</button>
</form>
