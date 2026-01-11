<h1>Data Buku</h1>

<a href="{{ route('admin.buku.create') }}">Tambah Buku</a>

<table border="1">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Status</th>
    </tr>
    @foreach($books as $buku)
        <tr>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
            <td>{{ $buku->status }}</td>
        </tr>
    @endforeach
</table>
