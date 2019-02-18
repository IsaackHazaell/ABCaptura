<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street',128)->nullable();
            $table->string('colony',128)->nullable();
            $table->string('town',128)->nullable();
            $table->string('state',128)->nullable();
            $table->integer('provider_id')->unsigned();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('providers')
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
        Schema::dropIfExists('addresses');
    }
}
