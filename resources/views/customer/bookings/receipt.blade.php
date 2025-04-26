@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Bukti Booking</h3>
                    </div>
                    <div class="card-body">
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
                        <p><strong>Total Biaya Layanan</strong> Rp. {{ number_format($booking->services->sum('price'), 0, ',', '.') }}</p>
                        <p><strong>Salon yang Dipilih:</strong> {{ $booking->barber ? $booking->barber->name : 'N/A' }}</p>
                        <p><strong>Catatan Tambahan:</strong> {{ $booking->additional_notes }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ ucfirst($booking->payment_method) }}</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('customer.bookings.index') }}" class="btn btn-primary">Kembali ke Daftar Booking</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#pdfModal">
                        Download PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Download Bukti Booking sebagai PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="/downloadReceipt/{{ $booking->id }}" style="width: 100%" height="560px"></iframe>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
