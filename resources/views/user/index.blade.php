@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Daftar Kamar Tersedia</h2>
    </div>

    @if ($rooms->count())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($rooms as $key => $room)
                <div class="col">
                    <div class="card shadow-sm h-100 border-0">
                        {{-- Gambar Kamar --}}
                        @if ($room->images->first())
                            <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Room Image">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Default Room Image">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-dark fw-semibold mb-2">
                                <i class="bi bi-door-closed-fill me-1 text-primary"></i>
                                {{ $room->room_type }}
                            </h5>
                            
                            {{-- Indikator Ketersediaan --}}
                            <div class="mb-2">
                                @if($room->total_room > 0)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Tersedia ({{ $room->total_room }})
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Habis
                                    </span>
                                @endif
                            </div>
                            
                            <p class="card-text mb-1">
                                <i class="bi bi-cash-coin me-1 text-success"></i>
                                <strong>Harga:</strong> <span class="text-dark">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                            </p>
                            <p class="card-text mb-1">
                                <i class="bi bi-building me-1 text-secondary"></i>
                                <strong>Kapasitas:</strong>
                                <span class="badge bg-warning text-dark">{{ $room->capacity }} orang</span>
                            </p>
                            
                            {{-- Fasilitas (jika ada) --}}
                            @if($room->facilities->count())
                                <p class="card-text mb-2">
                                    <i class="bi bi-star-fill me-1 text-info"></i>
                                    <strong>Fasilitas:</strong>
                                    @foreach($room->facilities->take(2) as $facility)
                                        <span class="badge bg-info me-1">{{ $facility->name }}</span>
                                    @endforeach
                                    @if($room->facilities->count() > 2)
                                        <span class="badge bg-light text-dark">+{{ $room->facilities->count() - 2 }} lagi</span>
                                    @endif
                                </p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="{{ route('user.show', $room->rooms_id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye-fill me-1"></i> Detail
                                </a>
                                
                                @if($room->total_room > 0)
                                    <a href="{{ route('user.reservations.create', ['room_id' => $room->rooms_id]) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-calendar-plus me-1"></i> Pesan
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="bi bi-calendar-x me-1"></i> Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $rooms->links() }}
        </div>
    @else
        <div class="alert alert-info text-center mt-4">
            <i class="bi bi-info-circle me-2"></i> Belum ada kamar yang tersedia saat ini.
        </div>
    @endif
</div>
@endsection