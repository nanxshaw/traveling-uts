
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Pemesanan Wisata</h3>
    <form action="{{ route('tourist-orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tourist_id">Wisata</label>
            <select class="form-control" id="tourist_id" name="tourist_id" required>
                @foreach($tourists as $tourist)
                    <option value="{{ $tourist->id }}" {{ $tourist->id == $order->tourist_id ? 'selected' : '' }}>
                        {{ $tourist->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="customer_name">Nama Pelanggan</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order->customer_name }}" required>
        </div>
        <div class="form-group">
            <label for="travel_date">Tanggal Perjalanan</label>
            <input type="date" class="form-control" id="travel_date" name="travel_date" value="{{ $order->travel_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
