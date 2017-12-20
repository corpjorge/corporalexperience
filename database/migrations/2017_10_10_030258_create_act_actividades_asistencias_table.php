<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActActividadesAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_actividades_asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('act_client_persona_id')->unsigned();
            $table->foreign('act_client_persona_id')->references('id')->on('act_client_personas');
            $table->integer('act_actividades_client_id')->unsigned();
            $table->foreign('act_actividades_client_id')->references('id')->on('act_actividades_clients');
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
        Schema::dropIfExists('act_actividades_asistencias');
    }
}
