<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id('id');
            $table->string('titulo', 255);
            $table->text('sinopsis')->nullable();
            $table->string('genero', 100)->nullable();
            $table->integer('ano_lanzamiento')->nullable();
            $table->string('director', 255)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->float('puntuacion_media')->nullable();
            $table->integer('cantidad_votos')->nullable();
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
        Schema::dropIfExists('peliculas');
    }
}
