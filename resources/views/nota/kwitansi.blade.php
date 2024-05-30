<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Booking</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 800px; margin: auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { padding: 20px; border: 1px solid #000; }
        .content p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Bukti Booking</h2>
        </div>
        <div class="content">
            <p><strong>Nama Lengkap:</strong> {{ $booking->full_name }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $booking->phone_number }}</p>
            <p><strong>Alamat:</strong> {{ $booking->address }}</p>
            <p><strong>Tanggal Booking:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Waktu Booking:</strong> {{ $booking->booking_time }}</p>
            <p><strong>Layanan yang Dipesan:</strong> {{ $booking->service->name }}</p>
            <p><strong>Barber yang Dipilih:</strong> {{ $booking->barber ? $booking->barber->name : 'N/A' }}</p>
            <p><strong>Catatan Tambahan:</strong> {{ $booking->additional_notes }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($booking->payment_method) }}</p>
        </div>
    </div>
</body>
</html>
