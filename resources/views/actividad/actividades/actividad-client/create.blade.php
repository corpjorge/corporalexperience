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
@if (Auth::user()->rol_id <= 2)
      <a class="btn btn-app" href="{{ url('sedes/create/'.$row->cliente->id)}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>
@else
  <a class="btn btn-app" href="{{ url('sedes')}}">
    <i class="fa fa-arrow-left"></i> Atras
  </a>
@endif
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
              <h3 class="box-title">Ingresar Actividad a:<br><br> {{$row->cliente->nombre}}<br>{{$row->direccion}} </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'actividades-client/'.$row->id, 'method' => 'post', 'id' => 'form']) !!}
              <div role="form">
                <!-- text input -->
              <div class="col-md-3">
                <div class="form-group {{ $errors->has('actividad') ? ' has-error' : '' }}">
                  <label>Actividad</label>
                  @if (Auth::user()->rol_id <= 2)
                  <input type="text" class="form-control" placeholder="Actividad" name="actividad" id="tags" value="{{ old('actividad') }}" required>
                @else
                  <select class="form-control" name="actividad" value="{{ old('actividad') }}" required>
                    <option value="">..Selecionar</option>
                    @foreach ($actividades as $actividad)
                    <option value="{{$actividad->nombre}}">{{$actividad->nombre}}</option>,
                    @endforeach


                  </select>
                 @endif
                </div>
              </div>

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
                <div class="form-group {{ $errors->has('nomina') ? ' has-error' : '' }}">
                  <label>Nomina</label>
                  <input type="text" class="form-control  " placeholder="Nomina" name="nomina" value="{{ old('nomina') }}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('pos') ? ' has-error' : '' }}">
                  <label>POS</label>
                  <input type="text" class="form-control" placeholder="POS" name="pos" value="{{ old('pos') }}" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group {{ $errors->has('edades') ? ' has-error' : '' }}">
                  <label>Edades</label>
                  <input type="text" class="form-control" placeholder="Edades" name="edades" value="{{ old('edades') }}" required>
                </div>
              </div>
@if (Auth::user()->rol_id <= 2)
              <div class="col-md-3">
                <div class="form-group {{ $errors->has('valor') ? ' has-error' : '' }}">
                  <label>Valor</label>
                  <input type="number" class="form-control" placeholder="$" name="valor" value="{{ old('valor') }}" required>
                </div>
              </div>
  @endif
              <div class="col-md-3">
                <div class="form-group {{ $errors->has('cargos') ? ' has-error' : '' }}">
                  <label>Cargos</label>
                  <input type="text" class="form-control tags" placeholder="cargos" name="cargos" id="tags_1" value="{{ old('cargos') }}" required>
                </div>
              </div>
@if (Auth::user()->rol_id <= 2)
              <div class="col-md-3">
                <div class="form-group required">
                    <label>Profesores</label><br>
                    @foreach ($users as $user)
                      <label>
                        <input type="checkbox" class="flat-red" value="{{$user->id}}" name="profesor[]"> {{$user->name}}
                      </label>
                    @endforeach
                </div>
              </div>
  @endif
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info" ><i class="fa fa-fw fa-plus"></i> Añadir</button>
                @if (Auth::user()->rol_id <= 2)
              <button type="submit" class="btn btn-success"  name="asignar" value="asignar" ><i class="fa fa-fw fa-plus"></i> Añadir y confirmar</button>
            @endif
              {{-- <a type="button" class="btn btn-default" href="{{ url('clientes')}}">Cancelar</a> --}}
            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}


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
                            <th>fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Ver</th>
                          </tr>
                          @foreach ($rows as $key)
                          <tr id="tabla_act_client">
                            <td>{{$key->id}}</td>
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
