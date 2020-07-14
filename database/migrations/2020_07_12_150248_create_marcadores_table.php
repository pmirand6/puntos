<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcadores', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_marcador');
            $table->string('descripcion_marcador');
            $table->float('latitud_marcador', 10, 6);
            $table->float('longitud_marcador', 10, 6);
            $table->unique(['latitud_marcador', 'longitud_marcador'], 'ubicacion_unique');
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
        Schema::dropIfExists('marcadores');
    }
}
