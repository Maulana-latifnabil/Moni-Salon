<!DOCTYPE html>
<html>

<head>
    <title>Kwitansi Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #343a40;
        }

        .content {
            padding: 20px;
            border-top: 2px solid #343a40;
        }

        .content p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.5;
            color: #495057;
        }

        .content p strong {
            display: inline-block;
            width: 150px;
            color: #212529;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="template/img/bglogin.jpg" alt="backround" height="140px">
            <h1>Bukti Booking</h1>
        </div>
        <div class="content">
            <p><strong>Nama Lengkap:</strong> {{ $booking->full_name }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $booking->phone_number }}</p>
            <p><strong>Alamat:</strong> {{ $booking->address }}</p>
            <p><strong>Tanggal Booking:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Waktu Booking:</strong> {{ $booking->booking_time }}</p>
            <p><strong>Layanan yang Dipesan:</strong>
                @foreach ($booking->services as $service)
                    <li>
                        {{ $service->name }}<br>
                    </li>
                @endforeach
            </p>
            <p><strong>Total Biaya Layanan</strong> Rp.
                {{ number_format($booking->services->sum('price'), 0, ',', '.') }}</p>
            <p><strong>Salon yang Dipilih:</strong> {{ $booking->barber ? $booking->barber->name : 'N/A' }}</p>
            <p><strong>Catatan Tambahan:</strong> {{ $booking->additional_notes }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($booking->payment_method) }}</p>
        </div>
    </div>
</body>

</html>
