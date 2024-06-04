@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pilih Layanan</h1>
    <form action="{{ route('customer.booking.step1.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="service_ids">Layanan yang Dipesan</label>
            <select name="service_ids[]" id="service_ids" class="form-control" multiple required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} - Rp. {{ number_format($service->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Selanjutnya</button>
    </form>
</div>
@endsection
