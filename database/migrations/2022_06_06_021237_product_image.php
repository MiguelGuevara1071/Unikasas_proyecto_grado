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
        Schema::create('product_image', function (Blueprint $table) {

            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('image_id')->unsigned();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('image_id')->references('id')->on('image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
