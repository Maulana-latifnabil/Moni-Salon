@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Booking Barbershop</h1>
        <form action="{{ route('customer.bookings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', Auth::user()->name) }}"
                    class="form-control" required readonly>
            </div>
            <div class="form-group">
                <label for="phone_number">Nomor Telepon</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                    class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat (opsional)</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="booking_date">Tanggal Booking</label>
                <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}"
                    class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="booking_time">Waktu Booking</label>
                <input type="time" name="booking_time" id="booking_time" value="{{ old('booking_time') }}"
                    class="form-control" required>
            </div>
            <div class="form-group">
                <label for="service_id">Layanan yang Dipesan</label>
                <select name="service_id" id="service_id" class="form-control">
                    <option value="">Pilih Layanan</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} - Rp. {{ number_format($service->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="selected_barber">Barber yang Dipilih</label>
                <select name="barber_id" id="barber_id" class="form-control">
                    <option value="">Pilih Barber</option>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                            {{ $barber->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="additional_notes">Catatan Tambahan</label>
                <textarea name="additional_notes" id="additional_notes" class="form-control">{{ old('additional_notes') }}</textarea>
            </div>
            <div class="form-group">
                <label for="payment_method">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai</option>
                    <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit
                    </option>
                    <option value="online_payment" {{ old('payment_method') == 'online_payment' ? 'selected' : '' }}>
                        Pembayaran Online</option>
                </select>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="agree_privacy_policy" id="agree_privacy_policy" class="form-check-input"
                    {{ old('agree_privacy_policy') ? 'checked' : '' }} required>
                <label for="agree_privacy_policy" class="form-check-label">Saya setuju dengan Kebijakan Privasi</label>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="agree_terms_conditions" id="agree_terms_conditions" class="form-check-input"
                    {{ old('agree_terms_conditions') ? 'checked' : '' }} required>
                <label for="agree_terms_conditions" class="form-check-label">Saya setuju dengan Syarat dan Ketentuan</label>
            </div>
            <button type="submit" class="btn btn-success">Booking Sekarang</button>
        </form>
    </div>
@endsection
