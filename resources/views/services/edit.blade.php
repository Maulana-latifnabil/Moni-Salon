@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Layanan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Layanan</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $service->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control">{{ $service->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $service->price }}" required>
                </div>
                <div class="form-group">
                    <label for="duration">Durasi (menit)</label>
                    <input type="number" name="duration" id="duration" class="form-control" value="{{ $service->duration }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update Layanan</button>
            </form>
        </div>
    </div>
</div>
@endsection
