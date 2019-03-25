<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year')->nullable();
            $table->decimal('price',10,2);
            $table->integer('month')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('unity_id')->unsigned();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')
              ->onDelete('cascade')
              ->onUpdate('cascade');
              $table->foreign('unity_id')->references('id')->on('unities')
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
        Schema::dropIfExists('prices');
    }
}
