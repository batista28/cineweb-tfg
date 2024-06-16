@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: auto;">
    <h1 style="margin-bottom: 20px; color: white;">Create User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; margin-bottom: 5px; color: white;">Name</label>
            <input type="text" name="name" style="width: 100%; padding: 8px; border-radius: 5px;" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; margin-bottom: 5px; color: white;">Email</label>
            <input type="email" name="email" style="width: 100%; padding: 8px; border-radius: 5px;" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; color: white;">Password</label>
            <input type="password" name="password" style="width: 100%; padding: 8px; border-radius: 5px;" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; color: white;">Confirm
                Password</label>
            <input type="password" name="password_confirmation" style="width: 100%; padding: 8px; border-radius: 5px;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="is_admin" style="color: white;">Admin</label>
            <input type="checkbox" name="is_admin" value="1">
        </div>
        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Create</button>
    </form>
</div>
@endsection