@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Añadir Asistencia
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Añadir Asistencia</li>
      </ol>
    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('asignacion/'.$actividad->id)}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>

      <a class="btn btn-app" href="{{ url('asistencia-descargar/'.$actividad->id)}}">
        <i class="fa fa-download"></i> Descargar
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

      @if(session()->has('error'))
         <div class="alert alert-danger alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-check"></i> error!</h4>
           {{session()->get('error')}}
         </div>
      @endif


  @if (Auth::user()->rol_id != 10)

      <div class="box box-primary" id="agregarSede">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Persona</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'asistencia/'.$actividad->id, 'method' => 'post']) !!}
              <div role="form">
                <!-- text input -->
                <div class="form-group {{ $errors->has('identificacion') ? ' has-error' : '' }}">
                  <label>Identificacion</label>
                  <input type="number" class="form-control" placeholder="identificacion" name="identificacion" id="identificacion" value="{{ old('identificacion') }}" >
                </div>

              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info" ><i class="fa fa-fw fa-plus"></i> Añadir</button>

            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}

@endif

@if (Auth::user()->rol_id <= 2)
  {!! Form::open(['url' => 'asistencia/'.$actividad->id.'/eliminar', 'method' => 'post']) !!}
@endif
      <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Asistencia</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
              @foreach ($personas as $persona)

                @foreach ($rows as $key)

                  @if ($persona->id == $key->persona->id)
                  <li>
                    <label>
                      @if (Auth::user()->rol_id <= 2)
                        <input type="checkbox" value="{{$key->id}}" name="asistencia[]" >
                      @endif
                    <span class="text">{{$key->persona->identificacion}}: {{$key->persona->nombre}}</span>
                   </label>
                  </li>
                 @else

                @endif
                @endforeach

              @endforeach


              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              @if (Auth::user()->rol_id <= 2)
              <button type="submit" class="btn btn-default pull-right">Borrar Seleccionados</button>
            @endif
            </div>
          </div>
@if (Auth::user()->rol_id <= 2)
{!! Form::close() !!}
@endif





@endsection
