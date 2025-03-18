<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Mewah - Stay in Luxury</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url("{{ asset('assets/images/hotel.jpg') }}") no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }
        .overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .btn-reserve {
            background: #ff9800;
            border: none;
            padding: 12px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-reserve:hover {
            background: #e68900;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <div class="hero position-relative">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Selamat Datang di Hotel Mewah</h1>
            <p class="lead">Nikmati pengalaman menginap terbaik dengan fasilitas premium dan layanan eksklusif.</p>
            <a href="{{ route('login') }}" class="btn btn-reserve text-white mt-3">Pesan Sekarang</a>
        </div>
    </div>

    <!-- Section About -->
    <section class="container py-5 text-center">
        <h2 class="fw-bold">Tentang Kami</h2>
        <p class="lead">Hotel kami menawarkan pemandangan yang luar biasa, kamar mewah, dan fasilitas kelas dunia untuk memastikan kenyamanan Anda selama menginap.</p>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
