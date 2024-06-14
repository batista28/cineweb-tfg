<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesPlataformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_plataformas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_serie');
            $table->unsignedBigInteger('ID_plataforma');
            $table->foreign('ID_serie')->references('id')->on('series');
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
        Schema::dropIfExists('series_plataformas');
    }
}
