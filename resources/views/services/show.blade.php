@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detail Layanan</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $service->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $service->description ?? 'Tidak ada deskripsi' }}</p>
            <p><strong>Harga:</strong> Rp. {{ number_format($service->price, 0, ',', '.') }}</p>
            <p><strong>Durasi:</strong> {{ $service->duration }} menit</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
