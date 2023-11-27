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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_producto');
            $table->string('descripcion_producto');
            $table->string('precio_producto');
            $table->string('tipo_producto')->default('casa');
            $table->string('material_producto')->default('Plaqueta');
            $table->string('pisos_producto')->default('1 piso');
            $table->bigInteger('tamaño_producto')->default('50');
            $table->bigInteger('habitaciones_producto')->default('1');
            $table->string('estado_Producto')->default('Activo');

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
        Schema::dropIfExists('productos');
    }
};
