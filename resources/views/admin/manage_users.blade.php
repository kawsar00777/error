<!-- resources/views/admin/manage_users.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->first() }}</td>
                    <td>
                        <form action="{{ route('admin.updateRole', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="role" class="form-control">
                                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                <option value="sub_admin" {{ $user->hasRole('sub_admin') ? 'selected' : '' }}>Sub Admin</option>
                                <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update Role</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
