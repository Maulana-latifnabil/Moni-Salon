@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>
    <form action="{{ route('bookingAdmin.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $booking->full_name }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Nomor Telepon</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $booking->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="address">Alamat (opsional)</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $booking->address }}">
        </div>
        <div class="form-group">
            <label for="booking_date">Tanggal Booking</label>
            <input type="date" name="booking_date" id="booking_date" class="form-control" value="{{ $booking->booking_date }}" required>
        </div>
        <div class="form-group">
            <label for="booking_time">Waktu Booking</label>
            <input type="time" name="booking_time" id="booking_time" class="form-control" value="{{ $booking->booking_time }}" required>
        </div>
        <div class="form-group">
            <label for="service_id">Layanan yang Dipesan</label>
            <select name="service_id" id="service_id" class="form-control">
                @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }} - Rp. {{ number_format($service->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="selected_barber">Barber yang Dipilih (opsional)</label>
            <select name="selected_barber" id="selected_barber" class="form-control">
                <option value="">Pilih Barber</option>
                @foreach($barbers as $barber)
                    <option value="{{ $barber->id }}" {{ $booking->selected_barber == $barber->id ? 'selected' : '' }}>{{ $barber->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="additional_notes">Catatan Tambahan</label>
            <textarea name="additional_notes" id="additional_notes" class="form-control">{{ $booking->additional_notes }}</textarea>
        </div>
        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash" {{ $booking->payment_method == 'cash' ? 'selected' : '' }}>Tunai</option>
                <option value="credit_card" {{ $booking->payment_method == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="online_payment" {{ $booking->payment_method == 'online_payment' ? 'selected' : '' }}>Pembayaran Online</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
</div>
@endsection
