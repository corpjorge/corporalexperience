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

      @if(session()->has('error'))
         <div class="alert alert-danger alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-check"></i> Error!</h4>
           {{session()->get('error')}}
         </div>
      @endif


      <div class="box box-primary" id="agregarSede" >
            <div class="box-header with-border">
              <h3 class="box-title">Editar:<br><br>ID:<b> {{$row->id}}</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'finalizar/'.$row->id, 'method' => 'post', 'files' => true]) !!}
              <div role="form">
                <!-- text input -->
              <div class="col-md-3">
                <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                  <label>Fecha:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="fecha" placeholder="dd/mm/aaaa" value="{{ old('fecha') }}" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="bootstrap-timepicker">
                 <div class="form-group">
                    <label>Hora inicio:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control timepicker" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="bootstrap-timepicker">
                 <div class="form-group">
                    <label>Hora final:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control timepicker" name="hora_final" value="{{ old('hora_final') }}" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Participantes</label>
                  <input type="Number" class="form-control" placeholder="Participantes" name="participantes" value="{{old('participantes')}}" min="1">
                </div>
              </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Observaciones</label>
                  <input type="text" class="form-control" placeholder="MAX 650 Caracteres" name="observaciones" value="{{old('observaciones')}}">
                </div>
              </div>
            </div><br><br>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Fotos</label>
                  <input name="fotos[]" type="file" accept="image/*" multiple>
                </div>
              </div>

              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-success">Finalizar</button>
              </div>




            </div>

            <!-- /.box-body -->
          </div>
{!! Form::close() !!}




@endsection
