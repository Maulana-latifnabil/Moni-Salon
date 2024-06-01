
@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->

        </div>

        <!-- Content Row -->
        @can('katalog customer')
            <div class="row">
                <!-- Katalog Layanan -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Katalog Layanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $service->name }}</h5>
                                                <p class="card-text">{{ $service->description }}</p>
                                                <p class="card-text"><strong>Harga:</strong> {{ formatRupiah($service->price) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('customer.bookings.create') }}" class="btn btn-success btn-lg">Booking Sekarang</a>
                </div>
            </div>
        @endcan
        @can('katalog admin')
            <!-- Daftar Booking Hari Ini -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Booking Hari Ini</h6>
                        </div>
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
                                            <th>Metode Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookingsToday as $booking)
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
                                                <td>{{ ucfirst($booking->payment_method) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('katalog barber')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Booking Hari ini</h6>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Tanggal Booking</th>
                            <th>Waktu Booking</th>
                            <th>Layanan</th>
                            <th>Catatan Tambahan</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookingsToday as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->full_name }}</td>
                                <td>{{ $booking->phone_number }}</td>
                                <td>{{ $booking->address }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->booking_time }}</td>
                                <td>{{ $booking->service->name }}</td>
                                <td>{{ $booking->additional_notes }}</td>
                                <td>{{ ucfirst($booking->payment_method) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        @endcan
    </div>
@endsection
    <!-- DataTables CSS and JS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bookingsTableAdmin').DataTable();
            $('#bookingsTableBarber').DataTable();
        });
    </script>
