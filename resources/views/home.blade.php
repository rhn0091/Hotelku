@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('{{ asset('images/hotel-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .verify-card {
        background-color: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 15px;
    }

    .verify-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e3c72;
    }

    .verify-subtext {
        color: #555;
    }

    .btn-custom {
        background-color: #1e3c72;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #16325c;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg verify-card p-4">
                <div class="card-body text-center">
                    <h3 class="verify-title mb-3">Selamat Datang, {{ Auth::user()->name }} 👋</h3>

                    @if (session('status'))
                        <div class="alert alert-success rounded-pill px-4 py-2 small fw-medium">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="verify-subtext mb-4">
                        Untuk melanjutkan, silakan <strong>verifikasi email</strong> kamu terlebih dahulu.
                        Kami telah mengirimkan link verifikasi ke email kamu.
                    </p>

                    @if (!Auth::user()->hasVerifiedEmail())
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-custom">
                                Kirim Ulang Email Verifikasi
                            </button>
                        </form>
                    @else
                        <div class="alert alert-success mt-3 rounded-pill px-4 py-2">
                            Email kamu sudah diverifikasi ✅
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
