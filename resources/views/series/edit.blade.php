@extends('layouts.app')
<style>
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
</style>
@section('content')
<div style="max-width: 600px; margin: auto; color: white; padding-bottom: 80px;">
    <h1 style="margin-bottom: 20px; color: white;">Editar Serie: {{ $serie->titulo }}</h1>
    <form action="{{ route('series.update', $serie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label for="imagen" style="display: block; margin-bottom: 5px; color: white;">Imagen</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="{{ $serie->imagen }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="titulo" style="display: block; margin-bottom: 5px; color: white;">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $serie->titulo }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="sinopsis" style="display: block; margin-bottom: 5px; color: white;">Sinopsis</label>
            <textarea class="form-control" id="sinopsis" name="sinopsis"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>{{ $serie->sinopsis }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="genero" style="display: block; margin-bottom: 5px; color: white;">Género</label>
            <input type="text" class="form-control" id="genero" name="genero" value="{{ $serie->genero }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="ano_lanzamiento" style="display: block; margin-bottom: 5px; color: white;">Año de
                Lanzamiento</label>
            <input type="number" class="form-control" id="ano_lanzamiento" name="ano_lanzamiento"
                value="{{ $serie->ano_lanzamiento }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;"">
            <label for=" temporadas" style="display: block; margin-bottom: 5px; color: white;">Temporadas</label>
            <input type="number" class="form-control" id="temporadas" name="temporadas" value="{{ $serie->temporadas }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="estado_emision" style="display: block; margin-bottom: 5px; color: white;">Estado</label>
            <input type="text" class="form-control" id="estado_emision" name="estado_emision"
                value="{{ $serie->estado_emision }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="puntuacion_media" style="display: block; margin-bottom: 5px; color: white;">Puntuación
                Media</label>
            <input type="number" step="0.1" class="form-control" id="puntuacion_media" name="puntuacion_media"
                value="{{ $serie->puntuacion_media }}"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <button type="submit" class='btn-style'">Actualizar</button>
    </form>
</div>
@endsection