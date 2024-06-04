@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Konfirmasi Booking</h1>
    <form action="{{ route('customer.booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" value="{{ Auth::user()->name }}" class="form-control" required readonly>
        </div>
        <div class="form-group">
            <label for="phone_number">Nomor Telepon</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Alamat (opsional)</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="form-group">
            <label>Layanan yang Dipilih</label>
            <ul>
                @foreach ($services as $service)
                    <li>{{ $service->name }} - Rp. {{ number_format($service->price, 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <label>Barber yang Dipilih</label>
            <p>{{ $barber->name }}</p>
        </div>
        <div class="form-group">
            <label>Tanggal dan Waktu Booking</label>
            <p>{{ $bookingDate }} at {{ $bookingTime }}</p>
        </div>
        <div class="form-group">
            <label for="additional_notes">Catatan Tambahan (opsional)</label>
            <textarea name="additional_notes" id="additional_notes" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="online_payment">Online Payment</option>
            </select>
        </div>
        <div class="form-check">
            <input type="checkbox" name="agree_privacy_policy" id="agree_privacy_policy" class="form-check-input" required>
            <label for="agree_privacy_policy" class="form-check-label">Saya setuju dengan kebijakan privasi</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="agree_terms_conditions" id="agree_terms_conditions" class="form-check-input" required>
            <label for="agree_terms_conditions" class="form-check-label">Saya setuju dengan syarat dan ketentuan</label>
        </div>
        <button type="submit" class="btn btn-primary">Konfirmasi Booking</button>
    </form>
</div>
@endsection
