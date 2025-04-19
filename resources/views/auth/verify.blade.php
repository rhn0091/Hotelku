@extends('layouts.app')

@section('content')
<div class="container py-5 min-vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow rounded-4 border-0">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h4 class="mb-0">Verifikasi Alamat Email</h4>
            </div>

            <div class="card-body p-4 text-center">
                @if (session('resent'))
                    <div class="alert alert-success rounded-3">
                        Tautan verifikasi baru telah dikirim ke email kamu.
                    </div>
                @endif

                <p class="text-muted mb-3">
                    Sebelum melanjutkan, silakan cek email kamu untuk link verifikasi.<br>
                    Jika kamu belum menerima email tersebut:
                </p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
