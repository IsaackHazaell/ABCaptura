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
            $table->string('month',128)->nullable();
            $table->integer('product_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->string('unity',128);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')
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
