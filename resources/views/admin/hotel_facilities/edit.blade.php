@extends('layouts.app_admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Fasilitas Hotel</h2>

    <form action="{{ route('admin.hotel_facilities.update', $facility->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="facility_name" class="form-label">Nama Fasilitas</label>
            <input type="text" name="facility_name" id="facility_name" class="form-control" value="{{ $facility->facility_name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $facility->description }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.hotel_facilities.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
