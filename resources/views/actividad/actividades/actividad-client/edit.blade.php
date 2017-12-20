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

      <a class="btn btn-app" href="{{ url('actividades-client/create/'.$row->act_client_sede_id)}}">
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
              <h3 class="box-title">Editar Actividad a:<br><br> {{$row->sede->cliente->nombre}}<br>{{$row->sede->direccion}} </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'actividades-client/actualizar/'.$row->id, 'method' => 'post', 'id' => 'form']) !!}
              <div role="form">
                <!-- text input -->
              <div class="col-md-3">
                <div class="form-group {{ $errors->has('actividad') ? ' has-error' : '' }}">
                  <label>Actividad</label>
                  <input type="text" class="form-control" placeholder="Actividad" name="actividad" id="tags" value="{{$row->actividad->nombre}}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                  <label>Fecha:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="fecha" placeholder="dd/mm/aaaa" value="{{$row->fecha }}" required>
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
                      <input type="text" class="form-control timepicker" name="hora_inicio" value="{{  $row->hora_inicio }}" required>
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
                      <input type="text" class="form-control timepicker" name="hora_final" value="{{ $row->hora_final }}" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('nomina') ? ' has-error' : '' }}">
                  <label>Nomina</label>
                  <input type="text" class="form-control  " placeholder="Nomina" name="nomina" value="{{ $row->nomina }}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('pos') ? ' has-error' : '' }}">
                  <label>POS</label>
                  <input type="text" class="form-control" placeholder="POS" name="pos" value="{{ $row->nomina_pos }}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('edades') ? ' has-error' : '' }}">
                  <label>Edades</label>
                  <input type="text" class="form-control" placeholder="Edades" name="edades" value="{{ $row->nomina_edades }}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('valor') ? ' has-error' : '' }}">
                  <label>Valor</label>
                  <input type="number" class="form-control" placeholder="$" name="valor" value="{{ $row->valor }}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('cargos') ? ' has-error' : '' }}">
                  <label>Cargos</label>
                  <input type="text" class="form-control tags" placeholder="cargos" name="cargos" id="tags_1" value="{{ $row->nomina_cargos }}" required>
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



<script>
  $( function() {
    var availableTags = [
    @foreach ($actividades as $actividad)
    "{{$actividad->nombre}}",
    @endforeach
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
</script>


@endsection
