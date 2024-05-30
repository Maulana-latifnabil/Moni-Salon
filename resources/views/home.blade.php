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

        <div class="row">
            <!-- Katalog Layanan -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Katalog Layanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($services as $service)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $service->name }}</h5>
                                            <p class="card-text">{{ $service->description }}</p>
                                            <p class="card-text"><strong>Harga:</strong> {{ formatRupiah($service->price) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Booking -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="{{ route('customer.bookings.create') }}" class="btn btn-success btn-lg">Booking Sekarang</a>
            </div>
        </div>

    </div>
@endsection
