@extends('layouts.app_admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Manajemen Fasilitas Hotel</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.hotel_facilities.create') }}" class="btn btn-primary mb-3">+ Tambah Fasilitas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Fasilitas</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facilities as $facility)
                <tr>
                    <td>{{ $facility->facility_name }}</td>
                    <td>{{ $facility->description }}</td>
                    <td>
                        <a href="{{ route('admin.hotel_facilities.edit', $facility->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hotel_facilities.destroy', $facility->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin mau hapus fasilitas ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($facilities->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">Belum ada fasilitas.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
