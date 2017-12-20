<?php

namespace App\Http\Controllers\Actividad\Client;

use App\Model\Actividad\Client\ActClientFinal;
use App\Model\Actividad\Client\ActClientIntermediario;
use App\Model\Actividad\Actividades\ActActividadesClient;
use App\Model\Actividad\Client\ActClientSede;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

class FinalController extends Controller
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
      else {
        $cliente = ActClientIntermediario::where('identificacion',Auth::user()->documento)->first();
        $rows = ActClientIntermediario::find($cliente->id)->clientes()->paginate(30);
      }
      return view('actividad.client.final.index', ['rows' => $rows]);

    }

    public function permitir(Request $request, $id)
    {
      $request->validate([
        'email' => 'required|unique:users|',
      ]);

      $row = ActClientFinal::find($id);
      $dato = new User();
      $dato->documento = $row->identificacion;
      $dato->name = $row->nombre;
      $dato->email = $row->correo;
      $dato->password = "";
      $dato->rol_id = 10;
      $dato->estado = 1;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('clientes/'.$id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $rows = ActClientIntermediario::all();
      return view('actividad.client.final.create', ['rows' => $rows]);
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
        'identificacion' => 'required|unique:act_client_finals|unique:act_client_intermediarios|numeric|min:1|',
      ]);
        ActClientIntermediario::validacion($request);

        $datoFinal = new ActClientFinal();
        ActClientIntermediario::storeInter($request, $datoFinal);

        if($request->opc_intermediario == "SI") {
          $dato = new ActClientIntermediario();
          ActClientIntermediario::storeInter($request, $dato);
          $dato->save();
        }
        if($request->opc_intermediario == "NO") {
            $request->validate([
              'intermediario' => 'required',
            ]);
            $datoFinal->act_client_Inter_id=$request->intermediario;
        }else {
            $datoFinal->act_client_Inter_id=$dato->id;
        }
        $datoFinal->save();

        if ($request->sedes) {
           return redirect('sedes/create/'.$datoFinal->id);
        }
        else {
          session()->flash('message', 'Guardado correctamente');
          return redirect('clientes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Actividad\Client\ActClientFinal  $actClientFinal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $rows = ActClientIntermediario::find(1)->clientes()->paginate(30);
      $sedes = ActClientFinal::find($id)->sedes()->paginate(30);
      $actividades = ActClientFinal::find($id)->actividades()->paginate(30);
      $row = ActClientFinal::find($id);

      if (Auth::user()->rol_id == 10) {
        if ($row->intermediario->identificacion != Auth::user()->documento) {
          return redirect('404');
        }
      }

      $users = User::where('rol_id','7')->where('estado', 1)->orWhere('rol_id',2)->get();
      $permido = User::where('documento',$row->identificacion)->first();
      return view('actividad.client.final.show', compact('row','permido'), [ 'actividades' => $actividades, 'sedes' => $sedes, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Actividad\Client\ActClientFinal  $actClientFinal
     * @return \Illuminate\Http\Response
     */
    public function edit(ActClientFinal $actClientFinal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Actividad\Client\ActClientFinal  $actClientFinal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $actClientFinal)
    {
      $request->validate([
        // 'identificacion' => 'required|unique:act_client_finals|unique:act_client_intermediarios|numeric|min:1|',
        'nombre' => 'required|',
      ]);

      $dato = ActClientFinal::find($actClientFinal);
      $dato->nombre = $request->nombre;
      $dato->telefono = $request->telefono;
      $dato->correo = $request->correo;
      $dato->contacto = $request->contacto;
      $dato->save();
      session()->flash('message', 'Guardado correctamente');
      return redirect('clientes/'.$actClientFinal);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Actividad\Client\ActClientFinal  $actClientFinal
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActClientFinal $actClientFinal)
    {
        //
    }
}
