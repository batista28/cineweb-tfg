@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- Detalles de la serie -->
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset($serie->imagen) }}" alt="{{ $serie->titulo }}" class="card-img-top">
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $serie->titulo }}</h2>
                            <p><strong>Género:</strong> {{ $serie->genero }}</p>
                            <p><strong>Año de lanzamiento:</strong> {{ $serie->ano_lanzamiento }}</p>
                            <p><strong>Director:</strong> {{ $serie->director }}</p>
                            <p><strong>Estado de emisión:</strong> {{ $serie->estado_emision }}</p>
                            <p><strong>Sinopsis:</strong> {{ $serie->sinopsis }}</p>
                            <!-- Formulario para agregar la serie a la lista de pendientes -->
                            @auth
                                <form action="{{ route('listas.addSerie') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="serieId" value="{{ $serie->id }}">
                                    <input type="hidden" name="nombre_lista" value="series_pendientes">
                                    <input type="hidden" name="estado" value="pendiente">
                                    <button type="submit" class="btn btn-primary">Agregar a Pendientes</button>
                                </form>
                                <form action="{{ route('listas.addSerie') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="serieId" value="{{ $serie->id }}">
                                    <input type="hidden" name="nombre_lista" value="series_vistas">
                                    <input type="hidden" name="estado" value="vista">
                                    <button type="submit" class="btn btn-success">Agregar a Vistas</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                    <!-- Calificación y recomendaciones -->
                    <div class="container-div gap-container">
                        <!-- Formulario de calificación -->
                        <div class="calificacion-form">
                            <strong>Puntuación media:</strong>
                            <div class="puntuacion-media-card">
                                <br> {{ number_format($serie->puntuacion_media, 1) }}
                            </div>
                            <div class="votos">
                                <span>👥: {{ $serie->cantidad_votos }}</span>
                            </div>
                            <h4>Calificar esta serie</h4>
                            <form action="{{ route('series.calificar', $serie->id) }}" method="POST">
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
                        <!-- Recomendaciones por género -->
                        <div class="recomendaciones mt-4">
                            <h3>Recomendaciones</h3>
                            <h4>Por género</h4>
                            <div id="carouselGenero" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($seriesRelacionadasPorGenero as $serieGenero)
                                        <div class="carousel-item @if($loop->first) active @endif">
                                            <img src="{{ asset($serieGenero->imagen) }}" class="d-block w-100"
                                                alt="{{ $serieGenero->titulo }}">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{ $serieGenero->titulo }}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselGenero" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselGenero" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Añadir los scripts de Bootstrap al final del documento -->
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection