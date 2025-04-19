<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>QR Receipt</title>
</head>
<body>
    <h1>Reservasi Anda</h1>
    <p>Kode Resi: {{ $receipt->receipt_code }}</p>
    <p>Scan QR berikut untuk konfirmasi:</p>
    <img src="data:image/png;base64,{{ $qr }}" alt="QR Code" width="200">
</body>
</html>
