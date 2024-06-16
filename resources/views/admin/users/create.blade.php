@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: auto;">
    <h1 style="margin-bottom: 20px; color: white;">Crear Usuario</h1>
    <form action="{{ route('admin.users.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; margin-bottom: 5px; color: white;">Nombre</label>
            <input type="text" name="name"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; margin-bottom: 5px; color: white;">Email</label>
            <input type="email" name="email"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; color: white;">Contraseña</label>
            <input type="password" name="password"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; color: white;">Confirma
                Contraseña</label>
            <input type="password" name="password_confirmation"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="is_admin" style="color: white;">Admin</label>
            <input type="checkbox" name="is_admin" value="1"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;">
        </div>
        <button type="submit" class='btn-style'>Crear Usuario</button>
    </form>
</div>
@endsection