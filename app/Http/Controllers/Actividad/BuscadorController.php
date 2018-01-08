<?php

namespace App\Http\Controllers\Actividad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Actividad\Client\ActClientFinal;

class BuscadorController extends Controller
{

    public function nit(Request $request)
    {
      $rows = ActClientFinal::where('identificacion','LIKE', '%'.$request->dato.'%')->paginate(30);
      $limpiar = 1;
      return view('actividad.client.final.index',compact('limpiar'),['rows' => $rows]);
    }


}
