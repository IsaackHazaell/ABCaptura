<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(1);
            $table->string('name',228);
            $table->integer('category');
            $table->string('turn',228);
            $table->bigInteger('cellphone');
            $table->bigInteger('phonlandline')->nullable();
            $table->string('mail',228)->nullable();
            $table->string('company',228)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
