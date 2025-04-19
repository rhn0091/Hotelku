@extends('layouts.app_admin')

@section('content')
    <div class="container mt-4">

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary">Daftar Room</h2>
            <a href="{{ route('admin.create_room') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-2"></i>Tambah Room
            </a>
        </div>

        {{-- Card Section --}}
        <div class="row g-4">
            @forelse ($rooms as $key => $room)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $room->room_type }}</h5>
                            <p class="card-text">Jumlah Kamar: {{ $room->total_room }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.show', $room->rooms_id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('admin.edit_room', $room->rooms_id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('admin.destroy_room', $room->rooms_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus room ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Belum ada data room.
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
