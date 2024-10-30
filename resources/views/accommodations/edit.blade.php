@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Akomodasi</h3>
    <form action="{{ route('accommodations.update', $accommodation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nama Akomodasi</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $accommodation->name }}" required>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $accommodation->price }}" required step="0.01">
        </div>
        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $accommodation->location }}" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar Akomodasi</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if($accommodation->image)
                <img src="{{ Storage::url($accommodation->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;" class="mt-2">
                <p>Gambar saat ini. (Upload gambar baru jika ingin menggantinya)</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
