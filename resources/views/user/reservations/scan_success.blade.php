@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="text-success mb-4">✅ Reservasi Berhasil Dikonfirmasi!</h1>

    <p class="lead">
        Terima kasih telah melakukan konfirmasi.<br>
        Receipt Code: <strong>{{ session('receipt_code') }}</strong>
    </p>

    <a href="{{ route('user.reservations.index') }}" class="btn btn-primary mt-4">
        Kembali ke Daftar Reservasi
    </a>
</div>
@endsection