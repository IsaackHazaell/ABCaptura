<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construction_id')->unsigned();
            $table->date('date');
            $table->decimal('remaining',12,2);
            $table->decimal('total',12,2);
            $table->string('pay',128)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('funds');
    }
}
