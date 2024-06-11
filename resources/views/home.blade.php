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
                                        <div class="card shadow">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">{{ $service->name }}</h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $service->description }}</p>
                                                <p class="card-text"><strong>Harga : </strong>
                                                    {{ formatRupiah($service->price) }}
                                                </p>
                                                <p class="card-text"><strong>Estimasi : </strong>{{ $service->duration }} Menit
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
                    <a href="{{ route('customer.booking.step1') }}" class="btn btn-success btn-lg">Booking Sekarang</a>
                </div>
            </div>
        @endcan

        @can('katalog admin')
            <!-- Earnings Overview Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monitor pendapatan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>

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
                                            <th>No</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookingsToday as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
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
                                                <td>{{ ucfirst($booking->payment_method) }}</td>
                                                <td>{{ ucfirst($booking->status) }}</td> <!-- Tampilkan status -->
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
                                    <th>Status</th> <!-- Tambahkan kolom Status -->
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
                                        <td>
                                            @foreach ($booking->services as $service)
                                                {{ $service->name }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $booking->additional_notes }}</td>
                                        <td>{{ ucfirst($booking->payment_method) }}</td>
                                        <td>{{ ucfirst($booking->status) }}</td> <!-- Tampilkan status -->
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

@section('js')
    @can('katalog admin')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ LarapexChart::cdn() }}"></script>
        {{ $chart->script() }}
    @endcan
@endsection
