@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Participante
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Editar Participante</li>
      </ol>
    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('personas/'.$row->act_client_final_id.'/cliente')}}">
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
              <h3 class="box-title">Editar Participante</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'personas/'.$row->id, 'method' => 'put']) !!}
              <div role="form">
                <!-- text input -->
                {{-- <div class="form-group {{ $errors->has('identificacion') ? ' has-error' : '' }}">
                  <label>Identificacion</label>
                  <input type="number" class="form-control" placeholder="identificacion" name="identificacion" id="identificacion" value="{{ $row->identificacion }}" >
                </div> --}}

                <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="nombre" name="nombre" id="nombre" value="{{ $row->nombre }}" >
                </div>

                <div class="form-group {{ $errors->has('proceso') ? ' has-error' : '' }}">
                  <label>Proceso</label>
                  <input type="text" class="form-control  " placeholder="proceso" name="proceso" value="{{ $row->proceso }}" >
                </div>

                <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                  <label>Telefono</label>
                  <input type="number" class="form-control  " placeholder="telefono" name="telefono" value="{{ $row->telefono }}" >
                </div>
                <div class="form-group {{ $errors->has('correo') ? ' has-error' : '' }}">
                  <label>Correo</label>
                  <input type="mail" class="form-control  " placeholder="Correo" name="correo" value="{{ $row->correo }}" >
                </div>

                <div class="form-group {{ $errors->has('cliente') ? ' has-error' : '' }}">
                  <label>Correo</label>
                  <select class="form-control" name="cliente">
                    <option value="{{$row->cliente->id}}">{{$row->cliente->nombre}}</option>
                    @foreach ($rows as $row)
                      <option value="{{$row->id}}">{{$row->nombre}}</option>
                    @endforeach
                  </select>
                </div>

              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info" > Actualizar</button>

            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}




@endsection
