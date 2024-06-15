@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-form">

        <h2 class="text-center mb-4">Registro</h2>
        <form action="{{ route('store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label text-white">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label text-white">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label text-white">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-label text-white">Confirma Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-style">Registrarse</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;

        /* Color de fondo opcional */
    }

    .login-form {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: white;
        background-color: #253340;
        margin-top: -140px;
    }

    .card-header {
        font-weight: bold;
        padding: 10px 0;
        border-radius: 8px 8px 0 0;
        margin-bottom: 20px;

        /* Color de fondo del encabezado */
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #343a40;
        color: white;
        text-align: center;
    }

    .btn-style {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-style:hover {
        background-color: #0056b3;
    }

    .text-danger {
        color: #dc3545;
    }
</style>