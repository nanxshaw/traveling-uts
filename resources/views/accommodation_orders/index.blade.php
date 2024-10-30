@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Pemesanan Penginapan</h3>
    <a href="{{ route('accommodation-orders.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan</a>
    <table id="accommodationOrdersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Penginapan</th>
                <th>Nama Pemesan</th>
                <th>Tanggal Check-In</th>
                <th>Tanggal Check-Out</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->accommodation->name }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->check_in }}</td>
                    <td>{{ $order->check_out }}</td>
                    <td>
                        <a href="{{ route('accommodation-orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('accommodation-orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
        $('#accommodationOrdersTable').DataTable();
    });
</script>
@endsection
