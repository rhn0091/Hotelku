@extends('layouts.app_admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Container -->
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-plus-square-fill me-2"></i>Create New Room</h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.store_room') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="room_type" class="form-label"><i class="bi bi-door-open-fill me-1"></i>Room Type</label>
                            <input type="text" class="form-control" id="room_type" name="room_type" placeholder="e.g. Deluxe Room" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label"><i class="bi bi-cash-coin me-1"></i>Price (per night)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="e.g. 750000" required>
                        </div>

                        <div class="mb-3">
                            <label for="total_room" class="form-label"><i class="bi bi-stack me-1"></i>Total Rooms</label>
                            <input type="number" class="form-control" id="total_room" name="total_room" placeholder="e.g. 10" required>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label"><i class="bi bi-people-fill me-1"></i>Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="e.g. 2" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label"><i class="bi bi-card-text me-1"></i>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the room features..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label"><i class="bi bi-images me-1"></i>Upload Room Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save2-fill me-1"></i>Submit Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>
@endsection
