<?php

namespace App\Http\Controllers\Actividad\Actividades;

use App\Model\Actividad\Actividades\ActActividadesClient;
use App\Model\Actividad\Actividades\ActActividades;
use App\Model\Actividad\Actividades\ActActividadesAsignaciones;
use App\Model\Actividad\Client\ActClientFinal;
use App\Model\Actividad\Client\ActClientSede;
use App\Model\Actividad\ActEstados;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AsignacionActividad;
use App\Mail\AsignacionActividadClient;
use App\Jobs\Actividad\ProcessActAsignacion;

use Carbon\Carbon;
use Auth;
use DB;
use Mail;

class ActividadClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rows = ActActividadesClient::orderBy('id', 'desc')->paginate(12);
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      return view('actividad.actividades.actividad-client.index', ['rows' => $rows,'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $row = ActClientSede::find($id);
      if (Auth::user()->rol_id == 10) {
        if ($row->cliente->intermediario->identificacion != Auth::user()->documento ) {
          return redirect('404');
        }
      }
      $rows = ActClientSede::find($id)->actividades()->paginate(12);
      $actividades = ActActividades::all();
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      return view('actividad.actividades.actividad-client.create', compact('row'), ['rows' => $rows, 'actividades' => $actividades, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function programarCreate()
    {
      $clientes = ActClientFinal::all();
      $rows = ActActividadesClient::orderBy('id', 'desc')->paginate(12);
      $actividades = ActActividades::all();
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      return view('actividad.actividades.programacion.create', ['clientes' => $clientes, 'rows' => $rows, 'actividades' => $actividades, 'users' => $users]);
    }

    public function programarStorage(Request $request)
    {
      $request->validate([
        'clientes' => 'required|',
        'sedes' => 'required|',
        'actividad' => 'required|',
        'fecha' => 'required|',
        'hora_inicio' => 'required|',
        'hora_final' => 'required|',
        'valor' => 'required|numeric|min:1|'
      ]);

      $id = $request->sedes;

      $fecha = Carbon::parse($request->fecha);
      $fecha = $fecha->format('Y-m-d');

      $hora_inicio = Carbon::parse($request->hora_inicio);
      $hora_inicio = $hora_inicio->format('H:i:s');

      $hora_final = Carbon::parse($request->hora_final);
      $hora_final = $hora_final->format('H:i:s');

      if ($request->profesor) {
        $actDoble = DB::select('SELECT * FROM act_actividades_clients
                                         WHERE fecha = :fecha
                                           AND (
                                                 :horaInicial between hora_inicio and hora_final
                                                  OR
                                                 :horaFinal between hora_inicio and hora_final
                                               )',
        ['fecha' => $fecha, 'horaInicial' => $hora_inicio, 'horaFinal' => $hora_final]);

        if ($actDoble) {
          foreach ($actDoble as $actDoblekey) {
            foreach ($request->profesor as $ocupado) {
              $profeOcupado = ActActividadesAsignaciones::where('act_actividades_client_id',$actDoblekey->id)->where('user_id',$ocupado)->first();
              if ($profeOcupado) {
                session()->flash('error', 'El profesor '.$profeOcupado->usuario->name.' ya tiene una actividad en ese horario');
                return redirect('programar');
              }
            }
          }
         }
        }

      $actividad = ActActividades::addActividad($request->actividad);

      $dato = new ActActividadesClient();
      $dato->act_client_sede_id = $id;
      $dato->act_actividad_id = $actividad;
      $dato->fecha = $fecha;
      $dato->hora_inicio = $hora_inicio;
      $dato->hora_final = $hora_final;
      $dato->valor = $request->valor;
      if ($request->profesor) {
        $dato->act_estado_id = 2;
        $estado = 2;
      }
      else {
        $dato->act_estado_id = 1;
      }
      if ($request->asignar) {
        $request->validate(['profesor' => 'required|']);
        $dato->act_estado_id = 3;
        $estado = 3;
      }
       $dato->save();

      if ($request->asignar) {

        foreach ($request->profesor as $profesorCorreo) {
          $correo = User::where('id',$profesorCorreo)->first();
          Mail::send(new AsignacionActividad($correo->email,$dato));
        }

        $correoClient = ActClientSede::where('id',$id)->first();
        if (!$correoClient->cliente->correo == '') {
          Mail::send(new AsignacionActividadClient($correoClient->cliente->correo, $dato));
        }

      }

      if ($request->profesor) {
        ActActividadesAsignaciones::asignar($request->profesor,$dato->id,$estado);
      }

      session()->flash('message', 'Guardado correctamente');
      return redirect('programar');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientes($id)
    {
        $datos = ActClientSede::where('act_client_final_id',$id)->get();

        $idSedes = array();
        $idDirecciones = array();

        foreach ($datos as $sede) {
           array_push ( $idSedes , $sede->id );
           array_push ( $idDirecciones , $sede->direccion );
        }

        return response()->json([
             'idSedes' => $idSedes,
             'direccion' => $idDirecciones
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function programarShow($id)
    {
      if ($id == 0) {
        $rows = ActActividadesClient::orderBy('fecha', 'desc')->paginate(30);   
      }
      else{
        $rows = ActActividadesClient::where('act_estado_id',$id)->orderBy('fecha', 'desc')->paginate(12);
        $estado = ActEstados::find($id);
      }
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      return view('actividad.actividades.programacion.show', compact('estado'),[ 'rows' => $rows, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $request->validate([
        'actividad' => 'required|',
        'fecha' => 'required|',
        'hora_inicio' => 'required|',
        'hora_final' => 'required|',
        // 'nomina' => 'required|',
        // 'pos' => 'required|',
        // 'edades' => 'required|',
        // 'cargos' => 'required|',
        //'valor' => 'required|numeric|min:1|'
      ]);

      $fecha = Carbon::parse($request->fecha);
      $fecha = $fecha->format('Y-m-d');

      $hora_inicio = Carbon::parse($request->hora_inicio);
      $hora_inicio = $hora_inicio->format('H:i:s');

      $hora_final = Carbon::parse($request->hora_final);
      $hora_final = $hora_final->format('H:i:s');
      ////////
      // $fecha = '2018-01-31';
      // $hora_inicio = '17:00:00';
      // $hora_final = '21:00:00';
      ///////

        /*
        SELECT * FROM `act_actividades_clients` WHERE `fecha` = "2018-01-31"
                                                   AND ("19:00:00" between `hora_inicio` and `hora_final`
                                                   OR "21:00:00" between `hora_inicio` and `hora_final`);
        */
      if ($request->profesor) {
        $actDoble = DB::select('SELECT * FROM act_actividades_clients
                                         WHERE fecha = :fecha
                                           AND (
                                                 :horaInicial between hora_inicio and hora_final
                                                  OR
                                                 :horaFinal between hora_inicio and hora_final
                                               )',
        ['fecha' => $fecha, 'horaInicial' => $hora_inicio, 'horaFinal' => $hora_final]);

        if ($actDoble) {
          foreach ($actDoble as $actDoblekey) {
            foreach ($request->profesor as $ocupado) {
              $profeOcupado = ActActividadesAsignaciones::where('act_actividades_client_id',$actDoblekey->id)->where('user_id',$ocupado)->first();
              if ($profeOcupado) {
                session()->flash('error', 'El profesor '.$profeOcupado->usuario->name.' ya tiene una actividad en ese horario');
                return redirect('actividades-client/create/'.$id);
              }
            }
          }
          }
        }


      $actividad = ActActividades::addActividad($request->actividad);

      $dato = new ActActividadesClient();
      $dato->act_client_sede_id = $id;
      $dato->act_actividad_id = $actividad;
      $dato->fecha = $fecha;
      $dato->hora_inicio = $hora_inicio;
      $dato->hora_final = $hora_final;
      // $dato->nomina = $request->nomina;
      // $dato->nomina_pos = $request->pos;
      // $dato->nomina_edades = $request->edades;
      // $dato->nomina_cargos = $request->cargos;
      $dato->valor = $request->valor;
      if ($request->profesor) {
        $dato->act_estado_id = 2;
        $estado = 2;
      }
      else {
        $dato->act_estado_id = 1;
      }
      if ($request->asignar) {
        $request->validate(['profesor' => 'required|']);
        $dato->act_estado_id = 3;
        $estado = 3;
      }
      $dato->save();

      if ($request->asignar) {

        foreach ($request->profesor as $profesorCorreo) {
          $correo = User::where('id',$profesorCorreo)->first();
          Mail::send(new AsignacionActividad($correo->email,$dato));
        }

        $correoClient = ActClientSede::where('id',$id)->first();
        if (!$correoClient->cliente->correo == '') {
          Mail::send(new AsignacionActividadClient($correoClient->cliente->correo, $dato));
        }

      }

      if ($request->profesor) {
        ActActividadesAsignaciones::asignar($request->profesor,$dato->id,$estado);
      }

      session()->flash('message', 'Guardado correctamente');
      return redirect('actividades-client/create/'.$id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividadesClient  $actActividadesClient
     * @return \Illuminate\Http\Response
     */
    public function show($actActividadesClient)
    {
      $row = ActActividadesClient::find($actActividadesClient);
      if (Auth::user()->rol_id == 10) {
        if ($row->sede->cliente->intermediario->identificacion != Auth::user()->documento ) {
          return redirect('404');
        }
      }
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      $asignaciones = ActActividadesAsignaciones::where('act_actividades_client_id',$actActividadesClient)->get();
      return view('actividad.actividades.actividad-client.show', compact('row'), [ 'users' => $users, 'asignaciones' => $asignaciones]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividadesClient  $actActividadesClient
     * @return \Illuminate\Http\Response
     */
    public function edit($actActividadesClient)
    {

      $row = ActActividadesClient::find($actActividadesClient);
      $actividades = ActActividades::all();
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      return view('actividad.actividades.actividad-client.edit', compact('row'), ['actividades' => $actividades, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Actividades\ActActividadesClient  $actActividadesClient
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $actActividadesClient)
    {

      $request->validate([
        'actividad' => 'required|',
        'fecha' => 'required|',
        'hora_inicio' => 'required|',
        'hora_final' => 'required|',
        'nomina' => 'required|',
        'pos' => 'required|',
        'edades' => 'required|',
        'cargos' => 'required|',
        'valor' => 'required|numeric|min:1|'
      ]);

      $fecha = Carbon::parse($request->fecha);
      $fecha->format('Y-m-d');

      $hora_inicio = Carbon::parse($request->hora_inicio);
      $hora_inicio->format('H:i:s');

      $hora_final = Carbon::parse($request->hora_final);
      $hora_final->format('H:i:s');

      $actividad = ActActividades::addActividad($request->actividad);

      $dato = ActActividadesClient::find($actActividadesClient);
      $dato->act_actividad_id = $actividad;
      $dato->fecha = $fecha;
      $dato->hora_inicio = $hora_inicio;
      $dato->hora_final = $hora_final;
      $dato->nomina = $request->nomina;
      $dato->nomina_pos = $request->pos;
      $dato->nomina_edades = $request->edades;
      $dato->nomina_cargos = $request->cargos;
      $dato->valor = $request->valor;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('actividades-client/'.$actActividadesClient.'/edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Actividades\ActActividadesClient  $actActividadesClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $actActividadesClient)
    {

      $datos = ActActividadesClient::find($actActividadesClient);
      if ($request->asignar) {
        $request->validate([
          'profesor' => 'required|',
        ]);

        $actDoble = DB::select('SELECT * FROM act_actividades_clients
                                         WHERE fecha = :fecha
                                           AND (
                                                 :horaInicial between hora_inicio and hora_final
                                                  OR
                                                 :horaFinal between hora_inicio and hora_final
                                               )',
        ['fecha' => $datos->fecha, 'horaInicial' => $datos->hora_inicio, 'horaFinal' => $datos->hora_final]);

        if ($actDoble) {
          foreach ($actDoble as $actDoblekey) {
            foreach ($request->profesor as $ocupado) {
              $profeOcupado = ActActividadesAsignaciones::where('act_actividades_client_id',$actDoblekey->id)->where('user_id',$ocupado)->first();
              if ($profeOcupado) {
                session()->flash('error', 'El profesor '.$profeOcupado->usuario->name.' ya tiene una actividad en ese horario');
                return redirect('actividades-client/create/'.$datos->sede->id);
              }
             }
           }
          }


        $datos->act_estado_id = 2;
        ActActividadesAsignaciones::asignar($request->profesor,$actActividadesClient,2);
      }
      if ($request->confirmar) {
        $datos->act_estado_id = 3;
        $asignaciones = ActActividadesAsignaciones::where('act_actividades_client_id',$actActividadesClient)->get();
        foreach ($asignaciones as $asignacion) {
          $asignacion->act_estado_id = 3;
          $asignacion->save();
          Mail::send(new AsignacionActividad($asignacion->usuario->email, $asignacion->actividad));
        }
        $correoClient = ActClientSede::where('id',$asignacion->actividad->sede->cliente->id)->first();
        if (!$correoClient->cliente->correo == '') {
          Mail::send(new AsignacionActividadClient($correoClient->cliente->correo, $asignacion->actividad));
        }

      }
      $datos->save();

      session()->flash('message', 'Guardado correctamente');
      // return redirect('actividades-client/create/'.$datos->act_client_sede_id);
      return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividadesClient  $actActividadesClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActActividadesClient $actActividadesClient)
    {
        //
    }
}
