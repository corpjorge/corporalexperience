<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActClientPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_client_personas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('identificacion')->unique();
            $table->string('nombre');
            $table->string('proceso')->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->integer('act_client_final_id')->unsigned();
            $table->foreign('act_client_final_id')->references('id')->on('act_client_finals');
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
        Schema::dropIfExists('act_client_personas');
    }
}
