<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementProviderMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement_provider_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('statement_material_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->timestamps();
            $table->foreign('statement_material_id')->references('id')->on('statement_materials')
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
        Schema::dropIfExists('statement_provider_materials');
    }
}
