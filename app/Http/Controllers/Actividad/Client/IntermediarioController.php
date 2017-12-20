<?php

namespace App\Http\Controllers\Actividad\Client;

use App\Model\Actividad\Client\ActClientIntermediario;
use App\Model\Actividad\Client\ActClientFinal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntermediarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rows = ActClientIntermediario::orderBy('id', 'desc')->paginate(30);
      return view('actividad.ajustes.intermediario.index', ['rows' => $rows]);
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
     * @param  \App\Model\Actividad\Client\ActClientIntermediario  $actClientIntermediario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $row = ActClientIntermediario::find($id);
      $rows = ActClientFinal::where('act_client_Inter_id',$id)->orderBy('id', 'desc')->paginate(30);
      return view('actividad.ajustes.intermediario.show', compact('row'), ['rows' => $rows]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Actividad\Client\ActClientIntermediario  $actClientIntermediario
     * @return \Illuminate\Http\Response
     */
    public function edit(ActClientIntermediario $actClientIntermediario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Client\ActClientIntermediario  $actClientIntermediario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'nombre' => 'required|',
        'telefono' => 'required|',
        'correo' => 'required|',
        'contacto' => 'required|',
      ]);

      $row = ActClientIntermediario::find($id);
      $row->nombre = $request->nombre;
      $row->telefono = $request->telefono;
      $row->correo = $request->correo;
      $row->contacto = $request->contacto;
      $row->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('intermediario/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Actividad\Client\ActClientIntermediario  $actClientIntermediario
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActClientIntermediario $actClientIntermediario)
    {
        //
    }
}
