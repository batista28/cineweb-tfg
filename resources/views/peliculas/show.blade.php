@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset($pelicula->imagen) }}" alt="{{ $pelicula->titulo }}"
                                class="card-img-top">
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $pelicula->titulo }}</h2>
                            <p><strong>Género:</strong> {{ $pelicula->genero }}</p>
                            <p><strong>Año de lanzamiento:</strong> {{ $pelicula->ano_lanzamiento }}</p>
                            <p><strong>Director:</strong> {{ $pelicula->director }}</p>
                            <p><strong>Sinopsis:</strong> {{ $pelicula->sinopsis }}</p>
                            @auth
                                <form action="{{ route('listas.addPelicula') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="peliculaId" value="{{ $pelicula->id }}">
                                    <input type="hidden" name="nombre_lista" value="peliculas_pendientes">
                                    <input type="hidden" name="estado" value="pendiente">
                                    <button type="submit" class='btn-style'>Agregar a Pendientes</button>
                                </form>

                                <form action="{{ route('listas.addPelicula') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="peliculaId" value="{{ $pelicula->id }}">
                                    <input type="hidden" name="nombre_lista" value="peliculas_vistas">
                                    <input type="hidden" name="estado" value="vista">
                                    <button type="submit" class='btn-style'>Agregar a Vistas</button>
                                </form>

                            @endauth
                        </div>
                    </div>
                    <div class="container-div gap-container">
                        <div class="calificacion-form"><strong>Puntuación media:</strong>
                            <div class="puntuacion-media-card">
                                <br> {{ number_format($pelicula->puntuacion_media, 1) }}
                            </div>
                            <div class="votos">
                                <span>👥: {{ $pelicula->cantidad_votos }}</span>
                            </div>
                            <h4>Calificar esta película</h4>
                            <form action="{{ route('peliculas.calificar', $pelicula->id) }}" method="POST">
                                @csrf
                                <div class="form-group select-container">
                                    <div class="select-style">
                                        <select name="calificacion" id="calificacion" class="form-control">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Enviar Calificación</button>
                                </div>
                            </form>

                        </div>

                        <div class="recomendaciones mt-4">
                            <h3>Recomendaciones</h3>
                            <h4>Por género</h4>
                            <div class="carousel">
                                @foreach($peliculasRelacionadasPorGenero as $peliculaRelacionada)
                                    <div class="carousel-item">
                                        <img src="{{ asset($peliculaRelacionada->imagen) }}" class="d-block w-100"
                                            alt="{{ $peliculaRelacionada->titulo }}">
                                    </div>
                                @endforeach
                            </div>
                            <h4>Por director</h4>
                            <div class="carousel">
                                @foreach($peliculasRelacionadasPorDirector as $peliculaRelacionada)
                                    <div class="carousel-item">
                                        <img src="{{ asset($peliculaRelacionada->imagen) }}" class="d-block w-100"
                                            alt="{{ $peliculaRelacionada->titulo }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection