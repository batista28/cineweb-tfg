<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones_series', function (Blueprint $table) {
            $table->id('ID_calificación_serie');
            $table->float('Puntuación');
            $table->text('Comentario')->nullable();
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_serie');
            $table->foreign('ID_usuario')->references('id')->on('users');
            $table->foreign('ID_serie')->references('id')->on('series');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones_series');
    }
}
