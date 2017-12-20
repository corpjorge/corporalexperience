<?php

namespace App\Model\Actividad\Client;

use Illuminate\Database\Eloquent\Model;

class ActClientPersona extends Model
{
  public function cliente()
  {
    return $this->belongsTo('App\Model\Actividad\Client\ActClientFinal', 'act_client_final_id');
  }
}
