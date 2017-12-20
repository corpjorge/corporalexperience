@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asignacion
        <small>Resumen de las Asignaciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Asignacion</li>
      </ol>
    </section>

    <section class="content container-fluid">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Asignaciones</h3> <a href=""><i class="fa fa-refresh"></i></a>
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
                            @if (Auth::user()->rol_id <= 2)
                              <th>Profesor</th>
                            @endif
                            <th>Sede</th>
                            <th>Estado</th>
                          </tr>
                          @foreach ($rows as $key)
                          <tr id="tabla_sedes">
                            <td>{{$key->id}}</td>
                            @if (Auth::user()->rol_id <= 2)
                              <td>{{$key->usuario->name}}<a href="" target="_blank"></td>
                            @endif                            
                            <td><a href="{{ url('sedes/'.$key->actividad->sede->id)}}">{{$key->actividad->sede->direccion}}</a></td>
                            <td><a href="{{ url('asignacion/'.$key->id)}}"><small class="label label-{{$key->estado->estilo}}"> {{$key->estado->descripcion}}</small></a></td>
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
