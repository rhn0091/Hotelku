@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Room</h2>

    <div class="card">
        <div id="carouselRoomImages" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($room->images as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Room Image">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoomImages" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselRoomImages" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="card-body">
            <h4>{{ $room->room_type }}</h4>
            <p><strong>Harga:</strong> Rp {{ number_format($room->price, 0, ',', '.') }}</p>
            <p><strong>Kapasitas:</strong> {{ $room->capacity }} orang</p>
            <p><strong>Deskripsi:</strong> {{ $room->description ?? 'Tidak ada deskripsi' }}</p>
        </div>
    </div>

    <a href="{{ route('user.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
