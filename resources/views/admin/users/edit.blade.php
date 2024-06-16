@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: auto;">
    <h1 style="margin-bottom: 20px;">Edit User</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; margin-bottom: 5px;">Name</label>
            <input type="text" name="name"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;"
                value="{{ $user->name }}" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
            <input type="email" name="email"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;"
                value="{{ $user->email }}" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Password</label>
            <input type="password" name="password"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;"
                placeholder="Leave blank to keep the current password">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px;">Confirm Password</label>
            <input type="password" name="password_confirmation"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
        </div>
        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Update</button>
    </form>
</div>
@endsection