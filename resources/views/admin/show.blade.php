@extends('layouts.app_admin')

@section('content')
    <div class="container my-5">
        <!-- Judul -->
        <h2 class="text-center fw-bold mb-4">{{ $room->room_type }}</h2>

        <div class="row">
            <!-- Bagian Gambar -->
            <div class="col-md-6">
                <div id="carouselRoomImages" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
                    <!-- Indikator -->
                    <div class="carousel-indicators">
                        @foreach ($room->images as $key => $image)
                            <button type="button" data-bs-target="#carouselRoomImages" data-bs-slide-to="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>

                    <!-- Gambar -->
                    <div class="carousel-inner">
                        @foreach ($room->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100"
                                    style="height: 400px; object-fit: cover;" alt="Room Image">
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigasi -->
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
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-3">Detail Kamar</h4>
                    <p class="text-muted"><i class="fas fa-money-bill-wave text-success"></i> <strong>Harga:</strong> Rp {{ number_format($room->price, 0, ',', '.') }}</p>
                    <p class="text-muted"><i class="fas fa-users text-primary"></i> <strong>Kapasitas:</strong> {{ $room->capacity }} orang</p>
                    <p class="text-muted"><i class="fas fa-info-circle text-warning"></i> <strong>Deskripsi:</strong> {{ $room->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>
        </div>

        <!-- Fasilitas Kamar -->
        <div class="mt-5">
            <h3 class="fw-bold text-center mb-3">Fasilitas Kamar</h3>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach ($room->facilities as $facility)
                    <div class="col">
                        <div class="card border-0 shadow-sm p-3 text-center">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                            <p class="mt-2 fw-semibold">{{ $facility->facility_name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-5">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-lg btn-outline-primary rounded-pill px-5 py-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection
