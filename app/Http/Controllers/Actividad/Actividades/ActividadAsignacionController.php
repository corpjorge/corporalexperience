<?php

namespace App\Http\Controllers\Actividad\Actividades;

use App\Model\Actividad\Actividades\ActActividadesAsignaciones;
use App\Model\Actividad\Actividades\ActActividadesAdjunto;
use App\Model\Actividad\Client\ActClientFinal;
use App\Model\Actividad\Actividades\ActActividadesClient;
use App\Model\Actividad\Client\ActClientSede;
use App\Model\Actividad\ActEstados;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\User;
use Carbon\Carbon;
use Auth;

class ActividadAsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rol_id == 1 OR Auth::user()->rol_id == 2) {
          $sinAsignar = ActActividadesClient::where('act_estado_id', 1)->count();
          $sinConfirmar = ActActividadesClient::where('act_estado_id', 2)->count();
          $pendiente = ActActividadesClient::where('act_estado_id', 3)->count();
          $atrasado = ActActividadesClient::where('act_estado_id', 4)->count();
          return view('actividad.actividades.programacion.index', compact('sinAsignar', 'sinConfirmar', 'pendiente','atrasado'));

        }
        if (Auth::user()->rol_id == 7) {
          // $actHoy = ActActividadesAsignaciones::actHoy(Auth::user()->id)->paginate(15);
          $atrasados = ActActividadesAsignaciones::where('act_estado_id',4)->where('user_id',Auth::user()->id)->paginate(15);
          $rows = ActActividadesAsignaciones::where('user_id',Auth::user()->id)->where('act_estado_id','!=',1)->where('act_estado_id','!=',2)->where('act_estado_id','!=',6)->orderBy('id', 'desc')->paginate(30);
          return view('actividad.actividades.asignacion.index', ['rows' => $rows, 'atrasados' => $atrasados]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendarioIndex()
    {
        if (Auth::user()->rol_id == 1 OR Auth::user()->rol_id == 2) {
          $rows = ActActividadesClient::all();
        }
        if (Auth::user()->rol_id == 7) {
          $rows = ActActividadesAsignaciones::where('user_id',Auth::user()->id)->where('act_estado_id',3)->orWhere('act_estado_id',4)->orWhere('act_estado_id',5)->get();
        }
        return view('actividad.actividades.calendario.index', ['rows' => $rows]);
    }


    public function confirmar($id)
    {
      $dato = ActActividadesAsignaciones::find($id);
      $dato->confirmacion = 1;
      $dato->save();
      session()->flash('message', 'Actividad confirmada');
      return redirect()->back();

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividadesAsignaciones  $actActividadesAsignaciones
     * @return \Illuminate\Http\Response
     */
    public function show($actActividadesAsignaciones)
    {
      $row = ActActividadesAsignaciones::find($actActividadesAsignaciones);
      if (Auth::user()->rol_id == 10) {
        if ($row->actividad->sede->cliente->intermediario->identificacion != Auth::user()->documento ) {
           return redirect('404');
        }
      }
      if (Auth::user()->rol_id == 7) {
        if ($row->user_id != Auth::user()->id ) {
           return redirect('404');
        }
      }
      $imagenes = ActActividadesAdjunto::where('act_actividade_asignacion_id',$actActividadesAsignaciones)->get();
      return view('actividad.actividades.asignacion.show', ['row' => $row, 'imagenes' => $imagenes]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividadesAsignaciones  $actActividadesAsignaciones
     * @return \Illuminate\Http\Response
     */
    public function edit($actActividadesAsignaciones)
    {
      $row = ActActividadesAsignaciones::find($actActividadesAsignaciones);
      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      $estados = ActEstados::all();
      return view('actividad.actividades.asignacion.edit', ['row' => $row, 'users' => $users, 'estados' => $estados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Actividades\ActActividadesAsignaciones  $actActividadesAsignaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $actActividadesAsignaciones)
    {
      $request->validate([
        'usuario' => 'required|',
        'estado' => 'required|',
      ]);

      $dato = ActActividadesAsignaciones::find($actActividadesAsignaciones);
      $dato->user_id = $request->usuario;
      $dato->act_estado_id = $request->estado;
      $dato->fecha = $request->fecha;
      $dato->hora_inicio = $request->hora_inicio;
      $dato->hora_final = $request->hora_final;
      $dato->observaciones = $request->observaciones;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('asignacion/'.$actActividadesAsignaciones.'/edit');

    }

    public function finalizar($id)
    {
      $row = ActActividadesAsignaciones::find($id);
      if (Auth::user()->rol_id == 10) {
        if ($row->actividad->sede->cliente->intermediario->identificacion != Auth::user()->documento ) {
           return redirect('404');
        }
      }
      if (Auth::user()->rol_id == 7) {
        if ($row->user_id != Auth::user()->id ) {
           return redirect('404');
        }
      }
      if ($row->act_estado_id == 5) {
           return redirect('404');
      }
      return view('actividad.actividades.asignacion.finalizar', ['row' => $row]);
    }

    public function finalizarCheck(Request $request, $id)
    {
      ini_set('max_execution_time', 5000);

      $request->validate([
        'fecha' => 'required|',
        'hora_inicio' => 'required|',
        'hora_final' => 'required|',
        'participantes' => 'required|',
        'observaciones' => 'required|',
        'fotos' => 'required|',
      ]);
      if (count($request->fotos) > 5) {
        session()->flash('error', 'Máximo 5 fotos');
        return redirect('finalizar/'.$id);
      }

      $fecha = Carbon::parse($request->fecha);
      $fecha->format('Y-m-d');

      $hora_inicio = Carbon::parse($request->hora_inicio);
      $hora_inicio->format('H:i:s');

      $hora_final = Carbon::parse($request->hora_final);
      $hora_final->format('H:i:s');

      $dato = ActActividadesAsignaciones::find($id);
      $dato->act_estado_id = 5;
      $dato->fecha = $fecha;
      $dato->hora_inicio = $hora_inicio;
      $dato->hora_final = $hora_final;
      $dato->participantes = $request->participantes;
      $dato->observaciones = $request->observaciones;
      $dato->save();

      $i = 1;
      foreach ($request->fotos as $foto) {

       $nombre = str_random(40);
       $fileNameOrginal=$foto->getClientOriginalName();
       $fileName=$id.'-'.$nombre;
       $fileType=$foto->guessExtension();

       Storage::disk('local')->put($fileName,  \File::get($foto));
       $ubicacion = 'public/actividad/fotos/'.$fileName.'.'.$fileType;
       Storage::move($fileName, $ubicacion);

       $adjunto = new ActActividadesAdjunto();
       $adjunto->user_id = $dato->user_id;
       $adjunto->act_actividade_asignacion_id = $id;
       $adjunto->nombre = $fileName.'.'.$fileType;
       $adjunto->ruta = $ubicacion;
       $adjunto->save();

      }

      session()->flash('message', 'Guardado correctamente');
      return redirect('asignacion/'.$id);

    }


    public function descargar($id)
    {
      ini_set('max_execution_time', 5000);

      $row = ActActividadesAsignaciones::find($id);
      if (Auth::user()->rol_id == 10) {
        if ($row->actividad->sede->cliente->intermediario->identificacion != Auth::user()->documento ) {
           return redirect('404');
        }
      }
      if (Auth::user()->rol_id == 7) {
        if ($row->user_id != Auth::user()->id ) {
           return redirect('404');
        }
      }
      $imagenes = ActActividadesAdjunto::where('act_actividade_asignacion_id',$id)->get();

      //return view('actividad.actividades.asignacion.pdf', ['row' => $row, 'imagenes' => $imagenes]);

      $view =  \View::make('actividad.actividades.asignacion.pdf', ['row' => $row, 'imagenes' => $imagenes]);
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      //return $pdf->stream('simulador');
      return $pdf->download('actividad-'.$id.'.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividadesAsignaciones  $actActividadesAsignaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActActividadesAsignaciones $actActividadesAsignaciones)
    {
        //
    }
}
