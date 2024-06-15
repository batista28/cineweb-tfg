@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-form">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    <span class="alert-text">¡Ya estás logueado!</span>
                </div>
            </div>
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
    }

    .login-form {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #253340;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: white;
    }

    .card-body {
        color: white;
        /* Color del texto del cuerpo */
    }

    .alert {
        margin-bottom: 0px;
        position: relative;
        text-align: center;
        /* Alineación del texto en el centro */
    }

    .alert-text {
        display: block;
        /* Hacer que el span ocupe todo el ancho */
        font-size: 18px;
        /* Tamaño de fuente opcional */
        margin-bottom: 10px;
        /* Espacio inferior opcional */
    }
</style>