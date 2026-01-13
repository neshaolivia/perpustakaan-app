<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f6f7f6">

<div class="container py-5">

    <h4 class="mb-4 fw-semibold">Edit Buku</h4>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.buku.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text"
                           name="judul"
                           value="{{ old('judul', $book->judul) }}"
                           class="form-control @error('judul') is-invalid @enderror">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text"
                           name="author"
                           value="{{ old('author', $book->author) }}"
                           class="form-control @error('author') is-invalid @enderror">
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
               <div class="mb-3">
    <label class="form-label">Kategori</label>

    <select name="id_kategoris"
            class="form-select @error('id_kategoris') is-invalid @enderror">
        <option value="">-- Pilih Kategori --</option>

        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ old('id_kategoris', $book->id_kategoris) == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategoris }}
            </option>
        @endforeach
    </select>

    @error('id_kategoris')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror">
                        <option value="Tersedia" {{ $book->status == 'Tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>
                        <option value="Dipinjam" {{ $book->status == 'Dipinjam' ? 'selected' : '' }}>
                            Dipinjam
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control">{{ old('description', $book->description) }}</textarea>
                </div>

                <!-- Cover -->
                <div class="mb-3">
                    <label class="form-label">Cover Buku</label>
                    <input type="file" name="cover" class="form-control">

                    @if($book->cover)
                        <small class="d-block mt-2">
                            Cover saat ini:
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 width="80"
                                 class="rounded shadow-sm">
                        </small>
                    @endif
                </div>

                <!-- Button -->
                <div class="d-flex gap-2">
                    <button class="btn btn-success px-4">Update</button>
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary px-4">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
