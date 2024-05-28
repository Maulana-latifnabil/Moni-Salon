@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="form-group">
            <label for="permissions">Assign Permissions</label>
            @foreach($permissions as $permission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission{{ $permission->id }}">
                    {{ $permission->name }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
