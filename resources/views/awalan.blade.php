<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Segoe+UI&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/awalan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

    <!-- Hero Section -->
    <div class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Selamat Datang di Hotel Hebat</h1>
            <p>Nikmati pengalaman menginap terbaik dengan fasilitas premium dan layanan eksklusif.</p>
            @auth
                <a href="{{ route('user.index') }}" class="btn btn-reserve">Lihat Kamar</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-reserve">Login</a>
                <a href="{{ route('register') }}" class="btn btn-reserve">Register</a>
            @endauth
        </div>
    </div>

    <!-- About Section -->
    <section class="about-section text-center">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>
                Hotel kami menawarkan pemandangan yang luar biasa, kamar mewah, dan fasilitas kelas dunia untuk memastikan kenyamanan Anda selama menginap.
                Nikmati pelayanan ramah dan pengalaman tak terlupakan setiap kali Anda datang.
            </p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
