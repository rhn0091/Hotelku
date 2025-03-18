@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pesan Kamar</h2>

    <form action="{{ route('user.reservations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="room_id" class="form-label">Pilih Kamar</label>
            <select name="room_id" id="room_id" class="form-control" required>
                <option value="">-- Pilih Kamar --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }} - Rp{{ number_format($room->price, 0, ',', '.') }}/malam</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="check_in_date" class="form-label">Tanggal Check-in</label>
            <input type="date" name="check_in_date" id="check_in_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="check_out_date" class="form-label">Tanggal Check-out</label>
            <input type="date" name="check_out_date" id="check_out_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_rooms" class="form-label">Jumlah Kamar</label>
            <input type="number" name="total_rooms" id="total_rooms" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Pesan</button>
    </form>
</div>
@endsection
