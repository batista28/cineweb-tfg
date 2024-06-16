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

    /* Estilos personalizados para el formulario de contacto */
    .form-group {
        margin-bottom: 20px;
        /* Añade margen inferior para separar cada grupo */
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        /* Aumenta el margen inferior de las etiquetas */
        color: white;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #343a40;
        color: white;
    }
</style>

@section('content')
<div style="max-width: 600px; margin: auto; color: white; padding-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="margin-bottom: 20px;">
                <div class="card-header">{{ __('Formulario de Contacto') }}</div>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contacto.submit') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                            name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mensaje">{{ __('Mensaje') }}</label>
                        <textarea id="mensaje" class="form-control @error('mensaje') is-invalid @enderror"
                            name="mensaje" required autocomplete="mensaje">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class='btn-style'>
                            {{ __('Enviar Mensaje') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection