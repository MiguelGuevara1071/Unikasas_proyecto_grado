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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('telefono_usuario')->nullable();
            $table->string('email');
            $table->unique('email');
            $table->string('password');
            $table->string('estado_usuario');
            $table->bigInteger('rol_id')->unsigned();

            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('rols');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
