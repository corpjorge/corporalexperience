<?php

namespace App\Model\Actividad\Actividades;

use Illuminate\Database\Eloquent\Model;

class ActActividades extends Model
{
    public static function addActividad($actividadNom)
    {
      $actividades = ActActividades::where('nombre',$actividadNom)->first();
      if ($actividades) {
        $actividad = $actividades->id;
      }else{
        $dato = new ActActividades();
        $dato->nombre = $actividadNom;
        $dato->save();
        $actividad = $dato->id;
      }
      return $actividad;
    }
}
