@extends('layouts.app_admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Start -->
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Room</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.update_room', $room->rooms_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="room_type" class="form-label"><i class="bi bi-door-open-fill me-1"></i>Room Type</label>
                            <input type="text" name="room_type" class="form-control" value="{{ $room->room_type }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label"><i class="bi bi-cash-coin me-1"></i>Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $room->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="total_room" class="form-label"><i class="bi bi-stack me-1"></i>Total Room</label>
                            <input type="number" class="form-control" id="total_room" value="{{ $room->total_room }}" name="total_room" required>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label"><i class="bi bi-people-fill me-1"></i>Capacity</label>
                            <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label"><i class="bi bi-card-text me-1"></i>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $room->description }}</textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Back
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save-fill me-1"></i>Update Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</div>
@endsection
