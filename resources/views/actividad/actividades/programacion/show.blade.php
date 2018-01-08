@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actividades Programadas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Profesores</li>
      </ol>
    </section>

    @if(session()->has('message'))
       <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Realizado!</h4>
         {{session()->get('message')}}
       </div>
    @endif

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('asignacion')}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>
@isset ($estado)
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <b><i class="fa fa-info"></i> Note:</b><br>

            @if ($estado->id == 1)
              Acá encontrara las actividades programadas las cuales <b>no tiene un profesor asignado.</b><br>
              Para asignar un profesor de clic en el botón <small class="label label-default"><i class="fa fa-edit"></i> Sin asignar</small><br>
              Para ver los detalles de clic en el icono <i class="fa fa-eye"></i>
            @endif
            @if ($estado->id == 2)
              Acá encontrar las actividades programadas las cuales<b> no se le han confirmado al cliente ni al profesor asignado.</b><br>
              Para confirmar la activad de clic en el botón <small class="label label-info"><i class="fa fa-edit"></i> Sin Confirmar</small>
              (Al confirmar la activad emitirá un correo tanto cliente como a los profesores asignados, es necesario esperar a que termine de cargar)<br>
              Para ver los detalles de clic en el icono <i class="fa fa-eye"></i>
            @endif
            @if ($estado->id == 3)
              Acá encontrara las actividades programadas las cuales <b>están pendientes por ser ejecutadas por el profesor.</b><br>
              Para ver los detalles de clic en el icono <i class="fa fa-eye"></i>
            @endif
            @if ($estado->id == 4)
              Acá encontrara las actividades programadas las cuales <b>el profesor no se ha cerrado en el sistema.</b><br>
              Para ver los detalles de clic en el icono <i class="fa fa-eye"></i>
            @endif

       </p>
@endisset
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Actividades</h3> <a href=""><i class="fa fa-refresh"></i></a>


            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" >
                <tbody><tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Actividad</th>
                  <th>fecha</th>
                  <th>Hora</th>
                  <th>Estado</th>
                  <th>Ver</th>
                </tr>
                @foreach ($rows as $key)
                <tr id="tabla_act_client">
                  <td>{{$key->id}}</td>
                  <td>{{$key->sede->cliente->nombre}}</td>
                  <td>{{$key->actividad->nombre}}</td>
                  <td><?php $fecha = \Carbon\Carbon::parse($key->fecha); ?>{{$fecha->format('d-m-Y')}}</td>
                  <td>
                    <?php $hora_inicio = \Carbon\Carbon::parse($key->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                    a
                    <?php $hora_final = \Carbon\Carbon::parse($key->hora_final); ?>{{$hora_final->format('h:i A')}}
                  </td>
                  @if (Auth::user()->rol_id <= 2)
                  <td>
                    @if ($key->estado->id == 1)
                      <a href="" data-toggle="modal" data-target="#modal-default_{{$key->id}}"><small class="label label-{{$key->estado->estilo}}"><i class="fa fa-edit"></i> {{$key->estado->descripcion}}</small></a>
                      <div class="modal fade" id="modal-default_{{$key->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            {!! Form::open(['url' => 'actividades-client/'.$key->id, 'method' => 'PUT']) !!}
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Asignar Profesores</h4>
                            </div>
                            <div class="modal-body">
                              @foreach ($users as $user)
                                <label>
                                  <input type="checkbox" class="flat-red" value="{{$user->id}}" name="profesor[]" > {{$user->name}}
                                </label>
                              @endforeach

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-primary" name="asignar" value="asignar">Asignar</button>
                            </div>
                            {!! Form::close() !!}
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    @elseif ($key->estado->id == 2)
                      <a href="" data-toggle="modal" data-target="#modal-info_{{$key->id}}"><small class="label label-{{$key->estado->estilo}}"><i class="fa fa-edit"></i> {{$key->estado->descripcion}}</small></a>
                      <div class="modal modal-info fade" id="modal-info_{{$key->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              {!! Form::open(['url' => 'actividades-client/'.$key->id, 'method' => 'PUT']) !!}
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Confirmar</h4>
                            </div>
                            <div class="modal-body">
                              <p>Confirmar actividad</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-outline" name="confirmar" value="confirmar">Confirmar</button>
                            </div>
                              {!! Form::close() !!}
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    @else
                       <small class="label label-{{$key->estado->estilo}}"> {{$key->estado->descripcion}}</small>
                    @endif
                  </td>
                 @else
                   <td><small class="label label-{{$key->estado->estilo}}"> {{$key->estado->descripcion}}</small></td>
                  @endif
                  <td><a href="{{ url('actividades-client/'.$key->id)}}"><i class="fa fa-eye"></i></a></td>
                </tr>
                @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      {{ $rows->links() }}



    </section>




@endsection
