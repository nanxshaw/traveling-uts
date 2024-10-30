@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Pemesanan</h3>
    <form action="{{ route('accommodation-orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="accommodation_id">Penginapan</label>
            <select class="form-control" id="accommodation_id" name="accommodation_id" required>
                @foreach($accommodations as $accommodation)
                    <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="customer_name">Nama Pemesan</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="check_in">Tanggal Check-In</label>
            <input type="date" class="form-control" id="check_in" name="check_in" required>
        </div>
        <div class="form-group">
            <label for="check_out">Tanggal Check-Out</label>
            <input type="date" class="form-control" id="check_out" name="check_out" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
