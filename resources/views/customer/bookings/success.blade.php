@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payment Success</h1>
    <p>Your payment has been successfully processed. Thank you for your booking!</p>
    <a href="{{ route('customer.bookings.index') }}" class="btn btn-primary">Go to Bookings</a>
</div>
@endsection
