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
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('producto_id')->unsigned();

            $table->string('nombres_cotizante');
            $table->string('apellidos_cotizante');
            $table->string('email_cotizante');
            $table->string('telefono_cotizante');
            $table->string('ciudad_cotizante');
            $table->string('ubicacion_cotizante');
            $table->date('fecha_cotizacion');
            $table->string('comentarios_cotizacion')->nullable();
            $table->string('estado_cotizacion');

            $table->timestamps();

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
        Schema::dropIfExists('cotizacions');
    }
};
