@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1200px; margin: 0 auto;">
    <h1>Plataformas de Streaming</h1>
    <div class="row">
        @foreach($plataformas as $plataforma)
            <div class="col-md-3" style="margin-bottom: 20px;">
                <img src="{{ asset('img/' . $plataforma->nombre_plataforma . '.png') }}"
                    alt="{{ $plataforma->nombre_plataforma }}" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Estilos personalizados para el contenedor y las imágenes */
    .container {
        max-width: 1200px;
        /* Ancho máximo del contenedor */
        margin: 0 auto;
        /* Centrar el contenedor */
        background-color: #343a40;
    }

    .container .row .col-md-3 {
        margin-bottom: 20px;
        /* Margen inferior entre las imágenes */
    }

    .container .row .col-md-3 img {
        max-width: 100%;
        /* Para asegurar que las imágenes no se estiren más allá de su tamaño original */
        height: auto;
        /* Ajustar la altura automáticamente */
    }
</style>
@endsection