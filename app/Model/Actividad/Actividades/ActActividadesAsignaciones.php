<?php

namespace App\Model\Actividad\Actividades;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class ActActividadesAsignaciones extends Model
{
  public function usuario()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function actividad()
  {
    return $this->belongsTo('App\Model\Actividad\Actividades\ActActividadesClient', 'act_actividades_client_id');
  }
  public function estado()
  {
    return $this->belongsTo('App\Model\Actividad\ActEstados', 'act_estado_id');
  }
  public static function asignar($userID, $actividadID, $estado)
  {
    foreach ($userID as $key ) {
      $dato = new ActActividadesAsignaciones();
      $dato->user_id = $key;
      $dato->act_actividades_client_id = $actividadID;
      $dato->act_estado_id = $estado;
      $dato->save();
    }

  }

  public static function actHoy($idUser)
  {
    $hoy = $carbon = Carbon::now();
    $hoy = $hoy->format('Y-m-d');
    $Acthoy = ActActividadesAsignaciones::where('fecha',$hoy)->where('user_id',$idUser);
    return $Acthoy;
  }

  public static function realizadas($idUser)
  {
    $hoy = $carbon = Carbon::now();
    $hoy = $hoy->format('Y-m-d');
    $realizadas = ActActividadesAsignaciones::where('fecha',$hoy)->where('act_estado_id',5)->where('user_id',$idUser)->count();
    return $realizadas;
  }

  public static function actHoyClient()
  {
    $hoy = $carbon = Carbon::now();
    $hoy = $hoy->format('Y-m-d');
    $Acthoy = ActActividadesAsignaciones::where('fecha',$hoy);
    return $Acthoy;
  }



}
