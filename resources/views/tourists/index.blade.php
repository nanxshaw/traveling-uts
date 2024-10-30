@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Wisata</h3>
    <a href="{{ route('tourists.create') }}" class="btn btn-primary mb-3">Tambah Wisata</a>
    <table id="touristsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Wisata</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Gambar</th> <!-- Tambahkan kolom gambar -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tourists as $tourist)
            <tr>
                <td>{{ $tourist->id }}</td>
                <td>{{ $tourist->name }}</td>
                <td>{{ $tourist->description }}</td>
                <td>{{ $tourist->location }}</td>
                <td>
                    @if($tourist->image)
                        <img src="{{ Storage::url($tourist->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>
                    <a href="{{ route('tourists.edit', $tourist->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tourists.destroy', $tourist->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#touristsTable').DataTable();
    });
</script>
@endsection
