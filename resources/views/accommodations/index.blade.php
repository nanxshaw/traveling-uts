@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Akomodasi</h3>
    <a href="{{ route('accommodations.create') }}" class="btn btn-primary mb-3">Tambah Akomodasi</a>
    <table id="accommodationsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Akomodasi</th>
                <th>Harga</th>
                <th>Lokasi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accommodations as $accommodation)
            <tr>
                <td>{{ $accommodation->id }}</td>
                <td>{{ $accommodation->name }}</td>
                <td>{{ $accommodation->price }}</td>
                <td>{{ $accommodation->location }}</td>
                <td>
                    @if($accommodation->image)
                        <img src="{{ Storage::url($accommodation->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>
                    <a href="{{ route('accommodations.edit', $accommodation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('accommodations.destroy', $accommodation->id) }}" method="POST" style="display:inline;">
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
        $('#accommodationsTable').DataTable();
    });
</script>
@endsection
