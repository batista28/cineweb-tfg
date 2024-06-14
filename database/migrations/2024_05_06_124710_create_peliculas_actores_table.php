<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasActoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas_actores', function (Blueprint $table) {
            $table->id('ID_pelicula_actor');
            $table->unsignedBigInteger('ID_pelicula');
            $table->unsignedBigInteger('ID_actor');
            $table->foreign('ID_pelicula')->references('id')->on('peliculas');
            $table->foreign('ID_actor')->references('id')->on('actores');
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
        Schema::dropIfExists('peliculas_actores');
    }
}
