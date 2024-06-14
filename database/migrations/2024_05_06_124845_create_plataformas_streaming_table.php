<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlataformasStreamingTable extends Migration
{
    public function up()
    {
        Schema::create('plataformas_streaming', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_plataforma')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plataformas_streaming');
    }
}
