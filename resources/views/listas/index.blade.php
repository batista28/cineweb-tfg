@extends('layouts.app')

@section('content')
<style>
    /* Estilos para los botones */
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

    /* Estilo de fondo para el cuerpo */
    body {
        background-color: #1B2026;
    }

    /* Estilos adicionales para la tabla */
    .table-custom {
        width: 100%;
        color: white;
        background-color: #343a40;
        border: 2px solid white;
        margin-top: 20px;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .table-custom th,
    .table-custom td {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        color: #fff;
        background-color: #343a40;
        font-family: 'Inter', Arial, sans-serif;
    }

    .table-custom th {
        font-size: 18px;
    }

    .table-custom tbody tr:nth-child(even) {
        background-color: #454d55;
    }

    .table-custom tbody tr:hover {
        background-color: #495057;
    }

    .table-custom img {
        max-width: 100px;
        height: auto;
    }

    /* Estilos para los encabezados h3 */
    h3 {
        color: white;
        font-size: 24px;
    }

    /* Estilos para los botones de acción */
    .action-btn {
        padding: 5px 10px;
        margin: 2px;
        border: none;
        border-radius: 5px;
        background-color: #28a745;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .action-btn:hover {
        background-color: #218838;
    }

    /* Añadir margen inferior al contenido para evitar que el footer lo cubra */
    .content-wrapper {
        margin-bottom: 50px;
    }

    /* Estilos para el pie de página */
    footer {
        background-color: #343a40;
        color: white;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="btn-group" role="group">
                    <button type="button" class="btn-style">
                        <a href="{{ route('listas.index', ['tipo' => 'series_pendientes']) }}">Series Pendientes</a>
                    </button>
                    <button type="button" class="btn-style">
                        <a href="{{ route('listas.index', ['tipo' => 'peliculas_pendientes']) }}">Películas
                            Pendientes</a>
                    </button>
                    <button type="button" class="btn-style">
                        <a href="{{ route('listas.index', ['tipo' => 'series_vistas']) }}">Series Vistas</a>
                    </button>
                    <button type="button" class="btn-style">
                        <a href="{{ route('listas.index', ['tipo' => 'peliculas_vistas']) }}">Películas Vistas</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h3>{{ ucfirst(str_replace('_', ' ', $tipo)) }} de {{ $nombreUsuario }}</h3>
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Título</th>
                                <th>Sinopsis</th>
                                <th>Género</th>
                                <th>Año de Lanzamiento</th>
                                <th>Director</th>
                                @if (strpos($tipo, 'series_') !== false)
                                    <th>Estado de Emisión</th>
                                @endif
                                <th>Puntuación</th>
                                @if ($estado == 'pendiente')
                                    <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                @if ($item->serie || $item->pelicula)
                                    <tr id="item-{{ $item->id }}">
                                        <td>
                                            @if ($item->serie && $item->serie->imagen)
                                                <img src="{{ asset($item->serie->imagen) }}" alt="{{ $item->serie->titulo }}">
                                            @elseif ($item->pelicula && $item->pelicula->imagen)
                                                <img src="{{ asset($item->pelicula->imagen) }}" alt="{{ $item->pelicula->titulo }}">
                                            @else
                                                No hay imagen disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->serie)
                                                {{ $item->serie->titulo }}
                                            @elseif ($item->pelicula)
                                                {{ $item->pelicula->titulo }}
                                            @else
                                                No disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->serie)
                                                {{ $item->serie->sinopsis }}
                                            @elseif ($item->pelicula)
                                                {{ $item->pelicula->sinopsis }}
                                            @else
                                                No disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->serie)
                                                {{ $item->serie->genero }}
                                            @elseif ($item->pelicula)
                                                {{ $item->pelicula->genero }}
                                            @else
                                                No disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->serie)
                                                {{ $item->serie->ano_lanzamiento }}
                                            @elseif ($item->pelicula)
                                                {{ $item->pelicula->ano_lanzamiento }}
                                            @else
                                                No disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->serie)
                                                {{ $item->serie->director }}
                                            @elseif ($item->pelicula)
                                                {{ $item->pelicula->director }}
                                            @else
                                                No disponible
                                            @endif
                                        </td>
                                        @if ($item->serie)
                                            <td>{{ $item->serie->estado_emision }}</td>
                                        @endif
                                        <td>
                                            @if ($item->serie)
                                                {{ $item->serie->puntuacion_media }}
                                            @elseif ($item->pelicula)
                                                {{ $item->pelicula->puntuacion_media }}
                                            @else
                                                No disponible
                                            @endif
                                        </td>
                                        @if ($estado == 'pendiente')
                                            <td>
                                                <button type="button" class="action-btn"
                                                    onclick="agregarVista('{{ $tipo }}', {{ $item->serie ? $item->serie->id : $item->pelicula->id }})">
                                                    Agregar a Vistas
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if ($items->isEmpty())
                        <p>No hay elementos disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function agregarVista(tipo, id) {
        if (confirm('¿Estás seguro de que quieres marcar este ítem como visto?')) {
            window.location.href = '/listas/' + tipo + '/agregarVista/' + id;
        }
    }

</script>
@endsection