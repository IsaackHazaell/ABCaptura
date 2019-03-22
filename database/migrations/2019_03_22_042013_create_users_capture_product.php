<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCaptureProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capture_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('capture_id')->unsigned();
            $table->integer('price_id')->unsigned();
            $table->timestamps();
            $table->foreign('capture_id')->references('id')->on('captures')
              ->onDelete('cascade')
              ->onUpdate('cascade');
            $table->foreign('price_id')->references('id')->on('prices')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capture_product');
    }
}
