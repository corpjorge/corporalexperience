@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Activad
        <small>ID: {{$row->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Acividad</li>
      </ol>
    </section>



    <section class="content container-fluid">

      <a class="btn btn-app" href="javascript:history.back()">
        <i class="fa fa-arrow-left"></i> Atras
      </a>

      @if (count($errors) > 0)
  			<div class="alert alert-danger">
  					<strong>Error!</strong><br><br>
  					<ul>
  							@foreach ($errors->all() as $error)
  									<li>{{ $error }}</li>
  							@endforeach
  					</ul>
  			</div>
	    @endif

<div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body box-profile">

              <h3 class="profile-username text-center">{{$row->actividad->nombre}}</h3>

              <p class="text-muted text-center">{{$row->sede->direccion}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Fecha</b> <a class="pull-right">{{$row->fecha}}</a>
                </li>
                <li class="list-group-item">
                  <b>Hora</b> <a class="pull-right">{{$row->hora_inicio}} a {{$row->hora_final}}</a>
                </li>
                <li class="list-group-item">
                  <b>Nomina</b> <a class="pull-right">{{$row->nomina}}</a>
                </li>
                <li class="list-group-item">
                  <b>POS</b> <a class="pull-right">{{$row->nomina_pos}}</a>
                </li>
                <li class="list-group-item">
                  <b>Edades</b> <a class="pull-right">{{$row->nomina_edades}}</a>
                </li>
                <li class="list-group-item">
                  <b>Cargos</b> <a class="pull-right">{{$row->nomina_cargos}}</a>
                </li>
                <li class="list-group-item">
                  <b>Valor</b> <a class="pull-right">{{$row->valor}}</a>
                </li>
                <li class="list-group-item">
                  <b>Profesores: </b>
                  @foreach ($asignaciones as $asignacion)
                    @if ($row->act_estado_id == 3 OR Auth::user()->rol_id <= 2)
                     <a href="{{url('asignacion/'.$asignacion->id)}}" class="pull-right"><b>{{$asignacion->usuario->name}}</b></a><br>
                   @endif
                 @endforeach
                </li>
                <br>
                @if (Auth::user()->rol_id <= 2)
                <a href="{{ url('actividades-client/'.$row->id.'/edit')}}" class="btn btn-success" ><i class="fa fa-fw fa-edit"></i> Editar</a>

                @if ($row->act_estado_id == 1)
                  <button type="button" data-toggle="modal" data-target="#modal-default_{{$row->id}}" class="btn btn-{{$row->estado->estilo}}"> {{$row->estado->descripcion}}</button>
                  <div class="modal fade" id="modal-default_{{$row->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        {!! Form::open(['url' => 'actividades-client/'.$row->id, 'method' => 'PUT']) !!}
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
                @elseif ($row->act_estado_id == 2)
                  <button type="button" data-toggle="modal" data-target="#modal-info_{{$row->id}}" class="btn btn-{{$row->estado->estilo}}"> {{$row->estado->descripcion}}</button>
                  <div class="modal modal-info fade" id="modal-info_{{$row->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          {!! Form::open(['url' => 'actividades-client/'.$row->id, 'method' => 'PUT']) !!}
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">Ver asignacion</button>
                  <div class="modal modal-primary fade" id="modal-primary">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Usuarios asignados</h4>
                        </div>
                        <div class="modal-body">
                          @foreach ($asignaciones as $asignacion)
                            <p style="color:#000">{{$asignacion->usuario->name}} -<a href="{{url('asignacion/'.$asignacion->id)}}" style="color:#ffffff"> ver</a></p>
                          @endforeach
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                @endif

@endif

              </ul>
            </div>
        </div>
</div>


</section>

@endsection
