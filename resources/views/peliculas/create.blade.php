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
    <h1 style="margin-bottom: 20px; color: white;">Crear Película</h1>
    <form action="{{ route('peliculas.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="titulo" style="display: block; margin-bottom: 5px; color: white;">Título</label>
            <input type="text" name="titulo" id="titulo"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="sinopsis" style="display: block; margin-bottom: 5px; color: white;">Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                rows="3" required></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="genero" style="display: block; margin-bottom: 5px; color: white;">Género</label>
            <input type="text" name="genero" id="genero"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="ano_lanzamiento" style="display: block; margin-bottom: 5px; color: white;">Año de
                Lanzamiento</label>
            <input type="number" name="ano_lanzamiento" id="ano_lanzamiento"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="director" style="display: block; margin-bottom: 5px; color: white;">Director</label>
            <input type="text" name="director" id="director"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="puntuacion_media" style="display: block; margin-bottom: 5px; color: white;">Puntuación
                Media</label>
            <input type="number" step="0.1" name="puntuacion_media" id="puntuacion_media"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="imagen" style="display: block; margin-bottom: 5px; color: white;">URL del Póster</label>
            <input type="text" name="imagen" id="imagen"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                placeholder="Introduce la URL de la imagen del póster">
        </div>

        <button type="submit" class='btn-style'>Guardar
            Película</button>
    </form>
</div>
@endsection