<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f7f6;
        }
        .table thead {
            background-color: #9DB98F;
        }
        .table thead th {
            color: white;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <!-- Judul Halaman -->
    <h4 class="mb-4 fw-semibold">Data Buku</h4>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <!-- Header Card -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold mb-0">Daftar Buku</h5>
                <a href="{{ route('admin.buku.create') }}"
                   class="btn btn-success rounded-pill px-4">
                    + Tambah Buku
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Status</th>
                            <th class="text-center">Aksi</th>
                         </tr>
                    </thead>
                    <tbody>
                    @forelse($books as $buku)
<tr>
    <td>{{ $buku->judul }}</td>
    <td>{{ $buku->author }}</td>
    <td>
        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
            {{ $buku->status }}
        </span>
    </td>

    <!-- AKSI -->
    <td class="text-center">
        <div class="d-flex justify-content-center gap-2">

            <!-- EDIT -->
            <a href="{{ route('admin.buku.edit', $buku->id) }}"
               class="btn btn-warning btn-sm rounded-pill px-3">
                Edit
            </a>

            <!-- DELETE -->
            <form action="{{ route('admin.buku.destroy', $buku->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-danger btn-sm rounded-pill px-3">
                    Hapus
                </button>
            </form>

        </div>
    </td>
</tr>
@empty

                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Data buku belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
