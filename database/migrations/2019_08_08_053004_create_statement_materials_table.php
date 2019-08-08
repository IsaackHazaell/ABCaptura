<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->integer('construction_id')->unsigned();
            $table->integer('status');
            $table->decimal('total',12,2);
            $table->decimal('remaining',12,2);
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
        Schema::dropIfExists('statement_materials');
    }
}
