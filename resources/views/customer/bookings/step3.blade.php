@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tentukan Jadwal</h1>
    <form id="bookingForm" action="{{ route('customer.booking.step3.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="booking_date">Tanggal Booking</label>
            <input type="date" name="booking_date" id="booking_date" class="form-control" min="{{ date('Y-m-d') }}" required>
            @error('booking_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="booking_time">Waktu Booking</label>
            <select name="booking_time" id="booking_time" class="form-control" required>
                @foreach ($availableSlots as $slot)
                    @php
                        $isUnavailable = $bookings->contains($slot);
                    @endphp
                    <option value="{{ $slot }}" {{ $isUnavailable ? 'disabled' : '' }}>{{ $slot }}</option>
                @endforeach
            </select>
            @error('booking_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" id="submitBtn" class="btn btn-primary">Selanjutnya</button>
    </form>
</div>

<script>
document.getElementById('bookingForm').addEventListener('submit', function(event) {
    let bookingTime = document.getElementById('booking_time');
    let selectedOption = bookingTime.options[bookingTime.selectedIndex];

    if (selectedOption.disabled) {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Slot waktu yang dipilih sudah terbooking. Silakan pilih waktu lain.',
        });
    }
});
</script>
@endsection
