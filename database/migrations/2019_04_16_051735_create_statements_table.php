<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construction_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->integer('status');
            $table->decimal('total');
            $table->decimal('remaining');
            $table->timestamps();
            $table->foreign('construction_id')->references('id')->on('constructions')
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
        Schema::dropIfExists('statements');
    }
}
