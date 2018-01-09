<?php

namespace App\Http\Controllers\Actividad;

use App\Model\Actividad\Actividades\ActActividadesAsignaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = User::orderBy('id', 'desc')->where('rol_id',7)->paginate(30);
        return view('actividad.ajustes.profesores.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('actividad.ajustes.profesores.create');
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
        'documento' => 'required|unique:users|min:1',
        'name' => 'required|',
        'email' => 'required|unique:users',
        'password' => 'required|',
      ]);

      $row = new User();
      $row->documento = $request->documento;
      $row->name = $request->name;
      $row->email = $request->email;
      $row->password = crypt($request->password,"");
      $row->rol_id = 7;
      $row->estado = 1;
      $row->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('profesores/');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $rows = ActActividadesAsignaciones::orderBy('id', 'desc')->where('user_id',$id)->paginate(30);
      $row = User::find($id);
      return view('actividad.ajustes.profesores.show', compact('row'), ['rows' => $rows]);
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
      $request->validate([
        'name' => 'required|',
        'email' => 'required|',
      ]);

      $row = User::find($id);
      $row->name = $request->name;
      $row->email = $request->email;
      if($request->password){
        $row->password = crypt($request->password,"");
      }
      $row->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('profesores/'.$id);



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
