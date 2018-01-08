@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Programación
        <small>Resumen de las programación asignada</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Asignacion</li>
      </ol>
    </section>

    <section class="content container-fluid">

      @if(session()->has('message'))
         <div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{session()->get('message')}}
         </div>
      @endif

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <b><i class="fa fa-info"></i> Note:</b><br>
              Para confirmar el recibido de una actividad debe dar clic en el botón <b><i class="fa fa-check"></i> recibido</b><br>
              Para confirmar que se ha realizado una actividad debe dar clic en el icono <i class="fa fa-edit"></i> y finalizar la actividad con los datos solicitados</b><br>
              Para ver los detalles de clic en el icono <i class="fa fa-eye"></i><br>
              Para ver la dirección en <i class="fa fa-google"></i>oogle Maps de clic en el icono <i class="fa fa-map-marker"></i>
      </p>

      <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Atrasado</h3> <a href=""><i class="fa fa-refresh"></i></a>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-hover" >
                        <tbody><tr>
                          <th>#</th>
                          <th>Cliente</th>
                          <th>Actividad</th>
                          <th>Fecha</th>
                          <th>Estado</th>
                        </tr>
                        @foreach ($atrasados as $key)
                        <tr id="tabla_sedes">
                          <td>{{$key->id}}</td>
                          <td><a href="{{ url('sedes/'.$key->actividad->sede->id)}}"><i class="fa fa-eye"></i></a> {{$key->actividad->sede->cliente->nombre}}</td>
                          <td>{{$key->actividad->actividad->nombre}}</td>
                          <td><?php $fecha = \Carbon\Carbon::parse($key->actividad->fecha); ?>{{$fecha->format('d-m-Y')}}</td>
                          @if ($key->confirmacion == NULL)
                            <td><a href="{{ url('confirmar/'.$key->id)}}"><i class="fa fa-check"></i> Recibido</a></td>
                          @else
                            <td><a href="{{ url('asignacion/'.$key->id)}}"><small class="label label-{{$key->estado->estilo}}"><i class="fa fa-edit"></i> {{$key->estado->descripcion}}</small></a></td>
                          @endif
                        </tr>
                        @endforeach
                      </tbody></table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>

              </div>
{{ $atrasados->links() }}


                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Programación asignada <small class="label label-warning"> Pendientes</small></h3>

                      </div>
                      <!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                          <tbody><tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Sede</th>
                            <th>Actividad</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cerrar</th>
                          </tr>
                          @foreach ($rows as $key)
                          <tr id="tabla_sedes">
                            <td>{{$key->id}}</td>
                            <td><a href="{{ url('sedes/'.$key->actividad->sede->id)}}"><i class="fa fa-eye"></i></a> {{$key->actividad->sede->cliente->nombre}}</td>
                            <td><a href="https://maps.google.com/?q={{$key->actividad->sede->lat}},{{$key->actividad->sede->lng}}" target="_blank"><i class="fa fa-map-marker"></i> {{$key->actividad->sede->direccion}}</a></td>
                            <td>{{$key->actividad->actividad->nombre}}</td>
                            <td><?php $fecha = \Carbon\Carbon::parse($key->actividad->fecha); ?>{{$fecha->format('d-m-Y')}}</td>
                            <td>
                              <?php $hora_inicio = \Carbon\Carbon::parse($key->actividad->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                              a
                              <?php $hora_final = \Carbon\Carbon::parse($key->actividad->hora_final); ?>{{$hora_final->format('h:i A')}}
                            </td>
                            @if ($key->confirmacion == NULL)
                              <td><a href="{{ url('confirmar/'.$key->id)}}"><i class="fa fa-check"></i> Recibido</a></td>
                            @else
                              <td><a href="{{ url('asignacion/'.$key->id)}}"><i class="fa fa-edit"></i></a></td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody></table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
{{ $rows->links() }}
        </div>




    </section>




@endsection
