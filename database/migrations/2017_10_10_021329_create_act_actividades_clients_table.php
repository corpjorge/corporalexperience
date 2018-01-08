<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActActividadesClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_actividades_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('act_client_sede_id')->unsigned();
            $table->foreign('act_client_sede_id')->references('id')->on('act_client_sedes');
            $table->integer('act_actividad_id')->unsigned();
            $table->foreign('act_actividad_id')->references('id')->on('act_actividades');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final');
            /*
            $table->string('nomina')->nullable();
            $table->string('nomina_pos')->nullable();
            $table->string('nomina_edades')->nullable();
            $table->string('nomina_cargos')->nullable();
            */
            $table->bigInteger('valor')->nullable();
            $table->integer('act_estado_id')->unsigned();
            $table->foreign('act_estado_id')->references('id')->on('act_estados');
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
        Schema::dropIfExists('act_actividades_clients');
    }
}
