<?php

namespace App\Model\Actividad\Actividades;

use Illuminate\Database\Eloquent\Model;

class ActActividadesAsistencia extends Model
{
  public function persona()
  {
    return $this->belongsTo('App\Model\Actividad\Client\ActClientPersona', 'act_client_persona_id');
  }

  public function actividad()
  {
    return $this->belongsTo('App\Model\Actividad\Actividades\ActActividadesClient', 'act_actividades_client_id');
  }


}
