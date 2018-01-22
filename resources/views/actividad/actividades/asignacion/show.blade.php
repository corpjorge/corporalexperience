@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asignacion
        <small>ID: {{$row->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Asignacions</li>
      </ol>
    </section>



    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('asignacion')}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>

      @if (Auth::user()->rol_id <=2 OR Auth::user()->rol_id == 7)
        @if($row->act_estado_id != 5)
          @if ($row->act_estado_id != 6)
          <a class="btn btn-app" href="{{ url('finalizar/'.$row->id)}}">
            <i class="fa fa-check"></i> Finalizar
          </a>
          @endif
        @endif
      @endif

      @if (Auth::user()->rol_id <=2 OR Auth::user()->rol_id == 10)
        @if($row->act_estado_id == 5)
          <a class="btn btn-app" href="{{ url('descargar/'.$row->id)}}">
            <i class="fa fa-download"></i> Descargar
          </a>

        @endif
      @endif



      <a class="btn btn-app" href="{{ url('asistencia/'.$row->id)}}">
        <i class="fa fa-odnoklassniki"></i> Asistencia
      </a>


    <div class="callout callout-{{$row->estado->estilo}}"> <h4>{{$row->estado->descripcion}}</h4> </div>

    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          <b><i class="fa fa-info"></i> Note:</b><br>
            Para confirmar que se ha realizado una actividad debe dar clic en el icono <i class="fa fa-check"></i> y finalizar la actividad con los datos solicitados</b><br>
    </p>


<div class="col-md-6">
      <div class="box box-primary">
        <div class="box-body box-profile">
              <h3 class="profile-username text-center">Actividad</h3>
              @if (Auth::user()->rol_id <= 2)
                <a href="{{ url('asignacion/'.$row->id.'/edit')}}"><p class="text-muted text-center"><i class="fa fa-edit" style="color:red;"></i> {{$row->usuario->name}}</p></a>
              @else
                <p class="text-muted text-center">{{$row->usuario->name}}</p>
              @endif

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Actividad</b> <a class="pull-right">{{$row->actividad->actividad->nombre}}</a>
                </li>
                <li class="list-group-item">
                  <b>Fecha Asignada</b> <a class="pull-right">{{$row->actividad->fecha}}</a>
                </li>
                <li class="list-group-item">
                  <b>Fecha Realizada</b>
                  @if ($row->fecha == null)
                    <a class="pull-right">Sin realizar</a>
                  @else
                    <a class="pull-right">{{$row->fecha}}</a>
                  @endif

                </li>
                @if (Auth::user()->rol_id <= 2)
                <li class="list-group-item">
                  <b>Hora Asignada</b> <a class="pull-right">
                    <?php $hora_inicio = \Carbon\Carbon::parse($row->actividad->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                    a
                    <?php $hora_final = \Carbon\Carbon::parse($row->actividad->hora_final); ?>{{$hora_final->format('h:i A')}}
                  </a>
                </li>
                @endif
                <li class="list-group-item">
                  <b>Hora Realizada</b> <a class="pull-right">
                    @if ($row->hora_inicio == null)
                      Sin Realizar
                    @else
                      <?php $hora_inicio = \Carbon\Carbon::parse($row->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                      a
                      <?php $hora_final = \Carbon\Carbon::parse($row->hora_final); ?>{{$hora_final->format('h:i A')}}
                    @endif

                  </a>
                </li>
                @if (Auth::user()->rol_id <= 2)
                <li class="list-group-item">
                  <b>Valor</b> <a class="pull-right">{{$row->actividad->valor}}</a>
                </li>
                @endif
                <li class="list-group-item">
                  <b>Observaciones</b> <a class="pull-right">{{$row->observaciones}}</a><br><br>
                </li>
              </ul>
            </div>
        </div>
</div>


<div class="col-md-6">
      <div class="box box-primary">
                <div class="box-body box-profile">
                  <h3 class="profile-username text-center">Sede</h3>

                      <p class="text-muted text-center">{{$row->actividad->sede->cliente->nombre}}</p>

                      <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                          <b>Nombre</b> <a class="pull-right">{{$row->actividad->sede->nombre}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Contacto</b> <a class="pull-right">{{$row->actividad->sede->contacto}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Correo</b> <a class="pull-right">{{$row->actividad->sede->correo}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Telefono</b> <a class="pull-right">{{$row->actividad->sede->telefono}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Intermediario</b> <a class="pull-right">{{$row->actividad->sede->cliente->intermediario->nombre}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Observacion</b> <a class="pull-right">{{$row->actividad->sede->observacion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Direccion</b> <a class="pull-right">{{$row->actividad->sede->direccion}}</a><br><br>
                        </li>
                      </ul>
                    </div>
        </div>
</div>
{{--
<div class="col-md-4">
      <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center">Datos</h3>

                  <p class="text-muted text-center">Actividad</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Nomina</b> <a class="pull-right">{{$row->actividad->nomina}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>POS</b> <a class="pull-right">{{$row->actividad->nomina_pos}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Edades</b> <a class="pull-right">{{$row->actividad->nomina_edades}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Cargos</b> <a class="pull-right">{{$row->actividad->nomina_cargos}}</a>
                    </li>

                  </ul>
                </div>


        </div>
</div> --}}


<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-body box-profile">
      <div class="row margin-bottom">
        <!-- /.col -->
        <div class="col-sm-12">
          <div class="row">

            @foreach ($imagenes as $imagen)


            <div class="col-sm-3">
              <img class="img-responsive" src="{{ asset('storage/actividad/fotos/'.$imagen->nombre)}}" alt="Imagen">
              <br>
            </div>

            @endforeach

            <!--  /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</div>


</section>


@endsection
