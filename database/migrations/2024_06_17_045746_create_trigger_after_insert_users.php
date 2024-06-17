<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerAfterInsertUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER crear_listas_despues_insert
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                DECLARE usuario_id INT;

                -- Obtener el ID del usuario insertado
                SET usuario_id = NEW.id;

                -- Insertar las listas para el nuevo usuario
                INSERT INTO listas (ID_usuario, nombre_lista, created_at, updated_at)
                VALUES (usuario_id, "peliculas_pendientes", NOW(), NOW());

                INSERT INTO listas (ID_usuario, nombre_lista, created_at, updated_at)
                VALUES (usuario_id, "peliculas_vistas", NOW(), NOW());

                INSERT INTO listas (ID_usuario, nombre_lista, created_at, updated_at)
                VALUES (usuario_id, "series_pendientes", NOW(), NOW());

                INSERT INTO listas (ID_usuario, nombre_lista, created_at, updated_at)
                VALUES (usuario_id, "series_vistas", NOW(), NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS crear_listas_despues_insert');
    }
}
