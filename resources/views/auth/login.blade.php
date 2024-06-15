@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-form">
        <h2 class="text-center mb-4">Inicio de Sesión</h2>

        @if ($message = Session::get('success'))
            <div class="alert alert-success text-center">
                {{ $message }}
            </div>
        @endif

        <form action="{{ route('authenticate') }}" method="post" class="text-center">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label text-white">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="form-label text-white">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="remember">
                    Recuérdame
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-style">Iniciar Sesión</button>
            </div>

            @if (Route::has('password.request'))
                <div class="form-group">
                    <a href="{{ route('password.request') }}" class="text-white">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            @endif
        </form>
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
        background-color: #253340;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        margin-top: -260px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        color: white;
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

    .form-check-label {
        color: white;
    }

    .form-check-input {
        margin-top: 5px;
    }

    .alert {
        margin-bottom: 20px;
    }

    a {
        color: #007bff;
    }
</style>