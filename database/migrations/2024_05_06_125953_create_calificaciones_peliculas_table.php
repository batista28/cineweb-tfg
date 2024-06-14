<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesPeliculasTable extends Migration
{
    public function up()
    {
        Schema::create('calificaciones_peliculas', function (Blueprint $table) {
            $table->id('ID_calificación_película');
            $table->float('Puntuación');
            $table->text('Comentario')->nullable();
            $table->unsignedBigInteger('ID_usuario');
            // Cambiar el nombre de la columna a 'id' para que coincida con la clave primaria en 'peliculas'
            $table->unsignedBigInteger('id');
            $table->foreign('ID_usuario')->references('id')->on('users');
            // Actualizar el nombre de la clave externa para que coincida con la columna 'id' en 'peliculas'
            $table->foreign('id')->references('id')->on('peliculas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calificaciones_peliculas');
    }
}
