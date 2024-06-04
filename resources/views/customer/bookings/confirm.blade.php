<!-- resources/views/customer/bookings/confirm.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Konfirmasi Booking</h1>
    <form action="{{ route('customer.booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ Auth::user()->name }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Nomor Telepon</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="additional_notes">Catatan Tambahan</label>
            <textarea name="additional_notes" id="additional_notes" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash">Tunai</option>
                <option value="credit_card">Kartu Kredit</option>
                <option value="online_payment">Pembayaran Online</option>
            </select>
        </div>
        <div class="form-group">
            <h3>Layanan yang Dipilih</h3>
            <ul>
                @foreach ($services as $service)
                    <li>{{ $service->name }} - Rp. {{ number_format($service->price, 0, ',', '.') }}</li>
                @endforeach
            </ul>
            <h4>Total Biaya: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h4>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="agree_privacy_policy" required> Saya setuju dengan kebijakan privasi
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="agree_terms_conditions" required> Saya setuju dengan syarat dan ketentuan
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Konfirmasi Booking</button>
    </form>
</div>
@endsection
