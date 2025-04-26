@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pilih Salon</h1>
    <form action="{{ route('customer.booking.step2.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="barber_id">Salon yang Dipilih</label>
            <select name="barber_id" id="barber_id" class="form-control" required>
                @foreach ($barbers as $barber)
                    <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Selanjutnya</button>
    </form>
</div>
@endsection
