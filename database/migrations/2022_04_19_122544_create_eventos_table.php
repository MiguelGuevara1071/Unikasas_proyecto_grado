<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_evento');
            $table->date('fecha_evento');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->bigInteger('proyecto_id')->unsigned();
            $table->string('notificacion_evento');
            $table->string('invitados_evento');
            $table->string('lugar_evento');
            $table->string('asunto_evento');
            $table->string('mensaje_evento')->nullable();
            $table->string('estado_evento');

            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
};
