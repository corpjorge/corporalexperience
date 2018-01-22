<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActClientIntermediariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_client_intermediarios', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('identificacion')->unique();
            $table->string('nombre');
            $table->string('correo')->nullable();
            $table->string('contacto', '950')->nullable();
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
        Schema::dropIfExists('act_client_intermediarios');
    }
}
