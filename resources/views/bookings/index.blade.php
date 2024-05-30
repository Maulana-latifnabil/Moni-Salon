@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Booking Saya</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Tanggal Booking</th>
                    <th>Waktu Booking</th>
                    <th>Layanan</th>
                    <th>Barber</th>
                    <th>Catatan Tambahan</th>
                    <th>Metode Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->full_name }}</td>
                        <td>{{ $booking->phone_number }}</td>
                        <td>{{ $booking->address }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->booking_time }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->barber ? $booking->barber->name : 'N/A' }}</td>
                        <td>{{ $booking->additional_notes }}</td>
                        <td>{{ $booking->payment_method }}</td>
                        <td>
                            <a href="{{ route('bookingAdmin.edit', $booking->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('bookingAdmin.destroy', $booking->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                <a href="{{ route('customer.bookings.receipt', $booking->id) }}"
                                    class="btn btn-info btn-sm">Kwitansi</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
