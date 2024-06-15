@extends('layouts.app')

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

                    <div class="form-group row">
                        <label for="nombre"
                            style="display: block; margin-bottom: 5px; color: white;">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}"
                                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                                required autocomplete="nombre" autofocus>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            style="display: block; margin-bottom: 5px; color: white;">{{ __('Correo Electrónico') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}"
                                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                                required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mensaje"
                            style="display: block; margin-bottom: 5px; color: white;">{{ __('Mensaje') }}</label>

                            <div style="margin-bottom: 20px;">
                            <textarea id="mensaje" class="form-control @error('mensaje') is-invalid @enderror"
                                name="mensaje"
                                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                                required autocomplete="mensaje">{{ old('mensaje') }}</textarea>

                            @error('mensaje')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <div style="margin-bottom: 20px;">
                            <button type="submit"
                                style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                                {{ __('Enviar Mensaje') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection