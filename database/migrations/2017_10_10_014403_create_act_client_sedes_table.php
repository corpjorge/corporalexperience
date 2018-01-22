<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActClientSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_client_sedes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('contacto');
            $table->string('contacto_cargo')->nullable();
            $table->string('correo')->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->string('direccion');
            $table->string('observacion');
            $table->string('lat');
            $table->string('lng');
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
        Schema::dropIfExists('act_client_sedes');
    }
}
