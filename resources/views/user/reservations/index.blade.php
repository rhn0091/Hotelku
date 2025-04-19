@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold text-primary mb-2">Daftar Reservasi Anda</h2>
            <a href="{{ route('user.reservations.create') }}" class="btn btn-outline-primary">
                <i class="bi bi-plus-circle me-1"></i> Pesan Kamar
            </a>
        </div>
        <a href="{{ route('user.reservations.history') }}" class="btn btn-secondary">Lihat Riwayat Reservasi</a>


        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Card Reservasi --}}
        @forelse ($reservations as $reservation)
            <div class="card shadow-sm border-0 mb-3">
                <div class="row g-0">
                    {{-- Gambar --}}
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $reservation->room->images->first()->image_path) }}"
                            class="img-fluid w-100" style="object-fit: cover; max-height: 250px;"
                            alt="{{ $reservation->room->room_type }}">
                    </div>

                    {{-- Detail --}}
                    <div class="col-md-8 p-4 text-end">
                        <h5 class="card-title fw-semibold text-primary">{{ $reservation->room->room_type }}</h5>
                        <p class="mb-1"><strong>Check-in:</strong>
                            {{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d M Y') }}</p>
                        <p class="mb-1"><strong>Check-out:</strong>
                            {{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d M Y') }}</p>
                        <p class="mb-1"><strong>Jumlah Kamar:</strong> {{ $reservation->total_rooms }}</p>
                        <p class="mb-2">
                            <strong>Status:</strong>
                            @php
                                $statusColor = match ($reservation->status) {
                                    'pending' => 'warning',
                                    'confirmed' => 'success',
                                    'cancelled' => 'danger',
                                    'checked_out' => 'secondary',
                                    default => 'dark',
                                };
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">
                                {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                            </span>
                        </p>

                        {{-- Aksi --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('user.reservations.show', $reservation->reservation_id) }}"
                                class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            @if ($reservation->status === 'pending')
                                <form action="{{ route('user.reservations.destroy', $reservation->reservation_id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-5">
                <i class="bi bi-calendar-x fs-1 mb-3 d-block"></i>
                <p class="mb-0">Belum ada reservasi yang dibuat.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $reservations->links() }}
        </div>
    </div>
@endsection
