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
        /* Borde externo de la tabla */
        margin-top: 20px;
        border-collapse: collapse;
        border-spacing: 0;
        /* Añadir espacio entre filas para que no sean cuadrados */
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
        /* Texto más grande para los encabezados */
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
        /* Tamaño de fuente más grande */
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
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="btn-group" role="group">
                <button type="button" class="btn-style">
                    <a href="{{ route('listas.index', ['tipo' => 'series_pendientes']) }}">Series Pendientes</a>
                </button>
                <button type="button" class="btn-style">
                    <a href="{{ route('listas.index', ['tipo' => 'peliculas_pendientes']) }}">Películas Pendientes</a>
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
            @if ($tipo == 'series_pendientes' || $tipo == 'series_vistas')
                <!-- Mostrar los elementos de la lista de Series -->
                <div class="table-responsive">
                    <h3>{{ $tipo == 'series_pendientes' ? 'Series Pendientes' : 'Series Vistas' }} de {{ $nombreUsuario }}
                    </h3>
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Título</th>
                                <th>Sinopsis</th>
                                <th>Género</th>
                                <th>Año de Lanzamiento</th>
                                <th>Director</th>
                                <th>Estado de Emisión</th>
                                <th>Puntuación</th>
                                @if ($tipo == 'series_pendientes')
                                    <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr id="item-{{ $item->id }}">
                                    <td>
                                        @if ($item->serie && $item->serie->imagen)
                                            <img src="{{ asset($item->serie->imagen) }}" alt="{{ $item->serie->titulo }}">
                                        @else
                                            No hay imagen disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->titulo }}
                                        @else
                                            Serie no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->sinopsis }}
                                        @else
                                            Sinopsis no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->genero }}
                                        @else
                                            Género no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->ano_lanzamiento }}
                                        @else
                                            Año de lanzamiento no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->director }}
                                        @else
                                            Director no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->estado_emision }}
                                        @else
                                            Estado de emisión no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->serie)
                                            {{ $item->serie->puntuacion_media }}
                                        @else
                                            Puntuación no disponible
                                        @endif
                                    </td>
                                    @if ($tipo == 'series_pendientes')
                                        <td>
                                            <button type="button" class="action-btn"
                                                onclick="agregarVista('series_pendientes', {{ $item->id }})">Agregar a
                                                Vistas</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($items->isEmpty())
                        <p>No hay series disponibles.</p>
                    @endif
                </div>
            @elseif ($tipo == 'peliculas_pendientes' || $tipo == 'peliculas_vistas')
                <!-- Mostrar los elementos de la lista de Películas -->
                <div class="table-responsive mt-4">
                    <h3>{{ $tipo == 'peliculas_pendientes' ? 'Películas Pendientes' : 'Películas Vistas' }} de
                        {{ $nombreUsuario }}</h3>
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Título</th>
                                <th>Sinopsis</th>
                                <th>Género</th>
                                <th>Año de Lanzamiento</th>
                                <th>Director</th>
                                <th>Puntuación</th>
                                @if ($tipo == 'peliculas_pendientes')
                                    <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr id="item-{{ $item->id }}">
                                    <td>
                                        @if ($item->pelicula && $item->pelicula->imagen)
                                            <img src="{{ asset($item->pelicula->imagen) }}" alt="{{ $item->pelicula->titulo }}">
                                        @else
                                            No hay imagen disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pelicula)
                                            {{ $item->pelicula->titulo }}
                                        @else
                                            Película no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pelicula)
                                            {{ $item->pelicula->sinopsis }}
                                        @else
                                            Sinopsis no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pelicula)
                                            {{ $item->pelicula->genero }}
                                        @else
                                            Género no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pelicula)
                                            {{ $item->pelicula->ano_lanzamiento }}
                                        @else
                                            Año de lanzamiento no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pelicula)
                                            {{ $item->pelicula->director }}
                                        @else
                                            Director no disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pelicula)
                                            {{ $item->pelicula->puntuacion_media }}
                                        @else
                                            Puntuación no disponible
                                        @endif
                                    </td>
                                    @if ($tipo == 'peliculas_pendientes')
                                        <td>
                                            <button type="button" class="action-btn"
                                                onclick="agregarVista('peliculas_pendientes', {{ $item->id }})">Agregar a
                                                Vistas</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($items->isEmpty())
                        <p>No hay películas disponibles.</p>
                    @endif
                </div>
            @else
                <p>Selecciona una opción para ver los detalles.</p>
            @endif
        </div>
    </div>
</div>

<script>
    function agregarVista(tipo, id) {
        fetch(`/listas/agregarVista/${tipo}/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        }).then(response => {
            if (response.ok) {
                document.getElementById(`item-${id}`).remove();
            } else {
                alert('Error al agregar a vistas');
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Error al agregar a vistas');
        });
    }
</script>
@endsection