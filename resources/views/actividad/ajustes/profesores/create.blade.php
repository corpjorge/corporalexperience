@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Añadir Profesor
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Añadir Profesor</li>
      </ol>
    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('profesores')}}">
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


      <div class="box box-primary" id="agregarSede">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Profesor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'profesores', 'method' => 'post']) !!}
              <div role="form">
                <!-- text input -->
                <div class="form-group {{ $errors->has('documento') ? ' has-error' : '' }}">
                  <label>Documento</label>
                  <input type="number" class="form-control" placeholder="Documento" name="documento" id="documento" value="{{ old('documento') }}" min="1" max="9999999999">
                </div>

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" name="name" id="name" value="{{ old('name') }}" >
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label>Correo</label>
                  <input type="text" class="form-control  " placeholder="Correo" name="email" value="{{ old('email') }}" >
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label>Contraseña</label>
                  <input type="password" class="form-control  " placeholder="Contraseña" name="password"  >
                </div>

              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info" ><i class="fa fa-fw fa-plus"></i> Añadir</button>

            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}




@endsection
