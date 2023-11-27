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
        Schema::create('actividad_etapas', function (Blueprint $table) {
            $table->bigInteger('etapa_id')->unsigned();
            $table->bigInteger('actividad_id')->unsigned();

            $table->timestamps();

            $table->foreign('etapa_id')->references('id')->on('etapas');
            $table->foreign('actividad_id')->references('id')->on('actividads');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_etapas');
    }
};
