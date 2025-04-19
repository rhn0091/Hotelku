@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        {{-- Header Kamar --}}
        <div class="position-relative mb-4 rounded shadow-sm" style="height: 200px; overflow: hidden;">
            @if ($reservation->room->images->first())
                <img src="{{ asset('storage/' . $reservation->room->images->first()->image_path) }}" 
                     class="img-fluid w-100 h-100" 
                     style="object-fit: cover; max-height: 200px;" 
                     alt="Room Image">
                <div class="position-absolute bottom-0 start-0 bg-dark bg-opacity-50 w-100 p-3 text-white">
                    <h3 class="mb-0">{{ $reservation->room->room_type }}</h3>
                    <small class="d-block mt-1">
                        <i class="bi bi-geo-alt"></i> 
                        {{ $reservation->room->location ?? 'Lokasi tidak tersedia' }}
                    </small>
                </div>
            @else
                <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center">
                    <div class="text-center p-4">
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        <h4 class="mt-2">{{ $reservation->room->room_type }}</h4>
                    </div>
                </div>
            @endif
        </div>

        {{-- Status Alert --}}
        @if($reservation->status === 'pending')
            <div class="alert alert-warning alert-dismissible fade show mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Menunggu Konfirmasi!</strong> Reservasi Anda masih dalam proses verifikasi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif($reservation->status === 'confirmed')
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Reservasi Dikonfirmasi!</strong> Anda dapat melakukan check-in pada tanggal yang ditentukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- QR Code Section --}}
        @if ($reservation->status === 'pending' || $reservation->status === 'confirmed')
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-primary mb-0">
                            <i class="bi bi-qr-code me-2"></i>QR Code Reservasi
                        </h5>
                        <span class="badge bg-primary">ID: {{ $receipt->receipt_code }}</span>
                    </div>
                    
                    <div class="text-center p-3 bg-light rounded">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $qr_url }}" 
                             alt="QR Code" 
                             class="img-fluid mb-3 border rounded p-2 bg-white"
                             style="max-width: 200px;">
                        
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                            <a href="{{ $qr_url }}" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                               <i class="bi bi-box-arrow-up-right me-1"></i>Buka Link QR
                            </a>
                            <button onclick="window.print()" 
                                    class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-printer me-1"></i>Cetak QR
                            </button>
                            <a href="data:image/png;base64,{!! base64_encode(file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=200x200&data='.$qr_url)) !!}" 
                               download="QR-{{ $receipt->receipt_code }}.png" 
                               class="btn btn-outline-success btn-sm">
                               <i class="bi bi-download me-1"></i>Download
                            </a>
                        </div>
                        
                        <p class="mt-3 small text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Tunjukkan QR Code ini saat check-in di lokasi.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Detail Reservasi --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary mb-4">
                    <i class="bi bi-card-checklist me-2"></i>Detail Reservasi
                </h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <h6 class="fw-bold text-muted mb-3">Informasi Kamar</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-door-open text-primary me-2"></i>
                                    <strong>Tipe Kamar:</strong> {{ $reservation->room->room_type }}
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-cash-coin text-success me-2"></i>
                                    <strong>Harga per Kamar:</strong> Rp {{ number_format($reservation->room->price, 0, ',', '.') }}
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-building text-secondary me-2"></i>
                                    <strong>Jumlah Kamar:</strong> {{ $reservation->total_rooms }}
                                </li>
                                <li>
                                    <i class="bi bi-people-fill text-warning me-2"></i>
                                    <strong>Kapasitas:</strong> {{ $reservation->room->capacity }} orang/kamar
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <h6 class="fw-bold text-muted mb-3">Detail Reservasi</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-calendar-check text-primary me-2"></i>
                                    <strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reservation->check_in_date)->translatedFormat('l, d F Y') }}
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-calendar-x text-primary me-2"></i>
                                    <strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reservation->check_out_date)->translatedFormat('l, d F Y') }}
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-clock-history text-info me-2"></i>
                                    <strong>Durasi:</strong> {{ \Carbon\Carbon::parse($reservation->check_in_date)->diffInDays($reservation->check_out_date) }} malam
                                </li>
                                <li>
                                    <i class="bi bi-patch-check {{ $reservation->status === 'confirmed' ? 'text-success' : 'text-warning' }} me-2"></i>
                                    <strong>Status:</strong> 
                                    <span class="badge bg-{{ 
                                        $reservation->status === 'pending' ? 'warning' : 
                                        ($reservation->status === 'confirmed' ? 'success' : 'secondary') 
                                    }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- Total Pembayaran --}}
                <div class="bg-primary bg-opacity-10 p-3 rounded mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-primary">Total Pembayaran</h6>
                        <h4 class="fw-bold mb-0 text-primary">
                            Rp {{ number_format($reservation->total_rooms * $reservation->room->price, 0, ',', '.') }}
                        </h4>
                    </div>
                    <p class="small text-muted mb-0 mt-1">
                        <i class="bi bi-info-circle me-1"></i>
                        Harga sudah termasuk pajak dan biaya layanan
                    </p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-5">
            <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
            
            <div class="d-flex gap-2">
                @if($reservation->status === 'pending')
                    <form action="{{ route('user.reservations.update', $reservation->reservation_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle me-1"></i> Batalkan Reservasi
                        </button>
                    </form>
                @endif
                
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer me-1"></i> Cetak Reservasi
                </button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
            }
            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
@endpush