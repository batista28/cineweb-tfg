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
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #1B2026;
            text-align: center;
            padding-bottom: 50px;
        }

        /* Estilos para la tabla de usuarios */
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
            color: #fff;
            background-color: #343a40;
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

        /* Estilos para botones */
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

        .btn-success {
            background-color: #1abc9c;
        }

        .btn-success:hover {
            background-color: #16a085;
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

        .btn-style2 {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            background-color: #2c3e50;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-style2:hover {
            background-color: #1abc9c;
        }

        .btn-style2 a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 800px; margin: auto;">
        <h1 style="margin-bottom: 20px; color: white;">Lista de Usuarios</h1>
        <div style="margin-bottom: 20px;">
            <a href="{{ route('admin.users.create') }}" class="btn-style2">Añadir nuevo usuario</a>
        </div>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-success">Mostrar</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection