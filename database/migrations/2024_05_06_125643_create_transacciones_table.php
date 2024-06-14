<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id('ID_transacción');
            $table->string('Tipo_transacción', 100);
            $table->date('Fecha_transacción');
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_contenido');
            $table->string('Tipo_contenido', 5);
            $table->foreign('ID_usuario')->references('id')->on('users');
            // Aquí puedes agregar más claves foráneas si es necesario para referenciar otras tablas de contenido
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
        Schema::dropIfExists('transacciones');
    }
}
