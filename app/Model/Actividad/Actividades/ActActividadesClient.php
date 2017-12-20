<?php

namespace App\Model\Actividad\Actividades;

use Illuminate\Database\Eloquent\Model;
use App\Model\Actividad\Actividades\ActActividadesAsignaciones;

use Carbon\Carbon;

class ActActividadesClient extends Model
{
  public function estado()
  {
    return $this->belongsTo('App\Model\Actividad\ActEstados', 'act_estado_id');
  }
  public function sede()
  {
    return $this->belongsTo('App\Model\Actividad\Client\ActClientSede', 'act_client_sede_id');
  }
  public function actividad()
  {
    return $this->belongsTo('App\Model\Actividad\Actividades\ActActividades', 'act_actividad_id');
  }

  public function asignaciones()
  {
      return $this->hasMany('App\Model\Actividad\Actividades\ActActividadesAsignaciones')->orderBy('id', 'desc');
  }

  public static function atrasados()
  {
    $hoy = $carbon = Carbon::now();
    $hoy = $hoy->format('Y-m-d');
    $atrasadas = ActActividadesClient::atrasadas($hoy);
    foreach ($atrasadas as $atrasada) {
       ActActividadesClient::Actualizaratrasados($atrasada);
    }

  }

  public static function atrasadas($hoy)
  {
    $atrasadas = ActActividadesClient::where('fecha','<',$hoy)->where('act_estado_id','=',3)->orderBy('id', 'desc')->get();
    return $atrasadas;
  }

  public static function Actualizaratrasados($atrasado)
  {
       $dato = ActActividadesClient::find($atrasado->id);
       $dato->act_estado_id  = 4;
       $dato->save();

       $datoDos = ActActividadesAsignaciones::where('act_actividades_client_id',$atrasado->id)->get();
       foreach ($datoDos as $key) {
         $key->act_estado_id = 4;
         $key->save();
       }
  }

}
