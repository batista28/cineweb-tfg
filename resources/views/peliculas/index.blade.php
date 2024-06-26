@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logoCineWeb.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <title>CineWeb</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Estilos para el encabezado y la navegación */
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #1B2026;
            text-align: center;
            padding-bottom: 50px;
        }

        .header,
        .header1,
        nav a,
        .listapeliculas-container,
        .listapeliculas-container h2,
        table,
        th,
        td,
        .pagination,
        .pagination-container,
        .resultado,
        .footer,
        .footer-wrapper,
        .footer-links,
        .footer-links a,
        .social-links,
        .buscar-label,
        .ordenar-label,
        .ordenar-select,
        .buscar-input,
        label,
        select#orderField,
        p,
        span {
            font-family: 'Inter', Arial, sans-serif;
        }

        .ordenar-container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }

        .ordenar-label,
        .buscar-label {
            font-size: 18px;
            color: #fff;
            margin-right: 10px;
        }

        .ordenar-select,
        .buscar-input {
            padding: 8px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #2c3e50;
            color: #ecf0f1;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: #fff;
            background-color: #1a73e8;
            border: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #1558b3;
        }

        .pagination .page-link.disabled {
            background-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }

        .ordenar-select:hover,
        .buscar-input:hover {
            border-color: #1abc9c;
        }

        .buscar-input {
            padding: 6px 12px;
            font-size: 14px;
            width: 200px;
        }

        .header {
            background-color: #253340;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            overflow: hidden;
            margin-top: -10px;
            margin-left: -17px;
            gap: -50px;
        }

        .header1 {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        nav a {
            margin-right: 5px;
            color: white;
            text-decoration: none;
            font-family: 'Inter', Arial, sans-serif;
        }

        nav a:hover {
            color: #ddd;
        }

        .listapeliculas-container {
            margin: 20px;
            width: 90%;
            margin: auto;
            margin-bottom: 150px;
            max-height: calc(100vh - 200px);
        }



        .button-container {
            gap: 300px;
            /* Ajusta el espacio entre los botones */
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th,
        td {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            /* Alineación centrada para todas las celdas */
            color: #fff;
            background-color: #343a40;
            font-family: 'Inter', Arial, sans-serif;
        }

        th:first-child,
        td:first-child {
            border-left: 1px solid #ddd;
        }

        th:last-child,
        td:last-child {
            border-right: 1px solid #ddd;
        }

        th {
            background-color: #343a40;
        }

        .listapeliculas-container h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
            font-family: 'Inter', Arial, sans-serif;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .pagination-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 100px;
        }

        .pagination a {
            font-size: 24px;
        }

        .resultado {
            font-size: 18px;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #343a40;
        }

        tr:hover {
            background-color: #545a60;
        }

        .footer {
            background-color: #253340;
            padding: 1rem;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0;
            z-index: 1000;
        }

        .footer-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 10px;
        }

        span {
            color: white;
        }

        p {
            color: white;
        }

        .social-links img {
            width: 30px;
        }

        .pagination a:hover {
            color: #ddd;
        }

        label {
            color: white;
        }

        select#orderField {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #2c3e50;
            color: #ecf0f1;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-align: center;
            transition: all 0.3s ease;
        }

        select#orderField:hover {
            border-color: #1abc9c;
        }

        .buscar-input {
            padding: 8px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #2c3e50;
            color: #ecf0f1;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .buscar-input:hover {
            border-color: #1abc9c;
        }

        .ordenar-container {
            margin-bottom: 20px;
        }

        /* Estilos para los botones */
        .btn {
            padding: 8px 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #ecf0f1;
            background-color: #2c3e50;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        }

        .btn:hover {
            background-color: #1abc9c;
            color: #fff;
        }

        .btn-warning {
            background-color: #f39c12;

        }

        .btn-warning:hover {
            background-color: #e67e22;
        }

        .btn-danger {
            background-color: #e74c3c;

        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-add {
            display: inline-block;
            font-size: 16px;
            background-color: #2c3e50;
        }

        .btn-add:hover {
            background-color: #1abc9c;
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

        .btn-style a {
            color: inherit;
            text-decoration: none;
        }

        < !-- En la sección <style>de tu vista index.blade.php o en un archivo CSS externo --><style>
        /* Estilo para la tabla en modo responsive */
        @media (max-width: 768px) {
            .listapeliculas-container {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
                /* Ancho mínimo para evitar que se colapse completamente */
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            th,
            td {
                border-top: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                padding: 8px;
                text-align: center;
                /* Alineación centrada para todas las celdas */
                color: #fff;
                background-color: #343a40;
                font-family: 'Inter', Arial, sans-serif;
                white-space: nowrap;
                /* Evitar que el contenido se rompa en varias líneas */
            }

            th:first-child,
            td:first-child {
                border-left: 1px solid #ddd;
            }

            th:last-child,
            td:last-child {
                border-right: 1px solid #ddd;
            }

            th {
                background-color: #343a40;
            }

            .listapeliculas-container h2 {
                font-size: 1.5em;
                margin-bottom: 20px;
                color: #fff;
                text-align: center;
                font-family: 'Inter', Arial, sans-serif;
            }

            .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
            }

            .pagination-container {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 100px;
            }

            .pagination a {
                font-size: 16px;
            }

            .resultado {
                font-size: 14px;
                color: #fff;
            }

            tr:nth-child(even) {
                background-color: #343a40;
            }

            tr:hover {
                background-color: #545a60;
            }

            th,
            td {
                min-width: 100px;
                /* Ancho mínimo para cada celda */
            }
        }
    </style>

    </style>
</head>

<body>


    <main>
        <div class="listapeliculas-container">
            <h2>Lista de Películas</h2>

            <div class="ordenar-container">

                <form action="{{ route('peliculas.index') }}" method="GET" id="perPageForm">
                    <label for="perPage" class="ordenar-label">Número por página:</label>
                    <select name="perPage" id="perPage" class="ordenar-select">
                        <option value="5" {{ request()->input('perPage', 10) == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request()->input('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request()->input('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request()->input('perPage') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>

                <form action="{{ route('peliculas.index') }}" method="GET" id="orderFieldForm">
                    <label for="orderField" class="ordenar-label">Ordenar por:</label>
                    <select name="orderField" id="orderField" class="ordenar-select">
                        <option value="titulo_desc" {{ request()->input('orderField') == 'titulo_desc' ? 'selected' : '' }}>Título Descendente</option>
                        <option value="titulo_asc" {{ request()->input('orderField') == 'titulo_asc' ? 'selected' : '' }}>
                            Título Ascendente</option>
                        <option value="puntuacion_media_desc" {{ request()->input('orderField') == 'puntuacion_media_desc' ? 'selected' : '' }}>Mayor a Menor Puntuación</option>
                        <option value="puntuacion_media_asc" {{ request()->input('orderField') == 'puntuacion_media_asc' ? 'selected' : '' }}>Menor a Mayor Puntuación</option>
                        <option value="ano_lanzamiento_desc" {{ request()->input('orderField') == 'ano_lanzamiento_desc' ? 'selected' : '' }}>Más Recientes Primero</option>
                        <option value="ano_lanzamiento_asc" {{ request()->input('orderField') == 'ano_lanzamiento_asc' ? 'selected' : '' }}>Más Antiguas Primero</option>
                    </select>
                </form>

                <form action="{{ route('peliculas.index') }}" method="GET" id="searchForm">
                    <input type="hidden" name="perPage" value="{{ $perPage }}">
                    <label for="search" class="buscar-label">Buscar:</label>
                    <input type="text" name="search" id="search" class="buscar-input" placeholder="Título o Año"
                        value="{{ request()->input('search') }}">
                </form> @if (auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('peliculas.create') }}" class="btn btn-add">Añadir nueva película</a>
                @endif
            </div>

            <!-- Margen entre controles y la tabla -->
            <div style="margin-top: 20px;">
                <table>
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th>Título</th>
                            <th>Sinopsis</th>
                            <th>Género</th>
                            <th>Año de Lanzamiento</th>
                            <th>Director</th>
                            <th>Puntuación</th>
                            @auth
                                @if (auth()->check() && auth()->user()->is_admin)
                                    <th colspan="2">Acciones</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peliculas as $pelicula)
                            <tr>
                                <td>
                                    <a href="{{ route('peliculas.show', ['pelicula' => $pelicula->id]) }}">
                                        <img src="{{ $pelicula->imagen }}" alt="Imagen de {{ $pelicula->titulo }}"
                                            width="100">
                                    </a>
                                </td>
                                <td>{{ $pelicula->titulo }}</td>
                                <td>{{ $pelicula->sinopsis }}</td>
                                <td>{{ $pelicula->genero }}</td>
                                <td>{{ $pelicula->ano_lanzamiento }}</td>
                                <td>{{ $pelicula->director }}</td>
                                <td>{{ number_format($pelicula->puntuacion_media, 1) }}</td>

                                @auth
                                    @if (auth()->check() && auth()->user()->is_admin)

                                        <td>
                                            <!-- Botón de Editar -->
                                            <div class="button-container">
                                                <a href="{{ route('peliculas.edit', ['pelicula' => $pelicula->id]) }}"
                                                    class="btn btn-warning">Editar</a>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Botón de Eliminar con ventana emergente de confirmación -->
                                            <div class="button-container">
                                                <form action="{{ route('peliculas.destroy', $pelicula->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta película?')">Borrar</button>
                                                </form>
                                            </div>
                                        </td>

                                    @endif
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <div class="pagination-container">
                    {{ $peliculas->links() }}
                </div>
            </div>
        </div>
    </main>



    <script>
        document.getElementById('perPage').addEventListener('change', function () {
            document.getElementById('perPageForm').submit();
        });
        document.getElementById('orderField').addEventListener('change', function () {
            document.getElementById('orderFieldForm').submit();
        });
        document.getElementById('search').addEventListener('change', function () {
            document.getElementById('searchForm').submit();
        });

        document.addEventListener('DOMContentLoaded', function () {
            var showLoginAlert = '{{ session("showLoginAlert") }}';

            if (showLoginAlert == '1') {
                Swal.fire({
                    title: '¡Has iniciado sesión!',
                    text: 'Enhorabuena, has iniciado sesión con éxito y podrás disfrutar completamente de la página.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

            // Una vez mostrada la alerta, limpiar la sesión para no mostrarla nuevamente
            {{ session(['showLoginAlert' => null]) }};
            }
        });
    </script>
    @endsection