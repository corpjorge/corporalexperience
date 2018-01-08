<?php

namespace App\Http\Controllers;

use App\Model\Actividad\Actividades\ActActividadesAsignaciones;
use App\Model\Actividad\Actividades\ActActividadesClient;
use Illuminate\Http\Request;
use App\User;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      ActActividadesClient::atrasados();

      // if (Auth::user()->rol_id == 7) {
      //   $actHoy = ActActividadesAsignaciones::actHoy(Auth::user()->id)->paginate(15);
      //   $actHoyTotal = ActActividadesAsignaciones::actHoy(Auth::user()->id)->count();
      //   $atrasados = ActActividadesAsignaciones::where('act_estado_id',4)->where('user_id',Auth::user()->id)->paginate(15);
      //   $realizadas = ActActividadesAsignaciones::realizadas(Auth::user()->id);
      //   return view('home-profe', compact('actHoyTotal', 'realizadas'), ['actHoy' => $actHoy, 'atrasados' => $atrasados]);
      // }
      if (Auth::user()->rol_id == 10) {
        $actHoy = ActActividadesAsignaciones::actHoyClient()->paginate(15);
        return view('home-client', ['actHoy' => $actHoy,]);
      }
       else {
         // $actHoy = ActActividadesAsignaciones::actHoyClient()->paginate(15);
         // $total = ActActividadesAsignaciones::actHoyClient()->count();
         // $atrasados = ActActividadesAsignaciones::where('act_estado_id',4)->paginate(15);
         return view('home');
      }

    }

    public function desactivar($doc)
    {
        $dato = User::where('documento', $doc)->first();
        if($dato->estado == 1){
          $dato->estado=0;
          $resultado = "Usuario Desactivado";
        }
        else{
          $dato->estado=1;
          $resultado = "Usuario Activado";
        }
        $dato->save();
        return $resultado;

    }
}
