<?php

namespace App\Http\Controllers\Actividad\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Actividad\Actividades\ActActividadesClient;
use App\Model\Actividad\Actividades\ActActividades;
use App\Model\Actividad\Actividades\ActActividadesAsignaciones;
use App\Model\Actividad\Actividades\ActActividadesAdjunto;
use App\Model\Actividad\Client\ActClientFinal;
use App\Model\Actividad\Client\ActClientSede;
use App\Model\Actividad\Client\ActClientIntermediario;

use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\User;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $intermediarios = ActClientIntermediario::all();
      $profesores = User::where('rol_id',7)->get();
      $clientes = ActClientFinal::all();
      return view('actividad.informe.index',[ 'intermediarios' => $intermediarios, 'profesores' => $profesores, 'clientes' => $clientes]);
    }


    public function intermediarioExcel(Request $request)
    {
      $request->validate([
        'intermediario' => 'required|',
        'fecha' => 'required|',
      ]);

      list($incio, $final) = explode("-", $request->fecha);

      $incio = Carbon::parse($incio);
      $incio = $incio->format('Y-m-d');

      $final = Carbon::parse($final);
      $final = $final->format('Y-m-d');

      $clientes = ActClientFinal::where('act_client_Inter_id',$request->intermediario)->get();

      foreach ($clientes as $cliente) {
        $rows = ActClientFinal::find($cliente->id)->actividades()->where('act_estado_id',5)->get();
        foreach ($rows as $key) {

          $datetime1 = Carbon::parse($key->hora_inicio);
          $datetime2 = Carbon::parse($key->hora_final);
          $total =  $datetime1->diffInHours($datetime2, false);

                $result[] = $tabla = [
                  'EMPRESAS VISITADAS' => $key->sede->cliente->nombre,
                  'FECHAS' => $key->fecha,
                  'HORA DE INICIO' => $key->hora_inicio,
                  'HORA DE FINAL' => $key->hora_final,
                  'HORAS EJECUTADAS' => $total,
                  'COORDINADORA EPS' => $key->sede->contacto_cargo,

                ];
        }
      }

      if (empty($result)) {
          session()->flash('error', 'Resultado vacíos');
          return redirect()->back();
      }

      Excel::create(
          'Informe',
          function ($excel) use ($result) {
              $excel->sheet(
                  'Informe',
                  function ($sheet) use ($result) {
                      $sheet->fromArray($result);
                  }
              );
          }
      )->export('xls');

    }

    public function profesorExcel(Request $request)
    {
      $request->validate([
        'profesor' => 'required|',
        'fecha' => 'required|',
      ]);

      list($incio, $final) = explode("-", $request->fecha);

      $incio = Carbon::parse($incio);
      $incio = $incio->format('Y-m-d');

      $final = Carbon::parse($final);
      $final = $final->format('Y-m-d');

      $asignaciones = ActActividadesAsignaciones::where('user_id',$request->profesor)->where('act_estado_id',5)->get();

      foreach ($asignaciones as $key) {
          $datetime1 = Carbon::parse($key->hora_inicio);
          $datetime2 = Carbon::parse($key->hora_final);
          $total =  $datetime1->diffInHours($datetime2, false);

                $result[] = $tabla = [
                  'EMPRESAS VISITADAS' => $key->actividad->sede->cliente->nombre,
                  'ACTIVIDAD' => $key->actividad->actividad->nombre,
                  'FECHAS' => $key->fecha,
                  'HORA DE INICIO' => $key->hora_inicio,
                  'HORA DE FINAL' => $key->hora_final,
                  'HORAS EJECUTADAS' => $total,
                  'PARTICIPANTES' => $key->participantes,
                  'OBSERVACIÓN' => $key->observaciones,
                ];

      }

      if (empty($result)) {
          session()->flash('error', 'Resultado vacíos');
          return redirect()->back();
      }

      Excel::create(
          'Informe',
          function ($excel) use ($result) {
              $excel->sheet(
                  'Informe',
                  function ($sheet) use ($result) {
                      $sheet->fromArray($result);
                  }
              );
          }
      )->export('xls');

    }

    public function clientePdf(Request $request)
    {
      $request->validate([
        'cliente' => 'required|',
        'fecha' => 'required|',
      ]);

      list($incio, $final) = explode("-", $request->fecha);

      $incio = Carbon::parse($incio);
      $incio = $incio->format('Y-m-d');

      $final = Carbon::parse($final);
      $final = $final->format('Y-m-d');


      ini_set('max_execution_time', 300);

      $idCliente = $request->cliente;
      $rows = ActActividadesAsignaciones::all();
      // foreach ($rows as $key) {
      //   if ($idCliente == $key->actividad->sede->cliente->id) {
      //
      //     $imagenes = ActActividadesAdjunto::where('act_actividade_asignacion_id',$key->id)->get();
      //
      //     $keyDatos = $key;
      //
      //     $resultImg[] = $imagenes;
      //
      //   }
      // }
      //'imagenes' => $resultImg
      $view =  \View::make('actividad.actividades.asignacion.pdf-clientes',compact('idCliente'), ['rows' => $rows]);
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      //return $pdf->stream('simulador');
      return $pdf->download('informe.pdf');



    }

}
