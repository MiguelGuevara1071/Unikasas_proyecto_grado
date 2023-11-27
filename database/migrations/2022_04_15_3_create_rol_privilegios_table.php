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
        Schema::create('rol_privilegios', function (Blueprint $table) {
            $table->bigInteger('rol_id')->unsigned();
            $table->bigInteger('privilegio_id')->unsigned();

            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('rols');
            $table->foreign('privilegio_id')->references('id')->on('privilegios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_privilegios');
    }
};
