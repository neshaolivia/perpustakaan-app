<h1>Tambah Buku</h1>

<form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>Judul Buku</label><br>
        <input type="text" name="judul" placeholder="Judul Buku" required>
    </div>

    <div>
        <label>Author</label><br>
        <input type="text" name="author" placeholder="Nama Author" required>
    </div>

    <div>
        <label>Kategori</label><br>
        <select name="id_kategoris">
    <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
        <option value="{{ $k->id }}">
            {{ $k->nama_kategoris }}
             </option>
         @endforeach
         </select>
    </div>

    <div>
        <label>Deskripsi</label><br>
        <textarea name="description" placeholder="Deskripsi buku (opsional)"></textarea>
    </div>

    <div>
        <label>Cover Buku</label><br>
        <input type="file" name="cover">
    </div>

    <button type="submit">Simpan</button>
</form>
