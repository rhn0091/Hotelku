@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Pesan Kamar di Hotel Hebat</h4>
            </div>

            <div class="card-body">
                {{-- Flash error jika ada validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('user.reservations.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="room_id" class="form-label fw-bold">Pilih Kamar</label>
                        <select name="rooms_id" id="room_id" class="form-select" required>
                            <option value="">-- Pilih Tipe Kamar --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->rooms_id }}">{{ $room->room_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="check_in_date" class="form-label fw-bold">Tanggal Check-in</label>
                        <input type="date" name="check_in_date" id="check_in_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="check_out_date" class="form-label fw-bold">Tanggal Check-out</label>
                        <input type="date" name="check_out_date" id="check_out_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="total_rooms" class="form-label fw-bold">Jumlah Kamar</label>
                        <input type="number" name="total_rooms" id="total_rooms" class="form-control" min="1"
                            required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check2-circle me-1"></i> Pesan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
