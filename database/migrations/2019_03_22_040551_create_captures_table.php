<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date');
            $table->decimal('total',10,2);
            $table->string('description',128)->nullable();
            $table->integer('iva');
            $table->integer('honorarium');
            $table->integer('category');
            $table->integer('voucher');
            $table->integer('fund_id')->unsigned();
            $table->integer('construction_id')->unsigned();
            $table->timestamps();
            $table->foreign('fund_id')->references('id')->on('funds')
              ->onDelete('cascade')
              ->onUpdate('cascade');
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
        Schema::dropIfExists('captures');
    }
}
