@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cliente
        <small>Resumen del cliente</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Clientes</li>
      </ol>

    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('clientes')}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>
<br><br>

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

<div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{$row->nombre}}</h3>

              <p class="text-muted text-center">{{$row->identificacion}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Telefono</b> <a class="pull-right">{{$row->telefono}}</a><br><br>
                </li>
                <li class="list-group-item">
                  <b>Correo</b> <a class="pull-right">{{$row->correo}}</a><br><br>
                </li>
                <li class="list-group-item">
                  <b>Contacto</b> <a class="pull-right">{{$row->contacto}}</a><br><br>
                </li>
                <li class="list-group-item">
                  <b>Intermediario</b> <a class="pull-right">{{$row->intermediario->nombre}}</a><br><br>
                </li>
              </ul>
@if (Auth::user()->rol_id <= 2)

@if (!$permido)
  <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default">
    Convertir a usuario
  </button>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Confirmar</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['url' => 'clientes-permitir/'.$row->id, 'method' => 'post']) !!}
          <p>Permitir que este cliente inicie sesión con el correo:</p>
           <input type="text" class="form-control" id="email" placeholder="email" name="email" value="{{$row->correo}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="input" class="btn btn-primary">Permitir</button>
          {!! Form::close() !!}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@else

    @if ($permido->estado == 1)
      <button type="button" class="btn btn-danger btn-block" id="desactivar">
        Desactivar Usuario
      </button>
    @else
      <button type="button" class="btn btn-info btn-block" id="desactivar">
        Activar Usuario
      </button>
    @endif

@endif

  <script>
  $(document).ready(function(){
    $("#desactivar").click(function(e){
      e.preventDefault();

      var url  = "{{ url('user-desactivar/'.$row->identificacion) }}";

      $.get(url, function(result){
        $.bootstrapGrowl(result, {
          ele: 'body', // which element to append to
          type: 'success', // (null, 'info', 'danger', 'success')
          offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
          align: 'center', // ('left', 'right', or 'center')
          width: 250, // (integer, or 'auto')
          delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
          allow_dismiss: true, // If true then will display a cross to close the popup.
          stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
      }).fail(function(){
        $.bootstrapGrowl("No se agregó sede", {
          ele: 'body', // which element to append to
          type: 'danger', // (null, 'info', 'danger', 'success')
          offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
          align: 'center', // ('left', 'right', or 'center')
          width: 250, // (integer, or 'auto')
          delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
          allow_dismiss: true, // If true then will display a cross to close the popup.
          stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
      });
    });
  })

  </script>


@endif

            </div>
        </div>
</div>





    <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Actividades</a></li>
              <li><a href="#sedes" data-toggle="tab">Sedes</a></li>
              @if (Auth::user()->rol_id <= 2)
                <li><a href="#settings" data-toggle="tab">Datos</a></li>
              @endif
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                <div class="row">
                  <div class="col-xs-12">
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                          <tbody><tr>
                            <th>#</th>
                            <th>Actividad</th>
                            <th>fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Ver</th>
                          </tr>
                          @foreach ($actividades as $actividad)
                          <tr id="tabla_sedes">
                            <td>{{$actividad->id}}</td>
                            <td>{{$actividad->actividad->nombre}}</td>
                            <td>{{$actividad->fecha}}</td>
                            <td>
                              <?php $hora_inicio = \Carbon\Carbon::parse($actividad->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                              a
                              <?php $hora_final = \Carbon\Carbon::parse($actividad->hora_final); ?>{{$hora_final->format('h:i A')}}
                            </td>
                            @if (Auth::user()->rol_id <= 2)
                            <td>
                              @if ($actividad->estado->id == 1)
                                <a href="" data-toggle="modal" data-target="#modal-default_{{$actividad->id}}"><small class="label label-{{$actividad->estado->estilo}}"> {{$actividad->estado->descripcion}}</small></a>
                                <div class="modal fade" id="modal-default_{{$actividad->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      {!! Form::open(['url' => 'actividades-client/'.$actividad->id, 'method' => 'PUT']) !!}
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
                              @elseif ($actividad->estado->id == 2)
                                <a href="" data-toggle="modal" data-target="#modal-info_{{$actividad->id}}"><small class="label label-{{$actividad->estado->estilo}}"> {{$actividad->estado->descripcion}}</small></a>
                                <div class="modal modal-info fade" id="modal-info_{{$actividad->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                        {!! Form::open(['url' => 'actividades-client/'.$actividad->id, 'method' => 'PUT']) !!}
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
                                <a ><small class="label label-{{$actividad->estado->estilo}}"> {{$actividad->estado->descripcion}}</small></a>
                              @endif
                            </td>
                            @else
                             <td>
                              <small class="label label-{{$actividad->estado->estilo}}"> {{$actividad->estado->descripcion}}</small>
                             </td>
                            @endif
                            <td><a href="{{ url('actividades-client/'.$actividad->id)}}"><i class="fa fa-search"></i></a></td>
                          </tr>
                          @endforeach
                        </tbody></table>
                      </div>
                  </div>
                </div>
                {{ $actividades->links() }}

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="sedes">

                <div class="row">
                  <div class="col-xs-12">
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                          <tbody><tr>
                            <th>#</th>
                            <th>Dirección</th>
                            <th>contacto</th>
                            <th>Actividades</th>
                          </tr>
                          @foreach ($sedes as $sede)
                          <tr id="tabla_sedes">
                            <td>{{$sede->id}}</td>
                            <td><a href="https://maps.google.com/?q={{$sede->lat}},{{$sede->lng}}" target="_blank"> <i class="fa fa-map-marker"></i> </a>{{$sede->direccion}}</td>
                            <td><a href="{{ url('sedes/'.$sede->id)}}"><i class="fa fa-eye"></i></a> {{$sede->contacto}}</td>                            
                            <td><a href="{{ url('actividades-client/create/'.$sede->id)}}"><i class="fa fa-search"></i></a></td>
                          </tr>
                          @endforeach
                        </tbody></table>
                      </div>
                  </div>
                </div>

                {{ $sedes->links() }}

              </div>
              <!-- /.tab-pane -->
@if (Auth::user()->rol_id <= 2)


              <div class="tab-pane" id="settings">
                <div class="form-horizontal">
                  {!! Form::open(['url' => 'clientes/'.$row->id, 'method' => 'put']) !!}
                  {{-- <div class="form-group">
                    <label for="identificacion" class="col-sm-2 control-label">Identificacion</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="identificacion" placeholder="identificacion" name="identificacion" value="{{$row->identificacion}}">
                    </div>
                  </div> --}}
                  <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nombre" placeholder="nombre" name="nombre" value="{{$row->nombre}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="telefono" placeholder="telefono" name="telefono" value="{{$row->telefono}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="correo" class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" id="correo" placeholder="correo" name="correo" value="{{$row->correo}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contacto" class="col-sm-2 control-label">Contacto</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="contacto" placeholder="contacto" name="contacto" value="{{$row->contacto}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Actualizar</button>
                    </div>
                  </div>
                </div>
                {!! Form::close() !!}
              </div>
      @endif
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>




    </section>



@endsection
