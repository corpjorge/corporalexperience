<?php

namespace App\Http\Controllers\Actividad\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Actividad\Actividades\ActActividadesAsistencia;
use App\Model\Actividad\Actividades\ActActividadesAsignaciones;
use App\Model\Actividad\Actividades\ActActividadesClient;
use App\Model\Actividad\Client\ActClientPersona;

use Maatwebsite\Excel\Facades\Excel;
use Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //asignacion
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $actividad = ActActividadesAsignaciones::find($id);
      $rows = ActActividadesAsistencia::where('act_actividades_client_id',$id)->get();
      $personas = ActClientPersona::where('act_client_final_id',$actividad->actividad->sede->act_client_final_id)->get();
      return view('actividad.actividades.asistencia.create', compact('actividad'), ['rows' => $rows, 'personas' => $personas]);

    }

    public function ingreso(Request $request, $id)
    {
      $request->validate([
        'identificacion' => 'required|',
      ]);

      $persona = ActClientPersona::where('identificacion',$request->identificacion)->first();

      if ($persona == NULL) {
        session()->flash('error', 'Cedula no existe');
        return redirect('asistencia/'.$id);
      }
      else{
        $asistencia = ActActividadesAsistencia::where('act_client_persona_id',$persona->id)->where('act_actividades_client_id',$id)->first();
        if ($asistencia) {
          session()->flash('error', 'No se puede ingresar dos veces');
          return redirect('asistencia/'.$id);
        }
        else{
          $dato = new ActActividadesAsistencia();
          $dato->act_client_persona_id = $persona->id;
          $dato->act_actividades_client_id = $id;
          $dato->save();

          session()->flash('message', 'Guardado correctamente');
          return redirect('asistencia/'.$id);
        }
      }

    }

    public function ingresoActualizar(Request $request, $id)
    {
      $request->validate([
       'asistencia' => 'required|',
      ]);

      foreach ($request->asistencia as $key  ) {
        $dato =  ActActividadesAsistencia::find($key);
        $dato->delete();
      }
      session()->flash('message', 'Guardado correctamente');
      return redirect('asistencia/'.$dato->act_actividades_client_id);


    }

    public function descargar($id)
    {
      $asistencias = ActActividadesAsistencia::where('act_actividades_client_id',$id)->get();

      foreach ($asistencias as $asistencia) {
            $result[] = $tabla = [
              'identificacion' => $asistencia->persona->identificacion,
              'nombre' => $asistencia->persona->nombre,
              'proceso' => $asistencia->persona->proceso,
              'telefono' => $asistencia->persona->telefono,
              'correo' => $asistencia->persona->correo,
            ];
        }

        if (empty($result)) {
            session()->flash('error', 'Resultado vacíos');
            return redirect()->back();
        }

        Excel::create(
            'Asistencia',
            function ($excel) use ($result) {
                $excel->sheet(
                    'Asistencia',
                    function ($sheet) use ($result) {
                        $sheet->fromArray($result);
                    }
                );
            }
        )->export('xls');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // $request->validate([
      //   'asistencia' => 'required|',
      // ]);
      //
      // $dato =  ActActividadesAsistencia::find($id);
      // $dato->delete();
      // session()->flash('message', 'Guardado correctamente');
      // return redirect('asistencia/'.$dato->act_actividades_client_id);

    }
}
