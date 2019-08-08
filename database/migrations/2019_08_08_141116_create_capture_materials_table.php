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
          $table->date('date');
          $table->decimal('total',10,2);
          $table->integer('iva');
          $table->integer('honorarium');
          $table->string('voucher')->nullable();
          $table->string('folio',128)->nullable();
          $table->string('concept',128);
          $table->integer('fund_id')->unsigned();
          $table->integer('construction_id')->unsigned();
          $table->integer('statement_material_id')->unsigned();
          $table->timestamps();
          $table->foreign('fund_id')->references('id')->on('funds')
            ->onDelete('cascade')
            ->onUpdate('cascade');
          $table->foreign('construction_id')->references('id')->on('constructions')
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
