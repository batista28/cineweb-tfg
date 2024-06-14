<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_lista');
            $table->unsignedBigInteger('pelicula_id')->nullable();
            $table->unsignedBigInteger('serie_id')->nullable();
            $table->enum('estado', ['vista', 'pendiente']);
            $table->timestamps();

            $table->foreign('ID_lista')->references('ID_lista')->on('listas')->onDelete('cascade');
            $table->foreign('pelicula_id')->references('id')->on('peliculas')->onDelete('cascade');
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_items');
    }
}
