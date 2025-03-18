@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Edit Room</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.update_room', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="room_type" class="form-label">Jenis Room</label>
            <input type="text" name="room_type" class="form-control" value="{{ $room->room_type }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $room->price }}" required>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Kapasitas</label>
            <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $room->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
