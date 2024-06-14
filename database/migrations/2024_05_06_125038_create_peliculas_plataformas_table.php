<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasPlataformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas_plataformas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_pelicula');
            $table->unsignedBigInteger('ID_plataforma');
            $table->foreign('ID_pelicula')->references('id')->on('peliculas');
            $table->foreign('ID_plataforma')->references('id')->on('plataformas_streaming')->onDelete('cascade');
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
        Schema::dropIfExists('peliculas_plataformas');
    }
}
