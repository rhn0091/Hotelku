@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Edit Fasilitas Kamar</h2>

    <div class="card shadow-lg p-4">
        <form action="{{ route('admin.room_facility.update', $facility->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="rooms_id" class="form-label">Pilih Kamar</label>
                <select class="form-select" id="rooms_id" name="rooms_id" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->rooms_id }}" {{ $facility->rooms_id == $room->rooms_id ? 'selected' : '' }}>
                            {{ $room->room_type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="facility_name" class="form-label">Nama Fasilitas</label>
                <input type="text" class="form-control" id="facility_name" name="facility_name" value="{{ $facility->facility_name }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.room_facility.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
