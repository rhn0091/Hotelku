@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Room</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Room</th>
                <th>Harga</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $key => $room)
                <tr>
                    <td>{{ $i + $key + 1 }}</td>
                    <td>{{ $room->room_type }}</td>
                    <td>Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                    <td>{{ $room->capacity }} orang</td>
                    
                    <td>
                        <a href="{{ route('user.show', $room->rooms_id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $rooms->links() }}
</div>
@endsection
