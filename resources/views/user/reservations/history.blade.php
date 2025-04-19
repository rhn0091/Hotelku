@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Reservasi</h2>

    @if($reservations->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Kamar</th>
                    <th>Tanggal Check-in</th>
                    <th>Tanggal Check-out</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->room->room_name }}</td>
                        <td>{{ $reservation->check_in_date }}</td>
                        <td>{{ $reservation->check_out_date }}</td>
                        <td>
                            <span class="badge bg-{{ $reservation->status === 'cancelled' ? 'danger' : 'success' }}">
                                {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reservations->links() }}
    @else
        <p>Tidak ada riwayat reservasi.</p>
    @endif
</div>
@endsection
