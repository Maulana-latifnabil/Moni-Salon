@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Booking</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('bookingAdmin.index') }}">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('bookingAdmin.index') }}" class="btn btn-danger">Reset</a>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <th>Total Biaya</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th> <!-- Tambahkan kolom Status -->
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
                                <td>
                                    @foreach ($booking->services as $service)
                                        {{ $service->name }}<br>
                                    @endforeach
                                </td>
                                <td>{{ $booking->barber ? $booking->barber->name : 'N/A' }}</td>
                                <td>{{ $booking->additional_notes }}</td>
                                <td>Rp. {{ number_format($booking->services->sum('price'), 0, ',', '.') }}</td>
                                <td>{{ $booking->payment_method }}</td>
                                <td>{{ ucfirst($booking->status) }}</td> <!-- Tampilkan status -->
                                <td>
                                    <a href="{{ route('bookingAdmin.edit', $booking->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $booking->id }})">Hapus</button>
                                    <form id="delete-form-{{ $booking->id }}"
                                        action="{{ route('bookingAdmin.destroy', $booking->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
