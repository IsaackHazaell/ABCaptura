<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaptureMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capture_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('capture_id')->unsigned();
            $table->integer('statement_material_id')->unsigned();
            $table->timestamps();
            $table->foreign('capture_id')->references('id')->on('captures')
              ->onDelete('cascade')
              ->onUpdate('cascade');
            $table->foreign('statement_material_id')->references('id')->on('statement_materials')
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
        Schema::dropIfExists('capture_materials');
    }
}
