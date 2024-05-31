@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>
        @can('create users')
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        @endcan
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            @can('view users')
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                            @endcan
                                @can('edit users')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display:inline-block;">
                                @endcan
                                @can('delete users')

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
