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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Tanggal Booking</th>
                            <th>Layanan</th>
                            <th>Barber</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->full_name }}</td>
                                <td>{{ $booking->phone_number }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>
                                    @foreach ($booking->services as $service)
                                        {{ $service->name }}<br>
                                    @endforeach
                                </td>
                                <td>{{ $booking->barber ? $booking->barber->name : 'N/A' }}</td>
                                <td>Rp. {{ number_format($booking->services->sum('price'), 0, ',', '.') }}</td>
                                <td>{{ ucfirst($booking->status) }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <a href="{{ route('customer.bookings.edit', $booking->id) }}"
                                            class="btn btn-primary btn-sm m-1">Edit</a>
                                        <form action="{{ route('customer.bookings.destroy', $booking->id) }}"
                                            method="POST" style="display:inline;" class="m-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        <a href="{{ route('customer.bookings.receipt', $booking->id) }}"
                                            class="btn btn-info btn-sm m-1">Detail</a>
                                        @if ($booking->status == "pending")
                                            <form action="{{ route('bookings.checkin', $booking->id) }}" method="POST" class="m-1">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Check-In</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
