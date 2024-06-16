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
    <h1 style="margin-bottom: 20px; color: white;">Editar Película</h1>
    <form action="{{ route('peliculas.update', $pelicula->id) }}" method="POST" style="margin-bottom: 20px;"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label for="titulo" style="display: block; margin-bottom: 5px; color: white;">Título</label>
            <input type="text" name="titulo" id="titulo"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ old('titulo', $pelicula->titulo) }}" required>
            @error('titulo')
                <div style="color: #e74c3c; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="sinopsis" style="display: block; margin-bottom: 5px; color: white;">Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>{{ old('sinopsis', $pelicula->sinopsis) }}</textarea>
            @error('sinopsis')
                <div style="color: #e74c3c; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="genero" style="display: block; margin-bottom: 5px; color: white;">Género</label>
            <input type="text" name="genero" id="genero"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ old('genero', $pelicula->genero) }}" required>
            @error('genero')
                <div style="color: #e74c3c; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="ano_lanzamiento" style="display: block; margin-bottom: 5px; color: white;">Año de
                Lanzamiento</label>
            <input type="number" name="ano_lanzamiento" id="ano_lanzamiento"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ old('ano_lanzamiento', $pelicula->ano_lanzamiento) }}" required>
            @error('ano_lanzamiento')
                <div style="color: #e74c3c; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="director" style="display: block; margin-bottom: 5px; color: white;">Director</label>
            <input type="text" name="director" id="director"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ old('director', $pelicula->director) }}" required>
            @error('director')
                <div style="color: #e74c3c; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="puntuacion_media" style="display: block; margin-bottom: 5px; color: white;">Puntuación
                Media</label>
            <input type="number" step="0.1" name="puntuacion_media" id="puntuacion_media"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ old('puntuacion_media', $pelicula->puntuacion_media) }}" required>
            @error('puntuacion_media')
                <div style="color: #e74c3c; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="imagen" style="display: block; margin-bottom: 5px; color: white;">URL del Póster</label>
            <input type="text" name="imagen" id="imagen"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                value="{{ old('imagen', $pelicula->imagen) }}" placeholder="Introduce la URL de la imagen del póster">
        </div>

        <button type="submit" class='btn-style'>Actualizar
            Película</button>
    </form>
</div>
@endsection