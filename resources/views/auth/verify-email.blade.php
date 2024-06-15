@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-dark text-white">
    <div class="verification-container mx-auto" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Verificación de Email</h2>
        <div class="content-container text-center">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <p>Antes de proceder, por favor revisa tu email para un enlace de verificación.
            </p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class='btn-style'>Reenviar el código de verificacion</button>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .d-flex {
        display: flex;
    }

    .justify-content-center {
        justify-content: center;
    }

    .align-items-center {
        align-items: center;
    }

    .min-vh-100 {
        min-height: 100vh;
    }



    .text-white {
        color: #ffffff;
    }

    .verification-container {
        background-color: #333333;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-top: -400px;
        /* Mueve el contenedor hacia arriba */
    }

    .content-container {
        font-size: 1.1rem;
    }

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

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
</style>