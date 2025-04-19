@extends('layouts.app_receptionists')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Data Reservasi</h2>

        {{-- Form Filter dan Search --}}
        <form method="GET" action="{{ route('receptionist.dashboard') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Cari berdasarkan nama tamu...">
            </div>
            <div class="col-md-4">
                <input type="date" name="check_in_date" value="{{ request('check_in_date') }}" class="form-control"
                    placeholder="Filter tanggal check-in">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('receptionist.dashboard') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        {{-- Tabel Reservasi --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($reservations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Tamu</th>
                                    <th>Tipe Kamar</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Total Kamar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->user->name ?? '-' }}</td>
                                        <td>{{ $reservation->room->room_type ?? '-' }}</td>
                                        <td>{{ $reservation->check_in_date }}</td>
                                        <td>{{ $reservation->check_out_date }}</td>
                                        <td>{{ $reservation->total_rooms }}</td>
                                        <td>
                                            <span class="badge bg-{{ $reservation->status === 'pending' ? 'warning' : ($reservation->status === 'confirmed' ? 'success' : 'secondary') }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $reservations->withQueryString()->links() }}
                    </div>
                @else
                    <p class="text-muted">Tidak ada data reservasi ditemukan.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
