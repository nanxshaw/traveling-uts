@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Pemesanan Wisata</h3>
    <a href="{{ route('tourist-orders.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan</a>
    <table id="touristOrdersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Wisata</th>
                <th>Tanggal Perjalanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->tourist->name }}</td>
                    <td>{{ $order->travel_date }}</td>
                    <td>
                        <a href="{{ route('tourist-orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tourist-orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
        $('#touristOrdersTable').DataTable();
    });
</script>
@endsection
