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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('encargado_id')->unsigned();
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();

            $table->string('nombre_proyecto');
            $table->bigInteger('costo_estimado');
            $table->bigInteger('costo_final')->nullable();
            $table->string('ciudad_proyecto');
            $table->string('direccion_proyecto');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('suspension_proyecto')->nullable();
            $table->string('estado_proyecto')->default('En ejecución');

            $table->timestamps();

            $table->foreign('encargado_id')->references('id')->on('users');
            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
};
