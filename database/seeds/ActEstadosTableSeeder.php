<?php

use Illuminate\Database\Seeder;
use App\Model\Actividad\ActEstados;

class ActEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dato = new ActEstados();
      $dato->descripcion="Sin asignar";
      $dato->estilo="default";
      $dato->save();

      $dato = new ActEstados();
      $dato->descripcion="Sin Confirmar";
      $dato->estilo="info";
      $dato->save();

      $dato = new ActEstados();
      $dato->descripcion="Pendiente";
      $dato->estilo="warning";
      $dato->save();

      $dato = new ActEstados();
      $dato->descripcion="Atrasado";
      $dato->estilo="danger";
      $dato->save();

      $dato = new ActEstados();
      $dato->descripcion="Realizado";
      $dato->estilo="success";
      $dato->save();

      $dato = new ActEstados();
      $dato->descripcion="Cancelado";
      $dato->estilo="primary";
      $dato->save();
    }
}
