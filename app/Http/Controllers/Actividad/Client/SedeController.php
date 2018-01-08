<?php

namespace App\Http\Controllers\Actividad\Client;

use App\Model\Actividad\Client\ActClientSede;
use App\Model\Actividad\Client\ActClientFinal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->rol_id == 1 OR Auth::user()->rol_id == 2) {
          $marcadores = ActClientSede::all();
          $rows = ActClientSede::orderBy('id', 'desc')->paginate(30);
        }
        else{
          $cliente = ActClientFinal::where('identificacion',Auth::user()->documento)->first();
          if ($cliente) {
            $marcadores = ActClientSede::where('act_client_final_id',$cliente->id)->get();
            $rows = ActClientSede::where('act_client_final_id',$cliente->id)->orderBy('id', 'desc')->paginate(30);
          }
          else{
            $marcadores = NULL;
            $rows = NULL;
          }
        }
        return view('actividad.client.sede.index', ['rows' => $rows, 'marcadores' => $marcadores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $row = ActClientFinal::find($id);
      $rows = ActClientSede::where('act_client_final_id',$id)->orderBy('id', 'desc')->paginate(20);
      return view('actividad.client.sede.create', compact('row'), ['rows' => $rows]);
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
        'contacto' => 'required|',
        'direccion' => 'required|unique:act_client_sedes',
        'lat' => 'required|',
        'lng' => 'required|',
      ]);
      //if($request->ajax()){

        $dato = new ActClientSede();
        $dato->contacto=$request->contacto;
        $dato->contacto_cargo=$request->contacto_cargo;
        $dato->correo=$request->correo;
        $dato->telefono=$request->telefono;
        $dato->direccion=$request->direccion;
        $dato->lat=$request->lat;
        $dato->lng=$request->lng;
        $dato->act_client_final_id=$id;
        $dato->save();
      //}

      session()->flash('message', 'Guardado correctamente');
      return redirect('sedes/create/'.$id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Actividad\Client\ActClientSede  $actClientSede
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $row = ActClientSede::find($id);

      if (Auth::user()->rol_id == 10) {
        if ($row->cliente->intermediario->identificacion != Auth::user()->documento ) {
          return redirect('404');
        }
      }
      return view('actividad.client.sede.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Actividad\Client\ActClientSede  $actClientSede
     * @return \Illuminate\Http\Response
     */
    public function edit($actClientSede)
    {
        $row = ActClientSede::find($actClientSede);
        return view('actividad.client.sede.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Client\ActClientSede  $actClientSede
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $actClientSede)
    {
      $request->validate([
        'contacto' => 'required|',
        'direccion' => 'required|',
        'lat' => 'required|',
        'lng' => 'required|',
      ]);

        $dato = ActClientSede::find($actClientSede);
        $dato->contacto=$request->contacto;
        $dato->contacto_cargo=$request->contacto_cargo;
        $dato->correo=$request->correo;
        $dato->telefono=$request->telefono;
        $dato->direccion=$request->direccion;
        $dato->lat=$request->lat;
        $dato->lng=$request->lng;
        $dato->save();

        session()->flash('message', 'Guardado correctamente');
        return redirect('sedes/'.$actClientSede.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Actividad\Client\ActClientSede  $actClientSede
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActClientSede $actClientSede)
    {
        //
    }
}
