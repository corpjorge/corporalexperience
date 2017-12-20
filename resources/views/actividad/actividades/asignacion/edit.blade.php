@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Asignacion
        <small>Editar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Asignacion</li>
      </ol>
    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('asignacion/'.$row->id)}}">
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

      @if(session()->has('message'))
         <div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-check"></i> Realizado!</h4>
           {{session()->get('message')}}
         </div>
      @endif


      <div class="box box-primary" id="agregarSede" >
            <div class="box-header with-border">
              <h3 class="box-title">Editar:<br><br>ID:<b> {{$row->id}}</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'asignacion/'.$row->id, 'method' => 'put']) !!}
              <div role="form">
                <!-- text input -->

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Usuario</label>
                    @if ($row->fecha == null)
                      <select class="form-control"  placeholder="Seleccione" name="usuario">
                        <option value="{{$row->user_id}}">{{$row->usuario->name}}</option>
                        @foreach ($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                    @else
                      <select class="form-control" name="usuario" disabled="">
                        <option value="{{$row->user_id}}">{{$row->usuario->name}}</option>
                      </select>
                    @endif
              </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Fecha</label>
                  <input type="date" class="form-control" placeholder="Fecha" name="fecha" value="{{$row->fecha}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Hora Inicio</label>
                  <input type="time" class="form-control" placeholder="hora_inicio" name="hora_inicio" value="{{$row->hora_inicio}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Hora Final</label>
                  <input type="time" class="form-control" placeholder="hora_final" name="hora_final" value="{{$row->hora_final}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Observaciones</label>
                  <input type="text" class="form-control" placeholder="observaciones" name="observaciones" value="{{$row->observaciones}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Estado</label>
                  <select class="form-control"  placeholder="Seleccione" name="estado">
                    <option value="{{$row->act_estado_id}}">{{$row->estado->descripcion}}</option>
                    @foreach ($estados as $estado)
                      <option value="{{$estado->id}}">{{$estado->descripcion}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              </div>

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}




    </section>



@endsection
