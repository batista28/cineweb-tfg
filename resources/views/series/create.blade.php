@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: auto; color: white; padding-bottom: 80px;">
    <h1 style="margin-bottom: 20px; color: white;">Crear nueva serie</h1>

    <form action="{{ route('series.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="titulo" style="display: block; margin-bottom: 5px; color: white;">Título:</label>
            <input type="text" id="titulo" name="titulo"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="sinopsis" style="display: block; margin-bottom: 5px; color: white;">Sinopsis:</label>
            <textarea id="sinopsis" name="sinopsis"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required></textarea>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="genero" style="display: block; margin-bottom: 5px; color: white;">Género:</label>
            <input type="text" id="genero" name="genero"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="ano_lanzamiento" style="display: block; margin-bottom: 5px; color: white;">Año de
                lanzamiento:</label>
            <input type="number" id="ano_lanzamiento" name="ano_lanzamiento"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="temporadas" style="display: block; margin-bottom: 5px; color: white;">Temporadas:</label>
            <input type="number" id="temporadas" name="temporadas"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="estado_emision" style="display: block; margin-bottom: 5px; color: white;">Estado de
                emisión:</label>
            <input type="text" id="estado_emision" name="estado_emision"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="puntuacion_media" style="display: block; margin-bottom: 5px; color: white;">Puntuación
                media:</label>
            <input type="number" id="puntuacion_media" name="puntuacion_media" step="0.1"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="imagen" style="display: block; margin-bottom: 5px; color: white;">URL de la imagen:</label>
            <input type="text" id="imagen" name="imagen"
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da; background-color: #343a40; color: white;"
                required>
        </div>
        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Crear
            Serie</button>
    </form>
</div>
@endsection