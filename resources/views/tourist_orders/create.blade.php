
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Pesan Wisata</h3>
    <form action="{{ route('tourist-orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tourist_id">Wisata</label>
            <select class="form-control" id="tourist_id" name="tourist_id" required>
                <option value="">Pilih Wisata</option>
                @foreach($tourists as $tourist)
                    <option value="{{ $tourist->id }}">{{ $tourist->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="customer_name">Nama Pelanggan</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="travel_date">Tanggal Perjalanan</label>
            <input type="date" class="form-control" id="travel_date" name="travel_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>
@endsection
