<?php

namespace App\Http\Controllers\Actividad\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Actividad\Client\ActClientPersona;
use App\Model\Actividad\Client\ActClientFinal;

use Auth;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::user()->rol_id <= 2) {
        $rows = ActClientFinal::orderBy('id', 'desc')->paginate(30);

      }
      // else {
      //   $cliente = ActClientIntermediario::where('identificacion',Auth::user()->documento)->first();
      //   $rows = ActClientIntermediario::find($cliente->id)->clientes()->paginate(30);
      // }
      return view('actividad.client.persona.index', [ 'rows' => $rows]);
    }


    public function cliente($id)
    {
        $rows = ActClientPersona::where('act_client_final_id',$id)->get();
        return view('actividad.client.persona.personas', [ 'rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $rows = ActClientFinal::all();
      return view('actividad.client.persona.create', [ 'rows' => $rows]);
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
        'identificacion' => 'required|unique:act_client_personas|min:1',
        'nombre' => 'required|',
        'cliente' => 'required|',
      ]);

      $dato = new ActClientPersona();
      $dato->identificacion = $request->identificacion;
      $dato->nombre = $request->nombre;
      $dato->proceso = $request->proceso;
      $dato->telefono = $request->telefono;
      $dato->correo = $request->correo;
      $dato->act_client_final_id = $request->cliente;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('personas/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $row = ActClientPersona::find($id);
      return view('actividad.client.persona.show', [ 'row' => $row]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $row = ActClientPersona::find($id);
      $rows = ActClientFinal::all();
      return view('actividad.client.persona.edit', compact('row'), [ 'rows' => $rows]);
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
      $request->validate([
        // 'identificacion' => 'required|unique:act_client_personas|',
        'nombre' => 'required|',
        'cliente' => 'required|',
      ]);

      $dato = ActClientPersona::find($id);
      // $dato->identificacion = $request->identificacion;
      $dato->nombre = $request->nombre;
      $dato->proceso = $request->proceso;
      $dato->telefono = $request->telefono;
      $dato->correo = $request->correo;
      $dato->act_client_final_id = $request->cliente;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('personas/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
