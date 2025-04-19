@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 mb-3 text-center">Daftar Fasilitas Kamar</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Fasilitas & Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $index => $room)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="align-middle">{{ $room->room_type }}</td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    @forelse ($room->facilities as $facility)
                                        <li class="d-flex justify-content-between align-items-center mb-1">
                                            <span>- {{ $facility->facility_name }}</span>
                                            <div>
                                                <!-- Tombol Ubah Fasilitas -->
                                                <a href="{{ route('admin.room_facility.update', $facility->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Ubah
                                                </a>

                                                <!-- Tombol Hapus Fasilitas -->
                                                <form action="{{ route('admin.room_facility.destroy', $facility->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>

                                            </div>
                                        </li>
                                    @empty
                                        <span class="text-muted">Tidak ada fasilitas</span>
                                    @endforelse
                                </ul>

                                <!-- Tombol Tambah Fasilitas -->
                                <a href="{{ route('admin.room_facility.create', ['room_id' => $room->id]) }}"
                                    class="btn btn-success btn-sm mt-2">
                                    Tambah Fasilitas
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
