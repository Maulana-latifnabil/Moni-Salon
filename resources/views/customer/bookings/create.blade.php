@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Booking Mony Salon Beauty</h1>
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
            <select name="booking_time" id="booking_time" class="form-control" required>
                <option value="">Pilih Waktu</option>
                @php
                    $currentDate = date('Y-m-d');
                    $currentTime = date('H:i');
                @endphp
                @foreach ($availableSlots as $slot)
                    @php
                        $isUnavailable = false;
                        foreach ($bookings as $booking) {
                            if ($booking->booking_time == $slot) {
                                $isUnavailable = true;
                                break;
                            }
                        }
                    @endphp
                    {{-- Tambahan: Tambahkan kondisi untuk memeriksa apakah slot sudah dipilih sebelumnya --}}
                    @php
                        $isAlreadySelected = false;
                        foreach ($selectedBookingTimes as $selectedTime) {
                            if ($selectedTime == $slot) {
                                $isAlreadySelected = true;
                                break;
                            }
                        }
                    @endphp
                    {{-- Akhir Tambahan --}}
                    @if ($isUnavailable || old('booking_date') == $currentDate && $slot <= $currentTime || $isAlreadySelected)
                        <option value="{{ $slot }}" disabled class="unavailable">{{ $slot }}</option>
                    @else
                        <option value="{{ $slot }}">{{ $slot }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="service_ids">Layanan yang Dipesan</label>
            <select name="service_ids[]" id="service_ids" class="form-control" multiple>
                <option value="">Pilih Layanan</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ collect(old('service_ids'))->contains($service->id) ? 'selected' : '' }}>
                        {{ $service->name }} - Rp. {{ number_format($service->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="barber_id">Salon yang Dipilih</label>
            <select name="barber_id" id="barber_id" class="form-control">
                <option value="">Pilih Salon</option>
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
                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="online_payment" {{ old('payment_method') == 'online_payment' ? 'selected' : '' }}>Pembayaran Online</option>
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
        <button type="submit" class="btn btn-primary">Buat Booking</button>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookingDateInput = document.getElementById('booking_date');
            const barberIdInput = document.getElementById('barber_id');
            const bookingTimeSelect = document.getElementById('booking_time');
            const selectedBookingTimes = @json($selectedBookingTimes); // Menyinkronkan variabel PHP dengan JavaScript

            bookingDateInput.addEventListener('change', fetchUnavailableSlots);
            barberIdInput.addEventListener('change', fetchUnavailableSlots);

            function fetchUnavailableSlots() {
                const date = bookingDateInput.value;
                const barberId = barberIdInput.value;

                if (date && barberId) {
                    fetch(`/customer/bookings/unavailable-slots?date=${date}&barber_id=${barberId}`)
                        .then(response => response.json())
                        .then(unavailableSlots => {
                            const options = bookingTimeSelect.options;
                            const currentDate = new Date().toISOString().split('T')[0];
                            const currentTime = new Date().toTimeString().split(' ')[0].substr(0, 5);

                            for (let i = 0; i < options.length; i++) {
                                if (unavailableSlots.includes(options[i].value) || (date === currentDate && options[i].value <= currentTime) || selectedBookingTimes.includes(options[i].value)) {
                                    options[i].disabled = true;
                                    options[i].classList.add('unavailable');
                                } else {
                                    options[i].disabled = false;
                                    options[i].classList.remove('unavailable');
                                }
                            }
                        });
                }
            }
        });
    </script>
@endsection

