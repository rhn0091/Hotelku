@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <h4 class="mt-4 mb-3">Tambah Fasilitas Kamar</h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('room.room_facility.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rooms_id" class="form-label">Pilih Ruangan</label>
                        <select name="rooms_id" id="rooms_id" class="form-select @error('rooms_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Ruangan --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->rooms_id }}" {{ old('room_id') == $room->rooms_id ? 'selected' : '' }}>
                                    {{ $room->room_type }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="facility_name" class="form-label">Nama Fasilitas</label>
                        <input type="text" name="facility_name" id="facility_name" 
                            class="form-control @error('facility_name') is-invalid @enderror" 
                            value="{{ old('facility_name') }}" required>
                        @error('facility_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.room_facility.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
