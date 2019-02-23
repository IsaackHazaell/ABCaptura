<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',228);
            $table->integer('year');
            $table->decimal('cost');
            $table->string('unit',228);
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
        Schema::dropIfExists('unit_prices');
    }
}
