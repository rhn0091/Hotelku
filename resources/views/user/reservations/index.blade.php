@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Reservasi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('user.reservations.create') }}" class="btn btn-primary">Pesan Kamar</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Jumlah Kamar</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->room->name }}</td>
                <td>{{ $reservation->check_in_date }}</td>
                <td>{{ $reservation->check_out_date }}</td>
                <td>{{ $reservation->total_rooms }}</td>
                <td>{{ ucfirst($reservation->status) }}</td>
                <td>
                    <a href="{{ route('user.reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">Detail</a>
                    @if ($reservation->status === 'pending')
                        <form action="{{ route('user.reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan?')">Batal</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
