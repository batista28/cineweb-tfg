@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $plataforma->nombre_plataforma }}</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Películas</h2>
            <ul>
                @forelse($plataforma->peliculas as $pelicula)
                    <li>{{ $pelicula->nombre_pelicula }}</li>
                @empty
                    <li>No hay películas asociadas.</li>
                @endforelse
            </ul>
        </div>

        <div class="col-md-6">
            <h2>Series</h2>
            <ul>
                @forelse($plataforma->series as $serie)
                    <li>{{ $serie->nombre_serie }}</li>
                @empty
                    <li>No hay series asociadas.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection