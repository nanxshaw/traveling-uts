@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Wisata</h3>
    <form action="{{ route('tourists.update', $tourist->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="form-group">
            <label for="name">Nama Wisata</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tourist->name) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $tourist->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $tourist->location) }}" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar Wisata</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*"> <!-- Gambar opsional -->
        </div>

        @if($tourist->image)
            <div class="form-group">
                <label>Gambar Saat Ini:</label><br>
                <img src="{{ Storage::url($tourist->image) }}" alt="Image" style="max-width: 200px; max-height: 200px; margin-top: 10px;">
            </div>
        @endif
        
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
