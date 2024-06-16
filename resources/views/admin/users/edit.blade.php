@extends('layouts.app')
<style>
    .btn-style {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        background-color: #049dbf;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-style:hover {
        background-color: #034e5f;
    }

    .btn-style a {
        color: inherit;
        text-decoration: none;
    }
</style>
@section('content')
<div style="max-width: 600px; margin: auto;">
    <h1 style="margin-bottom: 20px; color: white;">Editar Usuario: {{ $user->name }}</h1>
    </h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; margin-bottom: 5px; color: white;">Nombre</label>
            <input type="text" name="name"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ $user->name }}" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; margin-bottom: 5px; color: white;"">Email</label>
            <input type=" email" name="email"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ $user->email }}" required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; color: white;">Contraseña</label>
            <input type="password" name="password"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                placeholder="Leave blank to keep the current password">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; color: white;">Confirma Contraseña</label>
            <input type="password" name="password_confirmation"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;">
        </div>
        <button type="submit" class='btn-style'>Actualizar</button>
    </form>
</div>
@endsection