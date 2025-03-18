@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Daftar Room</h2>
    <a href="{{ route('admin.create_room') }}" class="btn btn-primary mb-3">Tambah Room</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Room</th>
                <th>Jumlah Kamar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $key => $room)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $room->room_type }}</td>
                    <td>{{ $room->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

