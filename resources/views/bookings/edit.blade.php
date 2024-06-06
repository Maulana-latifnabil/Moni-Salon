@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Update Status Booking</h1>
    <form action="{{ route('bookingAdmin.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="waiting" {{ $booking->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                <option value="on-progress" {{ $booking->status == 'on-progress' ? 'selected' : '' }}>On Progress</option>
                <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Status</button>
    </form>
</div>
@endsection
