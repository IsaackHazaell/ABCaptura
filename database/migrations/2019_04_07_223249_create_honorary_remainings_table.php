<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHonoraryRemainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honorary_remainings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('remaining',8,2);
            $table->integer('construction_id')->unsigned();
            $table->timestamps();
            $table->foreign('construction_id')->references('id')->on('constructions')
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
        Schema::dropIfExists('honorary_remainings');
    }
}
