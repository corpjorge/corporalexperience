<?php

namespace App\Model\Actividad\Client;

use Illuminate\Database\Eloquent\Model;

class ActClientIntermediario extends Model
{


     public static function validacion($request)
     {
        $request->validate([
          'nombre' => 'required',
          'opc_intermediario' => 'required',
        ]);
     }

     public function clientes()
     {
         return $this->hasMany('App\Model\Actividad\Client\ActClientFinal','act_client_Inter_id')->orderBy('id', 'desc');
     }

     public static function storeInter($request, $dato)
     {
       $dato->identificacion=$request->identificacion;
       $dato->nombre=$request->nombre;
       $dato->correo=$request->correo;
       $dato->contacto=$request->contacto;
     }
}
