@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-gray-800">Booking Saya !</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Booking</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Telepon</th>
                                <th>Tanggal Booking</th>
                                <th>Layanan</th>
                                <th>Booking</th>
                                <th>Total Biaya</th>
                                <th>Status Booking</th>
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
                                    <td>Rp. {{ number_format($booking->total_price, 0, ',', '.') }}</td>

                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-start">
                                            <a href="{{ route('customer.bookings.edit', $booking->id) }}"
                                                class="btn btn-primary btn-sm m-1">Edit</a>
                                            <button class="btn btn-danger btn-sm m-1"
                                                onclick="confirmDelete({{ $booking->id }})">Hapus</button>
                                            <form id="delete-form-{{ $booking->id }}"
                                                action="{{ route('customer.bookings.destroy', $booking->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ route('customer.bookings.receipt', $booking->id) }}"
                                                class="btn btn-info btn-sm m-1">Detail</a>
                                            @if ($booking->status == 'pending')
                                                <form action="{{ route('bookings.checkin', $booking->id) }}" method="POST"
                                                    class="m-1">
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

    </div>
@endsection

@section('js')
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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "searching": false,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
