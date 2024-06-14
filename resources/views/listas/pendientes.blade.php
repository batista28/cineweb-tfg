@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Películas Pendientes</h2>
    @if ($listas->isNotEmpty())
        @foreach($listas as $lista)
            @if ($lista->items->where('estado', 'pendiente')->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th>Título</th>
                            <th>Sinopsis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista->items->where('estado', 'pendiente') as $item)
                            @if ($item->pelicula)
                                <tr>
                                    <td><img src="{{ $item->pelicula->poster }}" alt="Poster de {{ $item->pelicula->titulo }}" width="100">
                                    </td>
                                    <td>{{ $item->pelicula->titulo }}</td>
                                    <td>{{ $item->pelicula->sinopsis }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay películas pendientes en la lista {{ $lista->nombre_lista }}.</p>
            @endif
        @endforeach
    @else
        <p>No hay listas disponibles.</p>
    @endif
</div>
@endsection