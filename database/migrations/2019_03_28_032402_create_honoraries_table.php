<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHonorariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honoraries', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('capture_id')->unsigned();
          $table->integer('provider_id')->unsigned();
          $table->decimal('total',10,2);
          $table->integer('status');
          $table->timestamps();
          $table->foreign('capture_id')->references('id')->on('captures')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('honoraries');
    }
}
