<?php

namespace App\Model\Actividad\Client;

use Illuminate\Database\Eloquent\Model;

class ActClientFinal extends Model
{

    public function intermediario()
    {
      return $this->belongsTo('App\Model\Actividad\Client\ActClientIntermediario', 'act_client_Inter_id');
    }
    public function sedes()
    {
        return $this->hasMany('App\Model\Actividad\Client\ActClientSede')->orderBy('id', 'desc');
    }

    public function actividades()
    {
      return $this->hasManyThrough(
            'App\Model\Actividad\Actividades\ActActividadesClient',
            'App\Model\Actividad\Client\ActClientSede'
            // 'act_client_final_id', // Foreign key on users table...
            // 'act_client_sede_id', // Foreign key on posts table...
            // 'id', // Local key on countries table...
            // 'id' // Local key on users table...);
      );
    }
 

}
