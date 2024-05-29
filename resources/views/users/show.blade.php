@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
    </div>
    <div class="form-group">
        <label for="roles">Roles</label>
        <input type="text" class="form-control" value="{{ $user->roles->pluck('name')->join(', ') }}" disabled>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
