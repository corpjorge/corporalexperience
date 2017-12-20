<?php

namespace App\Http\Controllers\Actividad\Actividades;

use App\Model\Actividad\Actividades\ActActividades;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rows = ActActividades::orderBy('id', 'desc')->paginate(30);
      return view('actividad.ajustes.actividad.index', ['rows' => $rows]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        return view('actividad.ajustes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('actividad.ajustes.actividad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'nombre' => 'required|',
        'descripcion' => 'required|',
      ]);

      $row = new ActActividades();
      $row->nombre = $request->nombre;
      $row->descripcion = $request->descripcion;
      $row->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('actividad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividades  $actActividades
     * @return \Illuminate\Http\Response
     */
    public function show(ActActividades $ActActividades)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividades  $actActividades
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $row = ActActividades::find($id);
      return view('actividad.ajustes.actividad.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Actividades\ActActividades  $actActividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
          'nombre' => 'required|',
          'descripcion' => 'required|',
        ]);

        $row = ActActividades::find($id);
        $row->nombre = $request->nombre;
        $row->descripcion = $request->descripcion;
        $row->save();

        session()->flash('message', 'Guardado correctamente');
        return redirect('actividad/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Actividad\Actividades\ActActividades  $actActividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActActividades $actActividades)
    {
        //
    }
}
