<?php

namespace App\Model\Actividad\Client;

use Illuminate\Database\Eloquent\Model;

class ActClientSede extends Model
{
  public function cliente()
  {
    return $this->belongsTo('App\Model\Actividad\Client\ActClientFinal', 'act_client_final_id');
  }

  public function actividades()
  {
      return $this->hasMany('App\Model\Actividad\Actividades\ActActividadesClient')->orderBy('id', 'desc');
  }

  public function asignaciones()
  {
    return $this->hasManyThrough(
          'App\Model\Actividad\Actividades\ActActividadesAsignaciones',
          'App\Model\Actividad\Actividades\ActActividadesClient'
          // 'act_client_final_id', // Foreign key on users table...
          // 'act_client_sede_id', // Foreign key on posts table...
          // 'id', // Local key on countries table...
          // 'id' // Local key on users table...);
    );
  }

}
