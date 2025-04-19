@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Judul -->
    <h2 class="text-center fw-bold text-primary mb-5">{{ $room->room_type }}</h2>

    <div class="row g-4">
        <!-- Gambar Carousel -->
        <div class="col-md-6">
            <div id="carouselRoomImages" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($room->images as $key => $image)
                        <button type="button" data-bs-target="#carouselRoomImages" data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($room->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100"
                                 style="height: 400px; object-fit: cover;" alt="Room Image">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoomImages" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselRoomImages" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                </button>
            </div>
        </div>

        <!-- Detail Kamar -->
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-3 text-dark">Detail Kamar</h4>
                <p class="mb-2">
                    <i class="bi bi-cash-coin text-success me-2 fs-5"></i>
                    <strong>Harga:</strong>
                    <span class="badge bg-success-subtle text-dark">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                </p>
                <p class="mb-2">
                    <i class="bi bi-people-fill text-primary me-2 fs-5"></i>
                    <strong>Kapasitas:</strong>
                    <span class="badge bg-primary-subtle text-dark">{{ $room->capacity }} orang</span>
                </p>
                <p class="mb-0">
                    <i class="bi bi-info-circle text-warning me-2 fs-5"></i>
                    <strong>Deskripsi:</strong>
                </p>
                <blockquote class="blockquote ps-3 border-start border-3 border-warning text-muted mt-1">
                    <small>{{ $room->description ?? 'Tidak ada deskripsi' }}</small>
                </blockquote>
            </div>
        </div>
    </div>

    <!-- Fasilitas -->
    <div class="mt-5">
        <h3 class="fw-bold text-center text-primary mb-4">Fasilitas Kamar</h3>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($room->facilities as $facility)
                <div class="col">
                    <div class="card border-0 shadow-sm p-3 text-center h-100 transition hover-shadow">
                        <i class="bi bi-check-circle-fill text-success fs-3 mb-2"></i>
                        <p class="fw-semibold mb-0">{{ $facility->facility_name }}</p>
                    </div>
                </div>
            @empty
                <div class="col text-center text-muted">Tidak ada fasilitas terdaftar.</div>
            @endforelse
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-5">
        <a href="{{ route('user.index') }}" class="btn btn-outline-primary rounded-pill px-5 py-2">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>
@endsection
