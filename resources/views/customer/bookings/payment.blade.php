@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Payment</h1>
        <p>Total Amount: Rp {{ number_format($totalPrice, 2) }}</p>
        <button id="pay-button">Pay Now</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://js.paypal.com/v1/checkout.js"></script>

    <script>
        document.getElementById('pay-button').onclick = function() {
            // Panggil Snap JS Midtrans untuk membuat transaksi
            snap.pay('{{ $snapToken }}', {
                // Optional: Fungsi callback ketika pembayaran selesai
                onSuccess: function(result) {
                    alert('Payment success!');
                    window.location.href = "{{ route('customer.booking.success') }}";
                },
                // Optional: Fungsi callback ketika pembayaran dibatalkan
                onPending: function(result) {
                    alert('Waiting for your payment!');
                    window.location.href = "{{ route('customer.booking.success') }}";
                },
                // Optional: Fungsi callback ketika pembayaran dibatalkan
                onError: function(result) {
                    alert('Payment failed!');
                    window.location.href = "{{ route('customer.booking.confirm') }}";
                }
            });
        };
    </script>
@endsection
