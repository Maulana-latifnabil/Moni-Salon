@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tentukan Jadwal</h1>
    <form action="{{ route('customer.booking.step3.post') }}" method="POST">
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
        <button type="submit" class="btn btn-primary">Selanjutnya</button>
    </form>
</div>

@if(session('booking_error'))
<!-- Bootstrap Modal -->
<div class="modal fade" id="bookingErrorModal" tabindex="-1" role="dialog" aria-labelledby="bookingErrorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingErrorModalLabel">Booking Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Pilih waktu yang lain
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#bookingErrorModal').modal('show');
    });
</script>
@endif
@endsection
