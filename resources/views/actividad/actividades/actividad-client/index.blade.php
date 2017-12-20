@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Añadir Actividad
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Añadir Actividad</li>
      </ol>
    </section>


    <section class="content container-fluid">



                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Actividades </h3> <a href=""><i class="fa fa-refresh"></i></a>

                        <div class="box-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-default" ><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                          <tbody><tr>
                            <th>#</th>
                            <th>Sede</th>
                            <th>fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Ver</th>
                          </tr>
                          @foreach ($rows as $key)
                          <tr id="tabla_act_client">
                            <td>{{$key->id}}</td>
                            <td>{{$key->sede->direccion}} - <b>{{$key->actividad->nombre}}<b></td>
                            <td>{{$key->fecha}}</td>
                            <td>
                              <?php $hora_inicio = \Carbon\Carbon::parse($key->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                              a
                              <?php $hora_final = \Carbon\Carbon::parse($key->hora_final); ?>{{$hora_final->format('h:i A')}}
                            </td>
                            @if (Auth::user()->rol_id <= 2)
                            <td>
                              @if ($key->estado->id == 1)
                                <a href="" data-toggle="modal" data-target="#modal-default_{{$key->id}}"><small class="label label-{{$key->estado->estilo}}"> {{$key->estado->descripcion}}</small></a>
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
                                <a href="" data-toggle="modal" data-target="#modal-info_{{$key->id}}"><small class="label label-{{$key->estado->estilo}}"> {{$key->estado->descripcion}}</small></a>
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
                            <td><a href="{{ url('actividades-client/'.$key->id)}}"><i class="fa fa-search"></i></a></td>
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
